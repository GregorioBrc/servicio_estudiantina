<?php

namespace App\Http\Controllers;

use App\Models\inventario;
use App\Models\prestamo;
use Illuminate\Http\Request;


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
     * Actualiza un recurso específico en la base de datos.
     */
    public function update(Request $request, inventario $inventario)
    {
        // Valida los datos de entrada para la actualización.
        $validated = $request->validate([
            'partitura_id' => 'required|integer|exists:partituras,id',
            'estante_id' => 'required|integer|exists:estantes,id',
            'cantidad' => 'required|integer|min:0', // Permitimos 0 por si se acaba el stock.
             // Añade aquí otras validaciones.
        ]);

        // Actualiza el objeto $inventario con los datos validados.
        $inventario->update($validated);

        // Redirige al listado principal con un mensaje de éxito.
        return redirect()->route('inventario.index')
            ->with('success', 'Ítem de inventario actualizado exitosamente.');
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
        $Res->Cosa1 = $request;

        $query = prestamo::with(['inventario.partitura.obra', 'Usuario_Inventario'])
            ->select('prestamos.*')
            ->orderBy('fecha_prestamo', 'desc');

        // Búsqueda global
        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhereHas('inventario.partitura.obra', function($q) use ($search) {
                      $q->where('titulo', 'like', "%{$search}%");
                  })
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  })
                  ->orWhere('descripcion', 'like', "%{$search}%");
            });
        }

        // Ordenamiento
        if ($request->has('order')) {
            $columns = ['id', 'obra_titulo', 'instrumento', 'cantidad', 'usuario_nombre', 'usuario_email', 'fecha_prestamo', 'descripcion'];
            $column = $columns[$request->order[0]['column']] ?? 'id';
            $direction = $request->order[0]['dir'] ?? 'asc';
            
            if ($column === 'obra_titulo') {
                $query->join('inventarios', 'prestamos.inventario_id', '=', 'inventarios.id')
                      ->join('partituras', 'inventarios.partitura_id', '=', 'partituras.id')
                      ->join('obras', 'partituras.obra_id', '=', 'obras.id')
                      ->orderBy('obras.titulo', $direction)
                      ->select('prestamos.*');
            } elseif ($column === 'instrumento') {
                $query->join('inventarios', 'prestamos.inventario_id', '=', 'inventarios.id')
                      ->orderBy('inventarios.instrumento', $direction)
                      ->select('prestamos.*');
            } elseif ($column === 'usuario_nombre' || $column === 'usuario_email') {
                $query->join('users', 'prestamos.user_id', '=', 'users.id')
                      ->orderBy($column === 'usuario_nombre' ? 'users.name' : 'users.email', $direction)
                      ->select('prestamos.*');
            } else {
                $query->orderBy($column, $direction);
            }
        }

        $totalRecords = Prestamo::count();
        $filteredRecords = $query->count();

        // Paginación
        $prestamos = $query
            ->get();


        $Res->prestamos = $prestamos;
        $Res->totalRecords = $totalRecords;
        $Res->filteredRecords = $filteredRecords;
        return response()->json($Res);

    }

    


}

