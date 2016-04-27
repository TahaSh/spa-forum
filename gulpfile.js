var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');


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
    mix.browserify('main.js')
      .styles([
        './node_modules/normalize.css/normalize.css',
        './node_modules/nprogress/nprogress.css',
        './node_modules/loaders.css/loaders.css',
        './node_modules/sweetalert/dist/sweetalert.css'
      ]);
});

