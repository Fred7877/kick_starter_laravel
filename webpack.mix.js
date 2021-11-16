const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/jquery.bootstrap-duallistbox.min.js', 'public/js')
    .copy('resources/js/select2.min.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .postCss('resources/css/bootstrap-duallistbox.min.css', 'public/css')
    .postCss('resources/css/style-dualbox.css', 'public/css')
    .copy('resources/css/select2.min.css', 'public/css')
    .sourceMaps();
