var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enablePostCssLoader()
    .enableSassLoader(function (options) {}, {
        resolveUrlLoader: false
    })
    .autoProvidejQuery()
    .addEntry('js/app', './assets/js/app.js')
    .addStyleEntry('css/app', './assets/scss/app.scss')

    .addStyleEntry('dashboard',
        [
            './assets/scss/app.scss',
            './assets/scss/dashboard/dashboard.scss',
            './assets/scss/dashboard/dashboard_items.scss',
            './assets/scss/dashboard/dashboard_admin.scss'
        ])
;

module.exports = Encore.getWebpackConfig();
