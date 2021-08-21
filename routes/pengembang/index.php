<?php

Route::prefix('v1/pengembang/')->group(function () {

  Route::group(['middleware' => "auth:sanctum"], function () {

    // All secure URL's
    Route::group(['middleware' => "is_pengembang"], function () {

      include_once __DIR__ . "/dashboard.php";
      include_once __DIR__ . "/user.php";
      include_once __DIR__ . "/pengembang.php";
      include_once __DIR__ . "/perumahan.php";
      include_once __DIR__ . "/brosur.php";
      include_once __DIR__ . "/form.php";
    });
  });
});
