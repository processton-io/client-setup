<?php

use Illuminate\Support\Facades\Route;
use Processton\Client\Controllers\ProfileIndexController;
use Processton\Client\Controllers\SelectProfileController;
use Processton\Client\Controllers\SetCustomerAddressController;
use Processton\Client\Controllers\SetCustomerCurrencyController;
use Processton\Client\Middleware\CustomerMustHaveAddress;
use Processton\Client\Middleware\CustomerMustHaveCurrency;
use Processton\Client\Middleware\URLMustHaveCustomer;
use Processton\Company\Middleware\UserMustHaveCompany;
use Processton\Contact\Middleware\UserMustHaveContact;
use Processton\Org\Middleware\OrgMustBeInstalled;
use Processton\Org\Middleware\OrgMustHaveBasicProfile;
use Processton\Org\Middleware\OrgMustHaveFinancialProfile;

Route::middleware([
        'web',
    ])->group(function () {

    Route::middleware([
        'auth',
        'verified',
        UserMustHaveContact::class,
        UserMustHaveCompany::class,
    ])->group(function () {

        Route::get('/', [SelectProfileController::class, 'index'])->name('dashboard');

        Route::prefix('c/{profile}')->middleware([
            URLMustHaveCustomer::class,
        ])->group(function () {

            Route::get('/set/currency', [SetCustomerCurrencyController::class, 'index'])
                ->name('client.set.currency');
            Route::post('/set/currency', [SetCustomerCurrencyController::class, 'index']);

            Route::get('/set/address', [SetCustomerAddressController::class, 'index'])
                ->name('client.set.address');
            Route::post('/set/address', [SetCustomerAddressController::class, 'index']);

            Route::middleware([
                CustomerMustHaveAddress::class,
                CustomerMustHaveCurrency::class,
            ])->group(function () {

                Route::get('/', [ProfileIndexController::class, 'index'])->name('profile.index');
            });
        });

    });
});
