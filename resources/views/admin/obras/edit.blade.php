<x-app-layout title="Editar Obra">
    <nav>
        <a href="{{ route('admin.obras.index') }}">Volver al listado</a>
        <a href="{{ route('admin.obras.show', $obra) }}">Mostrar obra</a>
    </nav>

    <h1>Editar obra {{ $obra->titulo }}</h1>

    <form method="POST" action="{{ route('admin.obras.update', $obra) }}">
        @csrf
        @method('PUT')

        <!-- Campo oculto para el título actual -->
        <input type="hidden" name="titulo_actual" value="{{ $obra->titulo }}">

        <div>
            <label for="titulo">Título de la Obra:</label>
            <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $obra->titulo) }}" required>
            @error('titulo')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="anio">Año:</label>
            <input type="number" name="anio" id="anio" value="{{ old('anio', $obra->anio) }}" min="1900" max="{{ date('Y') }}" required>
            @error('anio')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <h3>Autores y Contribuciones</h3>
            <div id="autores-contribuciones">
                @if($obra->autores->count() > 0)
                    @foreach($obra->autores as $index => $autor)
                        <div class="autor-contribucion">
                            <select name="autores[]">
                                <option value="">Seleccionar Autor</option>
                                @foreach($autores as $a)
                                    <option value="{{ $a->id }}" {{ $a->id == $autor->id ? 'selected' : '' }}>
                                        {{ $a->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <select name="tipos_contribucion[]">
                                <option value="">Seleccionar Tipo de Contribución</option>
                                @foreach($tiposContribucion as $tipo)
                                    <option value="{{ $tipo->id }}" {{ $autor->pivot->tipo_contribucion_id == $tipo->id ? 'selected' : '' }}>
                                        {{ $tipo->nombre_contribucion }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="button" onclick="eliminarAutorContribucion(this)">Eliminar</button>
                        </div>
                    @endforeach
                @else
                    <div class="autor-contribucion">
                        <select name="autores[]">
                            <option value="">Seleccionar Autor</option>
                            @foreach($autores as $autor)
                                <option value="{{ $autor->id }}">{{ $autor->nombre }}</option>
                            @endforeach
                        </select>
                        <select name="tipos_contribucion[]">
                            <option value="">Seleccionar Tipo de Contribución</option>
                            @foreach($tiposContribucion as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->nombre_contribucion }}</option>
                            @endforeach
                        </select>
                        <button type="button" onclick="eliminarAutorContribucion(this)">Eliminar</button>
                    </div>
                @endif
            </div>
            <button type="button" onclick="agregarAutorContribucion()">Agregar Autor</button>
        </div>

        <button type="submit">Actualizar obra</button>
    </form>

    <script>
        function agregarAutorContribucion() {
            const contenedor = document.getElementById('autores-contribuciones');
            const nuevoDiv = document.createElement('div');
            nuevoDiv.className = 'autor-contribucion';
            nuevoDiv.innerHTML = `
                <select name="autores[]">
                    <option value="">Seleccionar Autor</option>
                    @foreach($autores as $autor)
                        <option value="{{ $autor->id }}">{{ $autor->nombre }}</option>
                    @endforeach
                </select>
                <select name="tipos_contribucion[]">
                    <option value="">Seleccionar Tipo de Contribución</option>
                    @foreach($tiposContribucion as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->nombre_contribucion }}</option>
                    @endforeach
                </select>
                <button type="button" onclick="eliminarAutorContribucion(this)">Eliminar</button>
            `;
            contenedor.appendChild(nuevoDiv);
        }

        function eliminarAutorContribucion(boton) {
            boton.parentElement.remove();
        }
    </script>
</x-app-layout>
