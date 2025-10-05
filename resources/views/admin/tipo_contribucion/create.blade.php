<x-app-layout title="Crear Tipo de Contribución">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-12 gap-4">
                <div class="text-center sm:text-left">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Crear Tipo de Contribución</h1>
                    <p class="text-lg text-gray-600">Agregar un nuevo tipo de contribución</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-emerald-500 to-teal-500 sm:mx-0 mx-auto mt-4 rounded-full"></div>
                </div>
                <a href="{{ route('admin.tipo_contribuciones.index') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-lg shadow-lg hover:from-blue-600 hover:to-blue-700 transition duration-300 flex items-center gap-2 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver al Listado
                </a>
            </div>

            <!-- Create Form -->
            <div class="bg-white shadow-lg rounded-xl p-8 border-t-4 border-emerald-500">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Formulario de Creación</h2>
                </div>
                <form method="POST" action="{{ route('admin.tipo_contribuciones.store')}}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="nombre_contribucion" class="block text-sm font-medium text-gray-700 mb-2">Nombre del Tipo de Contribución</label>
                        <div class="relative">
                            <input type="text" id="nombre_contribucion" name="nombre_contribucion" value="{{ old('nombre_contribucion') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200" required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-9 0V1m10 3V1m0 3l1 1v16a2 2 0 01-2 2H6a2 2 0 01-2-2V5l1-1z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('nombre_contribucion')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-6 py-3 rounded-lg hover:from-emerald-600 hover:to-teal-700 transition duration-300 font-medium shadow-lg">
                            Crear Tipo de Contribución
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
