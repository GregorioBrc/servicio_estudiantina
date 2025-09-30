<?php

namespace App\Http\Controllers;

use App\Models\instrumento;
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
        $Users = User::all()->load('instrumentos');
        return view('admin.usuarios.index', compact('Users'));
    }

    public function create()
    {
        $instrumentos = instrumento::all();
        return view('admin.usuarios.create', compact('instrumentos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'es_escritor' => 'boolean',
        ]);
        $instru = instrumento::find($request->Instru);

        $Us = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'es_escritor' => $request->boolean('es_escritor'),
        ]);

        $Us->Instrumentos()->attach($instru);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function destroy($id)
    {
        return "Usuario $id eliminado";
    }

    public function show($user)
    {
        return $user;
        return view('admin.usuarios.show', [
            'id' => $user->id
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

    public function CambiarPassword(Request $request)
    {
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
