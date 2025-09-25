<x-app-layout title="Subtipos de Instrumentos - UNET">
    <!-- Dark theme override to ensure consistency -->
    <div class="dark-theme-override min-h-screen bg-gray-900 relative overflow-hidden">
        <!-- Animated background elements -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-purple-500 rounded-full mix-blend-soft-light filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute top-1/3 right-1/4 w-72 h-72 bg-yellow-500 rounded-full mix-blend-soft-light filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-1/4 left-1/3 w-80 h-80 bg-indigo-500 rounded-full mix-blend-soft-light filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
        </div>

        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header with musical theme -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 p-6 bg-gradient-to-r from-gray-800 to-gray-900 rounded-2xl shadow-2xl border border-gray-700 animate-fade-in">
                <div class="flex items-center mb-4 md:mb-0">
                    <div class="bg-gray-900 p-3 rounded-full mr-4 animate-pulse">
                        <i class="fas fa-guitar text-purple-500 text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white">Subtipos de Instrumentos</h1>
                        <p class="text-purple-300 mt-1">Gestión de categorías musicales - UNET</p>
                    </div>
                </div>
                <a href="{{ route('subtipo_instrumento.create') }}" class="group bg-gradient-to-r from-purple-600 to-indigo-700 hover:from-purple-700 hover:to-indigo-800 text-white font-bold py-3 px-6 rounded-full shadow-lg hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:-translate-y-1 flex items-center mt-4 md:mt-0">
                    <i class="fas fa-plus-circle mr-2 group-hover:rotate-90 transition-transform duration-300"></i>Crear Nuevo Subtipo
                </a>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-gradient-to-r from-green-800 to-emerald-900 border-l-4 border-green-500 text-green-100 p-4 rounded-lg shadow-lg mb-8 animate-slide-down" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-400 text-xl mr-3 animate-bounce"></i>
                        <span class="block sm:inline font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Main Content Card -->
            <div class="bg-gray-800 rounded-2xl shadow-2xl overflow-hidden border border-gray-700 transition-all duration-300 hover:shadow-3xl">
                <!-- Decorative header -->
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 p-4 border-b border-gray-700">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-white flex items-center">
                            <i class="fas fa-list mr-2 text-purple-400"></i>Listado de Subtipos
                        </h2>
                        <div class="flex space-x-2">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        </div>
                    </div>
                </div>

                <!-- Responsive Table Container -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-700 hidden md:table">
                        <thead class="bg-gradient-to-r from-gray-800 to-gray-900">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-purple-300 uppercase tracking-wider">
                                    <i class="fas fa-fingerprint mr-1"></i>ID
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-purple-300 uppercase tracking-wider">
                                    <i class="fas fa-tag mr-1"></i>Nombre
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-purple-300 uppercase tracking-wider">
                                    <i class="fas fa-align-left mr-1"></i>Descripción
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-purple-300 uppercase tracking-wider">
                                    <i class="fas fa-guitar mr-1"></i>Instrumento
                                </th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-purple-300 uppercase tracking-wider">
                                    <i class="fas fa-cogs mr-1"></i>Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            @forelse($subtipos as $subtipo)
                                <tr class="hover:bg-gray-750 transition duration-200 ease-in-out transform hover:scale-[1.01]">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-purple-300">
                                        <span class="bg-gray-900 px-2 py-1 rounded">#{{ $subtipo->id }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-white">
                                        {{ $subtipo->nombre }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300 max-w-xs truncate">
                                        {{ $subtipo->descripcion ?? 'Sin descripción' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-blue-900 to-indigo-900 text-blue-300 border border-blue-700">
                                            <i class="fas fa-music mr-1"></i>{{ $subtipo->instrumento->nombre ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('subtipo_instrumento.show', $subtipo) }}" class="text-blue-400 hover:text-blue-300 p-2 rounded-full hover:bg-gray-700 transition duration-200 ease-in-out transform hover:scale-110" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('subtipo_instrumento.edit', $subtipo) }}" class="text-yellow-400 hover:text-yellow-300 p-2 rounded-full hover:bg-gray-700 transition duration-200 ease-in-out transform hover:scale-110" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('subtipo_instrumento.destroy', $subtipo) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-400 p-2 rounded-full hover:bg-gray-700 transition duration-200 ease-in-out transform hover:scale-110" onclick="return confirm('¿Estás seguro de que deseas eliminar este subtipo?')" title="Eliminar">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 whitespace-nowrap text-sm text-gray-400 text-center">
                                        <div class="flex flex-col items-center justify-center py-12 animate-pulse">
                                            <div class="relative">
                                                <i class="fas fa-music text-6xl text-gray-600 mb-6"></i>
                                                <i class="fas fa-music text-4xl text-purple-500 absolute -top-2 -right-2 animate-bounce"></i>
                                            </div>
                                            <h3 class="text-2xl font-bold text-gray-300 mb-2">No hay subtipos de instrumentos</h3>
                                            <p class="text-gray-500 max-w-md mb-6">Aún no se han registrado subtipos de instrumentos en la academia UNET.</p>
                                            <a href="{{ route('subtipo_instrumento.create') }}" class="bg-gradient-to-r from-purple-600 to-indigo-700 hover:from-purple-700 hover:to-indigo-800 text-white font-bold py-2 px-6 rounded-full shadow-lg hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:-translate-y-1 flex items-center">
                                                <i class="fas fa-plus-circle mr-2"></i>Crear tu primer subtipo
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Mobile view -->
                    <div class="md:hidden">
                        @forelse($subtipos as $subtipo)
                            <div class="border-b border-gray-700 p-4 hover:bg-gray-750 transition duration-200">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-bold text-white text-lg">{{ $subtipo->nombre }}</h3>
                                        <p class="text-gray-400 text-sm mt-1">{{ $subtipo->descripcion ?? 'Sin descripción' }}</p>
                                        <div class="mt-2">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-blue-900 to-indigo-900 text-blue-300">
                                                <i class="fas fa-music mr-1"></i>{{ $subtipo->instrumento->nombre ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </div>
                                    <span class="bg-gray-900 px-2 py-1 rounded text-purple-300 font-mono text-sm">#{{ $subtipo->id }}</span>
                                </div>
                                <div class="flex justify-end space-x-2 mt-3">
                                    <a href="{{ route('subtipo_instrumento.show', $subtipo) }}" class="text-blue-400 hover:text-blue-300 p-2 rounded-full hover:bg-gray-700 transition duration-200" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('subtipo_instrumento.edit', $subtipo) }}" class="text-yellow-400 hover:text-yellow-300 p-2 rounded-full hover:bg-gray-700 transition duration-200" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('subtipo_instrumento.destroy', $subtipo) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-400 p-2 rounded-full hover:bg-gray-700 transition duration-200" onclick="return confirm('¿Estás seguro de que deseas eliminar este subtipo?')" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <div class="flex flex-col items-center justify-center animate-pulse">
                                    <div class="relative">
                                        <i class="fas fa-music text-6xl text-gray-600 mb-6"></i>
                                        <i class="fas fa-music text-4xl text-purple-500 absolute -top-2 -right-2 animate-bounce"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-300 mb-2">No hay subtipos de instrumentos</h3>
                                    <p class="text-gray-500 max-w-md mb-6">Aún no se han registrado subtipos de instrumentos en la academia UNET.</p>
                                    <a href="{{ route('subtipo_instrumento.create') }}" class="bg-gradient-to-r from-purple-600 to-indigo-700 hover:from-purple-700 hover:to-indigo-800 text-white font-bold py-2 px-6 rounded-full shadow-lg hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:-translate-y-1 flex items-center">
                                        <i class="fas fa-plus-circle mr-2"></i>Crear tu primer subtipo
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Decorative footer -->
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 p-3 border-t border-gray-700">
                    <div class="flex justify-between items-center">
                        <p class="text-xs text-gray-500">Academia Universitaria de Música - UNET</p>
                        <div class="flex space-x-1">
                            <i class="fas fa-music text-xs text-gray-600"></i>
                            <i class="fas fa-music text-xs text-gray-600"></i>
                            <i class="fas fa-music text-xs text-gray-600"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom styles for animations and dark theme override -->
    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slide-down {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.5s ease-out forwards;
        }

        .animate-slide-down {
            animation: slide-down 0.3s ease-out forwards;
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        .bg-gray-750 {
            background-color: #3a4250;
        }

        /* Dark theme override */
        .dark-theme-override {
            background-color: #111827; /* gray-900 */
            color: #f9fafb; /* gray-50 */
        }
    </style>

    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</x-app-layout>
