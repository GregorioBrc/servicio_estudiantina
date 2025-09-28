<x-app-layout title="Vista usuario">
    <nav>
        <p>
            Bienvenido, {{ Auth::user()->name }}
        </p>

        <a href="{{ route('usuario.dashboard') }}">Inicio</a>
        <br>
        <a href="{{ route('usuario.partituras') }}">Partituras</a>
        <br>
        <a href="{{ route('usuario.perfil', Auth::user()->id) }}">Perfil</a>
        <br>
        <a href="{{ route('logout') }}">Cerrar sesión</a>
    </nav>
    <h1>Vista general del usuario</h1>
</x-app-layout>
