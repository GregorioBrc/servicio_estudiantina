document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('dark-mode-toggle');
    const icon = document.getElementById('dark-mode-icon');
    const body = document.body;

    // Verificar si el botón existe antes de continuar
    if (!toggleButton || !icon) {
        return;
    }

    // Set initial state
    const isDark = body.classList.contains('dark');
    if (isDark) {
        icon.textContent = '☀️';
    } else {
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
