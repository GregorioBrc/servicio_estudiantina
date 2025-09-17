<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartituraController extends Controller
{
    public function index()
    {
        return view('admin.partituras.index');
    }

    public function create()
    {
        return view('admin.partituras.create');
    }

    public function store(Request $request)
    {
        return 'Partitura creada';
    }

    public function destroy($id)
    {
        return "Partitura $id eliminada";
    }

    public function show($id)
    {
        return view('admin.partituras.show', [
            'id' => $id
        ]);
    }

    public function edit($id)
    {
        return view('admin.partituras.edit', [
            'id' => $id
        ]);
    }

    public function update(Request $request, $id)
    {
        return "Partitura $id actualizada";
    }

    public function misPartituras()
    {
        return view('user.partituras');
    }
}
