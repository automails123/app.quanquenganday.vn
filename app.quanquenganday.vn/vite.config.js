import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            // input: ['resources/css/app.css', 'resources/js/app.js'],
            input: [
                'resources/css/app.css', 
                'resources/js/app.js', 
                'resources/css/custom.css' // Tất cả nằm chung trong 1 mảng []
            ],
            refresh: true,
        }),
    ],
});
