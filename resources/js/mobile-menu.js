// Mobile menu toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');

            // Change icon based on menu state
            const svg = mobileMenuToggle.querySelector('svg');
            if (mobileMenu.classList.contains('hidden')) {
                // Show hamburger icon
                svg.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                `;
            } else {
                // Show close icon
                svg.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                `;
            }
        });
    }

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
            const isClickInsideMenu = mobileMenu.contains(event.target);
            const isClickOnToggle = mobileMenuToggle && mobileMenuToggle.contains(event.target);

            if (!isClickInsideMenu && !isClickOnToggle) {
                mobileMenu.classList.add('hidden');
                // Reset icon to hamburger
                if (mobileMenuToggle) {
                    const svg = mobileMenuToggle.querySelector('svg');
                    svg.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    `;
                }
            }
        }
    });

    // Handle window resize - hide mobile menu on large screens
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768 && mobileMenu && !mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.add('hidden');
            // Reset icon to hamburger
            if (mobileMenuToggle) {
                const svg = mobileMenuToggle.querySelector('svg');
                svg.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                `;
            }
        }
    });
});
