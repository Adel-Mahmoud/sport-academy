<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SubscribeController;

Auth::routes();
Route::middleware(['maneger'])->group(function () {
    Route::resource("users",\App\Http\Controllers\UserController::class);
});
Route::middleware(['maneger_and_admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource("sports",\App\Http\Controllers\SportController::class);
    Route::resource("coaches",\App\Http\Controllers\CoachController::class);
    Route::resource("players",\App\Http\Controllers\PlayerController::class);
    Route::resource("subscribe",SubscribeController::class);
    Route::get('paid', [SubscribeController::class, 'PaidSubscription'])->name("paid");
    Route::get('unpaid', [SubscribeController::class, 'UnPaidSubscription'])->name("unpaid");
    Route::get('subscribe_old', [SubscribeController::class, 'OldSubscription'])->name("subscribe_old");
    Route::delete('subscribe_delete_old', [SubscribeController::class, 'DeleteOldSubscription'])->name("subscribe_delete_old");
    Route::resource("jobs",\App\Http\Controllers\JobController::class);
    Route::resource("employees",\App\Http\Controllers\EmployeeController::class);
    Route::resource("salary",SalaryController::class);
    Route::get('salary_paid', [SalaryController::class, 'PaidSalary'])->name("salary_paid");
    Route::get('salary_unpaid', [SalaryController::class, 'UnPaidSalary'])->name("salary_unpaid");
    Route::get('salary_old', [SalaryController::class, 'OldSalary'])->name("salary_old");
    Route::delete('salary_delete_old', [SalaryController::class, 'DeleteOldSalary'])->name("salary_delete_old");
    Route::resource("teams",\App\Http\Controllers\TeamController::class);
    Route::resource("expenses",\App\Http\Controllers\ExpensController::class);
    Route::resource("settings",\App\Http\Controllers\SettingController::class);
});
Route::get('index/add', [App\Http\Controllers\PlayerController::class, 'indexUser'])->name("indexUser"); 