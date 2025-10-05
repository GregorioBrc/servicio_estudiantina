<?php

namespace App\Http\Controllers;

use App\Models\tipo_contribucion;
use Illuminate\Http\Request;

class tipoContribucionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipo_contribuciones = tipo_contribucion::paginate(10);
        return view("admin.tipo_contribucion.index", ["tiposContribucion" => $tipo_contribuciones]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.tipo_contribucion.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_contribucion' => 'required|string|max:255|unique:tipo_contribuciones,nombre_contribucion',
        ]);

        tipo_contribucion::create($validated);

        return redirect()->route('admin.tipo_contribuciones.index')
            ->with('success', 'Tipo de contribución creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(tipo_contribucion $tipo_contribucion, Request $request)
    {
        $autor_nombre = null;

        // Si se proporciona un autor_id, filtrar las contribuciones por ese autor
        if ($request->has('autor_id')) {
            $autor_id = $request->input('autor_id');
            $tipo_contribucion->load(['contribuciones' => function ($query) use ($autor_id) {
                $query->where('autor_id', $autor_id)->with(['autor', 'obra']);
            }]);

            // Obtener el nombre del autor para mostrarlo en la vista
            $autor = \App\Models\autor::find($autor_id);
            $autor_nombre = $autor ? $autor->nombre : null;
        } else {
            $tipo_contribucion->load(['contribuciones.autor', 'contribuciones.obra']);
        }

        return view("admin.tipo_contribucion.show", [
            "tipoContribucion" => $tipo_contribucion,
            "autor_nombre" => $autor_nombre
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tipo_contribucion $tipo_contribucion)
    {
        return view("admin.tipo_contribucion.edit", ["tipoContribucion" => $tipo_contribucion]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tipo_contribucion $tipo_contribucion)
    {
        if ($request->id != $tipo_contribucion->id) {
            return redirect()->back()->with('error', 'Invalid ID.');
        }
        $validated = $request->validate([
            'nombre_contribucion' => 'required|string|max:255|unique:tipo_contribuciones,nombre_contribucion,' . $tipo_contribucion->id
        ]);

        $tipo_contribucion->update($validated);

        return redirect()->route('admin.tipo_contribuciones.index')
            ->with('success', 'Tipo de contribución actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tipo_contribucion $tipo_contribucion)
    {
        $tipo_contribucion->delete();

        return redirect()->route('admin.tipo_contribuciones.index')
            ->with('success', 'Tipo de contribución eliminado exitosamente.');
    }
}
