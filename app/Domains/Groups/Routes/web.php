<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->prefix('groups')->group(function () {
    Route::get('/', [App\Domains\Groups\Controllers\Web\GroupController::class, 'index']);
});