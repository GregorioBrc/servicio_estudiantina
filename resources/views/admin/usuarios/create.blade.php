<x-app-layout title="Crear usuario">
    <h1>Crear usuario ADMIN</h1>
    <nav>
        <a href="{{ route('admin.usuarios.index') }}">---Volver al listado---</a>
    </nav>
    <!-- Formulario Crear Usuario -->
    <form method="POST" action="{{ route('admin.usuarios.store') }}">
        @csrf
        <div>
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label for="password_confirmation">Confirmar Contraseña:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div>
            <label for="es_escritor">Administrador:</label>
            <input type="checkbox" name="es_escritor" id="es_escritor">
        </div>

        <div>
            <h2>Instrumentos</h2>
            @foreach ($instrumentos as $instru)
                <div>
                    <label for="{{$instru->id}}{{$instru->nombre}}">{{$instru->nombre}} {{$instru->tipo}}</label>
                    <input type="checkbox" name="Instru[]" value="{{$instru->id}}" id="{{$instru->id}}{{$instru->nombre}}">
                </div>
            @endforeach
        </div>

        <div>
            <button type="submit">Crear Usuario</button>
        </div>
    </form>
</x-app-layout>
