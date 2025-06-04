<?php

use Illuminate\Support\Facades\Route;
use Processton\Subscription\Controllers\WebController;

Route::middleware([
    'web'
])->prefix('{profile}')->group(function () {
    Route::prefix('/subscibe/{planId}')->group(function () {
        Route::get('/', [WebController::class , 'subscribe'])->name('processton-subscribe.index');
        Route::post('/', [WebController::class , 'doSubscibe'])->name('processton-subscribe.index.process');
        
    });
});