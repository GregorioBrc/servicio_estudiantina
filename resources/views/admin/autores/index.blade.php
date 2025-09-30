<x-app-layout title="Autores">
    <h1>Autores</h1>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Cantidad de Obras</th>
            <th>Acciones</th>
        </tr>
        @foreach ($autores as $autor)
            <tr>
                <td>
                    {{ $autor->nombre }}
                </td>

                <td>
                    {{ count($autor->contribuciones) }}
                </td>

                <td>
                    <a href="{{ route('admin.autores.show', $autor) }}">-Mostrar-</a>
                    <a href="{{ route('admin.autores.edit', $autor) }}">-Editar-</a>
                    <a href="{{ route('admin.autores.destroy', $autor) }}">-Eliminar-</a>
                </td>
            </tr>
        @endforeach
    </table>

</x-app-layout>
