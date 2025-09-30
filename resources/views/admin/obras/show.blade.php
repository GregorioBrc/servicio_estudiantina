<x-app-layout title="Datos Obra">
    <h1>Detalles de la Obra</h1>
    <nav>
        <a href="{{ route('admin.obras.index') }}">Volver al listado</a>
        <a href="{{ route('admin.obras.edit', $obra) }}">Editar obra</a>
    </nav>

    <div>
        <h2>{{ $obra->titulo }}</h2>
        <p><strong>Año:</strong> {{ $obra->anio }}</p>

        <h3>Autores y Contribuciones</h3>
        @if($obra->autores->count() > 0)
            <ul>
                @foreach($obra->autores as $autor)
                    <li>
                        <strong>{{ $autor->nombre }}</strong> -
                        Tipo: {{ $autor->pivot->tipoContribucion->nombre ?? 'Sin tipo definido' }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>No hay autores asignados a esta obra.</p>
        @endif

        <h3>Partituras</h3>
        @if($obra->partituras->count() > 0)
            <ul>
                @foreach($obra->partituras as $partitura)
                    <li>
                        {{ $partitura->titulo }} -
                        {{ $partitura->instrumento->nombre ?? 'Sin instrumento' }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>No hay partituras asociadas a esta obra.</p>
        @endif
    </div>
</x-app-layout>
