{{-- Formulario para cambiar contraseña --}}
<div class="container mx-auto mt-6">
    <div class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto">
        <h2 class="text-lg font-semibold mb-4">Cambiar contraseña</h2>
        @if ($errors->any())
            <div class="mb-4">
                <ul class="text-red-600 text-sm list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('status'))
            <div class="mb-4 text-green-600 text-sm">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="mb-4">
                <label class="block text-gray-700" for="email">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="w-full px-3 py-2 border rounded-lg"
                    value="{{ $email ?? old('email') }}"
                    required
                    autofocus
                >
            </div>
            <div class="mb-4">
                <label class="block text-gray-700" for="password">Nueva contraseña</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="w-full px-3 py-2 border rounded-lg"
                    required
                >
            </div>
            <div class="mb-4">
                <label class="block text-gray-700" for="password_confirmation">Confirmar contraseña</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="w-full px-3 py-2 border rounded-lg"
                    required
                >
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full">
                Actualizar contraseña
            </button>
        </form>
    </div>
</div>