<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Estudiantina' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col {{ auth()->check() && auth()->user()->dark_mode ? 'dark bg-gray-900 text-white' : 'bg-white text-gray-900' }}">
    <x-header-landing></x-header-landing>

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <x-footer></x-footer>

    <!-- Marca de agua del logo UNET -->
    <div class="watermark-container fixed bottom-4 right-4 z-10 pointer-events-none opacity-10 dark:opacity-20">
        <img src="/images/Logo_Unet.svg" alt="Logo UNET" class="w-24 h-24 md:w-32 md:h-32 lg:w-40 lg:h-40 watermark-svg">
    </div>

    @stack('scripts')
</body>
</html>
