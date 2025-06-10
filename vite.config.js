import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            // Input untuk file aset Anda
            input: [
                'resources/sass/app.scss', // <--- Pastikan baris ini ada
                'resources/js/app.js',     // <--- Pastikan baris ini ada
            ],
            refresh: true, // Untuk refresh browser saat perubahan file
        }),
    ],
});