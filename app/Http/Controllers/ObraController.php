<?php

namespace App\Http\Controllers;

use App\Models\obra;
use Illuminate\Http\Request;

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

        return $obras;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.obras.Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'anio' => "required|integer|min:1900"
        ]);

        $obra = obra::create($validated);

        return redirect()->route('obras.index')
                        ->with('success', 'Obra created successfully.');
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
        return $obra;
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

        return view("admin.obras.Edit", compact('obra'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, obra $obra)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'anio' => "required|integer|min:1900"
        ]);

        $obra->update($validated);

        return redirect()->route('obras.index')
                        ->with('success', 'Obra updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(obra $obra)
    {
        $obra->delete();

        return redirect()->route('obras.index')
                        ->with('success', 'Obra deleted successfully.');
    }
}
