<?php

namespace Processton\Client;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ClientServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'client');

        if ($this->app->runningInConsole()) {
            // Export the migration
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        }
        $this->registerWebRoutes();
        $this->registerApiRoutes();

    }

    protected function registerWebRoutes()
    {
        Route::group($this->webRouteConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    protected function webRouteConfiguration()
    {
        return [];
    }

    protected function registerApiRoutes()
    {
        Route::group($this->apiRouteConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        });
    }

    protected function apiRouteConfiguration()
    {
        return [];
    }
}
