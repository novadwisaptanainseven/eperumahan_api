<?php


use App\Http\Controllers\FormController;

$prefix = "form";

// GROUP FORM DATA PERUMAHAN
Route::prefix($prefix)->group(function () {
  // Get Newest Form Admin
  Route::get('/new', [FormController::class, 'getNewestForm']);

  // Get All Form Data Perumahan
  Route::get('', [FormController::class, 'getAllForm']);

  // Get Form Data Perumahan By ID
  Route::get('/{id_form}', [FormController::class, 'getForm']);

  // Add Form Data Perumahan
  Route::post('', [FormController::class, 'addForm']);

  // Update Form Data Perumahan
  Route::post('/{id_form}', [FormController::class, 'updateForm']);

  // Delete Form Data Perumahan By ID
  Route::get('/{id_form}/delete', [FormController::class, 'deleteForm']);
});
