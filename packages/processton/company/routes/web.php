<?php

use Illuminate\Support\Facades\Route;
use Processton\Company\Controllers\WebController;

Route::middleware('web')->group(function () {

    Route::prefix('set')->group(function () {

        Route::get('company', [WebController::class, 'setCompany'])->name('processton-company.set.company');
        Route::post('company', [WebController::class, 'setCompany'])->name('processton-company.set.company.process');

    });

    Route::prefix('add')->group(function () {

        Route::get('company', [WebController::class, 'setCompany'])->name('processton-company.add.company');
        Route::post('company', [WebController::class, 'setCompany'])->name('processton-company.add.company.process');
    });
});
