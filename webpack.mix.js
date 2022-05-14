const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.styles([
    'resources/assets/admin/plugins/fontawesome-free/css/all.min.css',
    'resources/assets/admin/plugins/select2/css/select2.css',
    'resources/assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.css',
    'resources/assets/admin/css/adminlte.min.css',
    'resources/assets/admin/css/site.css',
], 'public/assets/admin/css/admin.css');

mix.scripts([
    'resources/assets/admin/plugins/jquery/jquery.min.js',
    'resources/assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'resources/assets/admin/plugins/select2/js/select2.full.js',
    'resources/assets/admin/js/adminlte.min.js',
    'resources/assets/admin/js/demo.js'
], 'public/assets/admin/js/admin.js');

mix.js('resources/assets/admin/js/imageHandle.js', 'public/assets/admin/js/imageHandle.js');

mix.copyDirectory('resources/assets/admin/plugins/fontawesome-free/webfonts',
    'public/assets/admin/webfonts');

mix.copyDirectory('resources/assets/admin/img',
    'public/assets/admin/img');

mix.copy('resources/assets/admin/css/adminlte.min.css.map',
    'public/assets/admin/css/adminlte.min.css.map');


// FRONT
mix.styles([
    'resources/assets/front/css/blog.css'
], 'public/assets/front/css/blog.css');

mix.scripts([
    'resources/assets/front/js/scripts.js'
], 'public/assets/front/js/scripts.js');
