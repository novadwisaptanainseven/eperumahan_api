<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\PengembangController;
use App\Http\Controllers\PerumahanController;
use App\Http\Controllers\PropertiController;

Route::get('/image/{path}/{filename}', [FileController::class, 'image']);
Route::get('/brosur/{path}/{filename}', [FileController::class, 'brosur']);
Route::get('/document/{path}/{filename}', [FileController::class, 'document']);
Route::get('/document/{path}/{filename}/preview', [FileController::class, 'documentPreview']);
Route::get('/form/{path}/{filename}', [FileController::class, 'form']);
Route::get('/form/{path}/{filename}/preview', [FileController::class, 'formPreview']);

// Export Excel Rekap Perumahan
Route::get("/export/rekapitulasi", [PerumahanController::class, "exportRekapPerumahan"]);

// Export Excel Pengembang
Route::get("/export/pengembang/user/{id_user}", [PengembangController::class, "exportPengembang"]);

// Export Excel Perumahan
Route::get("/export/perumahan/user/{id_user}", [PerumahanController::class, "exportPerumahan"]);

// Export Excel Verifikasi Perumahan
Route::get("/export/perumahan-verifikasi/user/{id_user}", [PerumahanController::class, "exportPerumahanVerifikasi"]);

// Export Excel Verifikasi Bangunan
Route::get("/export/bangunan-verifikasi/user/{id_user}", [PropertiController::class, "exportBangunanVerifikasi"]);

// Export Excel Perumahan
Route::get("/export/perumahan-test/user/{id_user}", [PerumahanController::class, "getPerumahanTest"]);
