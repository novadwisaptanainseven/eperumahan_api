<?php

use App\Http\Controllers\FileController;

Route::get('/image/{path}/{filename}', [FileController::class, 'image']);
Route::get('/brosur/{path}/{filename}', [FileController::class, 'brosur']);
Route::get('/document/{path}/{filename}', [FileController::class, 'document']);
Route::get('/document/{path}/{filename}/preview', [FileController::class, 'documentPreview']);
Route::get('/form/{path}/{filename}', [FileController::class, 'form']);
Route::get('/form/{path}/{filename}/preview', [FileController::class, 'formPreview']);
