<?php

use Illuminate\Support\Facades\Route;

use Processton\Subscription\Controllers\WebController;

Route::middleware([
    'web'
])->group(function () {

    Route::any('c/{profile}/subscriptions', [WebController::class , 'index'])->name('processton-subscribe.index');

    Route::any('c/{profile}/subscribe/{planId}', [WebController::class , 'subscribe'])->name('processton-subscribe.subscribe');

    Route::any('c/{profile}/{subscriptionId}', [WebController::class , 'show'])->name('processton-subscribe.show');

    Route::any('c/{profile}/{subscriptionId}', [WebController::class , 'cancel'])->name('processton-subscribe.cancel');

    Route::any('c/{profile}/{subscriptionId}', [WebController::class , 'update'])->name('processton-subscribe.renew');
});