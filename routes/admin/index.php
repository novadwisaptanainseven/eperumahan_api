<?php

Route::prefix('v1/admin/')->group(function () {

  Route::group(['middleware' => 'auth:sanctum'], function () {
    //All secure URL's

    Route::group(['middleware' => "check_status"], function () {

      include_once __DIR__ . "/dashboard.php";
      include_once __DIR__ . "/user.php";
      include_once __DIR__ . "/pengembang.php";
      include_once __DIR__ . "/perumahan.php";
      include_once __DIR__ . "/formulir.php";
      include_once __DIR__ . "/kecamatan_kelurahan.php";
      include_once __DIR__ . "/exports.php";
    });
  });
});
