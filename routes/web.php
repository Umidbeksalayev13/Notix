<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\EventsController;
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/dashboard')->middleware('auth')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('events', EventsController::class);
    Route::resource('events', EventsController::class);
});

Route::post('/telegram/account', [UserAccountController::class, 'store'])->name('telegram.account');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
