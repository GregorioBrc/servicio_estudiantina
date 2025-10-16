document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('dark-mode-toggle');
    const toggleButtonMobile = document.getElementById('dark-mode-toggle-mobile');
    const icon = document.getElementById('dark-mode-icon');
    const iconMobile = document.getElementById('dark-mode-icon-mobile');
    const body = document.body;

    // Set initial state
    const isDark = body.classList.contains('dark');

    function updateIcons(isDarkMode) {
        const sunIcon = '☀️';
        const moonIcon = '🌙';

        if (icon) icon.textContent = isDarkMode ? sunIcon : moonIcon;
        if (iconMobile) iconMobile.textContent = isDarkMode ? sunIcon : moonIcon;
    }

    // Set initial icons
    updateIcons(isDark);

    // Handle desktop toggle
    if (toggleButton) {
        toggleButton.addEventListener('click', toggleDarkMode);
    }

    // Handle mobile toggle
    if (toggleButtonMobile) {
        toggleButtonMobile.addEventListener('click', toggleDarkMode);
    }

    function toggleDarkMode() {
        const currentDark = body.classList.contains('dark');
        const newDark = !currentDark;

        // Update UI immediately
        if (newDark) {
            body.classList.add('dark', 'bg-gray-900', 'text-white');
            body.classList.remove('bg-white', 'text-gray-900');
        } else {
            body.classList.remove('dark', 'bg-gray-900', 'text-white');
            body.classList.add('bg-white', 'text-gray-900');
        }

        // Update both icons
        updateIcons(newDark);

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
            } else {
                body.classList.add('dark', 'bg-gray-900', 'text-white');
                body.classList.remove('bg-white', 'text-gray-900');
            }
            updateIcons(!newDark);
        });
    }
});
