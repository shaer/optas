'use strict'

const {
    mix
} = require('laravel-mix');

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
mix.copy('bower_components/bootstrap/dist/fonts', 'public/assets/fonts');
mix.copy('bower_components/fontawesome/fonts', 'public/assets/fonts');
mix.styles([
    'bower_components/bootstrap/dist/css/bootstrap.css',
    'bower_components/fontawesome/css/font-awesome.css',
    'resources/css/sb-admin-2.css',
    'resources/css/custom.css',
    'resources/css/timeline.css'
], 'public/assets/stylesheets/styles.css', './');
mix.scripts([
    'bower_components/jquery/dist/jquery.js',
    'bower_components/moment/min/moment.min.js',
    'bower_components/bootstrap/dist/js/bootstrap.js',
    //'bower_components/Chart.js/Chart.js',
    'bower_components/metisMenu/dist/metisMenu.js',
    'resources/js/sb-admin-2.js',
    'resources/js/frontend.js'
], 'public/assets/scripts/frontend.js', './');



mix.styles([
    'bower_components/angular-material/angular-material.min.css',
    'bower_components/angular-loading-bar/src/loading-bar.css',
    'resources/css/angular.css'
], 'public/assets/stylesheets/angular.css', './');

mix.scripts([
    'bower_components/moment/moment.js',
    'bower_components/angular/angular.min.js',
    'bower_components/angular-route/angular-route.min.js',
    'bower_components/angular-animate/angular-animate.min.js',
    'bower_components/angular-aria/angular-aria.min.js',
    'bower_components/angular-messages/angular-messages.min.js',
    'bower_components/angular-material/angular-material.min.js',
    'bower_components/angular-loading-bar/src/loading-bar.js',
    'resources/js/angular-resources/app.js',
    'resources/js/angular-resources/Filters/*.js',
    'resources/js/angular-resources/Services/*.js',
    'resources/js/angular-resources/Directives/*.js',
    'resources/js/angular-resources/Controllers/*.js'
], 'public/assets/scripts/angular.js', './');
