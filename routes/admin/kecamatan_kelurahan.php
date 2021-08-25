<?php

use App\Http\Controllers\PerumahanController;

$prefix = "kecamatan";

Route::prefix($prefix)->group(function () {
  // Kecamatan
  Route::get("/", [PerumahanController::class, "getAllKecamatan"]);

  Route::get("/{id_kecamatan}", [PerumahanController::class, "getKecamatanById"]);

  Route::post("/", [PerumahanController::class, "insertKecamatan"]);

  Route::put("/{id_kecamatan}", [PerumahanController::class, "editKecamatan"]);

  Route::delete("/{id_kecamatan}", [PerumahanController::class, "deleteKecamatan"]);

  // Kelurahan
  Route::get("/{id_kecamatan}/kelurahan", [PerumahanController::class, "getAllKelurahan"]);

  Route::get("/kelurahan/{id_kelurahan}", [PerumahanController::class, "getKelurahanById"]);

  Route::post("/kelurahan", [PerumahanController::class, "insertKelurahan"]);

  Route::put("/kelurahan/{id_kelurahan}", [PerumahanController::class, "editKelurahan"]);

  Route::delete("/kelurahan/{id_kelurahan}", [PerumahanController::class, "deleteKelurahan"]);
});
