<x-app-layout title="Tipos de Contribución">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-12 gap-4">
                <div class="text-center sm:text-left">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Tipos de Contribución</h1>
                    <p class="text-lg text-gray-600">Gestionar tipos de contribución para obras</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-emerald-500 to-teal-500 sm:mx-0 mx-auto mt-4 rounded-full"></div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.index') }}" class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-6 py-3 rounded-lg shadow-lg hover:from-gray-600 hover:to-gray-700 transition duration-300 flex items-center gap-2 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.tipo_contribuciones.create') }}" class="bg-gradient-to-r from-yellow-500 to-yellow-700 text-white px-6 py-3 rounded-lg shadow-lg hover:from-yellow-600 hover:to-orange-700 transition duration-300 flex items-center gap-2 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Crear Tipo
                    </a>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @include('components.alert-messages')

            <!-- Tipos List - Desktop Table / Mobile Cards -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Lista de Tipos de Contribución</h2>
                </div>

                <!-- Desktop Table View -->
                <div class="hidden lg:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contribuciones</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($tiposContribucion as $tipo)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                                    <div class="text-sm font-medium text-yellow-900">{{ $tipo->id }}</div>
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <a href="{{ route('admin.tipo_contribuciones.show', $tipo) }}" class="text-yellow-600 hover:text-yellow-800 hover:underline">
                                        {{ $tipo->nombre_contribucion }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        {{ $tipo->contribuciones->count() }} contribuciones
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.tipo_contribuciones.show', $tipo) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs transition duration-200">Ver</a>
                                        <a href="{{ route('admin.tipo_contribuciones.edit', $tipo) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs transition duration-200">Editar</a>
                                        <form action="{{ route('admin.tipo_contribuciones.destroy', $tipo) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition duration-200" onclick="return confirm('¿Estás seguro de eliminar este tipo de contribución?')">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No hay tipos de contribución registrados</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Mobile/Tablet Card View -->
                <div class="lg:hidden">
                    @forelse ($tiposContribucion as $tipo)
                    <div class="p-4 hover:bg-gray-50 transition duration-200 border-b border-gray-200 last:border-b-0">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        <a href="{{ route('admin.tipo_contribuciones.show', $tipo) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                                            {{ $tipo->nombre_contribucion }}
                                        </a>
                                    </div>
                                    <div class="text-sm text-gray-500">ID: #{{ $tipo->id }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800">
                                {{ $tipo->contribuciones->count() }} contribuciones
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('admin.tipo_contribuciones.show', $tipo) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded text-sm transition duration-200 flex-1 text-center">Ver</a>
                            <a href="{{ route('admin.tipo_contribuciones.edit', $tipo) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded text-sm transition duration-200 flex-1 text-center">Editar</a>
                            <form action="{{ route('admin.tipo_contribuciones.destroy', $tipo) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm transition duration-200" onclick="return confirm('¿Estás seguro de eliminar este tipo de contribución?')">Eliminar</button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">No hay tipos de contribución</h3>
                        <p class="mt-2 text-gray-500">Aún no se han registrado tipos de contribución en el sistema.</p>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($tiposContribucion->hasPages())
                <div class="px-4 py-4 bg-gray-50 border-t border-gray-200 sm:px-6">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-sm text-gray-700 text-center sm:text-left">
                            Mostrando <span class="font-medium">{{ $tiposContribucion->firstItem() }}</span> a <span class="font-medium">{{ $tiposContribucion->lastItem() }}</span> de <span class="font-medium">{{ $tiposContribucion->total() }}</span> resultados
                        </div>
                        <div class="flex flex-wrap justify-center gap-1 sm:space-x-1">
                            {{-- Previous Page Link --}}
                            @if ($tiposContribucion->onFirstPage())
                            <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded cursor-not-allowed sm:px-3">Anterior</span>
                            @else
                            <a href="{{ $tiposContribucion->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition duration-200 sm:px-3">Anterior</a>
                            @endif

                            {{-- First Page (Desktop only) --}}
                            @if($tiposContribucion->currentPage() > 3)
                            <a href="{{ $tiposContribucion->url(1) }}" class="hidden px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition duration-200 sm:inline-block">1</a>
                            @if($tiposContribucion->currentPage() > 4)
                            <span class="hidden px-2 py-2 text-sm text-gray-500 sm:inline-block">...</span>
                            @endif
                            @endif

                            {{-- Page Numbers Around Current Page --}}
                            @php
                            // Mobile: solo 3 páginas alrededor de la actual
                            // Desktop: 5 páginas alrededor de la actual
                            $start = max(1, $tiposContribucion->currentPage() - 1);
                            $end = min($tiposContribucion->lastPage(), $tiposContribucion->currentPage() + 1);

                            // En desktop, mostrar más páginas
                            if (!preg_match('/mobile|android|iphone|ipad/i', request()->header('User-Agent', ''))) {
                            $start = max(1, $tiposContribucion->currentPage() - 2);
                            $end = min($tiposContribucion->lastPage(), $tiposContribucion->currentPage() + 2);
                            }
                            @endphp

                            @for ($page = $start; $page <= $end; $page++)
                                @if ($page==$tiposContribucion->currentPage())
                                <span class="px-4 py-2 text-sm font-medium text-white bg-blue-500 border border-blue-500 rounded sm:px-3">{{ $page }}</span>
                                @else
                                <a href="{{ $tiposContribucion->url($page) }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition duration-200 sm:px-3">{{ $page }}</a>
                                @endif
                                @endfor

                                {{-- Last Page (Desktop only) --}}
                                @if($tiposContribucion->currentPage() < $tiposContribucion->lastPage() - 2)
                                    @if($tiposContribucion->currentPage() < $tiposContribucion->lastPage() - 3)
                                        <span class="hidden px-2 py-2 text-sm text-gray-500 sm:inline-block">...</span>
                                        @endif
                                        <a href="{{ $tiposContribucion->url($tiposContribucion->lastPage()) }}" class="hidden px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition duration-200 sm:inline-block">{{ $tiposContribucion->lastPage() }}</a>
                                        @endif

                                        {{-- Next Page Link --}}
                                        @if ($tiposContribucion->hasMorePages())
                                        <a href="{{ $tiposContribucion->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition duration-200 sm:px-3">Siguiente</a>
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
