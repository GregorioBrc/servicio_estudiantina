<x-app-layout title="Usuarios">
    <nav>
        <a href="{{ route('admin.index') }}">--Dashboard--</a>
        <br>
        <a href="{{route('admin.usuarios.create')}}">--Crear Usuario--</a>
    </nav>
    <h1>CRUD usuarios ADMIN</h1>
    <main>
        <table>
            <tr>
                <th>
                    Nombre
                </th>
                <th>
                    Email
                </th>
                <th>
                    Instrumento
                </th>
                <th>
                    Acciones
                </th>
            </tr>
            @foreach ($Users as $U)
                <tr>
                    <td>
                        {{$U->name}}
                    </td>
                    <td>
                        {{$U->email}}
                    </td>
                    <td>
                        @php
                            $ax = "";
                            foreach ($U->instrumentos as $Ins) {
                                $ax = $ax . $Ins->nombre . " " . $Ins->tipo . ", ";
                            }
                            echo $ax;
                        @endphp
                    </td>
                    <td>
                        <a href="{{ route('admin.usuarios.show', $U) }}">-Mostrar-</a>
                        <a href="{{ route('admin.usuarios.edit', $U) }}">-Editar-</a>
                        <a href="{{ route('admin.usuarios.destroy', $U) }}">-Eliminar-</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </main>
</x-app-layout>
