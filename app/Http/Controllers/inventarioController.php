<?php

namespace App\Http\Controllers;

use App\Models\inventario;
use App\Models\prestamo;
use Illuminate\Http\Request;
use App\Models\estante;
use Illuminate\Support\Facades\DB;


class inventarioController extends Controller
{
    /**
     * Muestra una lista de todos los recursos del inventario.
     */
    public function index()
    {
        // Obtiene todos los items del inventario, paginados de 10 en 10.
        $inventarios = inventario::get();

        // Retornar json.
        return $inventarios;
    }


    /**
     * Almacena un nuevo recurso recién creado.
     */
    public function store(Request $request)
    {
        // Valida los datos de entrada.
        $validated = $request->validate([
            'partitura_id' => 'required|integer|exists:partituras,id', // Es buena práctica verificar que el id exista en la tabla partituras.
            'estante_id' => 'required|integer|exists:estantes,id',   // Y también en la tabla estantes.
            'cantidad' => 'required|integer|min:1',
            // Añade aquí otras validaciones si tu tabla 'inventario' tiene más campos.
        ]);

        // Comprueba si ya existe un ítem con la misma partitura y estante.
        $itemExists = inventario::where('partitura_id', $validated['partitura_id'])
                                 ->where('estante_id', $validated['estante_id'])
                                 ->exists(); // Usar exists() es más eficiente que first() o get().

        if ($itemExists) {
            // Si el ítem ya existe, redirige hacia atrás con un mensaje de error.
            return redirect()->back()->with('error', 'Este ítem ya existe en el inventario.');
        }

        // Crea el nuevo registro en el inventario.
        inventario::create($validated);

        // Redirige al listado principal con un mensaje de éxito.
        return redirect()->route('inventario.index')
            ->with('success', 'Ítem de inventario creado exitosamente.');
    }

    /**
     * Muestra un recurso específico.
     */
    public function show(inventario $inventario)
    {
        // Gracias al Route Model Binding de Laravel, ya tenemos el objeto $inventario.
        // Se lo pasamos a la vista 'show'.
        return view('inventario.show', compact('inventario'));
    }

