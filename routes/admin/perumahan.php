<?php

use App\Http\Controllers\PerumahanController;
use App\Http\Controllers\WebsiteController;

$prefix1 = "perumahan";
$prefix2 = "properti";

// Perumahan
Route::prefix($prefix1)->group(function () {
  Route::get("/rekap", [WebsiteController::class, "getInformasiPerumahan"]);

  // Search Perumahan
  Route::get('/search', [PerumahanController::class, 'searchPerumahan']);

  // Get All Data Perumahan
  Route::get('/select', [PerumahanController::class, 'getSelectPerumahan']);

  // Insert Data Perumahan
  Route::post('/', [PerumahanController::class, 'insertPerumahanMaster']);

  // Update Data Perumahan
  Route::post('/{id_perumahan}', [PerumahanController::class, 'updatePerumahanMaster']);

  // Delete Perumahan
  Route::delete('/{id_perumahan}', [PerumahanController::class, 'deletePerumahan']);

  // Get All Data Perumahan
  Route::get('/', [PerumahanController::class, 'getAll']);

  // Get Data Perumahan By ID
  Route::get('/{id_perumahan}', [PerumahanController::class, 'getById']);

  // Update Status Perumahan By ID
  Route::put('/{id_perumahan}/status', [PerumahanController::class, 'updateStatus']);

  // Search Properti By ID Perumahan
  Route::get('/{id_perumahan}/properti/search', [PerumahanController::class, 'searchProperti']);

  // Get All Properti By ID Perumahan
  Route::get('/{id_perumahan}/properti', [PerumahanController::class, 'getAllPropertiById']);

  // Get Properti By ID Perumahan & ID Bangunan
  Route::get('/{id_perumahan}/properti/{id_bangunan}', [PerumahanController::class, 'getPropertiById']);

  // Update Status Publish Properti By ID Perumahan & ID Bangunan
  Route::put('/{id_perumahan}/properti/{id_bangunan}/status', [PerumahanController::class, 'updateStatusProperti']);
});

// Properti
Route::prefix($prefix2)->group(function () {
  // Search Properti
  Route::get('/search', [PerumahanController::class, 'searchProperti']);

  // Get All Properti
  Route::get('/', [PerumahanController::class, 'getAllProperti']);

  // Get Properti By ID
  Route::get('/{id_properti}', [PerumahanController::class, 'getPropertiById2']);

  // Update Status Publish By ID
  Route::put('/{id_properti}/status', [PerumahanController::class, 'updateStatusProperti2']);
});
