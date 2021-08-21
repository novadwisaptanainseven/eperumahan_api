<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
include_once __DIR__ . "/admin/index.php";
// END API LEVEL ADMIN

// API LEVEL PENGEMBANG
include_once __DIR__ . "/pengembang/index.php";
// END API LEVEL PENGEMBANG

// Login User
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    // For Checking User
    Route::get('/cek_auth', [AuthController::class, 'me']);
});

// API Public
include_once __DIR__ . "/public_routes/index.php";
