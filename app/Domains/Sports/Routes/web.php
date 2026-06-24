<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->prefix('sports')->group(function () {
    Route::get('/', [App\Domains\Sports\Controllers\Web\SportController::class, 'index']);
});