{{-- filepath: c:\Users\axelo\Documentos\UNET\ServicioLaravel\estudiantina\resources\views\components\header-landing.blade.php --}}
<header class="bg-gradient-to-r from-blue-600 to-blue-800 px-4 sm:px-6 text-white py-3 sm:py-4 lg:py-6">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-2 sm:px-4">
        <!-- Logo y título -->
        <div class="flex items-center flex-shrink-0">
            @auth
                <a href="{{ route('home') }}" class="flex items-center hover:opacity-90 transition duration-200">
                    <img src="/images/Logo_Unet_Text.svg" alt="Logo Estudiantina" class="h-10 w-10 sm:h-12 sm:w-12 md:h-14 md:w-14 lg:h-16 lg:w-16 mr-2 sm:mr-3 md:mr-4 shadow-lg object-cover bg-amber-50">
                    <span class="text-lg sm:text-xl md:text-2xl font-bold whitespace-nowrap">Estudiantina</span>
                </a>
            @else
                <a href="{{ route('home') }}" class="flex items-center hover:opacity-90 transition duration-200">
                    <img src="/images/Logo_Unet_Text.svg" alt="Logo Estudiantina" class="h-10 w-10 sm:h-12 sm:w-12 md:h-14 md:w-14 lg:h-16 lg:w-16 mr-2 sm:mr-3 md:mr-4 shadow-lg object-cover bg-amber-50">
                    <span class="text-lg sm:text-xl md:text-2xl font-bold whitespace-nowrap">Estudiantina</span>
                </a>
            @endauth
        </div>

        <!-- Menú de navegación para escritorio -->
        <nav class="hidden md:flex items-center space-x-2 lg:space-x-4">
            @auth
                <!-- Dark Mode Toggle -->
                <button id="dark-mode-toggle" class="bg-white dark:bg-gray-200 text-blue-700 dark:text-blue-900 px-3 py-2 rounded-lg shadow hover:bg-blue-100 dark:hover:bg-gray-300 font-semibold transition duration-200 flex items-center">
                    <span id="dark-mode-icon" class="text-sm">🌙</span>
                </button>
                <a href="{{ route('logout') }}" class="bg-white dark:bg-gray-200 text-blue-700 dark:text-blue-900 px-4 py-2 rounded-lg shadow hover:bg-blue-100 dark:hover:bg-gray-300 font-semibold transition duration-200 text-sm lg:text-base">
                    Cerrar Sesión
                </a>
            @else
                @if (!request()->routeIs('login'))
                    <a href="{{ route('login') }}" class="bg-white dark:bg-gray-200 text-blue-700 dark:text-blue-900 px-4 py-2 rounded-lg shadow hover:bg-blue-100 dark:hover:bg-gray-300 font-semibold transition duration-200 text-sm lg:text-base">
                        Iniciar Sesión
                    </a>
                @endif
            @endauth
        </nav>

        <!-- Menú móvil (hamburguesa) - No mostrar en página de login -->
        @if (!request()->routeIs('login'))
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-toggle" class="text-white hover:text-blue-200 focus:outline-none focus:text-blue-200 transition duration-200">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        @endif
    </div>

    <!-- Menú móvil desplegable - No mostrar en página de login -->
    @if (!request()->routeIs('login'))
        <div id="mobile-menu" class="md:hidden hidden mt-4 pb-4 border-t border-blue-500">
            <div class="flex flex-col space-y-3 px-2">
                @auth
                    <!-- Dark Mode Toggle -->
                    <button id="dark-mode-toggle-mobile" class="bg-white dark:bg-gray-200 text-blue-700 dark:text-blue-900 px-4 py-3 rounded-lg shadow hover:bg-blue-100 dark:hover:bg-gray-300 font-semibold transition duration-200 flex items-center justify-center">
                        <span id="dark-mode-icon-mobile" class="mr-2">🌙</span>
                        <span>Modo Oscuro</span>
                    </button>
                    <a href="{{ route('logout') }}" class="bg-white dark:bg-gray-200 text-blue-700 dark:text-blue-900 px-4 py-3 rounded-lg shadow hover:bg-blue-100 dark:hover:bg-gray-300 font-semibold transition duration-200 text-center">
                        Cerrar Sesión
                    </a>
                @else
                    @if (!request()->routeIs('login'))
                        <a href="{{ route('login') }}" class="bg-white dark:bg-gray-200 text-blue-700 dark:text-blue-900 px-4 py-3 rounded-lg shadow hover:bg-blue-100 dark:hover:bg-gray-300 font-semibold transition duration-200 text-center">
                            Iniciar Sesión
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    @endif
</header>

