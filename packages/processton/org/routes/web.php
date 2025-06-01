<?php


use Illuminate\Support\Facades\Route;
use Processton\Org\Controllers\WebController;
use Processton\AccessControll\Middleware\UserMustBeEligibleToEditOrg;

Route::middleware([
        'web',
        'auth',
        UserMustBeEligibleToEditOrg::class
    ])->group(function () {

    Route::get('/setup/org/basic', [WebController::class, 'setOrgBasicProfile'])->name('processton-org.set-basic-org');
    Route::post('/setup/org/basic', [WebController::class, 'setOrgBasicProfile'])->name('processton-org.set-basic-org.process');

    Route::get('/setup/org/financial', [WebController::class, 'setOrgFinancialProfile'])->name('processton-org.set-financial-org');
    Route::post('/setup/org/financial', [WebController::class, 'setOrgFinancialProfile'])->name('processton-org.set-financial-org.process');

});