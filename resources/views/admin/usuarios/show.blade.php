<x-app-layout title="Mostrar usuario">
    <nav>
        <a href="{{ route('admin.usuarios.index') }}">--Volver--</a>
        <a href="{{ route('admin.usuarios.edit', $id) }}">--Editar--</a>
    </nav>

    <h1>Mostrar usuario {{ $id }} ADMIN</h1>

    <main>
        <div>
            <p>Nombre: {{ $nombre }}</p>
        </div>
        <div>
            <p>Correo: {{ $email }}</p>
        </div>
        <div>
            <p>Administrador: @if ($es_admin)
                    Si
                @else
                    NO
                @endif
            </p>
        </div>

        <div>
            <p>Fecha de Creacion: {{ $fecha_creacion }}</p>
        </div>
        <div>
            <h2>Instrumentos</h2>
            <ul>
                @foreach ($instrumen as $inst)
                    <li>
                        {{ $inst->nombre }} {{ $inst->tipo }}
                    </li>
                @endforeach
            </ul>
        </div>

    </main>


</x-app-layout>
