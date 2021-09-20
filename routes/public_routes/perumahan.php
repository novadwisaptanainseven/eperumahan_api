<?php

use App\Http\Controllers\PerumahanController;

// Get All Kategori
Route::get('/kategori', [PerumahanController::class, 'getAllKategori']);

// Get All Kecamatan
Route::get('/kecamatan', [PerumahanController::class, 'getAllKecamatan']);
