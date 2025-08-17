import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        cors: true,
        hmr: {
            overlay: {
                errors: true,
                warnings: false,
            },
        },
    },
    optimizeDeps: {
        include: ['datatables.net-bs5', 'datatables.net-responsive-bs5'],
    },
    build: {
        rollupOptions: {
            external: ['cdn.datatables.net'],
        },
    },
});