    /**
     * Actualiza inventario.
     */
    public function update(Request $request, int $partitura_id, int $estante_id_original)
    {
        $validated = $request->validate([
            'cantidad' => 'required|integer|min:0', // Cantidad a asignar
            'gaveta'   => 'required|string|max:255' // Nombre del estante de DESTINO
        ]);

        try {
            // Usamos una transacción para que la operación de "mover" sea segura.
            // O todo se completa, o nada cambia.
            DB::transaction(function () use ($validated, $partitura_id, $estante_id_original) {
                
                // 1. VERIFICAR QUE EL REGISTRO ORIGINAL EXISTE
                $inventarioOriginal = DB::table('inventario')
                    ->where('partitura_id', $partitura_id)
                    ->where('estante_id', $estante_id_original)
                    ->first();

                if (!$inventarioOriginal) {
                    abort(404, 'El registro de inventario que intentas modificar no existe.');
                }

                // 2. OBTENER EL ESTANTE DE DESTINO
                // Si el estante con el nombre 'gaveta' no existe, lo crea.
                // Si ya existe, simplemente lo obtiene.
                $estanteDestino = estante::firstOrCreate(
                    ['gaveta' => trim($validated['gaveta'])]
                );

                // 3. DECIDIR LA ACCIÓN BASADO EN SI EL ESTANTE CAMBIÓ O NO
                
                if ($estanteDestino->id == $estante_id_original) {
                    // --- CASO A: EL ESTANTE NO CAMBIA ---
                    // El nombre de la gaveta corresponde al mismo estante original.
                    // Simplemente actualizamos la cantidad.
                    
                    DB::table('inventario')
                        ->where('partitura_id', $partitura_id)
                        ->where('estante_id', $estante_id_original)
                        ->update(['Cantidad' => $validated['cantidad']]);

                } else {
                    // --- CASO B: EL ESTANTE CAMBIA (SE MUEVE LA PARTITURA) ---
                    // El nombre de la gaveta es diferente al original.

                    // Paso 1: Eliminar el registro del estante antiguo.
                    DB::table('inventario')
                        ->where('partitura_id', $partitura_id)
                        ->where('estante_id', $estante_id_original)
                        ->delete();

                    // Paso 2: Crear o actualizar el registro en el nuevo estante.
                    // `updateOrInsert` es perfecto para esto:
                    // - Busca si ya hay un registro para esa partitura en el nuevo estante.
                    // - Si lo hay, actualiza su cantidad (útil si mueves partituras a un estante donde ya había de las mismas).
                    // - Si no lo hay, crea el nuevo registro.
                    DB::table('inventario')->updateOrInsert(
                        [
                            'partitura_id' => $partitura_id,
                            'estante_id'   => $estanteDestino->id
                        ],
                        [
                            'Cantidad'     => $validated['cantidad']
                        ]
                    );
                }
            });

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el inventario: ' . $e->getMessage()
            ], $e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException || $e->getCode() == 404 ? 404 : 500);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Inventario actualizado exitosamente'
        ]);
    }

    /**
     * Elimina un recurso específico de la base de datos.
     */
    public function destroy(inventario $inventario)
    {
        // Elimina el registro de la base de datos.
        $inventario->delete();

        // Redirige al listado principal con un mensaje de éxito.
        return redirect()->route('inventario.index')
            ->with('success', 'Ítem de inventario eliminado exitosamente.');
    }


    public function apigetPartiturasData(Request $request){

        $Res = new \stdClass();

        $query = inventario::with(['partitura.obra.contribuciones.autor', 'partitura.obra.contribuciones.tipoContribucion', 'estante', 'partitura.instrumento'])
            ->select('inventario.*')
            ->whereHas('partitura.obra')
            ->where('cantidad', '>', 0);

        // Búsqueda global
        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $query->where(function($q) use ($search) {
                // Search in obra data
                $q->whereHas('partitura.obra', function($q) use ($search) {
                    $q->where('titulo', 'like', "%{$search}%")
                      ->orWhere('anio', 'like', "%{$search}%");
                })
                  ->orWhereHas('partitura.obra.contribuciones.autor', function($q) use ($search) {
                      $q->where('nombre', 'like', "%{$search}%")
                        ->orWhere('apellido', 'like', "%{$search}%");
                  })
                  ->orWhereHas('partitura.obra.contribuciones.tipoContribucion', function($q) use ($search) {
                      $q->where('nombre_contribucion', 'like', "%{$search}%");
                  })
                  ->orWhereHas('partitura.instrumento', function($q_instrumento) use ($search) {
                    // Asume que la columna en la tabla 'instrumentos' se llama 'nombre'
                    $q_instrumento->where('nombre', 'like', "%{$search}%");
                    })
                  ->orWhereHas('estante', function($q) use ($search) {
                      $q->where('gaveta', 'like', "%{$search}%");
                  });
            });
        }

        // Ordenamiento
        if ($request->has('order')) {
            $columns = ['titulo', 'autor', 'tipo_contribucion', 'anio', 'instrumento', 'cantidad', 'gaveta'];
            $column = $columns[$request->order[0]['column']] ?? 'titulo';
            $direction = $request->order[0]['dir'] ?? 'asc';
            
            if ($column === 'autor') {
                $query->join('partituras', 'inventarios.partitura_id', '=', 'partituras.id')
                      ->join('obras', 'partituras.obra_id', '=', 'obras.id')
                      ->join('contribuciones', 'obras.id', '=', 'contribuciones.obra_id')
                      ->join('autores', 'contribuciones.autor_id', '=', 'autores.id')
                      ->orderBy('autores.nombre', $direction)
                      ->select('inventarios.*');
            } elseif ($column === 'tipo_contribucion') {
                $query->join('partituras', 'inventarios.partitura_id', '=', 'partituras.id')
                      ->join('obras', 'partituras.obra_id', '=', 'obras.id')
                      ->join('contribuciones', 'obras.id', '=', 'contribuciones.obra_id')
                      ->join('tipo_contribuciones', 'contribuciones.tipo_contribucion_id', '=', 'tipo_contribuciones.id')
                      ->orderBy('tipo_contribuciones.nombre_contribucion', $direction)
                      ->select('inventarios.*');
            } elseif ($column === 'titulo' || $column === 'anio') {
                $query->join('partituras', 'inventarios.partitura_id', '=', 'partituras.id')
                      ->join('obras', 'partituras.obra_id', '=', 'obras.id')
                      ->orderBy("obras.$column", $direction)
                      ->select('inventarios.*');
            } elseif ($column === 'gaveta') {
                $query->join('estantes', 'inventarios.estante_id', '=', 'estantes.id')
                      ->orderBy('estantes.gaveta', $direction)
                      ->select('inventarios.*');
            } else {
                $query->orderBy($column, $direction);
            }
        }

        $totalRecords = inventario::where('cantidad', '>', 0)->count();
        $filteredRecords = $query->count();

        // Paginación
        $inventarios = $query
            ->get();

        $Res->inventarios = $inventarios;
        $Res->totalRecords = $totalRecords;
        $Res->filteredRecords = $filteredRecords;
        return response()->json($Res);
    }

    
     public function apigetPrestamosData(Request $request){

        $Res = new \stdClass();

        // --- 1. Eager Loading con los NOMBRES CORRECTOS de tus relaciones ---
        // Usamos 'Partitura' y 'Usuario_Inventario' tal como los definiste en el modelo.
        $query = Prestamo::with([
            'Partitura.obra',          // Para obtener el título de la obra
            'Partitura.instrumento',   // Para obtener el nombre del instrumento
            'Usuario_Inventario',      // Para obtener los datos del usuario
            'Estante'                  // Para obtener la gaveta
        ]);

        // --- 2. Búsqueda global usando las RUTAS CORRECTAS ---
        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $query->where(function($q) use ($search) {
                $q->where('descripcion', 'like', "%{$search}%")
                ->orWhere('estado', 'like', "%{$search}%") // Buscamos por el nuevo campo estado
                ->orWhereHas('Partitura.obra', function($q_obra) use ($search) {
                    $q_obra->where('titulo', 'like', "%{$search}%");
                })
                ->orWhereHas('Partitura.instrumento', function($q_instrumento) use ($search) {
                    $q_instrumento->where('nombre', 'like', "%{$search}%");
                })
                ->orWhereHas('Usuario_Inventario', function($q_usuario) use ($search) {
                    // Tu JSON muestra 'nombre' y 'correo'
                    $q_usuario->where('nombre', 'like', "%{$search}%")
                                ->orWhere('correo', 'like', "%{$search}%");
                });
            });
        }

        // --- 3. Ordenamiento usando los JOINS y nombres de columna CORRECTOS ---
        if ($request->has('order')) {
            $columns = [
                // Mapeamos el índice de la columna de DataTables a la columna real en la BD
                // Usamos los nombres de columna de tu schema original
                1 => 'obras.titulo',
                2 => 'instrumentos.nombre',
                3 => 'prestamos.cantidad',
                4 => 'usuarios_inventario.nombre',
                5 => 'usuarios_inventario.correo',
                6 => 'prestamos.created_at',       // Reemplazamos fecha_prestamo
                7 => 'prestamos.fecha_devolucion', // Nuevo campo
                8 => 'prestamos.estado'            // Nuevo campo
            ];
            
            $columnIndex = $request->order[0]['column'];
            $column = $columns[$columnIndex] ?? 'prestamos.created_at'; // Orden por defecto
            $direction = $request->order[0]['dir'] ?? 'desc';
            
            $query->reorder(); // Limpia cualquier ordenamiento previo

            // Añadimos los joins necesarios solo para la columna que se está ordenando
            if (str_contains($column, 'usuarios_inventario')) {
                $query->join('usuarios_inventario', 'prestamos.usuario_inventario_id', '=', 'usuarios_inventario.id');
            }
            if (str_contains($column, 'obras') || str_contains($column, 'instrumentos')) {
                $query->join('partituras', 'prestamos.partitura_id', '=', 'partituras.id');
                if (str_contains($column, 'obras')) {
                    $query->join('obras', 'partituras.obra_id', '=', 'obras.id');
                }
                if (str_contains($column, 'instrumentos')) {
                    $query->join('instrumentos', 'partituras.instrumento_id', '=', 'instrumentos.id');
                }
            }
            
            // Aplicamos el ordenamiento y seleccionamos solo las columnas de prestamos
            // para evitar conflictos y asegurar que el 'with()' funcione bien.
            $query->orderBy($column, $direction)->select('prestamos.*');

        } else {
            // Orden por defecto si no se especifica uno
            $query->orderBy('prestamos.created_at', 'desc');
        }

        $totalRecords = Prestamo::count();
        $prestamos = $query->get();
        $filteredRecords = $prestamos->count();

        $Res->prestamos = $prestamos;
        $Res->totalRecords = $totalRecords;
        $Res->filteredRecords = $filteredRecords;
        
        return response()->json($Res);
    }
    


}

