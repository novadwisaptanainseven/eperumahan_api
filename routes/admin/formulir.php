<?php

use App\Http\Controllers\FormController;

// GROUP FORMULIR MASTER

// Get All Formulir Master
Route::get("formulir", [FormController::class, 'getAllFormMaster']);

// Add Formulir Master
Route::post("formulir", [FormController::class, 'addFormMaster']);

// Get All Form Data Perumahan
Route::get('form', [FormController::class, 'getAllForm']);

// Update Status Active Form Master By ID
Route::put("formulir/{id_form}/status_active", [FormController::class, 'updateStatusActive']);
// Get Form By ID
Route::get("formulir/{id_form}", [FormController::class, 'getFormAdminById']);

// Delete Form Master By ID
Route::delete("formulir/{id_form}", [FormController::class, 'deleteFormMaster']);

// GROUP FORMULIR PENGEMBANG

// Get All Formulir Pengembang
Route::get("formulir_pengembang", [FormController::class, 'getAllFormPengembang']);
