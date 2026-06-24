<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Sports\Controllers\Admin\SportController;

Route::middleware(['web','auth.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('sports', SportController::class);
});