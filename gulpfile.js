var paths = {
    'SOURCE': './resources/assets/',
    'DESTINATION': './public/assets/',
    'NODE': './node_modules/',
}

var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss', paths.DESTINATION + 'css', {
        includePaths: [
            paths.NODE + 'foundation-sites/scss',
        ]
    });

    mix.babel([
        // jQuery needs to be loaded before foundation
        paths.NODE + 'jquery/dist/jquery.js',

        // core and media query are need to initialize before any
        // other component and are required for all other components
        paths.NODE + 'foundation-sites/js/foundation.core.js',
        paths.NODE + 'foundation-sites/js/foundation.util.mediaQuery.js',

        // Feel free to add or remove components at your discretion
        // check the Foundation docs for components requirements
        // paths.NODE + 'foundation-sites/js/foundation.util.box.js',
        // paths.NODE + 'foundation-sites/js/foundation.util.keyboard.js',
        // paths.NODE + 'foundation-sites/js/foundation.util.motion.js',
        // paths.NODE + 'foundation-sites/js/foundation.util.nest.js',
        // paths.NODE + 'foundation-sites/js/foundation.util.timerAndImageLoader.js',
        // paths.NODE + 'foundation-sites/js/foundation.util.touch.js',
        // paths.NODE + 'foundation-sites/js/foundation.util.triggers.js',
        // paths.NODE + 'foundation-sites/js/foundation.abide.js',
        // paths.NODE + 'foundation-sites/js/foundation.accordion.js',
        // paths.NODE + 'foundation-sites/js/foundation.accordionMenu.js',
        // paths.NODE + 'foundation-sites/js/foundation.drilldown.js',
        // paths.NODE + 'foundation-sites/js/foundation.dropdown.js',
        // paths.NODE + 'foundation-sites/js/foundation.dropdownMenu.js',
        // paths.NODE + 'foundation-sites/js/foundation.equalizer.js',
        // paths.NODE + 'foundation-sites/js/foundation.interchange.js',
        // paths.NODE + 'foundation-sites/js/foundation.magellan.js',
        // paths.NODE + 'foundation-sites/js/foundation.offcanvas.js',
        // paths.NODE + 'foundation-sites/js/foundation.orbit.js',
        // paths.NODE + 'foundation-sites/js/foundation.responsiveMenu.js',
        // paths.NODE + 'foundation-sites/js/foundation.responsiveToggle.js',
        // paths.NODE + 'foundation-sites/js/foundation.reveal.js',
        // paths.NODE + 'foundation-sites/js/foundation.slider.js',
        // paths.NODE + 'foundation-sites/js/foundation.sticky.js',
        // paths.NODE + 'foundation-sites/js/foundation.tabs.js',
        // paths.NODE + 'foundation-sites/js/foundation.toggler.js',
        // paths.NODE + 'foundation-sites/js/foundation.tooltip.js',
    ], paths.DESTINATION + 'js/foundation.js', './');
	
	mix.version(['assets/css/app.css', 'assets/js/foundation.js']);
});