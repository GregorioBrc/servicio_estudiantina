<x-app-layout title="Editar Autor">
    <nav>
        <a href="{{ route('admin.autores.index') }}">Volver al listado</a>
        <a href="{{ route('admin.autores.show', $autor->nombre) }}">Mostrar autor</a>
    </nav>

    <h1>Editar autor {{ $autor->nombre }}</h1>

    <form method="POST" action="{{ route('admin.autores.update', $autor) }}">
        @csrf
        @method('PUT')

        <!-- Campo oculto para el nombre actual -->
        <input type="hidden" name="nombre_actual" value="{{ $autor->nombre }}">

        <div>
            <label for="nombre">Nombre del Autor:</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $autor->nombre) }}" required>
            @error('nombre')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Actualizar autor</button>
    </form>
</x-app-layout>
