var Encore = require('@symfony/webpack-encore');
var path = require('path');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    //.setManifestKeyPrefix('build/')

    .addEntry('app', './assets/js/app.js')
    //.addEntry('page1', './assets/js/page1.js')
    //.addEntry('page2', './assets/js/page2.js')


    .addStyleEntry('style', './assets/scss/style.scss')

    .copyFiles({
        from: './assets/images',
        to: 'images/[path][name].[ext]'
    })

    .splitEntryChunks()

    .enableSingleRuntimeChunk()

    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())
    .enableSassLoader()

    // enables @babel/preset-env polyfills
    .configureBabel(() => {}, {
        useBuiltIns: 'usage',
        corejs: 3
    })

    .enableVueLoader()

    .addAliases({
        '@tools': path.resolve(__dirname, 'assets/js/tools'),
        '@public-views': path.resolve(__dirname, 'assets/js/views/Public'),
        '@user-views': path.resolve(__dirname, 'assets/js/views/User'),
        '@admin-views': path.resolve(__dirname, 'assets/js/views/Admin'),
    })
;

module.exports = Encore.getWebpackConfig();
