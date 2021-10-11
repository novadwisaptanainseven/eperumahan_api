<?php

use App\Http\Controllers\PerumahanController;

$prefix = "perumahan";

Route::prefix($prefix)->group(function () {
  Route::get("/rekapitulasi", [PerumahanController::class, "exportRekapPerumahan"]);
});
