<x-app-layout title="Editar usuario">
    <nav>
        <a href="{{ route('admin.usuarios.index') }}">Volver al listado</a>
        <a href="{{ route('admin.usuarios.show', $user->id) }}">Mostrar usuario</a>
    </nav>

    <h1>Editar usuario {{ $user->name }}</h1>

    <form method="POST" action="{{ route('admin.usuarios.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div>
            <label for="es_escritor">
                <input type="checkbox" name="es_escritor" id="es_escritor" value="1" {{ old('es_escritor', $user->es_escritor) ? 'checked' : '' }}>
                Es administrador
            </label>
        </div>

        <div>
            <label for="password">Nueva contraseña (dejar vacío para no cambiar):</label>
            <input type="password" name="password" id="password">
        </div>

        <div>
            <label for="password_confirmation">Confirmar nueva contraseña:</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
        </div>

        <div>
            <h2>Instrumentos</h2>
            @foreach ($instrumentos as $instru)
                <div>
                    <label for="Instru_{{ $instru->id }}">{{ $instru->nombre }} {{ $instru->tipo }}</label>
                    <input type="checkbox" name="Instru[]" value="{{ $instru->id }}" id="Instru_{{ $instru->id }}"
                           {{ in_array($instru->id, old('Instru', $user->instrumentos->pluck('id')->toArray())) ? 'checked' : '' }}>
                </div>
            @endforeach
        </div>

        <button type="submit">Actualizar usuario</button>
    </form>
</x-app-layout>
