<?php

namespace App\Http\Controllers;

use App\Models\prestamo;
use App\Models\inventario;
use App\Models\estante;
use App\Models\usuario_inventario;
use App\Models\partitura;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validated = $request->validate([
            'descripcion' => 'string|max:255',
            'cantidad' => 'required,integer',
            'usuario_inventario_id' => 'required|integer|exists:partituras,id',
            'partitura_id' => 'required|integer|exists:partituras,id',
            'estante_id' => 'required,integer,exists:estante,id',
        ]);

        prestamo::create($validated);

        return redirect()->route('prestamos.index')->with('success', 'Prestamo created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(prestamo $prestamo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(prestamo $prestamo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(prestamo $prestamo)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(prestamo $prestamo)
    {
        //
    }

    public function apiSolicitarPrestamo(Request $request)
    {
        
        if (! $request->expectsJson()) {
            $request->headers->set('Accept', 'application/json');
        }

        $validated = $request->validate([
            'email'                 => 'required_without:usuario_inventario_id|email',
            'usuario_inventario_id' => 'required_without:email|integer|exists:usuarios_inventario,id',

            'partitura_id' => 'required|exists:partituras,id',
            'cantidad' => 'required|integer|min:1',
            'instrumento' => 'required|string', // Lo usamos para la descripción
        ]);

        // Resolver el usuario_inventario_id
        $usuario = null;
        if (!empty($validated['usuario_inventario_id'])) {
            $usuario = usuario_inventario::find($validated['usuario_inventario_id']);
        }
        if (!$usuario && !empty($validated['email'])) {
            $usuario = usuario_inventario::where('correo', $validated['email'])->first();
        }
        if (!$usuario) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario inventario no encontrado'
            ], 404);
        }
    
    if (empty($estanteId)) {
    $estanteId = \DB::table('inventario')
        ->where('partitura_id', (int) $validated['partitura_id'])
        ->value('estante_id');
}

    $estanteId = $estanteId ?: 1;

    $obraTitulo = $request->input('obra_titulo') ?? $request->input('titulo');
    if (!$obraTitulo) {
        $p = partitura::with('obra')->find($validated['partitura_id']);
        $obraTitulo = optional($p?->obra)->titulo;
    }
        // La tabla 'prestamos' en el servidor es diferente a la del cliente.
        // Adaptamos los datos para que coincidan.
    $prestamo = \App\Models\prestamo::create([
        'descripcion'           => "Solicitud para {$validated['instrumento']}",
        'cantidad'              => (int) $validated['cantidad'],
        'usuario_inventario_id' => $usuario->id,
        'partitura_id'          => (int) $validated['partitura_id'],
        'estante_id'            => $estanteId,

        'obra_titulo'           => $obraTitulo,
        'fecha_prestamo'        => $request->input('fecha_prestamo', now()),
        'fecha_devolucion'      => $request->input('fecha_devolucion'),
        'estado'                => $request->input('estado', 'Pendiente'),
]);

        return response()->json([
            'success' => true,
            'message' => 'Solicitud de préstamo creada en el servidor.',
            'prestamo_id' => $prestamo->id
        ]);
    }

    public function apiProcesarPrestamo(Request $request, $id)
    {
        // 1. Validar la entrada: esperamos una 'accion' que sea 'aceptar' o 'rechazar'.
        try {
            $validated = $request->validate([
                'accion' => 'required|string|in:aceptar,rechazar'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Acción no válida. Se esperaba "aceptar" o "rechazar".',
                'errors' => $e->errors()
            ], 422); // 422 Unprocessable Entity
        }

        // Usamos una transacción para asegurar la integridad de los datos.
        // Si algo falla (ej. no hay stock), se revierte toda la operación.
        DB::beginTransaction();

        try {
            // 2. Buscar el préstamo en la base de datos del servidor.
            $prestamo = \App\Models\prestamo::find($id);

            // Si el préstamo no se encuentra, devolvemos un error 404.
            if (!$prestamo) {
                return response()->json([
                    'success' => false,
                    'message' => "No se encontró el préstamo con ID {$id} en el servidor."
                ], 404); // 404 Not Found
            }

            $accion = $validated['accion'];
            $partituraId = $prestamo->partitura_id;
            $cantidadSolicitada = $prestamo->cantidad;

            // 3. Lógica para ACEPTAR la solicitud
            if ($accion === 'aceptar') {
                // Buscamos el registro en la tabla 'inventario' para esta partitura.
                $inventario = DB::table('inventario')
                                ->where('partitura_id', $partituraId)
                                ->first();

                if (!$inventario) {
                    throw new \Exception("No hay registro de inventario para la partitura ID {$partituraId}.");
                }

                // Calculamos la cantidad ya prestada para esta partitura.
                $cantidadYaPrestada = \App\Models\prestamo::where('partitura_id', $partituraId)->sum('cantidad');
                
                // Calculamos la disponibilidad.
                $cantidadDisponible = $inventario->Cantidad - $cantidadYaPrestada;

                // Verificamos si hay suficiente stock.
                if ($cantidadDisponible < $cantidadSolicitada) {
                    throw new \Exception("Stock insuficiente para la partitura ID {$partituraId}. Disponible: {$cantidadDisponible}, Solicitado: {$cantidadSolicitada}.");
                }

                // Si hay stock, la solicitud se considera "activa".
                // En tu estructura actual, un préstamo que existe en la tabla es un préstamo activo.
                // Así que no necesitamos cambiarle ningún estado. Simplemente confirmamos la transacción.
                
                DB::commit(); // Confirmamos la transacción.

                return response()->json([
                    'success' => true,
                    'message' => "Préstamo ID {$id} aceptado. El stock fue verificado."
                ]);
            }

            // 4. Lógica para RECHAZAR la solicitud
            if ($accion === 'rechazar') {
                // Si la solicitud se rechaza, simplemente la eliminamos de la tabla de préstamos.
                $prestamo->delete();
                
                DB::commit(); // Confirmamos la transacción (la eliminación).

                return response()->json([
                    'success' => true,
                    'message' => "Préstamo ID {$id} rechazado y eliminado."
                ]);
            }

        } catch (\Exception $e) {
            // 5. Si ocurre cualquier error durante el proceso, revertimos todo.
            DB::rollBack();

            // Devolvemos un error 500 con el mensaje específico del problema.
            return response()->json([
                'success' => false,
                'message' => 'Error interno del servidor: ' . $e->getMessage()
            ], 500); // 500 Internal Server Error
        }
    }

    public function apiPrestamosPendientes(Request $request)
    {
        try {
            // Obtenemos todos los préstamos SIN intentar cargar relaciones complejas.
            $prestamos = \App\Models\prestamo::all();

            // Devolvemos la colección tal cual.
            return response()->json($prestamos);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error en el servidor al obtener la lista de préstamos: ' . $e->getMessage()
            ], 500);
        }
    }

    public function apiMisPrestamos(Request $request)
    {
        // NOTA: Por ahora, esto devuelve una lista vacía porque no sabemos qué usuario está pidiendo sus préstamos.
        // Más adelante, cuando implementemos autenticación, aquí buscaremos los préstamos del usuario autenticado.
        return response()->json([
            'success' => true,
            'prestamos' => []
        ]);
    }


    
}
