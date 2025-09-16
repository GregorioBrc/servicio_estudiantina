<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return 'Listado de usuarios';
    }

    public function create()
    {
        return 'Formulario de creación de usuario';
    }

    public function store(Request $request)
    {
        return 'Usuario creado';
    }

    public function destroy($id)
    {
        return "Usuario $id eliminado";
    }

    public function show($id)
    {
        return "Detalle del usuario $id";
    }

    public function edit($id)
    {
        return "Formulario de edición de usuario $id";
    }

    public function update(Request $request, $id)
    {
        return "Usuario $id actualizado";
    }

    public function dashboard()
    {
        return 'Dashboard del usuario';
    }

    public function perfil($id)
    {
        return "Perfil del usuario $id";
    }
}
