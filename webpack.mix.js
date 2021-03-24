const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

mix.js('resources/js/belich.js', 'public/js')
    .sass('resources/sass/belich.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('./tailwind.config.js')],
});
