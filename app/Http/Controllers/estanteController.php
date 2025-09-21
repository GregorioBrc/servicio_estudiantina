<?php

namespace App\Http\Controllers;

use App\Models\estante;
use Illuminate\Http\Request;

class estanteController extends Controller
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
            'gaveta' => 'required|integer|unique:estantes,gaveta',
        ]);

        estante::create($validated);

        return redirect()->route('estantes.index')
            ->with('success', 'Estante created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(estante $estante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(estante $estante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, estante $estante)
    {
        $validated = $request->validate([
            'gaveta' => 'required|integer|unique:estantes,gaveta,' . $estante->id,
        ]);

        $estante->update($validated);

        return redirect()->route('estantes.index')
            ->with('success', 'Estante updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(estante $estante)
    {
        $estante->delete();

        return redirect()->route('estantes.index')
            ->with('success', 'Estante deleted successfully.');
    }
}
