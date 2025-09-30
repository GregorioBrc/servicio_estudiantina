{{-- filepath: c:\Users\axelo\Documentos\UNET\ServicioLaravel\estudiantina\resources\views\login\login.blade.php --}}
<x-app-layout title="Iniciar Sesión">
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-50 px-2">
        <div class="bg-white rounded-lg shadow-lg p-6 sm:p-8 w-full max-w-sm">
            <div class="flex justify-center mb-6">
                <img src="/images/logo_unet_fondo.jpg" alt="Logo Estudiantina" class="h-20 w-20 rounded-full shadow-lg object-cover">
            </div>
            <h2 class="text-2xl font-bold text-center mb-6 text-blue-700">Iniciar Sesión</h2>
            <form action="{{ route('login.store') }}" method="POST" class="space-y-4">
                @csrf
                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
                <input
                    type="password"
                    name="password"
                    placeholder="Contraseña"
                    required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-2">
                    <label for="remember" class="text-sm text-gray-700">Recordarme</label>
                </div>
                <button type="submit" class="w-full bg-blue-700 text-white py-2 rounded-lg font-semibold hover:bg-blue-800 transition">
                    Iniciar Sesión
                </button>
                @if ($errors->any())
                    <div class="mt-2 text-red-600 text-sm">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
            <div class="mt-4 text-center">
                <a href="{{ route('password.request') }}" class="text-blue-700 underline text-sm hover:text-blue-900">
                    ¿Olvidaste tu contraseña?
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
