<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web'])
    ->prefix('campaigns')
    ->group(function () {
        // Add custom web routes for Campaigns if needed
    });
