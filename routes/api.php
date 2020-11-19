<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
// GROUP USER
Route::prefix('v1/admin/')->group(function () {

    Route::group(['middleware' => 'auth:sanctum'], function () {
        //All secure URL's

        // Get All Data User
        Route::get('users', [UserController::class, 'getAllUsers']);

        // Get User By ID
        Route::get('user/{id_user}', [UserController::class, 'getUserById']);

        // Update Data User
        Route::put('user/{id_user}', [UserController::class, 'updateUser']);

        // Update Status User
        Route::put('user/{id_user}/status', function ($id_user) {
            return response()->json([
                "message" => "Update Status User with id_user: $id_user, Success"
            ]);
        });
    });

    // Login User
    Route::post('login', [UserController::class, 'login']);

    // Add User
    Route::post('register', [UserController::class, 'register']);
});
