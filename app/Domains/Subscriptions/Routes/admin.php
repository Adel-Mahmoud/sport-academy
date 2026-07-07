<?php

use Illuminate\Support\Facades\Route;
use App\Domains\Subscriptions\Controllers\Admin\SubscriptionController;

Route::middleware(['web', 'auth.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('subscriptions', SubscriptionController::class);
});