<x-app-layout title="Crear Instrumento">
    <div class="min-h-screen bg-white text-gray-900 p-6 flex items-center justify-center">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg border border-gray-200">
            <h1 class="text-3xl font-bold mb-6 text-center text-gray-900">Crear Nuevo Instrumento</h1>

            <form action="{{ route('admin.instrumentos.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del Instrumento:</label>
                    <input type="text" name="nombre" id="nombre" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-gray-900" required value="{{ old('nombre') }}">
                    @error('nombre')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo de Instrumento:</label>
                    <input type="text" name="tipo" id="tipo" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-gray-900"  required value="{{ old('tipo') }}">
                    @error('tipo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4 mt-6">
                    <a href="{{ route('admin.instrumentos.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" style="background-color: #ffffff;">
                        Cancelar
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Guardar Instrumento
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
