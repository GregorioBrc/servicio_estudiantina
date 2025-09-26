<x-app-layout title="Obras">
    <ul>
        @foreach ($autores as $autor)
            <li>
                <a href="{{ route('admin.autores.show', $autor) }}">{{ $autor->nombre }}</a>
            </li>
            
        @endforeach
    </ul>

</x-app-layout>
