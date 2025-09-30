{{-- filepath: c:\Users\axelo\Documentos\UNET\ServicioLaravel\estudiantina\resources\views\components\header-landing.blade.php --}}
<header class="bg-blue-700 text-white py-6">
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-between px-4">
        <!-- Imagen y frase a la izquierda, ambos enlazados a la raíz -->
        <a href="{{ route('home') }}" class="flex items-center mb-4 md:mb-0 hover:opacity-90 transition">
            <img src="/images/logo_unet_fondo.jpg" alt="Logo Estudiantina" class="h-16 w-16 mr-4 shadow-lg object-cover rounded-full">
            <span class="text-2xl font-bold">Estudiantina</span>
        </a>
        <!-- Login o saludo a la derecha -->
        <div>
            @auth
                <span class="bg-text-blue-700 text-white px-4 py-2 rounded font-semibold block md:inline-block">
                    Hola, {{ Auth::user()->name }}
                </span>
                <a href="{{ route('logout') }}" class="bg-white text-blue-700 px-4 py-2 rounded shadow hover:bg-blue-100 font-semibold transition block md:inline-block">
                    Logout
                </a>
            @else
                <a href="{{ route('login') }}" class="bg-white text-blue-700 px-4 py-2 rounded shadow hover:bg-blue-100 font-semibold transition block md:inline-block">
                    Login
                </a>
            @endauth
        </div>
    </div>
</header>