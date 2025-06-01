<?php

namespace Processton\Invoice;

use Illuminate\Support\ServiceProvider;

class InvoiceServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish migrations, config, views
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'processton-invoice');
        $this->registerWebRoutes();
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/processton-invoice'),
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
