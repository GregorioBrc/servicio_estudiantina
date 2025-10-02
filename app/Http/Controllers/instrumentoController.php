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
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:instrumentos,nombre',
            'tipo' => 'required|string|max:255'
        ]);

        instrumento::create($validated);

        return redirect()->route('admin.instrumentos.index')
            ->with('success', 'Instrumento created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(instrumento $instrumento)
    {
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
            'nombre' => 'required|string|max:255|unique:instrumentos,nombre,' . $instrumento->id,
            'tipo' => 'required|string|max:255'
        ]);

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
