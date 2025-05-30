<?php

use Illuminate\Support\Facades\Route;
use Processton\Form\Controllers\FormRenderer;

Route::middleware('web')->group(function () {

    Route::prefix('submit')->group(function () {

        Route::any('/{id}', [FormRenderer::class, 'index'])->name('processton-form.render');
        Route::any('/{id}/embed', [FormRenderer::class, 'embeded'])->name('processton-form.embed');

    });
});
