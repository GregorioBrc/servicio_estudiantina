<?php

namespace App\Http\Controllers;

use App\Models\SubtipoInstrumento;
use Illuminate\Http\Request;

class SubtipoInstrumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subtipos = SubtipoInstrumento::with('instrumento')->get();
        return view('admin.subtipos_instrumentos.index', compact('subtipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instrumentos = \App\Models\instrumento::all();
        return view('admin.subtipos_instrumentos.create', compact('instrumentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:subtipo_instrumentos,nombre',
            'descripcion' => 'nullable|string',
            'instrumento_id' => 'required|exists:instrumentos,id'
        ]);

        SubtipoInstrumento::create($validated);

        return redirect()->route('subtipo_instrumento.index')
            ->with('success', 'Subtipo de instrumento creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubtipoInstrumento $subtipoInstrumento)
    {
        return view('admin.subtipos_instrumentos.show', compact('subtipoInstrumento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubtipoInstrumento $subtipoInstrumento)
    {
        $instrumentos = \App\Models\instrumento::all();
        return view('admin.subtipos_instrumentos.edit', compact('subtipoInstrumento', 'instrumentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubtipoInstrumento $subtipoInstrumento)
    {
        if ($request->id != $subtipoInstrumento->id) {
            return redirect()->back()->with('error', 'Solicitud inválida.');
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:subtipo_instrumentos,nombre,' . $subtipoInstrumento->id,
            'descripcion' => 'nullable|string',
            'instrumento_id' => 'required|exists:instrumentos,id'
        ]);

        $subtipoInstrumento->update($validated);

        return redirect()->route('subtipo_instrumento.index')
            ->with('success', 'Subtipo de instrumento actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubtipoInstrumento $subtipoInstrumento)
    {
        $subtipoInstrumento->delete();

        return redirect()->route('subtipo_instrumento.index')
            ->with('success', 'Subtipo de instrumento eliminado exitosamente.');
    }
}
