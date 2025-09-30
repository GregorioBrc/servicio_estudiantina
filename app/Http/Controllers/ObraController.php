<?php

namespace App\Http\Controllers;

use App\Models\obra;
use App\Models\autor;
use App\Models\tipo_contribucion;
use App\Models\contribuciones;
use Illuminate\Http\Request;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Mail;

class ObraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obras = obra::with(['autores', 'partituras.instrumento'])->get();

        $obras->each(function ($o) {
            $o->autores->each(function ($autor) {
                $autor->pivot->load('tipoContribucion');
            });
        });

        //return $obras;

        return view('admin.obras.index', compact('obras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $autores = autor::all();
        $tiposContribucion = tipo_contribucion::all();
        return view("admin.obras.create", compact('autores', 'tiposContribucion'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'anio' => "required|integer|min:1900",
            'autores' => 'nullable|array',
            'autores.*' => 'exists:autores,id',
            'tipos_contribucion' => 'nullable|array',
            'tipos_contribucion.*' => 'exists:tipo_contribuciones,id'
        ]);

        $obra = obra::create($validated);

        // Guardar contribuciones de autores
        if ($request->has('autores') && $request->has('tipos_contribucion')) {
            foreach ($request->autores as $index => $autorId) {
                if (isset($request->tipos_contribucion[$index])) {
                    contribuciones::create([
                        'autor_id' => $autorId,
                        'obra_id' => $obra->id,
                        'tipo_contribucion_id' => $request->tipos_contribucion[$index]
                    ]);
                }
            }
        }

        return redirect()->route('admin.obras.index')
                        ->with('success', 'Obra creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(obra $obra)
    {
        $obra->load(['autores', 'partituras.instrumento']);

        $obra->autores->each(function ($autor) {
            $autor->pivot->load('tipoContribucion');
        });
        return view('admin.obras.show', compact('obra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(obra $obra)
    {
        $obra->load(['autores', 'partituras.instrumento']);

        $obra->autores->each(function ($autor) {
            $autor->pivot->load('tipoContribucion');
        });

        $autores = autor::all();
        $tiposContribucion = tipo_contribucion::all();

        return view("admin.obras.edit", compact('obra', 'autores', 'tiposContribucion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, obra $obra)
    {
        // Verificar que el título actual coincida con la obra que estamos editando
        if ($request->titulo_actual != $obra->titulo) {
            return redirect()->back()->with('error', 'Título de obra inválido.');
        }

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'anio' => "required|integer|min:1900",
            'autores' => 'nullable|array',
            'autores.*' => 'exists:autores,id',
            'tipos_contribucion' => 'nullable|array',
            'tipos_contribucion.*' => 'exists:tipo_contribuciones,id'
        ]);

        $obra->update($validated);

        // Actualizar contribuciones de autores
        // Primero eliminar las contribuciones existentes
        contribuciones::where('obra_id', $obra->id)->delete();

        // Guardar nuevas contribuciones
        if ($request->has('autores') && $request->has('tipos_contribucion')) {
            foreach ($request->autores as $index => $autorId) {
                if (isset($request->tipos_contribucion[$index])) {
                    contribuciones::create([
                        'autor_id' => $autorId,
                        'obra_id' => $obra->id,
                        'tipo_contribucion_id' => $request->tipos_contribucion[$index]
                    ]);
                }
            }
        }

        return redirect()->route('admin.obras.index')
                        ->with('success', 'Obra actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(obra $obra)
    {
        $obra->delete();

        return redirect()->route('admin.obras.index')
                        ->with('success', 'Obra eliminada exitosamente.');
    }
}
