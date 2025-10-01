<x-app-layout title="Detalle de Instrumento">
    <div class="min-h-screen bg-white text-gray-900 p-6 flex items-center justify-center">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg border border-gray-200">
            <h1 class="text-3xl font-bold mb-6 text-center text-gray-900">Detalle del Instrumento</h1>

            <div class="space-y-4">
                <div>
                    <p class="text-sm font-medium text-gray-700">ID:</p>
                    <p class="text-lg font-semibold text-gray-900">#{{ $instrumento->id }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-700">Nombre:</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $instrumento->nombre }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-700">Tipo:</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $instrumento->tipo }}</p>
                </div>
            </div>

            <div class="flex justify-start space-x-4 mt-8">
                <a href="{{ route('admin.instrumentos.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Volver al Listado
                </a>
                <a href="{{ route('admin.instrumentos.edit', $instrumento) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                    Editar
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
