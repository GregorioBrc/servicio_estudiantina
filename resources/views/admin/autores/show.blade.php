<x-app-layout title="Datos Obra">
    <nav>
        <a href="{{ route('admin.autores.edit', $Nombre) }}">Editar</a>
        <br>
        <a href="{{ route('admin.autores.index') }}">Volver</a>
    </nav>
    <h2>Información sobre {{ $Nombre }}</h2>
    <table>
        <tr>
            <th>
                Nombre Obra
            </th>
            <th>
                Año
            </th>
            <th>
                Tipo de contribución
            </th>
        </tr>
        @foreach ($Contribucion as $item)
            <tr>
                <td>
                    {{ $item->obra->titulo }}
                </td>
                <td>
                    {{ $item->obra->anio }}
                </td>
                <td>
                    {{ $item->tipocontribucion->nombre_contribucion }}
                </td>
            </tr>
        @endforeach
    </table>
</x-app-layout>
