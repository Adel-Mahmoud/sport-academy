<?php

use Illuminate\Support\Facades\Route;
use App\Domains\Permissions\Controllers\PermissionController;

Route::middleware(['web','auth.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('permissions', PermissionController::class);
});


