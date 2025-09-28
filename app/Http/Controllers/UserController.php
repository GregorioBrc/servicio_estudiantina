<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'es_escritor' => 'boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'es_escritor' => $request->boolean('es_escritor'),
        ]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado correctamente.');
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
        $user = Auth::user();
        return view('user.perfil', [
            'id' => $id,
            'nombre' => $user->name,
            'email' => $user->email
        ]);
    }

    public function CambiarPassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Contraseña actual incorrecta']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Contraseña actualizada correctamente.');
    }
}
