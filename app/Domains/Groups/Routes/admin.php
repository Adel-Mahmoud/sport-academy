<?php

use Illuminate\Support\Facades\Route;
use App\Domains\Groups\Controllers\Admin\GroupController;

Route::middleware(['web', 'auth.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('groups', GroupController::class);
    // add routes to manage group players and coaches if needed
    Route::get('groups/{group}/manage', [GroupController::class, 'manage'])->name('groups.manage');
    Route::post('groups/manage', [GroupController::class, 'addPlayersToGroup'])->name('groups.addPlayersToGroup');
    Route::put('groups/manage/transferPlayers', [GroupController::class, 'transferPlayers'])->name('groups.transferPlayers');
});