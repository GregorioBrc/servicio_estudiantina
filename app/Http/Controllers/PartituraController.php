<?php

namespace App\Http\Controllers;

use App\Models\instrumento;
use App\Models\obra;
use App\Models\partitura;
use App\Models\tipo_contribucion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PartituraController extends Controller
{
    public function index(Request $request)
    {
        $query = partitura::with(['instrumento', 'obra']);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('obra', function($q) use ($search) {
                $q->where('titulo', 'LIKE', "%{$search}%");
            });
        }

        $partituras = $query->paginate(10)->appends(['search' => $request->search]);
        return view('admin.partituras.index', compact('partituras'));
    }

    public function create()
    {
        $obras = obra::all();
        $instrumentos = instrumento::all();
        return view('admin.partituras.create', compact('obras', 'instrumentos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'obra_id' => 'required|integer|exists:obras,id',
            'instrumento_id' => 'required|exists:instrumentos,id|integer',
            'url_pdf' => 'required|string|max:255',
            'link_video' => 'nullable|string|url|max:255',
        ]);

        try {
            // Intentar crear la partitura
            $partitura = partitura::create($validated);

            // Obtener la obra con sus autores
            $obra = obra::with('autores')->findOrFail($validated['obra_id']);

            // Relacionar los autores de la obra con el instrumento de la partitura
            foreach ($obra->autores as $autor) {
                // Verificar si la relación ya existe antes de crearla
                if (!$autor->instrumentos()->where('instrumento_id_fk', $validated['instrumento_id'])->exists()) {
                    $autor->instrumentos()->attach($validated['instrumento_id']);
                }
            }

            return redirect()->route('admin.partituras.index')
                ->with('success', 'Partitura creada exitosamente');

        } catch (\Illuminate\Database\UniqueConstraintViolationException $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ya existe una partitura para esta combinación de obra e instrumento. Por favor, selecciona una combinación diferente.');
        }
    }

    public function destroy(partitura $partitura)
    {
        $partitura->delete();

        return redirect()->route('admin.partituras.index')
            ->with('success', 'Partitura eliminada exitosamente');
    }

    public function show(partitura $partitura)
    {
        $partitura->load(["instrumento", "obra"]);
        $partitura->user_cant = $usuariosConInstrumento = $partitura->instrumento->usuarios()->count();

        $qrCodePDF = QrCode::size(150)->generate($partitura->url_pdf);
        $qrCodeYT = QrCode::size(150)->generate($partitura->link_video);

        return view('admin.partituras.show', compact('partitura', 'qrCodePDF', 'qrCodeYT'));
    }

    public function edit(partitura $partitura)
    {
        $partitura->load(["instrumento", "obra"]);
        $obras = obra::all();
        $instrumentos = instrumento::all();
        return view('admin.partituras.edit', compact('partitura', 'obras', 'instrumentos'));
    }

    public function update(Request $request, partitura $partitura)
    {
        $validated = $request->validate([
            'obra_id' => 'required|integer|exists:obras,id',
            'instrumento_id' => 'required|exists:instrumentos,id|integer',
            'url_pdf' => 'required|string',
            'link_video' => 'nullable|string|url',
        ]);

        $partitura->update($validated);

        return redirect()->route('admin.partituras.index')
            ->with('success', 'Partitura actualizada exitosamente');
    }

    public function misPartituras()
        {
            $User = User::find(Auth::id())->load([
                'instrumentos.partituras.obra.autores' => function ($query) {
                    $query->withPivot('tipo_contribucion_id');
                }
            ]);

            $tiposContribucion = tipo_contribucion::pluck('nombre_contribucion', 'id');

            foreach ($User->instrumentos as $instrumento) {
                foreach ($instrumento->partituras as $partitura) {
                    foreach ($partitura->obra->autores as $autor) {
                        if ($autor->pivot->tipo_contribucion_id) {
                            $autor->tipo_contribucion_nombre = $tiposContribucion[$autor->pivot->tipo_contribucion_id] ?? null;
                        } else {
                            $autor->tipo_contribucion_nombre = null;
                        }
                    }
                }
            }

            $totalPartituras = 0;
            foreach ($User->instrumentos as $instrumento) {
                $totalPartituras += $instrumento->partituras->count();
            }

            // Obtener instrumentos del usuario para el filtro
            $instrumentosUsuario = $User->instrumentos;

            return view('user.partituras', compact('User', 'totalPartituras', 'instrumentosUsuario'));
        }

    public function misPartiturasPorAutor(Request $request)
        {
            $User = User::find(Auth::id())->load(['instrumentos.partituras.obra']);

            // Obtener todos los autores que tienen obras con partituras para los instrumentos del usuario
            $autoresConPartituras = [];
            $tiposContribucion = tipo_contribucion::pluck('nombre_contribucion', 'id');

            foreach ($User->instrumentos as $instrumento) {
                foreach ($instrumento->partituras as $partitura) {
                    $obra = $partitura->obra;
                    $obra->load(['autores' => function ($query) {
                        $query->withPivot('tipo_contribucion_id');
                    }]);

                    foreach ($obra->autores as $autor) {
                        // Si el autor no está en el array, inicializarlo
                        if (!isset($autoresConPartituras[$autor->id])) {
                            $autoresConPartituras[$autor->id] = [
                                'autor' => $autor,
                                'obras' => []
                            ];
                        }

                        // Agregar la partitura con su instrumento y tipo de contribución
                        $tipoContribucion = null;
                        if ($autor->pivot->tipo_contribucion_id) {
                            $tipoContribucion = $tiposContribucion[$autor->pivot->tipo_contribucion_id] ?? null;
                        }

                        // Si la obra no está en el array del autor, agregarla
                        if (!isset($autoresConPartituras[$autor->id]['obras'][$obra->id])) {
                            $autoresConPartituras[$autor->id]['obras'][$obra->id] = [
                                'obra' => $obra,
                                'tipo_contribucion' => $tipoContribucion,
                                'partituras' => []
                            ];
                        }


                        $autoresConPartituras[$autor->id]['obras'][$obra->id]['partituras'][] = [
                            'partitura' => $partitura,
                            'instrumento' => $instrumento,
                            'tipo_contribucion' => $tipoContribucion
                        ];
                    }
                }
            }

            // Ordenar autores por nombre
            usort($autoresConPartituras, function($a, $b) {
                return strcmp($a['autor']->nombre, $b['autor']->nombre);
            });

            $totalPartituras = 0;
            foreach ($User->instrumentos as $instrumento) {
                $totalPartituras += $instrumento->partituras->count();
            }

            // Obtener instrumentos del usuario para el filtro
            $instrumentosUsuario = $User->instrumentos;

            // Obtener el parámetro 'autor' de la solicitud
            $autorBuscado = $request->query('autor');

            return view('user.partituras_por_autor', compact('autoresConPartituras', 'totalPartituras', 'instrumentosUsuario', 'autorBuscado'));
        }

    public function usuario_ShowPartitura($id, Request $request)
    {
        $partitura = partitura::find($id)->load("obra");

        $qrCodePDF = QrCode::size(150)->generate($partitura->url_pdf);
        $qrCodeYT = QrCode::size(150)->generate($partitura->link_video);

        // Determinar la URL de retorno según la página anterior
        $backUrl = route('usuario.partituras');
        if ($request->has('from') && $request->from === 'autor') {
            $backUrl = route('usuario.partituras.autor');
        }

        return view('user.partitura_show', [
            'partitura' => $partitura,
            'backUrl' => $backUrl,
            'qrCodePDF' => $qrCodePDF,
            'qrCodeYT' => $qrCodeYT
        ]);
    }
}
