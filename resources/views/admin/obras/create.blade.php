<x-app-layout title="Crear Obra">
    <h1>Crear partitura ADMIN</h1>

    <form action="{{ route('admin.obras.store') }}" method="POST">
        @csrf
        <p><button type="submit">Crear obra</button></p>
    </form>
</x-app-layout>
