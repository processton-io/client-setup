<?php

use Illuminate\Support\Facades\Route;
use Processton\Abacus\Filament\Pages\BalanceSheet;
use Processton\Abacus\Filament\Pages\GeneralLedger;
use Processton\Abacus\Filament\Pages\ProfitLossStatement;
use Processton\Abacus\Filament\Pages\TrialBalance;
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
        OrgMustBeInstalled::class,
        OrgMustHaveBasicProfile::class,
        OrgMustHaveFinancialProfile::class,
        UserMustHaveContact::class,
        UserMustHaveCompany::class,
    ])->prefix('abacus')->group(function () {

        Route::get('/general-ledger', [GeneralLedger::class, 'streamPdf'])->name('general-ledger.stream-pdf');

        Route::get('/trial-balance', [TrialBalance::class, 'streamPdf'])->name('trial-balance.stream-pdf');

        Route::get('/profit-loss-statement', [ProfitLossStatement::class, 'streamPdf'])->name('profit-loss-statement.stream-pdf');

        Route::get('/balance-sheet', [BalanceSheet::class, 'streamPdf'])->name('balance-sheet.stream-pdf');

        Route::get('/cash-flow-statement', [\Processton\Abacus\Filament\Pages\CashFlowStatement::class, 'streamPdf'])->name('cash-flow-statement.stream-pdf');

    });
});