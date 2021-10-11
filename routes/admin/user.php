<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckStatus;

// GROUP USER
// Search User
Route::get('users/search', [UserController::class, 'searchUser']);

// Add User
Route::post('register', [UserController::class, 'register']);

// Get All Data User
Route::get('users', [UserController::class, 'getAllUsers']);

// Delete User By ID
Route::get('user/{id_user}/delete', [UserController::class, 'destroy']);

// For Checking User who is active at this moment
Route::get('/user/me', [AuthController::class, 'me'])->withoutMiddleware([CheckStatus::class]);

// Get User By ID
Route::get('user/{id_user}', [UserController::class, 'getUserById']);

// Update Data User
Route::post('user/{id_user}', [UserController::class, 'updateUser']);

// Update Status User
Route::post('user/{id_user}/status', [UserController::class, 'updateStatusUser']);

// Logout User Admin
Route::post('user/logout', [AuthController::class, 'logout']);

 // END GROUP USER
 // ==============================================================================================