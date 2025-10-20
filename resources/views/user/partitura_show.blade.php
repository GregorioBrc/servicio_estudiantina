<x-app-layout title="{{ $partitura->obra->titulo }}">
    <div class="max-w-4xl mx-auto mt-8 px-4 sm:px-6 lg:px-8 mb-16">
        <!-- Back navigation -->
        <div class="mb-6">
            <a href="{{ $backUrl ?? route('usuario.partituras') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver a partituras
            </a>
        </div>

        <!-- Main content card -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header section -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-8 text-white">
                <h1 class="text-3xl font-bold mb-2">{{ $partitura->obra->titulo }}</h1>
                @if($partitura->obra->compositor)
                    <p class="text-blue-100 text-lg">Compositor: {{ $partitura->obra->compositor }}</p>
                @endif
            </div>

            <!-- Content section -->
            <div class="p-6 space-y-6">
                <!-- PDF section -->
                <section>
                    <div class="flex items-center mb-4">
                        <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h2 class="text-xl font-semibold text-gray-800">Partitura PDF</h2>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 flex flex-col md:flex-row justify-between items-center gap-6">
                        <div class="flex-grow text-center md:text-left">
                            <p class="text-gray-600 mb-4">Escanea el código QR para abrir el documento directamente.</p>
                            <a href="{{ $partitura->url_pdf }}"
                            target="_blank"
                            class="inline-flex items-center px-6 py-3 bg-red-500 text-white font-medium rounded-lg hover:bg-red-600 transition duration-150 ease-in-out shadow-sm">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Ver/Descargar Partitura
                            </a>
                        </div>
                        <div class="div_Qr p-4 bg-white border border-gray-200 rounded-lg shadow-inner flex-shrink-0">
                            {!! $qrCodePDF !!}
                        </div>
                    </div>
                </section>

                <!-- Video section (conditional) -->
                @if ($partitura->link_video)
                    <section class="pt-6 border-t border-gray-200">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 text-purple-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-800">Video de Referencia</h3>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 flex flex-col md:flex-row justify-between items-center gap-6">
                            <div class="flex-grow text-center md:text-left">
                                <p class="text-gray-600 mb-4">Escanea el código QR para ver el video directamente en YouTube u otra plataforma.</p>
                                <a href="{{ $partitura->link_video }}"
                                target="_blank"
                                class="inline-flex items-center px-6 py-3 bg-purple-500 text-white font-medium rounded-lg hover:bg-purple-600 transition duration-150 ease-in-out shadow-sm">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Ver Video
                                </a>
                            </div>
                            <div class="div_Qr p-4 bg-white border border-gray-200 rounded-lg shadow-inner flex-shrink-0">
                                {!! $qrCodeYT !!}
                            </div>
                        </div>
                    </section>
                @endif

                <!-- Additional information section -->
                <section class="pt-6 border-t border-gray-200">
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">Información Adicional</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                        @if($partitura->instrumento)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                                </svg>
                                <span><strong>Instrumento:</strong> {{ $partitura->instrumento->nombre }}</span>
                            </div>
                        @endif
                        @if($partitura->created_at)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span><strong>Agregada:</strong> {{ $partitura->created_at->format('d/m/Y') }}</span>
                            </div>
                        @endif
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
