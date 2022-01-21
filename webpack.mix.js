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

 /**
  * Laravel Mix GraphQL Loader
  */
 class LaravelMixGraphQl {
 
     /**
      * All dependencies that should be installed by Mix.
      *
      * @return {Array}
      */
     dependencies() {
         return [
             'graphql',
             'graphql-tag'
         ];
     }
 
     /**
      * Rules to be merged with the master webpack loaders.
      *
      * @return {Array|Object}
      */
     webpackRules() {
         return {
             test: /\.(graphql|gql)$/,
             exclude: /node_modules/,
             loader: 'graphql-tag/loader'
         };
     }
 
 }
 
mix.extend('graphql', new LaravelMixGraphQl());

mix.js('resources/js/chat/chat-app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css').graphql();
