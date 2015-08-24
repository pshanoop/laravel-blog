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

var paths = {
 'jquery': '../bower/jquery/',
 'angular': '../bower/angular/',
 'angularRoute': '../bower/angular-route/',
 'angularResource': '../bower/angular-resource/',
 'bootstrap': '../bower/bootstrap-sass-official/assets/',
 'asset': 'resources/assets/',
 'fonts': 'bower/bootstrap-sass-official/assets/fonts/', //Icons and fonts
 'output':'public/'
};

elixir(function(mix) {

 mix.rubySass(paths.bootstrap + 'stylesheets/_bootstrap.scss',paths.output+'/css/bootstrap.css')
    .rubySass('app.scss')
    .rubySass('home.scss',paths.output+'/css/home.css');

 mix.copy(paths.asset+paths.fonts + 'bootstrap/**', paths.output +'fonts') //Copy fonts
     .copy(paths.asset+'img/**',paths.output + 'img')
     .scripts([
      paths.jquery + "dist/jquery.js",
      paths.bootstrap + "javascripts/bootstrap.js",
     ], paths.output+'/js/framework.js')
     .scripts([
      "home.js"
     ], paths.output+'/js/home.js')
     .scripts([
      paths.angular + "angular.js",
      paths.angularRoute + "angular-route.js",
      paths.angularResource + "angular-resource.js",
      'dashboard/ui-bootstrap-tpls.min.js',
      'dashboard/dashboard.js',
      'dashboard/services/*.js',
      'dashboard/controller/*.js'
     ],paths.output+'js/dashboard.js');


 mix.version(['css/*.css','js/*.js','fonts/']);
});