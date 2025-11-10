<?php

namespace App\Http\Controllers;

use App\Models\instrumento;
use Illuminate\Http\Request;

class InstrumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = instrumento::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nombre', 'LIKE', "%{$search}%");
        }

        $instrumentos = $query->paginate(10)->appends(['search' => $request->search]);
        return view('admin.instrumentos.index', compact('instrumentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.instrumentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación para múltiples tipos
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipos' => 'required|array|min:1',
            'tipos.*' => 'required|string|max:255'
        ]);

        $nombre = $validated['nombre'];
        $tipos = $validated['tipos'];
        $instrumentosCreados = 0;
        $errores = [];

        // Procesar cada tipo
        foreach ($tipos as $index => $tipo) {
            // Validar clave única compuesta nombre + tipo
            $exists = instrumento::where('nombre', $nombre)
                ->where('tipo', $tipo)
                ->exists();

            if ($exists) {
                $errores[] = "La combinación de nombre '$nombre' con tipo '$tipo' ya existe.";
            } else {
                try {
                    instrumento::create([
                        'nombre' => $nombre,
                        'tipo' => $tipo
                    ]);
                    $instrumentosCreados++;
                } catch (\Exception $e) {
                    $errores[] = "Error al crear el instrumento '$nombre' de tipo '$tipo': " . $e->getMessage();
                }
            }
        }

        // Preparar mensaje de respuesta
        if ($instrumentosCreados > 0) {
            $mensaje = "Se crearon $instrumentosCreados instrumento(s) exitosamente.";
            if (!empty($errores)) {
                $mensaje .= " Nota: Algunos tipos no pudieron ser creados debido a duplicados.";
            }

            return redirect()->route('admin.instrumentos.index')
                ->with('success', $mensaje);
        } else {
            // Si no se creó ningún instrumento, volver con error
            $mensajeError = "No se pudo crear ningún instrumento. ";
            if (!empty($errores)) {
                $mensajeError .= implode(' ', $errores);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', $mensajeError);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(instrumento $instrumento)
    {
        $instrumento->user_cant = $instrumento->usuarios()->count();
        return view('admin.instrumentos.show', compact('instrumento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(instrumento $instrumento)
    {
        return view('admin.instrumentos.edit', compact('instrumento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, instrumento $instrumento)
    {
        if ($request->id != $instrumento->id) {
            return redirect()->back()->with('error', 'Invalid request.');
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255'
        ]);

        $exists = instrumento::where('nombre', $validated['nombre'])
            ->where('tipo', $validated['tipo'])
            ->where('id', '!=', $instrumento->id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['nombre' => 'La combinación de nombre y tipo ya existe.']);
        }

        $instrumento->update($validated);

        return redirect()->route('admin.instrumentos.index')
            ->with('success', 'Instrumento updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(instrumento $instrumento)
    {
        $instrumento->delete();

        return redirect()->route('admin.instrumentos.index')
            ->with('success', 'Instrumento deleted successfully.');
    }
}
