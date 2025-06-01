<?php

use Illuminate\Support\Facades\Route;
use Processton\Customer\Controllers\SetCustomerCurrencyController;
use Processton\Customer\Middleware\URLMustHaveCustomer;



Route::prefix('/set/currency/{profile}')->middleware([
    URLMustHaveCustomer::class,
])->group(function () {
    Route::get('/', [SetCustomerCurrencyController::class, 'index'])->name('client.set.currency');
    Route::post('/', [SetCustomerCurrencyController::class, 'index']);

});