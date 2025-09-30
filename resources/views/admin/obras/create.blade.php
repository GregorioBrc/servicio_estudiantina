<x-app-layout title="Crear Obra">
    <h1>Crear Nueva Obra</h1>
    <nav>
        <a href="{{ route('admin.obras.index') }}">---Volver al listado---</a>
    </nav>

    <!-- Formulario Crear Obra -->
    <form method="POST" action="{{ route('admin.obras.store') }}">
        @csrf

        <div>
            <label for="titulo">Título de la Obra:</label>
            <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
            @error('titulo')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="anio">Año:</label>
            <input type="number" id="anio" name="anio" value="{{ old('anio') }}" min="1900" max="{{ date('Y') }}" required>
            @error('anio')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <h3>Autores y Contribuciones</h3>
            <div id="autores-contribuciones">
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
            </div>
            <button type="button" onclick="agregarAutorContribucion()">Agregar Autor</button>
        </div>

        <div>
            <button type="submit">Crear Obra</button>
        </div>
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
