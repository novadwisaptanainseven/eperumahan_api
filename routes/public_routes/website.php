<?php

use App\Http\Controllers\BrosurController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\PengembangController;
use App\Http\Controllers\PerumahanController;
use App\Http\Controllers\PropertiController;
use App\Http\Controllers\WebsiteController;

// API UNTUK BAGIAN HALAMAN WEBSITE E-PERUMAHAN

Route::prefix('v1/')->group(function () {
  // Search Properti
  Route::put('properti-search', [PropertiController::class, 'searchProperti']);
  // Get All Properti Yang Status Publishnya Aktif
  Route::get('properti', [PropertiController::class, 'getAllProperties']);
  // Get Properti berdasarkan slug
  Route::get('properti/{slug}', [PropertiController::class, 'getPropertiBySlug']);
  // Get Properti berdasarkan ID Perumahan
  Route::get('properti/id-perumahan/{id-perumahan}', [PropertiController::class, 'getAllPropertiById']);
  // Get Properti by ID Pengembang
  Route::get('properti/id-pengembang/{id_pengembang}', [PropertiController::class, 'getPropertiByIdPengembang']);

  // Get All Pengembang Aktif
  Route::get('pengembang', [PengembangController::class, 'getAllPengembang2']);
  // Get Pengembang by Slug Pengembang
  Route::get('pengembang/{slug}', [PengembangController::class, 'getPengembangBySlug']);

  // Get Perumahan by ID Pengembang
  Route::get('perumahan/{id_pengembang}', [PerumahanController::class, 'getPerumahanByIdPengembang']);
  // Get Perumahan by Slug
  Route::get('perumahan/slug/{slug}', [PerumahanController::class, 'getPerumahanBySlug']);

  // Kontak
  Route::post('kontak', [KontakController::class, 'sendMessage']);
  Route::get('kontak', [KontakController::class, 'getAllMessages']);
  Route::delete('kontak/{id}', [KontakController::class, 'deleteMessage']);

  // Brosur
  Route::get('brosur', [BrosurController::class, 'getAllBrosurUmum']);
  Route::get('brosur/{id_pengembang}', [BrosurController::class, 'getBrosurByIdPengembang']);

  // Kecamatan
  Route::get('/kecamatan', [PerumahanController::class, 'getAllKecamatan']);

  // Kelurahan
  Route::get('/kelurahan/{id_kecamatan}', [PerumahanController::class, 'getAllKelurahan']);

  // Route Halaman Beranda
  Route::get("/sibaper-beranda", [WebsiteController::class, "getInformasiBeranda"]);

  // Route Halaman Perumahan
  Route::prefix("/sibaper-perumahan")->group(function () {

    Route::get("/", [WebsiteController::class, "getInformasiPerumahan"]);

    Route::get("/perumahan", [WebsiteController::class, "getPerumahan"]);
  });
});
