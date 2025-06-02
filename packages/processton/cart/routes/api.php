<?php

use Illuminate\Support\Facades\Route;
use Processton\Cart\Controllers\ApiController;

Route::middleware([
    'api'
])->prefix('api')->group(function () {
    Route::prefix('cart')->group(function () {
        Route::get('/init', [ApiController::class => 'initialize'])->name('processton-cart.api.initialize');
        Route::prefix('{cartId}')->group(function () {

            Route::get('/', [ApiController::class => 'show'])->name('processton-cart.api.show');

            Route::prefix('/items')->group(function () {
                Route::get('/search', [ApiController::class => 'searchItems'])->name('processton-cart.api.items.search');
            });

            Route::post('/add', [ApiController::class => 'addItem'])->name('processton-cart.api.items.add');
            Route::post('/remove', [ApiController::class => 'removeItem'])->name('processton-cart.api.items.remove');
        
        });
    });
});