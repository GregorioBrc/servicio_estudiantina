<?php

namespace App\Http\Controllers;

use App\Models\autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = autor::with(['contribuciones.obra', 'contribuciones.tipocontribucion']);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nombre', 'LIKE', "%{$search}%");
        }

        $autores = $query->paginate(10)->appends(['search' => $request->search]);
        return view('admin.autores.index', compact('autores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.autores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:autores,nombre',
        ]);

        $autor = autor::create($validated);

        return redirect()->route('admin.autores.index')
            ->with('success', 'Autor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(autor $autor)
    {
        $autor->load(["contribuciones.obra", 'contribuciones.tipocontribucion']);
        return view('admin.autores.show', [
            'Nombre' => $autor->nombre,
            'Contribucion' => $autor->contribuciones
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(autor $autor)
    {
        $autor->load(["contribuciones.obra", "contribuciones.tipocontribucion"]);
        return view('admin.autores.edit', compact('autor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, autor $autor)
    {
        // Verificar que el nombre actual coincida con el autor que estamos editando
        if ($request->nombre_actual != $autor->nombre) {
            return redirect()->back()->with('error', 'Invalid autor name.');
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:autores,nombre,' . $autor->id,
        ]);

        $autor->update($validated);

        return redirect()->route('admin.autores.index')
            ->with('success', 'Autor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(autor $autor)
    {
        $autor->delete();

        return redirect()->route('admin.autores.index')
            ->with('success', 'Autor deleted successfully.');
    }
}
