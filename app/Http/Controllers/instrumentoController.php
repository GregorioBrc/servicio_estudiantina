<?php

namespace App\Http\Controllers;

use App\Models\instrumento;
use Illuminate\Http\Request;

class instrumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instrumentos = instrumento::paginate(10);
        return view('admin.instrumentos.index', compact('instrumentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.instrumentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validacion de Nombre y tipo, son una clave unica compuesta
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255'
        ]);

        // Validar clave única compuesta nombre + tipo
        $exists = instrumento::where('nombre', $validated['nombre'])
            ->where('tipo', $validated['tipo'])
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['nombre' => 'La combinación de nombre y tipo ya existe.']);
        }

        instrumento::create($validated);

        return redirect()->route('admin.instrumentos.index')
            ->with('success', 'Instrumento created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(instrumento $instrumento)
    {
        $instrumento->user_cant = $instrumento->usuarios()->count();
        return view('admin.instrumentos.show', compact('instrumento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(instrumento $instrumento)
    {
        return view('admin.instrumentos.edit', compact('instrumento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, instrumento $instrumento)
    {
        if ($request->id != $instrumento->id) {
            return redirect()->back()->with('error', 'Invalid request.');
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255'
        ]);

        $exists = instrumento::where('nombre', $validated['nombre'])
            ->where('tipo', $validated['tipo'])
            ->where('id', '!=', $instrumento->id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['nombre' => 'La combinación de nombre y tipo ya existe.']);
        }

        $instrumento->update($validated);

        return redirect()->route('admin.instrumentos.index')
            ->with('success', 'Instrumento updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(instrumento $instrumento)
    {
        $instrumento->delete();

        return redirect()->route('admin.instrumentos.index')
            ->with('success', 'Instrumento deleted successfully.');
    }
}
