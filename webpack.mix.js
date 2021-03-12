const mix = require("laravel-mix");

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

/* For a good intro on doing some basic useful stuff, see here: https://www.larashout.com/laravel-mix */

mix.js("resources/js/app.js", "public/js/app.js", [require("jquery")])
    .postCss("resources/css/app.css", "public/css", [
        require("postcss-import"),
        require("tailwindcss"),
        require("autoprefixer"),
    ])
    .sass("resources/css/styles.scss", "public/css/app.css")
		
    