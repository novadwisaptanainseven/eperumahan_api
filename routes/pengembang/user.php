<?php


use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckStatus;

// Logout User Pengembang
Route::post('user/logout', [AuthController::class, 'logout']);

// For Checking User who is active at this moment
Route::get('/akun/me', [AuthController::class, 'me'])->withoutMiddleware([CheckStatus::class]);
