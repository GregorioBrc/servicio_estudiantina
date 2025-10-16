<x-app-layout title="Partituras usuario">
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header section -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-12 gap-4">
                <div class="text-center sm:text-left">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Mis Partituras</h1>
                    <p class="text-gray-600">Gestiona y organiza tu colección de partituras</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-indigo-500 sm:mx-0 mx-auto mt-4 rounded-full">
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row items-center gap-3">
                    <div
                        class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-4 py-2 rounded-full text-sm font-medium shadow-lg">
                        {{ $User->instrumentos->count() }} instrumentos
                    </div>
                    <a href="{{ route('usuario.dashboard') }}"
                        class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-3 rounded-lg shadow-lg hover:from-green-600 hover:to-green-700 transition duration-300 flex items-center gap-2 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Volver al Dashboard
                    </a>
                </div>
            </div>

            <!-- Link to partituras por autor -->
            <div class="flex justify-end mb-4">
                <a href="{{ route('usuario.partituras.autor') }}" class="text-sm text-blue-600 hover:text-blue-800 transition duration-200">
                    Ver por autores -&gt;
                </a>
            </div>

            <!-- Stats summary -->
            <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-8">
                <div
                    class="bg-white shadow-lg rounded-xl p-6 hover:shadow-xl transition-shadow duration-300 border-l-4 border-blue-500">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-blue-600">{{ $totalPartituras }}</div>
                            <div class="text-gray-900 text-sm">Total de partituras</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search section -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <label for="search-input" class="block text-sm font-medium text-gray-900 mb-2">
                            Buscar por título de obra
                        </label>
                        <div class="relative">
                            <input type="text" id="search-input" placeholder="Buscar partituras..."
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-500">
                            <button type="button" id="clear-search" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 hidden">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                @forelse ($User->instrumentos as $instrumento)
                <div class="border-b border-gray-200 last:border-b-0">
                    <button
                        class="w-full px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition duration-200 instrumento-toggle">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                    </path>
                                </svg>
                            </div>
                            <div class="text-left">
                                <h3 class="font-semibold text-gray-900">{{ $instrumento->nombre }}</h3>
                                <p class="text-sm text-gray-500" data-original-count="{{ $instrumento->partituras->count() }}">
                                                                    {{ $instrumento->partituras->count() }} partitura(s) disponible(s)
                                                                </p>
                            </div>
                        </div>
                        <svg class="chevron-icon w-5 h-5 text-gray-400 transform transition-transform duration-200"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div class="instrumento-content hidden px-6 pb-4">
                        <div class="grid gap-2">
                            @forelse ($instrumento->partituras as $partitura)
                            <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition duration-200 border border-gray-100"
                                data-instrumento="{{ $instrumento->id }}"
                                data-obra-titulo="{{ $partitura->obra->titulo }}">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-blue-50 rounded flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <a href="{{ route('usuario.show.partitura', ['id' => $partitura->id]) }}"
                                            class="font-medium text-gray-900 hover:text-blue-600 transition duration-200">
                                            {{ $partitura->obra->titulo }}
                                        </a>
                                        @if ($partitura->obra->autores)
                                        @foreach ($partitura->obra->autores as $autor)
                                        <p class="text-sm text-gray-500">
                                            <a href="{{ route('usuario.partituras.autor', ['autor' => $autor->nombre]) }}" class="hover:text-blue-600 transition duration-200">
                                                {{ $autor->nombre }}
                                            </a>
                                            @if($autor->tipo_contribucion_nombre)
                                            ({{ $autor->tipo_contribucion_nombre }})
                                            @else
                                            (Sin tipo de contribución)
                                            @endif
                                        </p>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    @if ($partitura->link_video)
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                            </path>
                                        </svg>
                                        <a href="{{ $partitura->link_video }}">Video</a>
                                    </span>
                                    @endif
                                    <span class="text-gray-400">•</span>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-6 text-gray-500">
                                <svg class="w-12 h-12 mx-auto text-gray-300" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <p class="mt-2">No hay partituras para este instrumento.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                        </path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No tienes instrumentos asignados</h3>
                    <p class="mt-2 text-gray-500">Contacta con el administrador para que te asigne instrumentos.
                    </p>
                </div>
                @endforelse
            </div>
        </div>

        @vite(['resources/js/partituras.js'])

</x-app-layout>
