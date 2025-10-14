<x-app-layout title="Partituras por Autor">
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header section -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-12 gap-4">
                <div class="text-center sm:text-left">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Partituras por Autor</h1>
                    <p class="text-gray-600">Explora las partituras organizadas por autor y su contribución</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-indigo-500 sm:mx-0 mx-auto mt-4 rounded-full">
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row items-center gap-3">
                    <div
                        class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-4 py-2 rounded-full text-sm font-medium shadow-lg">
                        {{ $totalPartituras }} partituras
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

            <!-- Link to partituras -->
            <div class="flex justify-start mb-4">
                <a href="{{ route('usuario.partituras') }}" class="text-sm text-blue-600 hover:text-blue-800 transition duration-200">
                    &lt;- Ver partituras
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
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-blue-600">{{ count($autoresConPartituras) }}</div>
                            <div class="text-gray-600 text-sm">Total de autores</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search section -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <label for="search-input" class="block text-sm font-medium text-gray-700 mb-2">
                                                    Buscar por título de obra o nombre de autor
                                                </label>
                        <div class="relative">
                            <input type="text" id="search-input" placeholder="Buscar partituras..."
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   value="{{ $autorBuscado ?? '' }}">
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
                @forelse ($autoresConPartituras as $data)
                    <div class="border-b border-gray-200 last:border-b-0">
                        <button
                            class="w-full px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition duration-200 autor-toggle">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <h3 class="font-semibold text-gray-900">{{ $data['autor']->nombre }}</h3>
                                    <p class="text-sm text-gray-500" data-original-count="{{ count($data['obras']) }}">
                                                                            {{ count($data['obras']) }} obra(s) disponible(s)
                                                                        </p>
                                </div>
                            </div>
                            <svg class="chevron-icon w-5 h-5 text-gray-400 transform transition-transform duration-200"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div class="autor-content hidden px-6 pb-4">
                            <div class="grid gap-4 p-3">
                                @forelse ($data['obras'] as $obraData)
                                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200"
                                         data-obra-titulo="{{ $obraData['obra']->titulo }}">
                                        <h4 class="font-semibold text-gray-800">
                                            {{ $obraData['obra']->titulo }}
                                        </h4>
                                        @if ($obraData['tipo_contribucion'])
                                            <p class="text-sm text-gray-500 mb-3">
                                                Contribución:
                                                {{ $obraData['tipo_contribucion'] }}
                                            </p>
                                        @endif
                                        <div class="grid gap-2">
                                            @forelse ($obraData['partituras'] as $partituraData)
                                                <div
                                                    class="flex items-center justify-between p-3 bg-white rounded-lg hover:bg-blue-50 transition duration-200 border border-gray-100">
                                                    <div class="flex items-center gap-3">
                                                        <div
                                                            class="w-8 h-8 bg-blue-50 rounded flex items-center justify-center">
                                                            <svg class="w-4 h-4 text-blue-600" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('usuario.show.partitura', ['id' => $partituraData['partitura']->id, 'from' => 'autor']) }}"
                                                                class="font-medium text-gray-900 hover:text-blue-600 transition duration-200">
                                                                Partitura -
                                                                <strong>
                                                                    {{ $partituraData['instrumento']->nombre }}
                                                                    {{ $partituraData['instrumento']->tipo }}
                                                                </strong>
                                                            </a>

                                                        </div>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        @if ($partituraData['partitura']->link_video)
                                                            <span
                                                                class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">
                                                                <svg class="w-3 h-3" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                                                    </path>
                                                                </svg>
                                                                <a href="{{ $partituraData['partitura']->link_video }}"
                                                                    target="_blank">Video</a>
                                                            </span>
                                                        @endif
                                                        <span class="text-gray-400">•</span>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="text-center py-4 text-gray-500">
                                                    <p>No hay partituras para esta obra.</p>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-6 text-gray-500">
                                        <p>No hay obras disponibles para este autor.</p>
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
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">No hay autores con partituras</h3>
                        <p class="mt-2 text-gray-500">No tienes partituras asignadas actualmente o no hay autores
                            disponibles.</p>
                    </div>
                @endforelse
            </div>
        </div>

        @vite(['resources/js/partituras.js'])

</x-app-layout>
