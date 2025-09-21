<?php

namespace App\Http\Controllers;

use App\Models\obra;
use App\Models\partitura;
use Illuminate\Http\Request;

class PartituraController extends Controller
{
    public function index()
    {
        $partituras = partitura::with(['instrumento', 'obra'])->get();
        //return $partituras;
        return view('admin.partituras.index', compact('partituras'));
    }

    public function create()
    {
        return view('admin.partituras.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'obra_id' => 'required|integer|exists:obras,id',
            'instrumento_id' => 'required|exists:instrumentos,id|integer',
            'url_pdf' => 'required|string|url',
            'link_video' => 'string|url',
        ]);

        partitura::create($validated);

        return redirect()->route('partituras.index')
            ->with('success', 'Partitura creada exitosamente');
    }

    public function destroy(partitura $partitura)
    {
        $partitura->delete();

        return redirect()->route('partituras.index')
            ->with('success', 'Partitura eliminada exitosamente');
    }

    public function show(partitura $partitura)
    {
        $partitura->load(["instrumento", "obra"]);
        return view('admin.partituras.show', compact('partitura'));
    }

    public function edit(partitura $partitura)
    {
        $partitura->load(["instrumento", "obra"]);
        return view('admin.partituras.edit', compact('partitura'));
    }

    public function update(Request $request, partitura $partitura)
    {
        $validated = $request->validate([
            'obra_id' => 'required|integer|exists:obras,id',
            'instrumento_id' => 'required|exists:instrumentos,id|integer',
            'url_pdf' => 'required|string|url',
            'link_video' => 'string|url',
        ]);

        $partitura->update($validated);

        return redirect()->route('partituras.index')
            ->with('success', 'Partitura actualizada exitosamente');
    }

    public function misPartituras()
    {
        return view('user.partituras');
    }
}
