<x-app-layout title="Crear Partitura">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-12 gap-4">
                <div class="text-center sm:text-left">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Crear Nueva Partitura</h1>
                    <p class="text-lg text-gray-600">Agregar una partitura al sistema</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-teal-500 to-cyan-500 sm:mx-0 mx-auto mt-4 rounded-full"></div>
                </div>
                <a href="{{ route('admin.partituras.index') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-lg shadow-lg hover:from-blue-600 hover:to-blue-700 transition duration-300 flex items-center gap-2 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver al Listado
                </a>
            </div>

            <!-- Create Form -->
            <div class="bg-white shadow-lg rounded-xl p-8 border-t-4 border-teal-500">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Formulario de Creación</h2>
                </div>
                <form method="POST" action="{{ route('admin.partituras.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="obra_id" class="block text-sm font-medium text-gray-700 mb-2">Obra</label>
                        <div class="relative">
                            <select id="obra_id" name="obra_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition duration-200" required>
                                <option value="">Seleccionar Obra</option>
                                @foreach($obras as $obra)
                                    <option value="{{ $obra->id }}" {{ old('obra_id') == $obra->id ? 'selected' : '' }}>{{ $obra->titulo }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                                </svg>
                            </div>
                        </div>
                        @error('obra_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="instrumento_id" class="block text-sm font-medium text-gray-700 mb-2">Instrumento</label>
                        <div class="relative">
                            <select id="instrumento_id" name="instrumento_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition duration-200" required>
                                <option value="">Seleccionar Instrumento</option>
                                @foreach($instrumentos as $instrumento)
                                    <option value="{{ $instrumento->id }}" {{ old('instrumento_id') == $instrumento->id ? 'selected' : '' }}>{{ $instrumento->nombre }} ({{ $instrumento->tipo }})</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                                </svg>
                            </div>
                        </div>
                        @error('instrumento_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="url_pdf" class="block text-sm font-medium text-gray-700 mb-2">Enlace del PDF (opcional)</label>
                        <div class="relative">
                            <input type="url" id="url_pdf" name="url_pdf" value="{{ old('url_pdf') }}" placeholder="https://..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition duration-200">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('url_pdf')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="link_video" class="block text-sm font-medium text-gray-700 mb-2">Enlace de Video (opcional)</label>
                        <div class="relative">
                            <input type="url" id="link_video" name="link_video" value="{{ old('link_video') }}" placeholder="https://..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition duration-200">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('link_video')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-gradient-to-r from-teal-500 to-cyan-600 text-white px-6 py-3 rounded-lg hover:from-teal-600 hover:to-cyan-700 transition duration-300 font-medium shadow-lg">
                            Crear Partitura
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
