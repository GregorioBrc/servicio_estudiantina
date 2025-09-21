<?php

namespace App\Http\Controllers;

use App\Models\usuario_inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioInventarioController extends Controller
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
            'nombre' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $usuario_inventario = usuario_inventario::create([
            'nombre' => $request->name,
            'correo' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('usuario_inventario.index')
            ->with('success', 'Inventario de usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(usuario_inventario $usuario_inventario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(usuario_inventario $usuario_inventario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, usuario_inventario $usuario_inventario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(usuario_inventario $usuario_inventario)
    {
        //
    }
}
