import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/seller.css',
                'resources/css/buyer.css',
                'resources/css/landing.css',
                'resources/css/auth.css',
                'resources/js/bootstrap.js',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
