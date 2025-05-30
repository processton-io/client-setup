<?php

use Illuminate\Support\Facades\Route;
use Processton\Locale\Controllers\CountryController;
use Processton\Locale\Controllers\WidgetsController;

Route::prefix('api')->middleware('api')->group(function () {

    Route::apiResource('countries', CountryController::class);

    Route::prefix('stats')->group(function () {
        Route::prefix('cities')->group(function () {
            Route::get('count', [WidgetsController::class, 'getCitiesCount'])->name('widgets.cities.count');
        });
        Route::prefix('countries')->group(function () {
            Route::get('count', [WidgetsController::class, 'getCountiesCount'])->name('widgets.countries.count');
        });
        Route::prefix('regions')->group(function () {
            Route::get('count', [WidgetsController::class, 'getRegionsCount'])->name('widgets.regions.count');
        });
        Route::prefix('zones')->group(function () {
            Route::get('count', [WidgetsController::class, 'getZonesCount'])->name('widgets.zones.count');
        });
    });
});
