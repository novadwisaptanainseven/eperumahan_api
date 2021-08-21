<?php

use App\Http\Controllers\PengembangController;

// Get Akun Pengembang
Route::get('akun', [PengembangController::class, 'getAkun']);

// Update Akun Pengembang
Route::post('akun', [PengembangController::class, 'updatePengembang2']);
