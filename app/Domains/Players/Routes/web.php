<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->prefix('players')->group(function () {
    Route::get('/', [App\Domains\Players\Controllers\Web\PlayerController::class, 'index']);
});