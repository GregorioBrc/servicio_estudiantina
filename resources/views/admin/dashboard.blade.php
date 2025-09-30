<x-app-layout title="Dashboard administrador">
    <h1>Dashboard ADMIN</h1>
    <nav>
        <a href="{{route('admin.usuarios.index')}}">Usuarios</a>
        <a href="{{route('admin.autores.index')}}">Autores</a>
        <a href="{{route('admin.obras.index')}}">Obras</a>
        <a href="{{route('admin.partituras.index')}}">Partituras</a>
        <a href="{{route('admin.instrumentos.index')}}">Instrumentos</a>
        <a href="{{route('admin.tipo_contribuciones.index')}}">Tipo Contribuciones</a>
        <a href="{{ route('logout') }}">---Logout---</a>
    </nav>

    <main>
        Cosas
    </main>
</x-app-layout>
