<?php

use Illuminate\Support\Facades\Route;
use App\Domains\Settings\Controllers\Admin\SettingController;

Route::middleware(['web', 'auth.admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->name('index');
            Route::put('/', [SettingController::class, 'update'])->name('update');
        });
    });
