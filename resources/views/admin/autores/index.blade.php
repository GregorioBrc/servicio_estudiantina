<x-app-layout title="Autores">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-12 gap-4">
                <div class="text-center sm:text-left">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Gestión de Autores</h1>
                    <p class="text-lg text-gray-600">Administrar autores del sistema</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-green-500 to-teal-500 sm:mx-0 mx-auto mt-4 rounded-full"></div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.index') }}" class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-6 py-3 rounded-lg shadow-lg hover:from-gray-600 hover:to-gray-700 transition duration-300 flex items-center gap-2 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.autores.create') }}" class="bg-gradient-to-r from-green-500 to-teal-600 text-white px-6 py-3 rounded-lg shadow-lg hover:from-green-600 hover:to-teal-700 transition duration-300 flex items-center gap-2 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Crear Autor
                    </a>
                </div>
            </div>

            <!-- Authors List - Desktop Table / Mobile Cards -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Lista de Autores</h2>
                </div>

                <!-- Desktop Table View -->
                <div class="hidden lg:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Obras</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($autores as $index => $autor)
                                <tr class="hover:bg-gray-50 transition duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                            <div class="text-sm font-medium text-gray-900">{{ $autor->nombre }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ count($autor->contribuciones) }} obra(s)</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.autores.show', $autor) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs transition duration-200">Ver</a>
                                            <a href="{{ route('admin.autores.edit', $autor) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs transition duration-200">Editar</a>
                                            <form action="{{ route('admin.autores.destroy', $autor) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition duration-200" onclick="return confirm('¿Estás seguro de eliminar este autor?')">Eliminar</button>
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
                    @if($autores->isNotEmpty())
                        <div class="divide-y divide-gray-200">
                            @foreach ($autores as $index => $autor)
                                <div class="p-4 hover:bg-gray-50 transition duration-200">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $autor->nombre }}</div>
                                                <div class="text-sm text-gray-500">#{{ $index + 1 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="text-xs text-gray-500 mb-1">Obras:</div>
                                        <div class="text-sm text-gray-700">{{ count($autor->contribuciones) }} obra(s)</div>
                                    </div>
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('admin.autores.show', $autor) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded text-sm transition duration-200 flex-1 text-center">Ver</a>
                                        <a href="{{ route('admin.autores.edit', $autor) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded text-sm transition duration-200 flex-1 text-center">Editar</a>
                                        <form action="{{ route('admin.autores.destroy', $autor) }}" method="POST" class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm transition duration-200" onclick="return confirm('¿Estás seguro de eliminar este autor?')">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                @if($autores->isEmpty())
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">No hay autores</h3>
                        <p class="mt-2 text-gray-500">Aún no se han registrado autores en el sistema.</p>
                    </div>
                @endif

                <!-- Pagination -->
                @if($autores->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-700">
                                Mostrando <span class="font-medium">{{ $autores->firstItem() }}</span> a <span class="font-medium">{{ $autores->lastItem() }}</span> de <span class="font-medium">{{ $autores->total() }}</span> resultados
                            </div>
                            <div class="flex space-x-1">
                                {{-- Previous Page Link --}}
                                @if ($autores->onFirstPage())
                                    <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 border border-gray-300 rounded cursor-not-allowed">Anterior</span>
                                @else
                                    <a href="{{ $autores->previousPageUrl() }}" class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition duration-200">Anterior</a>
                                @endif

                                {{-- First Page --}}
                                @if($autores->currentPage() > 3)
                                    <a href="{{ $autores->url(1) }}" class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition duration-200">1</a>
                                    @if($autores->currentPage() > 4)
                                        <span class="px-2 py-2 text-sm text-gray-500">...</span>
                                    @endif
                                @endif

                                {{-- Page Numbers Around Current Page --}}
                                @php
                                    $start = max(1, $autores->currentPage() - 2);
                                    $end = min($autores->lastPage(), $autores->currentPage() + 2);
                                @endphp

                                @for ($page = $start; $page <= $end; $page++)
                                    @if ($page == $autores->currentPage())
                                        <span class="px-3 py-2 text-sm text-white bg-blue-500 border border-blue-500 rounded">{{ $page }}</span>
                                    @else
                                        <a href="{{ $autores->url($page) }}" class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition duration-200">{{ $page }}</a>
                                    @endif
                                @endfor

                                {{-- Last Page --}}
                                @if($autores->currentPage() < $autores->lastPage() - 2)
                                    @if($autores->currentPage() < $autores->lastPage() - 3)
                                        <span class="px-2 py-2 text-sm text-gray-500">...</span>
                                    @endif
                                    <a href="{{ $autores->url($autores->lastPage()) }}" class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition duration-200">{{ $autores->lastPage() }}</a>
                                @endif

                                {{-- Next Page Link --}}
                                @if ($autores->hasMorePages())
                                    <a href="{{ $autores->nextPageUrl() }}" class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition duration-200">Siguiente</a>
                                @else
                                    <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 border border-gray-300 rounded cursor-not-allowed">Siguiente</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
