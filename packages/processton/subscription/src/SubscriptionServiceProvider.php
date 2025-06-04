<?php

namespace Processton\Subscription;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SubscriptionServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'processton-subscription');

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
        return [
            'middleware' => config('panels.subscription.middleware.web', []),
        ];
    }

    protected function registerApiRoutes()
    {
        Route::group($this->apiRouteConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        });
    }

    protected function apiRouteConfiguration()
    {
        return [
            'middleware' => config('panels.subscription.middleware.api', []),
        ];
    }
}
