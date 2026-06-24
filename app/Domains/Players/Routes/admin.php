<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Players\Controllers\Admin\PlayerController;

Route::middleware(['web','auth.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('players', PlayerController::class);
});