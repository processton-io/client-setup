<?php

namespace Processton\Campaigns;

use Illuminate\Support\ServiceProvider;

class CampaignServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register services, bindings, etc.
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->publishes([
            __DIR__.'/../resources' => resource_path('views/vendor/campaigns'),
        ], 'views');
    }
}
