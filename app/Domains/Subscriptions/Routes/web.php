<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->prefix('subscriptions')->group(function () {
    Route::get('/', [App\Domains\Subscriptions\Controllers\Web\SubscriptionController::class, 'index']);
});