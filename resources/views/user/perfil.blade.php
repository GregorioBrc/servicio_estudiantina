<!-- Perfil Usuario Vista usuario -->
<x-app-layout title="Perfil usuario">
    <h1>Vista general del perfil del usuario {{ $id }}</h1>

    <div class="container mx-auto mt-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <p><strong>ID:</strong> {{ $id }}</p>
        </div>
    </div>

    <div class="container mx-auto mt-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <p><strong>Nombre:</strong> {{ $nombre }}</p>
        </div>
    </div>

    <div class="container mx-auto mt-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <p><strong>Email:</strong> {{ $email }}</p>
        </div>
    </div>

    {{-- Formulario para cambiar contraseña --}}
    <div class="container mx-auto mt-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Cambiar contraseña</h2>
            <form method="POST" action="{{ route('usuario.cambiar-password', $id) }}">
                @csrf
                <div>
                    <label class="block text-gray-700">Contraseña actual</label>
                    <input type="password" name="current_password" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Nueva contraseña</label>
                    <input type="password" name="password" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Actualizar contraseña</button>
            </form>
        </div>
    </div>

</x-app-layout>
