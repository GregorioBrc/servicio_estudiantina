<x-app-layout title="Detalles de la Partitura">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
            <div class="flex flex-col sm:flex-row items-center justify-between mb-12 gap-4">
                <div class="text-center sm:text-left">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Detalles de la Partitura</h1>
                    <p class="text-lg text-gray-600">Información completa de {{ $partitura->obra->titulo }} /
                        {{ $partitura->instrumento->nombre }} {{ $partitura->instrumento->tipo }}</p>
                    <div
                        class="w-24 h-1 bg-gradient-to-r from-purple-500 to-indigo-500 sm:mx-0 mx-auto mt-4 rounded-full">
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.partituras.index') }}"
                        class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-lg shadow-lg hover:from-blue-600 hover:to-blue-700 transition duration-300 flex items-center gap-2 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Volver al Listado
                    </a>
                    <a href="{{ route('admin.partituras.edit', $partitura) }}"
                        class="bg-gradient-to-r from-yellow-500 to-orange-600 text-white px-6 py-3 rounded-lg shadow-lg hover:from-yellow-600 hover:to-orange-700 transition duration-300 flex items-center gap-2 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Editar Partitura
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div
                    class="bg-white shadow-lg rounded-xl p-6 hover:shadow-xl transition-shadow duration-300 border-l-4 border-green-500">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Obra</h3>
                    </div>
                    <p class="text-gray-700 text-lg">
                        <a href="{{ route('admin.obras.show', $partitura->obra) }}" class="hover:text-indigo-700 hover:underline">
                            {{ $partitura->obra->titulo ?? 'Sin obra asignada' }}
                        </a>
                    </p>
                </div>

                <div
                    class="bg-white shadow-lg rounded-xl p-6 hover:shadow-xl transition-shadow duration-300 border-l-4 border-purple-500">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Instrumento</h3>
                    </div>
                    <a href="{{ route('admin.instrumentos.show', $partitura->instrumento) }}"
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 hover:bg-purple-200 hover:text-purple-900 hover:underline">
                        {{ $partitura->instrumento->nombre ?? 'Sin instrumento' }}
                    </a>
                    @if ($partitura->instrumento)
                        <p class="text-sm text-gray-500 mt-1">Tipo: {{ $partitura->instrumento->tipo }}</p>
                    @endif
                </div>

                <div
                    class="bg-white shadow-lg rounded-xl p-6 hover:shadow-xl transition-shadow duration-300 border-l-4 border-indigo-500">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Cantidad de Usuarios Asignados</h3>
                    </div>
                    @if ($partitura->user_cant > 0)
                        <p class="text-gray-700 text-lg">{{ $partitura->user_cant }}</p>
                    @else
                        <p class="text-gray-700 text-lg">{{ $partitura->user->name ?? 'Sin usuario asignado' }}</p>
                    @endif
                </div>
            </div>

            @if ($partitura->url_pdf)
                <div class="bg-white shadow-lg rounded-xl p-6 mb-8 border-t-4 border-red-500">
                    <div class="flex items-center mb-4">
                        <div class="w-40 h-15 bg-red-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-10 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900 ml-2">Documento PDF</h3>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 flex flex-col md:flex-row justify-between items-center gap-6">
                        <div class="flex-grow text-center md:text-left">
                            <p class="text-gray-600 mb-4">Escanea el código QR para abrir el documento directamente.</p>
                            <a href="{{ $partitura->url_pdf }}" target="_blank"
                                class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Ver PDF
                            </a>
                        </div>
<<<<<<< HEAD
                        <div class="div_Qr p-4 bg-white border border-gray-200 rounded-lg shadow-inner flex-shrink-0">
=======
                        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-inner flex-shrink-0">
>>>>>>> a81fa4d156bc7ae22cce0f9bc158baaa43143635
                            {!! $qrCodePDF !!}
                        </div>
                    </div>
                </div>
            @endif

            @if ($partitura->link_video)
                <div class="bg-white shadow-lg rounded-xl p-6 mb-8 border-t-4 border-teal-500">
                    <div class="flex items-center mb-4">
                        <div class="w-40 h-15 bg-teal-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-10 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                </path>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900 ml-2">Enlace de Video</h3>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 flex flex-col md:flex-row justify-between items-center gap-6">
                        <div class="flex-grow text-center md:text-left">
                            <p class="text-gray-600 mb-4">Escanea el código QR para ver el video directamente en YouTube u otra plataforma.</p>
                            <a href="{{ $partitura->link_video }}" target="_blank"
                                class="inline-flex items-center px-4 py-2 bg-teal-500 hover:bg-teal-600 text-white rounded-lg transition duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Ver Video
                            </a>
                        </div>
<<<<<<< HEAD
                        <div class="div_Qr p-4 bg-white border border-gray-200 rounded-lg shadow-inner flex-shrink-0">
=======
                        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-inner flex-shrink-0">
>>>>>>> a81fa4d156bc7ae22cce0f9bc158baaa43143635
                            {!! $qrCodeYT !!}
                        </div>
                    </div>
                </div>
            @endif



            {{-- <div class="bg-white shadow-lg rounded-xl p-6 border-t-4 border-gray-500">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Información Adicional</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Fecha de Creación
                        </h4>
                        <p class="text-gray-900">
                            {{ $partitura->created_at ? $partitura->created_at->format('d/m/Y H:i') : 'No disponible' }}
                        </p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Última
                            Actualización</h4>
                        <p class="text-gray-900">
                            {{ $partitura->updated_at ? $partitura->updated_at->format('d/m/Y H:i') : 'No disponible' }}
                        </p>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</x-app-layout>