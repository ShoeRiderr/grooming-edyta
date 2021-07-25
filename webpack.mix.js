const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');

/**
 * Admin
 */
mix.js('resources/js/admin/app.js', 'public/js/admin').vue();
mix.sass('resources/sass/admin/app.scss', 'public/css/admin');

mix.copy('node_modules/pdfjs-dist/build/pdf.worker.min.js', 'public/js/pdfjs');