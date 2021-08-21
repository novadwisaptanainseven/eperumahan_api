<?php

use App\Http\Controllers\DashboardController;

// Get All Dashboard Information
Route::get('dashboard/info', [DashboardController::class, 'getDashboardInfo']);
