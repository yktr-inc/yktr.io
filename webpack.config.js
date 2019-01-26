var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('js/app', './assets/js/app.js') // your js entry file
    .addStyleEntry('css/app', './assets/scss/app.scss') // your less/scss entry file
    .addStyleEntry('css/style', './assets/css/style.css') // your less/scss entry file
    .enablePostCssLoader(function(options) {
    options.config = {
        path: './postcss.config.js'
    };
    })
    .enableSassLoader(function (options) {}, {
        resolveUrlLoader: false
    })
;

module.exports = Encore.getWebpackConfig();


