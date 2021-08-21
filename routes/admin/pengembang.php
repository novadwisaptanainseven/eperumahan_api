<?php

use App\Http\Controllers\PengembangController;

$prefix = "pengembang";

Route::prefix($prefix)->group(function () {
  // Update Status Aktif Pengembang
  Route::put('/{id_pengembang}/status', [PengembangController::class, 'updateStatusPengembang']);

  // Search Pengembang
  Route::get('/search', [PengembangController::class, 'searchPengembang']);

  // Add Pengembang
  Route::post('/', [PengembangController::class, 'addPengembang']);

  // Update Pengembang
  Route::post('/{id_pengembang}', [PengembangController::class, 'updatePengembang']);

  // Delete Pengembang
  Route::delete('/{id_pengembang}', [PengembangController::class, 'deletePengembang']);

  // Get All Pengembang
  Route::get('/', [PengembangController::class, 'getAllPengembang']);

  // Get Pengembang By ID
  Route::get('/{id_pengembang}', [PengembangController::class, 'getPengembangById']);
});
