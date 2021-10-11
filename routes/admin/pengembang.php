<?php

use App\Http\Controllers\PengembangController;

$prefix = "pengembang";

Route::prefix($prefix)->group(function () {
  // Update Status Aktif Pengembang
  Route::post('/{id_pengembang}/status', [PengembangController::class, 'updateStatusPengembang']);

  // Search Pengembang
  Route::get('/search', [PengembangController::class, 'searchPengembang']);

  // Add Pengembang
  Route::post('/', [PengembangController::class, 'addPengembang']);

  // Update Pengembang
  Route::post('/{id_pengembang}', [PengembangController::class, 'updatePengembang']);

  // Delete Pengembang
  Route::get('/{id_pengembang}/delete', [PengembangController::class, 'deletePengembang']);

  // Delete Permanent Pengembang
  Route::get('/{id_pengembang}/delete-permanent', [PengembangController::class, 'destroy']);

  // Get All Pengembang
  Route::get('/', [PengembangController::class, 'getAllPengembang']);

  // Get All Select Pengembang
  Route::get('/select', [PengembangController::class, 'getSelectPengembang']);

  // Get Pengembang By ID
  Route::get('/{id_pengembang}', [PengembangController::class, 'getPengembangById']);
});
