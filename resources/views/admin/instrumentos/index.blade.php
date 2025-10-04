<x-app-layout title="Instrumentos">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-12 gap-4">
                <div class="text-center sm:text-left">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Gestión de Instrumentos</h1>
                    <p class="text-lg text-gray-600">Administrar instrumentos musicales</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-red-500 to-pink-500 sm:mx-0 mx-auto mt-4 rounded-full"></div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.index') }}" class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-6 py-3 rounded-lg shadow-lg hover:from-gray-600 hover:to-gray-700 transition duration-300 flex items-center gap-2 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.instrumentos.create') }}" class="bg-gradient-to-r from-red-500 to-pink-600 text-white px-6 py-3 rounded-lg shadow-lg hover:from-red-600 hover:to-pink-700 transition duration-300 flex items-center gap-2 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Crear Instrumento
                    </a>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Instruments List - Desktop Table / Mobile Cards -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Lista de Instrumentos</h2>
                </div>

                <!-- Desktop Table View -->
                <div class="hidden lg:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($instrumentos as $instrumento)
                                <tr class="hover:bg-gray-50 transition duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#{{ $instrumento->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                                                </svg>
                                            </div>
                                            <div class="text-sm font-medium text-gray-900">
                                                <a href="{{ route('admin.instrumentos.show', $instrumento) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                                                    {{ $instrumento->nombre }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            {{ $instrumento->tipo }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.instrumentos.show', $instrumento) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs transition duration-200">Ver</a>
                                            <a href="{{ route('admin.instrumentos.edit', $instrumento) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs transition duration-200">Editar</a>
                                            <form action="{{ route('admin.instrumentos.destroy', $instrumento) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition duration-200" onclick="return confirm('¿Estás seguro de eliminar este instrumento?')">Eliminar</button>
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
                    @if($instrumentos->isNotEmpty())
                        <div class="divide-y divide-gray-200">
                            @foreach ($instrumentos as $instrumento)
                                <div class="p-4 hover:bg-gray-50 transition duration-200">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    <a href="{{ route('admin.instrumentos.show', $instrumento) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                                                        {{ $instrumento->nombre }}
                                                    </a>
                                                </div>
                                                <div class="text-sm text-gray-500">#{{ $instrumento->id }}</div>
                                            </div>
                                        </div>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            {{ $instrumento->tipo }}
                                        </span>
                                    </div>
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('admin.instrumentos.show', $instrumento) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded text-sm transition duration-200 flex-1 text-center">Ver</a>
                                        <a href="{{ route('admin.instrumentos.edit', $instrumento) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded text-sm transition duration-200 flex-1 text-center">Editar</a>
                                        <form action="{{ route('admin.instrumentos.destroy', $instrumento) }}" method="POST" class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm transition duration-200" onclick="return confirm('¿Estás seguro de eliminar este instrumento?')">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                @if($instrumentos->isEmpty())
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">No hay instrumentos</h3>
                        <p class="mt-2 text-gray-500">Aún no se han registrado instrumentos en el sistema.</p>
                    </div>
                @endif

                <!-- Pagination -->
                @if($instrumentos->hasPages())
                    <div class="px-4 py-4 bg-gray-50 border-t border-gray-200 sm:px-6">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="text-sm text-gray-700 text-center sm:text-left">
                                Mostrando <span class="font-medium">{{ $instrumentos->firstItem() }}</span> a <span class="font-medium">{{ $instrumentos->lastItem() }}</span> de <span class="font-medium">{{ $instrumentos->total() }}</span> resultados
                            </div>
                            <div class="flex flex-wrap justify-center gap-1 sm:space-x-1">
                                {{-- Previous Page Link --}}
                                @if ($instrumentos->onFirstPage())
                                    <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded cursor-not-allowed sm:px-3">Anterior</span>
                                @else
                                    <a href="{{ $instrumentos->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition duration-200 sm:px-3">Anterior</a>
                                @endif

                                {{-- First Page (Desktop only) --}}
                                @if($instrumentos->currentPage() > 3)
                                    <a href="{{ $instrumentos->url(1) }}" class="hidden px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition duration-200 sm:inline-block">1</a>
                                    @if($instrumentos->currentPage() > 4)
                                        <span class="hidden px-2 py-2 text-sm text-gray-500 sm:inline-block">...</span>
                                    @endif
                                @endif

                                {{-- Page Numbers Around Current Page --}}
                                @php
                                    // Mobile: solo 3 páginas alrededor de la actual
                                    // Desktop: 5 páginas alrededor de la actual
                                    $start = max(1, $instrumentos->currentPage() - 1);
                                    $end = min($instrumentos->lastPage(), $instrumentos->currentPage() + 1);

                                    // En desktop, mostrar más páginas
                                    if (!preg_match('/mobile|android|iphone|ipad/i', request()->header('User-Agent', ''))) {
                                        $start = max(1, $instrumentos->currentPage() - 2);
                                        $end = min($instrumentos->lastPage(), $instrumentos->currentPage() + 2);
                                    }
                                @endphp

                                @for ($page = $start; $page <= $end; $page++)
                                    @if ($page == $instrumentos->currentPage())
                                        <span class="px-4 py-2 text-sm font-medium text-white bg-blue-500 border border-blue-500 rounded sm:px-3">{{ $page }}</span>
                                    @else
                                        <a href="{{ $instrumentos->url($page) }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition duration-200 sm:px-3">{{ $page }}</a>
                                    @endif
                                @endfor

                                {{-- Last Page (Desktop only) --}}
                                @if($instrumentos->currentPage() < $instrumentos->lastPage() - 2)
                                    @if($instrumentos->currentPage() < $instrumentos->lastPage() - 3)
                                        <span class="hidden px-2 py-2 text-sm text-gray-500 sm:inline-block">...</span>
                                    @endif
                                    <a href="{{ $instrumentos->url($instrumentos->lastPage()) }}" class="hidden px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition duration-200 sm:inline-block">{{ $instrumentos->lastPage() }}</a>
                                @endif

                                {{-- Next Page Link --}}
                                @if ($instrumentos->hasMorePages())
                                    <a href="{{ $instrumentos->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition duration-200 sm:px-3">Siguiente</a>
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
