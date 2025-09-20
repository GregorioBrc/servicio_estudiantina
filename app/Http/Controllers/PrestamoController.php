<?php

namespace App\Http\Controllers;

use App\Models\prestamo;
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
    public function update(Request $request, prestamo $prestamo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(prestamo $prestamo)
    {
        //
    }
}
