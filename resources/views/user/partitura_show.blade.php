<x-app-layout title="{{ $partitura->obra->titulo }}">
    <a href="{{ route('usuario.partituras') }}">---Atras---</a>
    <h1>{{ $partitura->obra->titulo }}</h1>
    <h2>link pdf</h2>
    <a href="{{ $partitura->url_pdf }}">{{ $partitura->url_pdf }}</a>
    @if ($partitura->link_video)
        <h3>Link Video</h3>
        <a href="{{ $partitura->link_video }}">{{ $partitura->link_video }}</a>
    @endif
</x-app-layout>
