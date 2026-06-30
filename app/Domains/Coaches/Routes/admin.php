<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Coaches\Controllers\Admin\CoachController;

Route::middleware(['web','auth.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('coaches', CoachController::class);
});