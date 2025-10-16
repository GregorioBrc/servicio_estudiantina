{{-- filepath: c:\Users\axelo\Documentos\UNET\ServicioLaravel\estudiantina\resources\views\components\header-landing.blade.php --}}
<header class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 text-white py-4 sm:py-6">
    <div class="max-w-5xl mx-auto flex flex-col sm:flex-row items-center justify-between px-4">
        <!-- Imagen y frase a la izquierda, ambos enlazados a la raíz -->
        @auth
            <a href="{{ route('home') }}" class="flex items-center mb-4 sm:mb-0 hover:opacity-90 transition">
                <img src="/images/logo_unet_fondo.jpg" alt="Logo Estudiantina" class="h-12 w-12 sm:h-16 sm:w-16 mr-3 sm:mr-4 shadow-lg object-cover">
                <span class="text-xl sm:text-2xl font-bold">Estudiantina</span>
            </a>
        @else
            <a href="{{ route('home') }}" class="flex items-center mb-4 sm:mb-0 hover:opacity-90 transition">
                <img src="/images/logo_unet_fondo.jpg" alt="Logo Estudiantina" class="h-12 w-12 sm:h-16 sm:w-16 mr-3 sm:mr-4 shadow-lg object-cover">
                <span class="text-xl sm:text-2xl font-bold">Estudiantina</span>
            </a>
        @endauth
        <!-- Login o saludo a la derecha -->
        <div class="flex flex-col sm:flex-row items-center gap-2 sm:gap-4">
            @auth
                <!-- Dark Mode Toggle -->
                <button id="dark-mode-toggle" class="bg-white dark:bg-gray-200 text-blue-700 dark:text-blue-900 px-3 sm:px-4 py-2 rounded shadow hover:bg-blue-100 dark:hover:bg-gray-300 font-semibold transition text-center">
                    <span id="dark-mode-icon">🌙</span>
                </button>
                <a href="{{ route('logout') }}" class="bg-white dark:bg-gray-200 text-blue-700 dark:text-blue-900 px-3 sm:px-4 py-2 rounded shadow hover:bg-blue-100 dark:hover:bg-gray-300 font-semibold transition text-center">
                    Logout
                </a>
            @else
            @if (!request()->routeIs('login'))
                <a href="{{ route('login') }}"
                class="bg-white dark:bg-gray-200 text-blue-700 dark:text-blue-900 px-3 sm:px-4 py-2 rounded shadow hover:bg-blue-100 dark:hover:bg-gray-300 font-semibold transition text-center">
                    Login
                </a>
            @endif
            @endauth
        </div>
    </div>
</header>

