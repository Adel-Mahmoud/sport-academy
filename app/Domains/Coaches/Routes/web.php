<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->prefix('coaches')->group(function () {
    Route::get('/', [App\Domains\Coaches\Controllers\Web\CoachController::class, 'index']);
});