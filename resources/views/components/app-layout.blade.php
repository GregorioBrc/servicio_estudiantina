<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Estudiantina' }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="min-h-screen flex flex-col">
    <x-header-landing></x-header-landing>

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <x-footer></x-footer>

    @stack('scripts')
</body>
</html>
