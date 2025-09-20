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
            'nombre' => 'required|string|max:255|unique:tipo_contribucion,nombre',
        ]);

        tipo_contribucion::create($validated);

        return redirect()->route('tipo_contribucion.index')
                        ->with('success', 'Tipo de contribución creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(tipo_contribucion $tipo_contribucion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tipo_contribucion $tipo_contribucion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tipo_contribucion $tipo_contribucion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tipo_contribucion $tipo_contribucion)
    {
        //
    }
}
