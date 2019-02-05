var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('js/app', './assets/js/app.js') // your js entry file
    .addStyleEntry('css/app', './assets/scss/app.scss')
    .addStyleEntry('css/style', './assets/css/style.css')
    .cleanupOutputBeforeBuild()
    .enablePostCssLoader()
    .enableSassLoader(function (options) {}, {
        resolveUrlLoader: false
    })
    .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
