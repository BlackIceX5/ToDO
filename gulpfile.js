const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

elixir((mix) => {
    mix.sass('app.scss')
       .webpack('app.js');
    mix.copy('node_modules/font-awesome/fonts', 'public/assets/fonts');
});