document.addEventListener("DOMContentLoaded", function () {
    // Toggle instrument sections
    document.querySelectorAll(".instrumento-toggle").forEach((button) => {
        button.addEventListener("click", function () {
            const content = this.nextElementSibling;
            const icon = this.querySelector(".chevron-icon");

            content.classList.toggle("hidden");
            icon.classList.toggle("rotate-180");

            // Cerrar otras secciones abiertas
            document
                .querySelectorAll(".instrumento-content")
                .forEach((otherContent) => {
                    if (
                        otherContent !== content &&
                        !otherContent.classList.contains("hidden")
                    ) {
                        otherContent.classList.add("hidden");
                        otherContent.previousElementSibling
                            .querySelector(".chevron-icon")
                            .classList.remove("rotate-180");
                    }
                });
        });
    });

    // Toggle autor sections
    document.querySelectorAll(".autor-toggle").forEach((button) => {
        button.addEventListener("click", function () {
            const content = this.nextElementSibling;
            const icon = this.querySelector(".chevron-icon");

            content.classList.toggle("hidden");
            icon.classList.toggle("rotate-180");

            // Cerrar otras secciones abiertas
            document
                .querySelectorAll(".autor-content")
                .forEach((otherContent) => {
                    if (
                        otherContent !== content &&
                        !otherContent.classList.contains("hidden")
                    ) {
                        otherContent.classList.add("hidden");
                        otherContent.previousElementSibling
                            .querySelector(".chevron-icon")
                            .classList.remove("rotate-180");
                    }
                });
        });
    });

    // Search + filter functionality
    const searchInput = document.getElementById("search-input");
    const clearButton = document.getElementById("clear-search");

    if (searchInput) {
        function filterPartituras() {
            const searchTerm = searchInput.value.toLowerCase();

            // Mostrar/ocultar botón de limpiar
            if (clearButton) {
                clearButton.classList.toggle("hidden", !searchTerm);
            }

            // Para vista de partituras por instrumento
            if (document.querySelector(".instrumento-content")) {
                document.querySelectorAll(".border-b").forEach((section) => {
                    let hasMatchingObras = false;
                    let matchingCount = 0;

                    // Buscar en todas las obras dentro de este instrumento
                    section
                        .querySelectorAll("[data-obra-titulo]")
                        .forEach((obraElement) => {
                            const obraTitulo = obraElement
                                .getAttribute("data-obra-titulo")
                                .toLowerCase();
                            const matchesSearch =
                                obraTitulo.includes(searchTerm);

                            // Mostrar/ocultar obra individual
                            obraElement.style.display =
                                matchesSearch || !searchTerm ? "flex" : "none";

                            if (matchesSearch) {
                                hasMatchingObras = true;
                                matchingCount++;
                            }
                        });

                    // Mostrar/ocultar la sección completa del instrumento
                    section.style.display =
                        hasMatchingObras || !searchTerm ? "block" : "none";

                    // Actualizar el contador de partituras disponibles
                    const countElement = section.querySelector(
                        ".text-sm.text-gray-500"
                    );
                    if (countElement) {
                        if (searchTerm) {
                            countElement.textContent = `${matchingCount} partitura(s) disponible(s)`;
                        } else {
                            // Restaurar el contador original
                            const originalCount = countElement.getAttribute(
                                "data-original-count"
                            );
                            if (originalCount) {
                                countElement.textContent = `${originalCount} partitura(s) disponible(s)`;
                            }
                        }
                    }
                });
            }

            // Para vista de partituras por autor
            if (document.querySelector(".autor-content")) {
                document
                    .querySelectorAll(".border-b")
                    .forEach((autorSection) => {
                        let hasMatchingObras = false;
                        let matchingCount = 0;

                        // Buscar en obras del autor
                        autorSection
                            .querySelectorAll("[data-obra-titulo]")
                            .forEach((obraElement) => {
                                const obraTitulo = obraElement
                                    .getAttribute("data-obra-titulo")
                                    .toLowerCase();
                                const matchesSearch =
                                    obraTitulo.includes(searchTerm);

                                // Mostrar/ocultar obra individual
                                obraElement.style.display =
                                    matchesSearch || !searchTerm
                                        ? "block"
                                        : "none";

                                if (matchesSearch) {
                                    hasMatchingObras = true;
                                    matchingCount++;
                                }
                            });

                        // Mostrar/ocultar sección completa del autor
                        autorSection.style.display =
                            hasMatchingObras || !searchTerm ? "block" : "none";

                        // Actualizar el contador de obras disponibles
                        const countElement = autorSection.querySelector(
                            ".text-sm.text-gray-500"
                        );
                        if (countElement) {
                            if (searchTerm) {
                                countElement.textContent = `${matchingCount} obra(s) disponible(s)`;
                            } else {
                                // Restaurar el contador original
                                const originalCount = countElement.getAttribute(
                                    "data-original-count"
                                );
                                if (originalCount) {
                                    countElement.textContent = `${originalCount} obra(s) disponible(s)`;
                                }
                            }
                        }
                    });
            }
        }

        searchInput.addEventListener("input", filterPartituras);

        // Limpiar búsqueda
        if (clearButton) {
            clearButton.addEventListener("click", function () {
                searchInput.value = "";
                filterPartituras();
                searchInput.focus();
            });
        }
    }
});
