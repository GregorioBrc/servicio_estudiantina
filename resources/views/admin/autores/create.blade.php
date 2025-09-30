<x-app-layout title="Crear Autor">
    <h1>Crear Autor</h1>
    <nav>
        <a href="{{ route('admin.autores.index') }}">---Volver al listado---</a>
    </nav>

    <!-- Formulario Crear Autor -->
    <form method="POST" action="{{ route('admin.autores.store') }}">
        @csrf

        <div>
            <label for="nombre">Nombre del Autor:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <button type="submit">Crear Autor</button>
        </div>
    </form>
</x-app-layout>
