<?php

namespace App\Http\Controllers;

use App\Models\usuario_inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Container\BindingResolutionException;

class UsuarioInventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $usuarios = UsuarioInventario::paginate(15);
        // return view('usuario_inventario.index', compact('usuarios'));
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
            'correo' => 'required|string|email|max:255|unique:usuarios_inventario',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $usuario_inventario = usuario_inventario::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
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

    public function apiRegistrarUsuario(Request $request)
    {
        $request->merge([
            'nombre' => $request->input('nombre', $request->input('name')),
            'correo' => $request->input('correo', $request->input('email')),
        ]);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:usuarios_inventario',
            'password' => 'required|string|min:8',
        ]);

        $user = \App\Models\usuario_inventario::create([
            'nombre' => $validated['nombre'],
            'correo' => $validated['correo'],
            'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Usuario registrado exitosamente en el servidor.',
            'usuario_inventario_id' => $user->id
        ], 201); // Código 201: Creado
    }

public function apiGetOrCreateByEmail(Request $request)
{
    if (! $request->expectsJson()) {
        $request->headers->set('Accept', 'application/json');
    }

    $validated = $request->validate([
        'email'  => 'required|email',
        'nombre' => 'nullable|string|max:255',
    ]);

    $user = \App\Models\usuario_inventario::where('correo', $validated['email'])->first();

    $created = false;
    if (!$user) {
        $user = \App\Models\usuario_inventario::create([
            'nombre'   => $validated['nombre'] ?? 'Sin nombre',
            'correo'   => $validated['email'],
            // clave dummy si este modelo no se usa para login en este proyecto
        ]);
        $created = true;
    }

    return response()->json([
        'created'               => $created,
        'usuario_inventario_id' => $user->id,
        'nombre'                => $user->nombre,
        'correo'                => $user->correo,
    ], $created ? 201 : 200);
}
    public function apiGetUsuario($id)
    {
        $user = \App\Models\usuario_inventario::find($id);
        if ($user) {
            return response()->json(['nombre' => $user->nombre]);
        }
        return response()->json(['nombre' => 'Usuario Desconocido'], 404);
    }

}
