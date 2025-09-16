<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartituraController extends Controller
{
    public function index()
    {
        return 'Listado de partituras';
    }

    public function create()
    {
        return 'Formulario de creación de partitura';
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
        return "Detalle de la partitura $id";
    }

    public function edit($id)
    {
        return "Formulario de edición de partitura $id";
    }

    public function update(Request $request, $id)
    {
        return "Partitura $id actualizada";
    }

    public function misPartituras()
    {
        return 'Partituras del usuario';
    }
}
