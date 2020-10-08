const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');



mix.js('resources/js/app.js', 'public/js').sourceMaps()
    .sass('resources/sass/app.scss', 'public/css').options({
    processCssUrls: false,
    postCss: [tailwindcss('./tailwind.config.js')],
    })
    .browserSync({
        proxy: 'http://worksheet.test/'
    });

mix.copyDirectory('resources/img', 'public/img');
