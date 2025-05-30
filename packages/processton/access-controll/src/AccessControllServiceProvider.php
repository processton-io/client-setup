<?php
namespace Processton\AccessControll;


use Illuminate\Support\ServiceProvider;

class AccessControllServiceProvider extends ServiceProvider
{

    public function boot()
    {

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'access-controll');

        if ($this->app->runningInConsole()) {
            // Export the migration
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }
        // $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
    }
}
