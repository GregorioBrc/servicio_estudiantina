<x-app-layout title="Crear Instrumento">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-12 gap-4">
                <div class="text-center sm:text-left">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Crear Nuevo Instrumento</h1>
                    <p class="text-lg text-gray-600">Agregar un instrumento al sistema</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-red-500 to-pink-500 sm:mx-0 mx-auto mt-4 rounded-full"></div>
                </div>
                <a href="{{ route('admin.instrumentos.index') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-lg shadow-lg hover:from-blue-600 hover:to-blue-700 transition duration-300 flex items-center gap-2 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver al Listado
                </a>
            </div>

            <!-- Success/Error Messages -->
            @include('components.alert-messages')

            <!-- Create Form -->
            <div class="bg-white shadow-lg rounded-xl p-8 border-t-4 border-red-500">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Formulario de Creación</h2>
                </div>
                <form method="POST" action="{{ route('admin.instrumentos.store') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">Nombre del Instrumento</label>
                            <div class="relative">
                                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200" required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('nombre')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <label class="block text-sm font-medium text-gray-700">Tipos de Instrumento</label>
                                <button type="button" id="add-tipo-btn" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm transition duration-200 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Agregar Tipo
                                </button>
                            </div>

                            <div id="tipos-container" class="space-y-3">
                                @if(old('tipos') && count(old('tipos')) > 0)
                                    @foreach(old('tipos') as $index => $tipo)
                                        <div class="tipo-item flex gap-3 items-center">
                                            <div class="relative flex-1">
                                                <input type="text" name="tipos[]" value="{{ $tipo }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200" placeholder="Tipo de instrumento" required>
                                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-9 0V1m10 3V1m0 3l1 1v16a2 2 0 01-2 2H6a2 2 0 01-2-2V5l1-1z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <button type="button" class="remove-tipo-btn bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded transition duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="tipo-item flex gap-3 items-center">
                                        <div class="relative flex-1">
                                            <input type="text" name="tipos[]" value="" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200" placeholder="Tipo de instrumento" required>
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-9 0V1m10 3V1m0 3l1 1v16a2 2 0 01-2 2H6a2 2 0 01-2-2V5l1-1z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <button type="button" class="remove-tipo-btn bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded transition duration-200" style="display: none;">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                @endif
                            </div>

                            @error('tipos')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('tipos.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-gradient-to-r from-red-500 to-pink-600 text-white px-6 py-3 rounded-lg hover:from-red-600 hover:to-pink-700 transition duration-300 font-medium shadow-lg">
                            Crear Instrumentos
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addTipoBtn = document.getElementById('add-tipo-btn');
            const tiposContainer = document.getElementById('tipos-container');

            // Función para actualizar la visibilidad de los botones de eliminar
            function updateRemoveButtons() {
                const removeButtons = tiposContainer.querySelectorAll('.remove-tipo-btn');
                removeButtons.forEach(btn => {
                    btn.style.display = removeButtons.length > 1 ? 'block' : 'none';
                });
            }

            // Agregar nuevo campo de tipo
            addTipoBtn.addEventListener('click', function() {
                const tipoItem = document.createElement('div');
                tipoItem.className = 'tipo-item flex gap-3 items-center';
                tipoItem.innerHTML = `
                    <div class="relative flex-1">
                        <input type="text" name="tipos[]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200" placeholder="Tipo de instrumento" required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-9 0V1m10 3V1m0 3l1 1v16a2 2 0 01-2 2H6a2 2 0 01-2-2V5l1-1z"></path>
                            </svg>
                        </div>
                    </div>
                    <button type="button" class="remove-tipo-btn bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded transition duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                `;
                tiposContainer.appendChild(tipoItem);
                updateRemoveButtons();
            });

            // Eliminar campo de tipo
            tiposContainer.addEventListener('click', function(e) {
                if (e.target.closest('.remove-tipo-btn')) {
                    const tipoItem = e.target.closest('.tipo-item');
                    if (tiposContainer.children.length > 1) {
                        tipoItem.remove();
                        updateRemoveButtons();
                    }
                }
            });

            // Inicializar botones
            updateRemoveButtons();
        });
    </script>
</x-app-layout>
