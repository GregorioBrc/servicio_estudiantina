import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    server: {
        // Usa '0.0.0.0' para escuchar en todas las interfaces de red
        host: '0.0.0.0', 
        // ¡IMPORTANTE! Fuerza al cliente HMR a usar la IP de tu PC
        hmr: {
            host: '192.168.0.102', 
        }
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/partituras.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});