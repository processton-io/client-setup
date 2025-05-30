<?php

use Illuminate\Support\Facades\Route;
use Processton\Locale\Controllers\WebController;

Route::middleware('web')->group(function () {

    Route::prefix('set')->group(function () {

        Route::get('country', [WebController::class, 'setCountry'])->name('locale.set.country');
        Route::post('country', [WebController::class, 'setCountry']);

        Route::get('address', [WebController::class, 'setAddress'])->name('locale.set.address');
        Route::post('address', [WebController::class, 'setAddress']);

        Route::get('region', [WebController::class, 'setRegion'])->name('locale.set.region');

    });
});
