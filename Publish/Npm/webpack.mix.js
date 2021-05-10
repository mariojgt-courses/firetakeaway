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
// Normal js files
mix.js('resources/vendor/Firetakeaway/js/app.js', 'public/vendor/Firetakeaway/js')
    .sourceMaps()
    .version();

// Vue js example
mix.js('resources/vendor/Firetakeaway/js/vue.js', 'public/vendor/Firetakeaway/js')
    .vue({version: 3})
    .sourceMaps()
    .version();

const tailwindcss = require('tailwindcss')

mix.sass('resources/vendor/Firetakeaway/sass/app.scss', 'public/vendor/Firetakeaway/css')
   .options({
      processCssUrls: false,
      postCss: [ tailwindcss('tailwind.config.js') ],
});
