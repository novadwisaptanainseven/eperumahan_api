<?php

use App\Http\Controllers\DashboardController;

// Get All Dashboard Information
Route::get('dashboard/info', [DashboardController::class, 'getDashboardInfo']);

// Get All Dashboard Information Super Admin
Route::get('dashboard/info/super-admin', [DashboardController::class, 'getDashboardInfoSuperAdmin']);
