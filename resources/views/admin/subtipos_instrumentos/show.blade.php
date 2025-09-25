<x-app-layout title="Detalles del Subtipo de Instrumento - UNET">
    <!-- Dark theme override to ensure consistency -->
    <div class="dark-theme-override min-h-screen bg-gray-900 relative overflow-hidden">
        <!-- Animated background elements -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-yellow-500 rounded-full mix-blend-soft-light filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute top-1/3 right-1/4 w-72 h-72 bg-amber-500 rounded-full mix-blend-soft-light filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-1/4 left-1/3 w-80 h-80 bg-orange-500 rounded-full mix-blend-soft-light filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
        </div>

        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header with musical theme -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 p-6 bg-gradient-to-r from-gray-800 to-gray-900 rounded-2xl shadow-2xl border border-gray-700 animate-fade-in">
                <div class="flex items-center mb-4 md:mb-0">
                    <div class="bg-gray-900 p-3 rounded-full mr-4 animate-pulse">
                        <i class="fas fa-info-circle text-yellow-500 text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white">Detalles del Subtipo</h1>
                        <p class="text-yellow-300 mt-1">Información completa - UNET</p>
                    </div>
                </div>
                <div class="flex space-x-3 mt-4 md:mt-0">
                    <a href="{{ route('subtipo_instrumento.edit', $subtipoInstrumento) }}" class="group bg-gradient-to-r from-yellow-600 to-amber-700 hover:from-yellow-700 hover:to-amber-800 text-white font-bold py-3 px-6 rounded-full shadow-lg hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:-translate-y-1 inline-flex items-center">
                        <i class="fas fa-edit mr-2 group-hover:rotate-12 transition-transform duration-300"></i> Editar
                    </a>
                    <a href="{{ route('subtipo_instrumento.index') }}" class="group bg-gradient-to-r from-gray-600 to-gray-800 hover:from-gray-700 hover:to-gray-900 text-white font-bold py-3 px-6 rounded-full shadow-lg hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:-translate-y-1 inline-flex items-center">
                        <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-300"></i> Volver
                    </a>
                </div>
            </div>

            <!-- Main Content Card -->
            <div class="bg-gray-800 rounded-2xl shadow-2xl overflow-hidden border border-gray-700 transition-all duration-300 hover:shadow-3xl">
                <!-- Decorative header -->
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 p-4 border-b border-gray-700">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-white flex items-center">
                            <i class="fas fa-info-circle mr-2 text-yellow-400"></i>Información Detallada
                        </h2>
                        <div class="flex space-x-2">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-8">
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- ID Card -->
                        <div class="bg-gradient-to-br from-gray-700 to-gray-800 p-5 rounded-xl shadow-lg border border-gray-600 transform transition duration-300 hover:scale-105">
                            <dt class="text-sm font-semibold text-yellow-300 flex items-center">
                                <i class="fas fa-fingerprint text-yellow-500 mr-2"></i>ID del Registro
                            </dt>
                            <dd class="mt-2 text-lg font-bold text-white">
                                #{{ $subtipoInstrumento->id }}
                            </dd>
                        </div>

                        <!-- Name Card -->
                        <div class="bg-gradient-to-br from-gray-700 to-gray-800 p-5 rounded-xl shadow-lg border border-gray-600 transform transition duration-300 hover:scale-105">
                            <dt class="text-sm font-semibold text-yellow-300 flex items-center">
                                <i class="fas fa-tag text-yellow-500 mr-2"></i>Nombre del Subtipo
                            </dt>
                            <dd class="mt-2 text-lg font-bold text-white">
                                {{ $subtipoInstrumento->nombre }}
                            </dd>
                        </div>

                        <!-- Description Card -->
                        <div class="bg-gradient-to-br from-gray-700 to-gray-800 p-5 rounded-xl shadow-lg border border-gray-600 md:col-span-2 transform transition duration-300 hover:scale-105">
                            <dt class="text-sm font-semibold text-yellow-300 flex items-center">
                                <i class="fas fa-align-left text-yellow-500 mr-2"></i>Descripción
                            </dt>
                            <dd class="mt-2 text-gray-300">
                                {{ $subtipoInstrumento->descripcion ?? 'No se proporcionó una descripción' }}
                            </dd>
                        </div>

                        <!-- Instrument Card -->
                        <div class="bg-gradient-to-br from-gray-700 to-gray-800 p-5 rounded-xl shadow-lg border border-gray-600 transform transition duration-300 hover:scale-105">
                            <dt class="text-sm font-semibold text-yellow-300 flex items-center">
                                <i class="fas fa-guitar text-yellow-500 mr-2"></i>Instrumento Principal
                            </dt>
                            <dd class="mt-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gradient-to-r from-purple-600 to-indigo-700 text-white">
                                    {{ $subtipoInstrumento->instrumento->nombre ?? 'N/A' }}
                                </span>
                            </dd>
                        </div>

                        <!-- Created At Card -->
                        <div class="bg-gradient-to-br from-gray-700 to-gray-800 p-5 rounded-xl shadow-lg border border-gray-600 transform transition duration-300 hover:scale-105">
                            <dt class="text-sm font-semibold text-yellow-300 flex items-center">
                                <i class="fas fa-calendar-plus text-yellow-500 mr-2"></i>Fecha de Creación
                            </dt>
                            <dd class="mt-2 text-gray-300 flex items-center">
                                <i class="fas fa-clock mr-2 text-yellow-500"></i>{{ $subtipoInstrumento->created_at->format('d/m/Y H:i') }}
                            </dd>
                        </div>

                        <!-- Updated At Card -->
                        <div class="bg-gradient-to-br from-gray-700 to-gray-800 p-5 rounded-xl shadow-lg border border-gray-600 md:col-span-2 transform transition duration-300 hover:scale-105">
                            <dt class="text-sm font-semibold text-yellow-300 flex items-center">
                                <i class="fas fa-calendar-edit text-yellow-500 mr-2"></i>Última Actualización
                            </dt>
                            <dd class="mt-2 text-gray-300 flex items-center">
                                <i class="fas fa-history mr-2 text-yellow-500"></i>{{ $subtipoInstrumento->updated_at->format('d/m/Y H:i') }}
                            </dd>
                        </div>
                    </dl>
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

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
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
