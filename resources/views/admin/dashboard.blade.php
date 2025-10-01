<x-app-layout title="Dashboard administrador">
    <div class="min-h-screen bg-gray-900 text-white p-6">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-bold mb-6">Dashboard ADMIN</h1>
            <nav class="space-y-2 mb-8">
                <a href="{{route('admin.usuarios.index')}}" class="block text-blue-400 hover:text-blue-200">Usuarios</a>
                <a href="{{route('admin.autores.index')}}" class="block text-blue-400 hover:text-blue-200">Autores</a>
                <a href="{{route('admin.obras.index')}}" class="block text-blue-400 hover:text-blue-200">Obras</a>
                <a href="{{route('admin.partituras.index')}}" class="block text-blue-400 hover:text-blue-200">Partituras</a>
                <a href="{{route('admin.instrumentos.index')}}" class="block text-blue-400 hover:text-blue-200 font-bold">Instrumentos</a>
                <a href="{{route('admin.tipo_contribuciones.index')}}" class="block text-blue-400 hover:text-blue-200">Tipo Contribuciones</a>
                <a href="{{ route('logout') }}" class="block text-red-400 hover:text-red-200">---Logout---</a>
            </nav>

            <main>
                <p class="text-lg">Cosas interesantes sobre la administración.</p>
            </main>
        </div>
    </div>
</x-app-layout>
