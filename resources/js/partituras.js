document.addEventListener('DOMContentLoaded', function() {
    // Toggle instrument sections
    document.querySelectorAll('.instrumento-toggle').forEach(button => {
        button.addEventListener('click', function() {
            const content = this.nextElementSibling;
            const icon = this.querySelector('.chevron-icon');

            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');

            // Cerrar otras secciones abiertas
            document.querySelectorAll('.instrumento-content').forEach(otherContent => {
                if (otherContent !== content && !otherContent.classList.contains('hidden')) {
                    otherContent.classList.add('hidden');
                    otherContent.previousElementSibling.querySelector('.chevron-icon').classList.remove('rotate-180');
                }
            });
        });
    });

    // Toggle autor sections
    document.querySelectorAll('.autor-toggle').forEach(button => {
        button.addEventListener('click', function() {
            const content = this.nextElementSibling;
            const icon = this.querySelector('.chevron-icon');

            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');

            // Cerrar otras secciones abiertas
            document.querySelectorAll('.autor-content').forEach(otherContent => {
                if (otherContent !== content && !otherContent.classList.contains('hidden')) {
                    otherContent.classList.add('hidden');
                    otherContent.previousElementSibling.querySelector('.chevron-icon').classList.remove('rotate-180');
                }
            });
        });
    });

    // Search + filter functionality
    const searchInput = document.querySelector('input[type="text"]');
    const instrumentSelect = document.querySelector('select');

    function filterPartituras() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedInstrument = instrumentSelect.value;

        document.querySelectorAll('.border-b[data-instrumento]').forEach(section => {
            const instrumentoId = section.dataset.instrumento;
            let hasVisibleItems = false;

            section.querySelectorAll('[data-instrumento]').forEach(item => {
                const text = item.textContent.toLowerCase();
                const matchesSearch = text.includes(searchTerm);
                const matchesInstrument = !selectedInstrument || selectedInstrument === instrumentoId;

                if (matchesSearch && matchesInstrument) {
                    item.style.display = 'flex';
                    hasVisibleItems = true;
                } else {
                    item.style.display = 'none';
                }
            });

            // Mostrar/ocultar la sección completa según resultados
            section.style.display = hasVisibleItems ? 'block' : 'none';
        });
    }

    searchInput.addEventListener('input', filterPartituras);
    instrumentSelect.addEventListener('change', filterPartituras);
});
