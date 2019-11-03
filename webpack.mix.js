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

// mix.js('resources/js/app.js', 'public/js');
mix.scripts([
    'public/assets/js/jquery.js',
    'public/assets/js/bootstrap.min.js',
    'public/assets/js/owl.carousel.min.js',
    'public/assets/js/jquery.magnific-popup.min.js',
    'public/assets/js/validator.min.js',
    'public/assets/js/jquery.smartWizard.min.js',
    'public/assets/js/jquery.mask.min.js',
    'public/assets/js/intlTelInput.min.js',
    'public/assets/js/main.js'
], 'public/js/app.js');

mix.sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false
    });
