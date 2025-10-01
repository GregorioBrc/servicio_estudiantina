<?php

namespace App\Http\Controllers;

use App\Models\instrumento;
use App\Models\obra;
use App\Models\partitura;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartituraController extends Controller
{
    public function index()
    {
        $partituras = partitura::with(['instrumento', 'obra', 'user'])->get();
        //return $partituras;
        return view('admin.partituras.index', compact('partituras'));
    }

    public function create()
    {
        $obras = obra::all();
        $instrumentos = instrumento::all();
        $users = User::all();
        return view('admin.partituras.create', compact('obras', 'instrumentos', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'obra_id' => 'required|integer|exists:obras,id',
            'instrumento_id' => 'required|exists:instrumentos,id|integer',
            'user_id' => 'required|exists:users,id|integer',
            'link_video' => 'nullable|string|url',
        ]);

        partitura::create($validated);

        return redirect()->route('admin.partituras.index')
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
        $partitura->load(["instrumento", "obra", "user"]);
        return view('admin.partituras.show', compact('partitura'));
    }

    public function edit(partitura $partitura)
    {
        $partitura->load(["instrumento", "obra", "user"]);
        $obras = obra::all();
        $instrumentos = instrumento::all();
        $users = User::all();
        return view('admin.partituras.edit', compact('partitura', 'obras', 'instrumentos', 'users'));
    }

    public function update(Request $request, partitura $partitura)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'obra_id' => 'required|integer|exists:obras,id',
            'instrumento_id' => 'required|exists:instrumentos,id|integer',
            'user_id' => 'required|exists:users,id|integer',
            'link_video' => 'nullable|string|url',
        ]);

        $partitura->update($validated);

        return redirect()->route('admin.partituras.index')
            ->with('success', 'Partitura actualizada exitosamente');
    }

    public function misPartituras()
    {
        $User = User::find(Auth::id())->load('instrumentos.partituras.obra');
        $totalPartituras = 0;

        foreach ($User->instrumentos as $instrumento) {
        $totalPartituras += $instrumento->partituras->count();
    
    }

        //return $User;
        return view('user.partituras',compact('User', 'totalPartituras'));
    }

    public function usuario_ShowPartitura($id) {
        $partitura = partitura::find($id)->load("obra");

        return view('user.partitura_show', ['partitura'=>$partitura]);
    }
}
