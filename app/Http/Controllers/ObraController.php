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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //return print_r($obra->autores);
        return $obra;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(obra $obra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, obra $obra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(obra $obra)
    {
        //
    }
}
