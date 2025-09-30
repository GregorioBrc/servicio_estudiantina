<x-app-layout title="Obras">
    <h1>Listado de Obras</h1>
    <nav>
        <a href="{{ route('admin.index') }}">Volver</a>
        <br>
        <a href="{{ route('admin.obras.create') }}">Crear Nueva Obra</a>
    </nav>

    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Año</th>
                <th>Autores</th>
                <th>Partituras</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($obras as $obra)
            <tr>
                <td>{{ $obra->titulo }}</td>
                <td>{{ $obra->anio }}</td>
                <td>
                    @foreach($obra->autores as $autor)
                        {{ $autor->nombre }} ({{ $autor->pivot->tipoContribucion->nombre_contribucion ?? 'Sin tipo' }})<br>
                    @endforeach
                </td>
                <td>{{ $obra->partituras->count() }}</td>
                <td>
                    <a href="{{ route('admin.obras.show', $obra) }}">Ver</a>
                    <a href="{{ route('admin.obras.edit', $obra) }}">Editar</a>
                    <form action="{{ route('admin.obras.destroy', $obra) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Está seguro de eliminar esta obra?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
