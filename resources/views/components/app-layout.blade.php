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

    @stack('scripts')
    @auth
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('dark-mode-toggle');
            const icon = document.getElementById('dark-mode-icon');
            const body = document.body;

            // Set initial state
            const isDark = {{ auth()->user()->dark_mode ? 'true' : 'false' }};
            if (isDark) {
                body.classList.add('dark', 'bg-gray-900', 'text-white');
                body.classList.remove('bg-white', 'text-gray-900');
                icon.textContent = '☀️';
            } else {
                body.classList.remove('dark', 'bg-gray-900', 'text-white');
                body.classList.add('bg-white', 'text-white-900');
                icon.textContent = '🌙';
            }

            toggleButton.addEventListener('click', function() {
                const currentDark = body.classList.contains('dark');
                const newDark = !currentDark;

                // Update UI immediately
                if (newDark) {
                    body.classList.add('dark', 'bg-gray-900', 'text-white');
                    body.classList.remove('bg-white', 'text-gray-900');
                    icon.textContent = '☀️';
                } else {
                    body.classList.remove('dark', 'bg-gray-900', 'text-white');
                    body.classList.add('bg-white', 'text-gray-900');
                    icon.textContent = '🌙';
                }

                // Update server
                fetch('/user/toggle-dark-mode', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ dark_mode: newDark })
                }).catch(error => {
                    console.error('Error updating dark mode:', error);
                    // Revert UI on error
                    if (newDark) {
                        body.classList.remove('dark', 'bg-gray-900', 'text-white');
                        body.classList.add('bg-white', 'text-gray-900');
                        icon.textContent = '🌙';
                    } else {
                        body.classList.add('dark', 'bg-gray-900', 'text-white');
                        body.classList.remove('bg-white', 'text-gray-900');
                        icon.textContent = '☀️';
                    }
                });
            });
        });
    </script>
    @endauth
</body>
</html>
