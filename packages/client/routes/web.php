<?php

use Illuminate\Support\Facades\Route;
use Processton\Client\Controllers\ProfileIndexController;
use Processton\Client\Controllers\AppsIndexController;
use Processton\Client\Controllers\SetCustomerAddressController;
use Processton\Client\Middleware\CustomerMustHaveAddress;
use Processton\Client\Middleware\CustomerMustHaveCurrency;
use Processton\Client\Middleware\URLMustHaveCustomer;
use Processton\Company\Middleware\UserMustHaveCompany;
use Processton\Contact\Middleware\UserMustHaveContact;

Route::middleware([
        'web',
    ])->group(function () {

    Route::middleware([
        'auth',
        'verified',
        UserMustHaveContact::class,
        UserMustHaveCompany::class,
    ])->group(function () {

        Route::prefix('c/{profile}')->middleware([
            URLMustHaveCustomer::class,
        ])->group(function () {

            // Route::get('/set/currency', [SetCustomerCurrencyController::class, 'index'])
            //     ->name('client.set.currency');
            // Route::post('/set/currency', [SetCustomerCurrencyController::class, 'index']);

            Route::get('/set/address', [SetCustomerAddressController::class, 'index'])
                ->name('client.set.address');
            Route::post('/set/address', [SetCustomerAddressController::class, 'index']);

            Route::middleware([
                CustomerMustHaveAddress::class,
                CustomerMustHaveCurrency::class,
            ])->group(function () {

                Route::get('/', [ProfileIndexController::class, 'index'])->name('customer.profile.index');
                Route::get('/members', [ProfileIndexController::class, 'index'])->name('customer.profile.members');
                Route::get('/billing', [ProfileIndexController::class, 'index'])->name('customer.profile.billing');
            });
        });

        Route::prefix('apps')->group(function () {
            Route::get('/', [AppsIndexController::class, 'index'])->name('apps.index');
        });

    });
});
