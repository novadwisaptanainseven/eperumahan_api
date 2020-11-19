<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengembangController;

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

 // GROUP USER

        // Get All Data User
        Route::get('users', [UserController::class, 'getAllUsers']);

        // For Checking User who is active at this moment
        Route::get('/user/me', [UserController::class, 'me']);

        // Get User By ID
        Route::get('user/{id_user}', [UserController::class, 'getUserById']);

        // Update Data User
        Route::put('user/{id_user}', [UserController::class, 'updateUser']);

        // Update Status User
        Route::put('user/{id_user}/status', [UserController::class, 'updateStatusUser']);

        // Logout User
        Route::post('user/logout', [UserController::class, 'logout']);
        
 // END GROUP USER
 // ==============================================================================================

// GROUP PENGEMBANG

        // Add Pengembang
        Route::post('/pengembang', [PengembangController::class, 'addPengembang']);

        // Update Pengembang
        Route::put('/pengembang/{id_pengembang}', [PengembangController::class, 'updatePengembang']);

        // Delete Pengembang
        Route::delete('/pengembang/{id_pengembang}', [PengembangController::class, 'deletePengembang']);

        // Get All Pengembang
        Route::get('/pengembang', [PengembangController::class, 'getAllPengembang']);

        // Get Pengembang By ID
        Route::get('/pengembang/{id_pengembang}', [PengembangController::class, 'getPengembangById']);
        

    });

// END API LEVEL ADMIN

    // Login User
    Route::post('login', [UserController::class, 'login']);

    // Add User
    Route::post('register', [UserController::class, 'register']);
});
