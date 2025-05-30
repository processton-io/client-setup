<?php

namespace Processton\Locale;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Processton\Locale\Models\Address;
use Processton\Locale\Models\City;
use Processton\Locale\Models\Country;
use Processton\Locale\Models\Currency;
use Processton\Locale\Models\Region;
use Processton\Locale\Models\Zone;
use Processton\Locale\Policies\AddressPolicy;
use Processton\Locale\Policies\CityPolicy;
use Processton\Locale\Policies\CountryPolicy;
use Processton\Locale\Policies\CurrencyPolicy;
use Processton\Locale\Policies\RegionPolicy;
use Processton\Locale\Policies\ZonePolicy;

class LocaleServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'locale');

        if ($this->app->runningInConsole()) {
            // Export the migration
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        }

        $this->registerWebRoutes();
        $this->registerApiRoutes();

        Gate::policy(City::class, CityPolicy::class);
        Gate::policy(Address::class, AddressPolicy::class);
        Gate::policy(Currency::class, CurrencyPolicy::class);
        Gate::policy(Region::class, RegionPolicy::class);
        Gate::policy(Zone::class, ZonePolicy::class);
        Gate::policy(Country::class, CountryPolicy::class);

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
            'middleware' => config('panels.locale.middleware.web'),
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
            'middleware' => config('panels.locale.middleware.api'),
        ];
    }
}
