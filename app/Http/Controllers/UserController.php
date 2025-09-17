<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.usuarios.index');
    }

    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function store(Request $request)
    {
        return 'Usuario creado';
    }

    public function destroy($id)
    {
        return "Usuario $id eliminado";
    }

    public function show($id = 0)
    {
        return view('admin.usuarios.show', [
            'id' => $id
        ]);
    }

    public function edit($id = 0)
    {
        return view('admin.usuarios.edit', [
            'id' => $id
        ]);
    }

    public function update(Request $request, $id)
    {
        return "Usuario $id actualizado";
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function perfil($id)
    {
        return view('user.perfil', [
            'id' => $id
        ]);
    }
}
