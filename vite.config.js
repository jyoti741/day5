import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/postcss';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/passkeys.js',
            ],
            refresh: true,
        }),
    ],
    css: {
        postcss: {
            plugins: [
                tailwindcss(),
            ],
        },
    },
});