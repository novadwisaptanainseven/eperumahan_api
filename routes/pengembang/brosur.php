<?php


use App\Http\Controllers\BrosurController;

$prefix = "brosur";

// GROUP BROSUR PENGEMBANG
Route::prefix($prefix)->group(function () {

  // Get All Brosur
  Route::get('/', [BrosurController::class, 'getAllBrosur']);

  // Get Brosur By ID
  Route::get('/{id_brosur}', [BrosurController::class, 'getBrosurById']);

  // Add Brosur
  Route::post('/', [BrosurController::class, 'addBrosur']);

  // Update Brosur By ID

  // Delete Brosur By ID
  Route::delete('/{id_brosur}', [BrosurController::class, 'deleteBrosur']);
});
