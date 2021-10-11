<?php

use App\Http\Controllers\PerumahanController;

$prefix = "kecamatan";

Route::prefix($prefix)->group(function () {
  // Kecamatan
  Route::get("/", [PerumahanController::class, "getAllKecamatan"]);

  Route::get("/{id_kecamatan}", [PerumahanController::class, "getKecamatanById"]);

  Route::post("/", [PerumahanController::class, "insertKecamatan"]);

  Route::post("/{id_kecamatan}", [PerumahanController::class, "editKecamatan"]);

  Route::get("/{id_kecamatan}/delete", [PerumahanController::class, "deleteKecamatan"]);

  // Kelurahan
  Route::get("/{id_kecamatan}/kelurahan", [PerumahanController::class, "getAllKelurahan"]);

  Route::get("/kelurahan/{id_kelurahan}", [PerumahanController::class, "getKelurahanById"]);

  Route::post("{id_kecamatan}/kelurahan", [PerumahanController::class, "insertKelurahan"]);

  Route::post("/kelurahan/{id_kelurahan}", [PerumahanController::class, "editKelurahan"]);

  Route::get("/kelurahan/{id_kelurahan}/delete", [PerumahanController::class, "deleteKelurahan"]);
});
