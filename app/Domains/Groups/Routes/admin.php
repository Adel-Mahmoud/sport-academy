<?php

use Illuminate\Support\Facades\Route;
use App\Domains\Groups\Controllers\Admin\GroupController;

Route::middleware(['web', 'auth.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('groups', GroupController::class);
    // add routes to manage group players and coaches if needed
    Route::get('groups/{group}/players', [GroupController::class, 'players'])->name('groups.players');
    Route::get('groups/{group}/coaches', [GroupController::class, 'coaches'])->name('groups.coaches');
});