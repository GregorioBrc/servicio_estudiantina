<x-app-layout title="Editar Obra">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-12 gap-4">
                <div class="text-center sm:text-left">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Editar Obra</h1>
                    <p class="text-lg text-gray-600">Modificar información de {{ $obra->titulo }}</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-yellow-500 to-orange-500 sm:mx-0 mx-auto mt-4 rounded-full"></div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.obras.index') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-lg shadow-lg hover:from-blue-600 hover:to-blue-700 transition duration-300 flex items-center gap-2 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Volver al Listado
                    </a>
                    <a href="{{ route('admin.obras.show', $obra) }}" class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-3 rounded-lg shadow-lg hover:from-purple-600 hover:to-purple-700 transition duration-300 flex items-center gap-2 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Ver Obra
                    </a>
                </div>
            </div>

            <!-- Edit Form -->
            <div class="bg-white shadow-lg rounded-xl p-8 border-t-4 border-yellow-500">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Formulario de Edición</h2>
                </div>
                <form method="POST" action="{{ route('admin.obras.update', $obra) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Campo oculto para el título actual -->
                    <input type="hidden" name="titulo_actual" value="{{ $obra->titulo }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="titulo" class="block text-sm font-medium text-gray-700 mb-2">Título de la Obra</label>
                            <div class="relative">
                                <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $obra->titulo) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition duration-200" required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-9 0V1m10 3V1m0 3l1 1v16a2 2 0 01-2 2H6a2 2 0 01-2-2V5l1-1z"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('titulo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Autores y Contribuciones</h3>
                        <div id="autores-contribuciones" class="space-y-4">
                            @if($obra->autores->count() > 0)
                                @foreach($obra->autores as $index => $autor)
                                    <div class="autor-contribucion flex flex-col sm:flex-row gap-4 p-4 bg-gray-50 rounded-lg">
                                        <div class="flex-1">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Autor</label>
                                            <select name="autores[]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                                <option value="">Seleccionar Autor</option>
                                                @foreach($autores as $a)
                                                    <option value="{{ $a->id }}" {{ $a->id == $autor->id ? 'selected' : '' }}>
                                                        {{ $a->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="flex-1">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Contribución</label>
                                            <select name="tipos_contribucion[]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                                <option value="">Seleccionar Tipo de Contribución</option>
                                                @foreach($tiposContribucion as $tipo)
                                                    <option value="{{ $tipo->id }}" {{ $autor->pivot->tipo_contribucion_id == $tipo->id ? 'selected' : '' }}>
                                                        {{ $tipo->nombre_contribucion }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="flex items-end">
                                            <button type="button" onclick="eliminarAutorContribucion(this)" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="autor-contribucion flex flex-col sm:flex-row gap-4 p-4 bg-gray-50 rounded-lg">
                                    <div class="flex-1">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Autor</label>
                                        <select name="autores[]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                            <option value="">Seleccionar Autor</option>
                                            @foreach($autores as $autor)
                                                <option value="{{ $autor->id }}">{{ $autor->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex-1">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Contribución</label>
                                        <select name="tipos_contribucion[]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                            <option value="">Seleccionar Tipo de Contribución</option>
                                            @foreach($tiposContribucion as $tipo)
                                                <option value="{{ $tipo->id }}">{{ $tipo->nombre_contribucion }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex items-end">
                                        <button type="button" onclick="eliminarAutorContribucion(this)" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="mt-4">
                            <button type="button" onclick="agregarAutorContribucion()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition duration-200 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Agregar Autor
                            </button>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-gradient-to-r from-yellow-500 to-orange-600 text-white px-6 py-3 rounded-lg hover:from-yellow-600 hover:to-orange-700 transition duration-300 font-medium shadow-lg">
                            Actualizar Obra
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function agregarAutorContribucion() {
            const contenedor = document.getElementById('autores-contribuciones');
            const nuevoDiv = document.createElement('div');
            nuevoDiv.className = 'autor-contribucion flex flex-col sm:flex-row gap-4 p-4 bg-gray-50 rounded-lg';
            nuevoDiv.innerHTML = `
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Autor</label>
                    <select name="autores[]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                        <option value="">Seleccionar Autor</option>
                        @foreach($autores as $autor)
                            <option value="{{ $autor->id }}">{{ $autor->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Contribución</label>
                    <select name="tipos_contribucion[]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                        <option value="">Seleccionar Tipo de Contribución</option>
                        @foreach($tiposContribucion as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->nombre_contribucion }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="button" onclick="eliminarAutorContribucion(this)" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            `;
            contenedor.appendChild(nuevoDiv);
        }

        function eliminarAutorContribucion(boton) {
            boton.closest('.autor-contribucion').remove();
        }
    </script>
</x-app-layout>
