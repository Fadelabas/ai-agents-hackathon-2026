<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Driver\AuthController;
use App\Http\Controllers\Driver\DashboardController;

Route::get('/',                      [ChatController::class, 'index']);
Route::post('/chat/message',         [ChatController::class, 'message']);
Route::get('/order/status/{token}',  [StatusController::class, 'show']);
// Driver routes
Route::get('/driver/login',  [AuthController::class, 'showLogin'])->name('driver.login');
Route::post('/driver/login', [AuthController::class, 'login']);
Route::post('/driver/logout',[AuthController::class, 'logout'])->name('driver.logout');

Route::middleware('driver.auth')->group(function () {
    Route::get('/driver/dashboard',              [DashboardController::class, 'index'])->name('driver.dashboard');
    Route::post('/driver/offer/{offer}/accept',  [DashboardController::class, 'accept'])->name('driver.accept');
    Route::post('/driver/offer/{offer}/reject',  [DashboardController::class, 'reject'])->name('driver.reject');
    Route::post('/driver/order/{order}/complete',[DashboardController::class, 'complete'])->name('driver.complete');
});