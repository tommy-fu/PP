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
    .sass('resources/sass/app.scss', 'public/css')
    .version();

mix.js('resources/js/section-builder.js', 'public/js');
// mix.js('resources/js/admin.js', 'public/js');

mix.js('resources/js/sections.js', 'public/js');
mix.js('resources/js/dashboard.js', 'public/js');
mix.js('resources/js/edit-section.js', 'public/js');

mix.sass('resources/sass/dashboard.scss', 'public/css');


mix.webpackConfig({
    module: {
        rules: [{
            test: /\.svg$/,
            include: path.join(__dirname, 'public/icons'),
            use: [{ loader: 'html-loader' }]
        }]
    }
});


// mix.browserSync('paste-panda-laravel.dew');

// const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
//
// mix.webpackConfig({
//     plugins: [
//         new BrowserSyncPlugin({
//             files: [
//                 'app/**/*',
//                 'public/**/*',
//                 'resources/views/**/*',
//                 'routes/**/*'
//             ]
//         })
//     ]
// });
// // Or:
//
// mix.browserSync({
//     proxy: 'my-domain.dev'
// })
