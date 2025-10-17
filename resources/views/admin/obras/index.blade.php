<x-app-layout title="Obras">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-12 gap-4">
                <div class="text-center sm:text-left">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Gestión de Obras</h1>
                    <p class="text-lg text-gray-600">Administrar obras musicales</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 sm:mx-0 mx-auto mt-4 rounded-full"></div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.index') }}" class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-6 py-3 rounded-lg shadow-lg hover:from-gray-600 hover:to-gray-700 transition duration-300 flex items-center gap-2 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.obras.create') }}" class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-6 py-3 rounded-lg shadow-lg hover:from-indigo-600 hover:to-purple-700 transition duration-300 flex items-center gap-2 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Crear Nueva Obra
                    </a>
                </div>
            </div>

            <!-- Search Form -->
            <div class="mb-8">
                <form method="GET" action="{{ route('admin.obras.index') }}" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow">
                        <input
                            type="text"
                            name="search"
                            placeholder="Buscar por título..."
                            value="{{ request('search') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 placeholder-gray-500"
                        >
                    </div>
                    <div class="flex gap-2">
                        <button
                            type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow transition duration-200 flex items-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Buscar
                        </button>
                        @if(request('search'))
                        <a
                            href="{{ route('admin.obras.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow transition duration-200 flex items-center gap-2"
                        >
                            Limpiar
                        </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Success/Error Messages -->
            @include('components.alert-messages')

            <!-- Works List - Desktop Table / Mobile Cards -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Lista de Obras</h2>
                </div>

                <!-- Desktop Table View -->
                <div class="hidden lg:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Año</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Autores</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Partituras</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($obras as $obra)
                                <tr class="hover:bg-gray-50 transition duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                                                </svg>
                                            </div>
                                            <div class="text-sm font-medium text-gray-900">
                                                <a href="{{ route('admin.obras.show', $obra) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                                                    {{ $obra->titulo }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $obra->anio }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        @foreach($obra->autores as $autor)
                                            <div class="mb-1">
                                                <a href="{{ route('admin.autores.show', $autor) }}" class="text-green-600 hover:text-green-800 hover:underline">
                                                    {{ $autor->nombre }}
                                                </a>
                                                <span class="text-xs text-gray-400">({{ $autor->pivot->tipoContribucion->nombre_contribucion ?? 'Sin tipo' }})</span>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $obra->partituras->count() }} partitura(s)</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.obras.show', $obra) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs transition duration-200">Ver</a>
                                            <a href="{{ route('admin.obras.edit', $obra) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs transition duration-200">Editar</a>
                                            <form action="{{ route('admin.obras.destroy', $obra) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition duration-200" onclick="return confirm('¿Está seguro de eliminar esta obra?')">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile/Tablet Card View -->
                <div class="lg:hidden">
                    @if($obras->isNotEmpty())
                        <div class="divide-y divide-gray-200">
                            @foreach ($obras as $obra)
                                <div class="p-4 hover:bg-gray-50 transition duration-200">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    <a href="{{ route('admin.obras.show', $obra) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                                                        {{ $obra->titulo }}
                                                    </a>
                                                </div>
                                                <div class="text-sm text-gray-500">{{ $obra->anio }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="text-xs text-gray-500 mb-1">Autores:</div>
                                        <div class="text-sm text-gray-700">
                                            @foreach($obra->autores as $autor)
                                                <div>
                                                    <a href="{{ route('admin.autores.show', $autor) }}" class="text-green-600 hover:text-green-800 hover:underline">
                                                        {{ $autor->nombre }}
                                                    </a>
                                                    <span class="text-xs text-gray-400">({{ $autor->pivot->tipoContribucion->nombre_contribucion ?? 'Sin tipo' }})</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="text-xs text-gray-500 mb-1">Partituras:</div>
                                        <div class="text-sm text-gray-700">{{ $obra->partituras->count() }} partitura(s)</div>
                                    </div>
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('admin.obras.show', $obra) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded text-sm transition duration-200 flex-1 text-center">Ver</a>
                                        <a href="{{ route('admin.obras.edit', $obra) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded text-sm transition duration-200 flex-1 text-center">Editar</a>
                                        <form action="{{ route('admin.obras.destroy', $obra) }}" method="POST" class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm transition duration-200" onclick="return confirm('¿Está seguro de eliminar esta obra?')">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                @if($obras->isEmpty())
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">No hay obras</h3>
                        <p class="mt-2 text-gray-500">Aún no se han registrado obras en el sistema.</p>
                    </div>
                @endif

                <!-- Pagination -->
                @if($obras->hasPages())
                    <div class="px-4 py-4 bg-gray-50 border-t border-gray-200 sm:px-6">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="text-sm text-gray-700 text-center sm:text-left">
                                Mostrando <span class="font-medium">{{ $obras->firstItem() }}</span> a <span class="font-medium">{{ $obras->lastItem() }}</span> de <span class="font-medium">{{ $obras->total() }}</span> resultados
                            </div>
                            <div class="flex flex-wrap justify-center gap-1 sm:space-x-1">
                                {{-- Previous Page Link --}}
                                @if ($obras->onFirstPage())
                                    <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded cursor-not-allowed sm:px-3">Anterior</span>
                                @else
                                    <a href="{{ $obras->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition duration-200 sm:px-3">Anterior</a>
                                @endif

                                {{-- First Page (Desktop only) --}}
                                @if($obras->currentPage() > 3)
                                    <a href="{{ $obras->url(1) }}" class="hidden px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition duration-200 sm:inline-block">1</a>
                                    @if($obras->currentPage() > 4)
                                        <span class="hidden px-2 py-2 text-sm text-gray-500 sm:inline-block">...</span>
                                    @endif
                                @endif

                                {{-- Page Numbers Around Current Page --}}
                                @php
                                    // Mobile: solo 3 páginas alrededor de la actual
                                    // Desktop: 5 páginas alrededor de la actual
                                    $start = max(1, $obras->currentPage() - 1);
                                    $end = min($obras->lastPage(), $obras->currentPage() + 1);

                                    // En desktop, mostrar más páginas
                                    if (!preg_match('/mobile|android|iphone|ipad/i', request()->header('User-Agent', ''))) {
                                        $start = max(1, $obras->currentPage() - 2);
                                        $end = min($obras->lastPage(), $obras->currentPage() + 2);
                                    }
                                @endphp

                                @for ($page = $start; $page <= $end; $page++)
                                    @if ($page == $obras->currentPage())
                                        <span class="px-4 py-2 text-sm font-medium text-white bg-blue-500 border border-blue-500 rounded sm:px-3">{{ $page }}</span>
                                    @else
                                        <a href="{{ $obras->url($page) }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition duration-200 sm:px-3">{{ $page }}</a>
                                    @endif
                                @endfor

                                {{-- Last Page (Desktop only) --}}
                                @if($obras->currentPage() < $obras->lastPage() - 2)
                                    @if($obras->currentPage() < $obras->lastPage() - 3)
                                        <span class="hidden px-2 py-2 text-sm text-gray-500 sm:inline-block">...</span>
                                    @endif
                                    <a href="{{ $obras->url($obras->lastPage()) }}" class="hidden px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition duration-200 sm:inline-block">{{ $obras->lastPage() }}</a>
                                @endif

                                {{-- Next Page Link --}}
                                @if ($obras->hasMorePages())
                                    <a href="{{ $obras->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition duration-200 sm:px-3">Siguiente</a>
                                @else
                                    <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded cursor-not-allowed sm:px-3">Siguiente</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
