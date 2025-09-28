<x-app-layout title="Partituras usuario">
    <h1>Vista de las partituras del usuario</h1>
    <div>
        <a href="{{route('usuario.dashboard')}}">Atrás</a>
    </div>
    <div>
        @foreach ($User->instrumentos as $instrumento)
            <details>
                <summary>{{ $instrumento->nombre }}</summary>
                <ul>
                    @foreach ($instrumento->partituras as $parti)
                        <li>
                            <a href="{{route('usuario.show.partitura',['id'=> "$parti->id"])}}">{{ $parti->obra->titulo }}</a>
                        </li>
                    @endforeach
                </ul>
            </details>
        @endforeach
    </div>
</x-app-layout>
