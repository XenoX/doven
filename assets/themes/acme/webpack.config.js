let Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning()
    .autoProvidejQuery()
    .autoProvideVariables({
        $: 'jquery',
        jQuery: 'jquery',
        'window.jQuery': 'jquery',
    })
    .enableSassLoader(function(sassOptions) {}, {
        resolveUrlLoader: false
    })
    .createSharedEntry('app', [
        './assets/themes/acme/scss/global.scss',
        './assets/themes/acme/css/style.css',
        './assets/themes/acme/js/app.js'
    ])
;

module.exports = Encore.getWebpackConfig();
