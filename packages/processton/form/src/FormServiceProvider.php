<?php

namespace Processton\Form;

use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish migrations, config, views
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'processton-form');
        $this->registerWebRoutes();
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/processton-form'),
        ], 'views');
    }

    public function register()
    {
        // Register plugin, commands, etc.
    }

    public function registerWebRoutes()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }
}
