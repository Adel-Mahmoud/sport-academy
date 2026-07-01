<?php

use Illuminate\Support\Facades\Route;
use App\Domains\Groups\Controllers\Admin\GroupController;

Route::middleware(['web', 'auth.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('groups', GroupController::class);
});