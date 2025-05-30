<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // if table 'orgs' exists, load the configuration from it

        



        if(Schema::hasTable('orgs')) {
        
            $orgConfigs = DB::table('orgs')->pluck('org_value', 'org_key')->toArray();

            foreach ($orgConfigs as $key => $value) {
                Config::set('org.' . $key, $value);
            }
        }

    }
}
