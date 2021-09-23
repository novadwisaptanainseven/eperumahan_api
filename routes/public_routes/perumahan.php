<?php

use App\Http\Controllers\PerumahanController;

// Get All Kategori
Route::get('/kategori', [PerumahanController::class, 'getAllKategori']);

// Get All Kecamatan
Route::get('/kecamatan', [PerumahanController::class, 'getAllKecamatan']);

// Get All Kelurahan by Id Kecamatan
Route::get('/kelurahan/{id_kecamatan}', [PerumahanController::class, 'getAllKelurahan']);
