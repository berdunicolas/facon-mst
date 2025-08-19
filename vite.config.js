import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/*',
                'resources/js/*',
                'resources/datatables/*'
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~fonts' : path.resolve(__dirname,'public/fonts')
        }
    }
});
