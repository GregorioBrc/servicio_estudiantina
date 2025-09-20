<?php

namespace App\Http\Controllers;

use App\Models\obra;
use App\Models\partitura;
use Illuminate\Http\Request;

class PartituraController extends Controller
{
    public function index()
    {
        $obras = obra::all();
        return view('admin.partituras.index',["obras" => $obras]);
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

    public function destroy($partitura)
    {
        return "Partitura $partitura eliminada";
    }

    public function show(partitura $partitura)
    {
        return $partitura;
        // return view('admin.partituras.show', [
        //     'id' => $partitura
        // ]);
    }

    public function edit(partitura $partitura)
    {
        return view('admin.partituras.edit', [
            'Parti' => $partitura->load(['obra'])
        ]);
    }

    public function update(Request $request, $partitura)
    {
        return "Partitura $partitura actualizada";
    }

    public function misPartituras()
    {
        return view('user.partituras');
    }
}
