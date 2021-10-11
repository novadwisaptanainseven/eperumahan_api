<?php

use App\Http\Controllers\PerumahanController;

$prefix1 = "perumahan";
$prefix2 = "properti";

// GROUP PERUMAHAN
// Get All Kategori
Route::get('/kategori', [PerumahanController::class, 'getAllKategori']);

// Get All Kecamatan
Route::get('/kecamatan', [PerumahanController::class, 'getAllKecamatan']);

// Get All Kelurahan by Id Kecamatan
Route::get('/kelurahan/{id_kecamatan}', [PerumahanController::class, 'getAllKelurahan']);

Route::prefix($prefix1)->group(function () {
  // Search Data Perumahan
  Route::get('/search', [PerumahanController::class, 'searchPerumahanPengembang']);

  // Add Data Perumahan
  Route::post('', [PerumahanController::class, 'addPerumahan']);

  // Delete Data Perumahan
  Route::get('/{id_perumahan}/delete', [PerumahanController::class, 'updatePerumahanById']);

  // Update Data Perumahan
  Route::post('/{id_perumahan}', [PerumahanController::class, 'updatePerumahanById']);

  // Update Status Perumahan
  Route::post('/{id_perumahan}/status', [PerumahanController::class, 'updateStatus']);

  // Get All Perumahan
  Route::get('', [PerumahanController::class, 'getAllPerumahan']);

  // Get Perumahan By ID
  Route::get('/{id_perumahan}', [PerumahanController::class, 'getById']);

  // Get Foto Perumahan
  Route::get('/foto/{filename}', [PerumahanController::class, 'getFotoPerumahan']);

  // Get File Legalitas Perumahan
  Route::get('/file/{filename}', [PerumahanController::class, 'getFileLegalitas']);

  // Delete Perumahan
  Route::get('/{id_perumahan}/delete', [PerumahanController::class, 'deletePerumahan']);

  // GROUP PERUMAHAN / FOTO

  // Add Foto Perumahan
  Route::post('/{id_perumahan}/foto', [PerumahanController::class, 'addFotoPerumahan']);

  // Update Status Utama Foto Perumahan
  Route::post('/{id_perumahan}/foto/{id_foto_perumahan}/status', [PerumahanController::class, 'updateStatusFoto']);

  // Delete Foto Perumahan By ID
  Route::get('/{id_perumahan}/foto/{id_foto_perumahan}/delete', [PerumahanController::class, 'deleteFoto']);

  // Get All Foto Perumahan
  Route::get('/{id_perumahan}/foto', [PerumahanController::class, 'getAllFoto']);

  // GROUP PERUMAHAN / SARANA DAN PRASARANA

  // Add Sarana dan Prasarana
  Route::post('/{id_perumahan}/sarana_prasarana', [PerumahanController::class, 'addSaranaPrasarana']);

  // Get All Sarana dan Prasarana By ID Perumahan
  Route::get('/{id_perumahan}/sarana_prasarana', [PerumahanController::class, 'getSaranaPrasarana']);

  // Delete Sarana dan Prasarana By ID
  Route::get('/{id_perumahan}/sarana_prasarana/{id_sarana_prasarana_perumahan}/delete', [PerumahanController::class, 'deleteSaranaPrasarana']);

  // GROUP PERUMAHAN / FASILITAS

  // Add Fasilitas
  Route::post('/{id_perumahan}/fasilitas', [PerumahanController::class, 'addFasilitas']);

  // Get All Fasilitas By ID Perumahan
  Route::get('/{id_perumahan}/fasilitas', [PerumahanController::class, 'getFasilitas']);

  // Delete Fasilitas By ID
  Route::get('/{id_perumahan}/fasilitas/{id_fasilitas_perumahan}/delete', [PerumahanController::class, 'deleteFasilitas']);

  // GROUP PERUMAHAN / PROPERTI

  // Search Properti By ID Perumahan
  Route::get('/{id_perumahan}/properti/search', [PerumahanController::class, 'searchProperti']);

  // Add Properti By ID Perumahan
  Route::post('/{id_perumahan}/properti', [PerumahanController::class, 'addProperti']);

  // Get All Properti By ID Perumahan
  Route::get('/{id_perumahan}/properti', [PerumahanController::class, 'getAllPropertiById']);

  // Get Properti By ID Perumahan & ID Bangunan
  Route::get('/{id_perumahan}/properti/{id_bangunan}', [PerumahanController::class, 'getPropertiById']);

  // Update Properti By ID
  Route::post('/{id_perumahan}/properti/{id_bangunan}', [PerumahanController::class, 'updatePropertiById']);

  // Update Status Publish Properti By ID Perumahan & ID Bangunan
  Route::post('/{id_perumahan}/properti/{id_bangunan}/status', [PerumahanController::class, 'updateStatusProperti']);

  // Add Spesifikasi Bangunan
  Route::post('/{id_perumahan}/properti/{id_bangunan}/spesifikasi', [PerumahanController::class, 'addSpesifikasiProperti']);

  // Add Fasilitas Bangunan
  Route::post('/{id_perumahan}/properti/{id_bangunan}/fasilitas', [PerumahanController::class, 'addFasilitasProperti']);

  // Delete Bangunan
  Route::get('/{id_perumahan}/properti/{id_bangunan}/delete', [PerumahanController::class, 'deleteProperti']);
});

Route::prefix($prefix2)->group(function () {

  // Get All Properti
  Route::get('', [PerumahanController::class, 'getAllProperti']);

  // Get Properti By ID
  Route::get('/{id_properti}', [PerumahanController::class, 'getPropertiById2']);

  // Update Status Publish By ID
  Route::post('/{id_properti}/status', [PerumahanController::class, 'updateStatusProperti2']);


  // GROUP PERUMAHAN / PROPERTI / SPESIFIKASI

  // Get All Spesifikasi By ID Bangunan
  Route::get('/{id_bangunan}/spesifikasi', [PerumahanController::class, 'getSpesifikasiProperti']);

  // Delete Spesifikasi Bangunan By ID
  Route::get('/{id_bangunan}/spesifikasi/{id_spesifikasi_rumah}/delete', [PerumahanController::class, 'deleteSpesifikasiProperti']);

  // Get All Fasilitas By ID Bangunan
  Route::get('/{id_bangunan}/fasilitas', [PerumahanController::class, 'getFasilitasProperti']);

  // Delete Fasilitas Bangunan By ID
  Route::get('/{id_bangunan}/fasilitas/{id_fasilitas}/delete', [PerumahanController::class, 'deleteFasilitasProperti']);

  // GROUP PERUMAHAN / PROPERTI / FOTO

  // Get All Foto Bangunan
  Route::get('/{id_bangunan}/foto', [PerumahanController::class, 'getFotoBangunan']);

  // Add Foto Bangunan
  Route::post('/{id_bangunan}/foto', [PerumahanController::class, 'addFotoBangunan']);

  // Update Status Utama Foto Bangunan
  Route::post('/{id_bangunan}/foto/{id_foto}/status', [PerumahanController::class, 'updateStatusFotoBangunan']);

  // Delete Foto Bangunan
  Route::get('/{id_bangunan}/foto/{id_foto}/delete', [PerumahanController::class, 'deleteFotoBangunan']);
});
