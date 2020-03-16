const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .sass("resources/sass/event/show.scss", "public/css/event")
    .sass("resources/sass/event/list.scss", "public/css/event")
    .sass("resources/sass/event/create.scss", "public/css/event")
    .sass("resources/sass/partial/form.scss", "public/css/partial")
    .sass("resources/sass/event/interests.scss", "public/css/event")
    .sass("resources/sass/home.scss", "public/css/");
