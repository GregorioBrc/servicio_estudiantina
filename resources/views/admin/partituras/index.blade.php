<x-app-layout title="Editar partitura">
    <ul>
        @foreach ($obras as $item)
            <li>
                <span>{{$item->titulo}}  {{$item->anio}}</span>
            </li>
        @endforeach
    </ul>
</x-app-layout>
