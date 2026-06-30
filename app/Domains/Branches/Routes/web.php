<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->prefix('branches')->group(function () {
    Route::get('/', [App\Domains\Branches\Controllers\Web\BranchController::class, 'index']);
});