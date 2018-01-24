let mix = require('laravel-mix');

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

mix.scripts([
    'public/frontend/js/jquery.min.js',
    'public/frontend/js/semantic.min.js',
    'public/frontend/js/swiper.min.js'
], 'public/frontend/js/app.js').version();

mix.styles([
    'public/frontend/css/semantic.min.css',
    'public/frontend/css/swiper.min.css',
    'public/frontend/css/main.css'
], 'public/frontend/css/app.css').version();

mix.babel([
    'public/backend/js/jquery.min.js',
    'public/backend/js/bootstrap.min.js',
    'public/backend/js/cropper.min.js',
    'public/backend/js/bootstrap-select.min.js',
    'public/backend/js/detect.js',
    'public/backend/js/fastclick.js',
    'public/backend/js/jquery.blockUI.js',
    'public/backend/js/waves.js',
    'public/backend/js/jquery.slimscroll.js',
    'public/backend/js/jquery.scrollTo.min.js',
    'public/backend/js/modernizr.min.js',
    'public/backend/js/toastr.min.js',
    'public/backend/js/switchery.min.js',
    'public/backend/js/sweet-alert.min.js',
    'public/backend/js/jquery.waypoints.min.js',
    'public/backend/js/jquery.counterup.min.js',
    'public/backend/js/jquery.app.js',
    'public/backend/js/jquery.core.js',
    'public/backend/js/script.js',
    'public/backend/js/select2.min.js'
], 'public/backend/js/admin.js').version();

mix.styles([
    'public/backend/css/toastr.min.css',
    'public/backend/css/sweet-alert.css',
    'public/backend/css/select2.min.css',
    'public/backend/css/bootstrap.min.css',
    'public/backend/css/cropper.min.css',
    'public/backend/css/bootstrap-select.min.css',
    'public/backend/css/core.css',
    'public/backend/css/components.css',
    'public/backend/css/icons.css',
    'public/backend/css/pages.css',
    'public/backend/css/menu.css',
    'public/backend/css/responsive.css',
    'public/backend/css/switchery.min.css',
    'public/backend/css/animate.min.css'
], 'public/backend/css/admin.css').version();
