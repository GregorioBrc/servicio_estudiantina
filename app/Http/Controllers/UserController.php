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
    public function index(Request $request)
    {
        $query = User::with('instrumentos');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        $Users = $query->paginate(10)->appends(['search' => $request->search]);
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
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }

    public function show($user)
    {
        $user = User::findOrFail($user)->load('instrumentos');
        return view('admin.usuarios.show', [
            'id' => $user->id,
            'nombre' => $user->name,
            'email' => $user->email,
            'es_admin' => $user->es_escritor,
            'fecha_creacion' => $user->created_at,
            'instrumen' => $user->instrumentos,
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id)->load('instrumentos');
        $instrumentos = instrumento::all();
        return view('admin.usuarios.edit', compact('user', 'instrumentos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'es_escritor' => 'boolean',
            'Instru' => 'required|array',
            'Instru.*' => 'exists:instrumentos,id',
        ]);

        $user = User::findOrFail($id);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'es_escritor' => $request->boolean('es_escritor'),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        $user->Instrumentos()->detach();
        foreach ($request->Instru as $instruId) {
            $instru = instrumento::find($instruId);
            $user->Instrumentos()->attach($instru);
        }

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado correctamente.');
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
