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
    .addEntry('js/crud', './assets/js/crud.js')
    .addStyleEntry('css/app', './assets/scss/app.scss')
    .addStyleEntry('notifications', './assets/scss/notifications.scss')
    .addStyleEntry('login', './assets/scss/login.scss')
    .addStyleEntry('crud', './assets/scss/crud.scss')
    .addStyleEntry('dashboard',
        [
            './assets/scss/app.scss',
            './assets/scss/dashboard/dashboard.scss',
            './assets/scss/dashboard/dashboard_items.scss',
            './assets/scss/dashboard/dashboard_admin.scss'
        ])
;

module.exports = Encore.getWebpackConfig();
