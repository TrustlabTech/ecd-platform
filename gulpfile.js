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

// elixir(function(mix) {
//     mix.sass('app.scss');
// });

//elixir(function(mix) {
    //mix.copy('resources/ecd-platform/dist/build.js', 'public/js/build.js');
    //mix.copy('resources/ecd-platform/index.blade.php', 'resources/views/index.blade.php');
//});

// Copy resources to public
elixir(function(mix) {
    mix.copy('resources/assets/css/app.css', 'public/css/app.css');
    mix.copy('resources/assets/css/bootstrap.min.css', 'public/css/bootstrap.min.css');
    mix.copy('resources/assets/css/font-awesome.min.css', 'public/css/font-awesome.min.css');
    mix.copy('resources/assets/css/select2.min.css', 'public/css/select2.min.css');
    mix.copy('resources/assets/js/bootstrap.min.js', 'public/js/bootstrap.min.js');
    mix.copy('resources/assets/js/jquery-3.1.1.min.js', 'public/js/jquery-3.1.1.min.js');
    mix.copy('resources/assets/js/tether.min.js', 'public/js/tether.min.js');
    mix.copy('resources/assets/js/moment.min.js', 'public/js/moment.min.js');
    mix.copy('resources/assets/js/combodate.js', 'public/js/combodate.js');
    mix.copy('resources/assets/js/app.js', 'public/js/app.js');
    mix.copy('resources/assets/js/id-checker.js', 'public/js/id-checker.js');
    mix.copy('resources/assets/js/gmaps.js', 'public/js/gmaps.js');
    mix.copy('resources/assets/js/select2.min.js', 'public/js/select2.min.js');
    mix.copy('resources/assets/js/attendance.js', 'public/js/attendance.js');
    mix.copy('resources/assets/js/files.js', 'public/js/files.js');
});

// Asset versioning / cache busting
elixir(function(mix) {
    mix.version([
        'public/css/app.css',
        'public/js/app.js',
        'public/js/gmaps.js',
        'public/js/attendance.js',
        'public/js/files.js'
    ]);
});
