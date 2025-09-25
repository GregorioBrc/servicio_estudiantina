<x-app-layout title="Crear Subtipo de Instrumento - UNET">
    <!-- Dark theme override to ensure consistency -->
    <div class="dark-theme-override min-h-screen bg-gray-900 relative overflow-hidden">
        <!-- Animated background elements -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-purple-500 rounded-full mix-blend-soft-light filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute top-1/3 right-1/4 w-72 h-72 bg-indigo-500 rounded-full mix-blend-soft-light filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-1/4 left-1/3 w-80 h-80 bg-pink-500 rounded-full mix-blend-soft-light filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
        </div>

        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header with musical theme -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 p-6 bg-gradient-to-r from-gray-800 to-gray-900 rounded-2xl shadow-2xl border border-gray-700 animate-fade-in">
                <div class="flex items-center mb-4 md:mb-0">
                    <div class="bg-gray-900 p-3 rounded-full mr-4 animate-pulse">
                        <i class="fas fa-plus-circle text-purple-500 text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white">Crear Subtipo de Instrumento</h1>
                        <p class="text-purple-300 mt-1">Agregar nueva categoría musical - UNET</p>
                    </div>
                </div>
                <a href="{{ route('subtipo_instrumento.index') }}" class="group bg-gradient-to-r from-gray-600 to-gray-800 hover:from-gray-700 hover:to-gray-900 text-white font-bold py-3 px-6 rounded-full shadow-lg hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:-translate-y-1 inline-flex items-center mt-4 md:mt-0">
                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-300"></i> Volver
                </a>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-gradient-to-r from-red-800 to-red-900 border-l-4 border-red-500 text-red-100 p-4 rounded-lg shadow-lg mb-8 animate-shake" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-red-400 text-xl mr-3 animate-pulse"></i>
                        <strong class="font-bold">¡Ups! Hubo algunos problemas con tu entrada.</strong>
                    </div>
                    <ul class="mt-2 list-disc pl-5 ml-8 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Main Content Card -->
            <div class="bg-gray-800 rounded-2xl shadow-2xl overflow-hidden border border-gray-700 transition-all duration-300 hover:shadow-3xl">
                <!-- Decorative header -->
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 p-4 border-b border-gray-700">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-white flex items-center">
                            <i class="fas fa-file-alt mr-2 text-purple-400"></i>Formulario de Registro
                        </h2>
                        <div class="flex space-x-2">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('subtipo_instrumento.store') }}" method="POST" class="px-6 py-8">
                    @csrf

                    <!-- Nombre Field -->
                    <div class="mb-6 group">
                        <label for="nombre" class="block text-purple-300 text-sm font-semibold mb-2 flex items-center">
                            <i class="fas fa-tag mr-2"></i>Nombre del Subtipo
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-tag text-gray-500"></i>
                            </div>
                            <input
                                type="text"
                                name="nombre"
                                id="nombre"
                                value="{{ old('nombre') }}"
                                class="w-full pl-10 pr-3 py-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out text-white placeholder-gray-400 focus:outline-none focus:ring-opacity-50 focus:shadow-lg focus:shadow-purple-500/30"
                                placeholder="Ej. Piano de cola, Violín eléctrico..."
                                required
                            >
                        </div>
                        <p class="mt-2 text-sm text-gray-400">Ingresa un nombre descriptivo para el subtipo de instrumento</p>
                    </div>

                    <!-- Descripcion Field -->
                    <div class="mb-6 group">
                        <label for="descripcion" class="block text-purple-300 text-sm font-semibold mb-2 flex items-center">
                            <i class="fas fa-align-left mr-2"></i>Descripción
                        </label>
                        <div class="relative">
                            <div class="absolute top-3 left-0 pl-3 flex items-start pointer-events-none">
                                <i class="fas fa-align-left text-gray-500"></i>
                            </div>
                            <textarea
                                name="descripcion"
                                id="descripcion"
                                rows="4"
                                class="w-full pl-10 pr-3 py-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out text-white placeholder-gray-400 focus:outline-none focus:ring-opacity-50 focus:shadow-lg focus:shadow-purple-500/30"
                                placeholder="Describe las características principales de este subtipo...">{{ old('descripcion') }}</textarea>
                        </div>
                        <p class="mt-2 text-sm text-gray-400">Proporciona detalles sobre las características especiales de este subtipo</p>
                    </div>

                    <!-- Instrumento Field -->
                    <div class="mb-8 group">
                        <label for="instrumento_id" class="block text-purple-300 text-sm font-semibold mb-2 flex items-center">
                            <i class="fas fa-guitar mr-2"></i>Instrumento Principal
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-music text-gray-500"></i>
                            </div>
                            <select
                                name="instrumento_id"
                                id="instrumento_id"
                                class="w-full pl-10 pr-3 py-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out text-white focus:outline-none focus:ring-opacity-50 focus:shadow-lg focus:shadow-purple-500/30 appearance-none"
                                required>
                                <option value="" disabled selected>Selecciona un instrumento principal</option>
                                @foreach($instrumentos as $instrumento)
                                    <option value="{{ $instrumento->id }}" {{ old('instrumento_id') == $instrumento->id ? 'selected' : '' }}>
                                        {{ $instrumento->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-500"></i>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-400">Selecciona el instrumento principal al que pertenece este subtipo</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-between pt-4">
                        <button
                            type="submit"
                            class="group bg-gradient-to-r from-purple-600 to-indigo-700 hover:from-purple-700 hover:to-indigo-800 text-white font-bold py-4 px-8 rounded-full shadow-lg hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:-translate-y-1 inline-flex items-center text-lg">
                            <i class="fas fa-plus-circle mr-3 group-hover:rotate-90 transition-transform duration-300"></i> Crear Subtipo
                        </button>

                        <div class="flex items-center text-gray-400 text-sm">
                            <i class="fas fa-info-circle mr-2"></i>
                            <span>Todos los campos son obligatorios</span>
                        </div>
                    </div>
                </form>

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

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
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

        .animate-shake {
            animation: shake 0.5s ease-in-out;
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
