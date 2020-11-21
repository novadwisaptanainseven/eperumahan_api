<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengembangController;
use App\Http\Controllers\PerumahanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// API LEVEL ADMIN
Route::prefix('v1/admin/')->group(function () {

    Route::group(['middleware' => 'auth:sanctum'], function () {
        //All secure URL's

        Route::group(['middleware' => 'check_status'], function () {
            // GROUP USER

            // Add User
            Route::post('register', [UserController::class, 'register']);

            // Get All Data User
            Route::get('users', [UserController::class, 'getAllUsers']);

            // For Checking User who is active at this moment
            Route::get('/user/me', [AuthController::class, 'me']);

            // Get User By ID
            Route::get('user/{id_user}', [UserController::class, 'getUserById']);

            // Update Data User
            Route::put('user/{id_user}', [UserController::class, 'updateUser']);

            // Update Status User
            Route::put('user/{id_user}/status', [UserController::class, 'updateStatusUser']);

            // Logout User
            Route::post('user/logout', [AuthController::class, 'logout']);

            // END GROUP USER
            // ==============================================================================================

            // GROUP PENGEMBANG

            // Add Pengembang
            Route::post('/pengembang', [PengembangController::class, 'addPengembang']);

            // Update Pengembang
            Route::post('/pengembang/{id_pengembang}', [PengembangController::class, 'updatePengembang']);

            // Delete Pengembang
            Route::delete('/pengembang/{id_pengembang}', [PengembangController::class, 'deletePengembang']);

            // Get All Pengembang
            Route::get('/pengembang', [PengembangController::class, 'getAllPengembang']);

            // Get Pengembang By ID
            Route::get('/pengembang/{id_pengembang}', [PengembangController::class, 'getPengembangById']);

            // END GROUP PENGEMBANG
            // ==============================================================================================

            // GROUP PERUMAHAN

            // Get All Data Perumahan
            Route::get('/perumahan', [PerumahanController::class, 'getAll']);

            // Get Data Perumahan By ID
            Route::get('/perumahan/{id_perumahan}', [PerumahanController::class, 'getById']);

            // Update Status Perumahan By ID
            Route::put('/perumahan/{id_perumahan}/status', [PerumahanController::class, 'updateStatus']);

            // GROUP PERUMAHAN / PROPERTI

            // Get All Properti
            Route::get('perumahan/{id_perumahan}/properti', [PerumahanController::class, 'getAllProperti']);

            // Get Properti By ID
            Route::get('perumahan/{id_perumahan}/properti/{id_bangunan}', [PerumahanController::class, 'getPropertiById']);

            // Update Status Publish Properti By ID
            Route::put('perumahan/{id_perumahan}/properti/{id_bangunan}/status', [PerumahanController::class, 'updateStatusProperti']);
        });
    });

    // END API LEVEL ADMIN
});

// Login User
Route::post('/login', [AuthController::class, 'login']);
