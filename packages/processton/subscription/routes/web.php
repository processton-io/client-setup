<?php

use Illuminate\Support\Facades\Route;

use Processton\Subscription\Controllers\WebController;

Route::middleware([
    'web'
])->prefix('s/{profile}')->group(function () {

    Route::any('subscriptions', [WebController::class , 'index'])->name('processton-subscribe.index');

    Route::any('subscribe/{planId}', [WebController::class , 'subscribe'])->name('processton-subscribe.subscribe');

    Route::any('subscription/{subscriptionId}', [WebController::class , 'show'])->name('processton-subscribe.show');

    Route::any('subscription/{subscriptionId}/cancel', [WebController::class , 'cancel'])->name('processton-subscribe.cancel');

    Route::any('subscription/{subscriptionId}/renew', [WebController::class , 'update'])->name('processton-subscribe.renew');
});