<?php

namespace App\Http\Controllers;

use App\Models\inventario;
use Illuminate\Http\Request;

class inventarioController extends Controller
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
        return view('inventario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'partitura_id' => 'required|integer',
            'estante_id' => 'required|integer',
            'cantidad' => 'required|integer|min:1',
        ]);

        $Item = inventario::where('partitura_id', $validated['partitura_id'])->where('estante_id', $validated['estante_id']);

        if (isset($Item)) {
            return redirect()->back()->with('error', 'Item already exists.');
        }

        inventario::create($validated);

        return redirect()->route('inventario.index')
            ->with('success', 'Inventario created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(inventario $inventario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(inventario $inventario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, inventario $inventario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(inventario $inventario)
    {
        //
    }
}
