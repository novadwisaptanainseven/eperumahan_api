<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Middleware\CheckStatus;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengembangController;
use App\Http\Controllers\PerumahanController;
use App\Http\Controllers\BrosurController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PropertiController;
use App\Models\Pengembang;

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

            // GROUP DASHBOARD

            // Get All Dashboard Information
            Route::get('dashboard/info', [DashboardController::class, 'getDashboardInfo']);

            // GROUP USER

            // Search User
            Route::get('users/search', [UserController::class, 'searchUser']);

            // Add User
            Route::post('register', [UserController::class, 'register']);

            // Get All Data User
            Route::get('users', [UserController::class, 'getAllUsers']);

            // For Checking User who is active at this moment
            Route::get('/user/me', [AuthController::class, 'me'])->withoutMiddleware([CheckStatus::class]);

            // Get User By ID
            Route::get('user/{id_user}', [UserController::class, 'getUserById']);

            // Update Data User
            Route::put('user/{id_user}', [UserController::class, 'updateUser']);

            // Update Status User
            Route::put('user/{id_user}/status', [UserController::class, 'updateStatusUser']);

            // Logout User Admin
            Route::post('user/logout', [AuthController::class, 'logout']);

            // END GROUP USER
            // ==============================================================================================

            // GROUP PENGEMBANG

            // Update Status Aktif Pengembang
            Route::put('/pengembang/{id_pengembang}/status', [PengembangController::class, 'updateStatusPengembang']);

            // Search Pengembang
            Route::get('/pengembang/search', [PengembangController::class, 'searchPengembang']);

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

            // Search Perumahan
            Route::get('/perumahan/search', [PerumahanController::class, 'searchPerumahan']);

            // Get All Data Perumahan
            Route::get('/perumahan', [PerumahanController::class, 'getAll']);

            // Get Data Perumahan By ID
            Route::get('/perumahan/{id_perumahan}', [PerumahanController::class, 'getById']);

            // Update Status Perumahan By ID
            Route::put('/perumahan/{id_perumahan}/status', [PerumahanController::class, 'updateStatus']);


            // GROUP PERUMAHAN / PROPERTI

            // Search Properti By ID Perumahan
            Route::get('perumahan/{id_perumahan}/properti/search', [PerumahanController::class, 'searchProperti']);

            // Search Properti
            Route::get('properti/search', [PerumahanController::class, 'searchProperti']);

            // Get All Properti
            Route::get('properti', [PerumahanController::class, 'getAllProperti']);

            // Get Properti By ID
            Route::get('properti/{id_properti}', [PerumahanController::class, 'getPropertiById2']);

            // Update Status Publish By ID
            Route::put('properti/{id_properti}/status', [PerumahanController::class, 'updateStatusProperti2']);

            // Get All Properti By ID Perumahan
            Route::get('perumahan/{id_perumahan}/properti', [PerumahanController::class, 'getAllPropertiById']);

            // Get Properti By ID Perumahan & ID Bangunan
            Route::get('perumahan/{id_perumahan}/properti/{id_bangunan}', [PerumahanController::class, 'getPropertiById']);

            // Update Status Publish Properti By ID Perumahan & ID Bangunan
            Route::put('perumahan/{id_perumahan}/properti/{id_bangunan}/status', [PerumahanController::class, 'updateStatusProperti']);

            // GROUP FORMULIR MASTER

            // Get All Formulir Master
            Route::get("formulir", [FormController::class, 'getAllFormMaster']);

            // Add Formulir Master
            Route::post("formulir", [FormController::class, 'addFormMaster']);

            // Update Status Active Form Master By ID
            Route::put("formulir/{id_form}/status_active", [FormController::class, 'updateStatusActive']);
            // Get Form By ID
            Route::get("formulir/{id_form}", [FormController::class, 'getFormAdminById']);

            // Delete Form Master By ID
            Route::delete("formulir/{id_form}", [FormController::class, 'deleteFormMaster']);

            // GROUP FORMULIR PENGEMBANG

            // Get All Formulir Pengembang
            Route::get("formulir_pengembang", [FormController::class, 'getAllFormPengembang']);
        });
    });
});
// END API LEVEL ADMIN

// API LEVEL PENGEMBANG
Route::prefix('v1/pengembang/')->group(function () {

    Route::group(['middleware' => "auth:sanctum"], function () {

        // All secure URL's
        Route::group(['middleware' => "is_pengembang"], function () {

            // GROUP DASHBOARD

            // Get All Dashboard Information
            Route::get('dashboard/info', [DashboardController::class, 'getDashboardPengembangInfo']);

            // Logout User Pengembang
            Route::post('user/logout', [AuthController::class, 'logout']);

            // GROUP USER

            // Get Akun Pengembang
            Route::get('akun', [PengembangController::class, 'getAkun']);

            // Update Akun Pengembang
            Route::post('akun', [PengembangController::class, 'updatePengembang2']);

            // For Checking User who is active at this moment
            Route::get('/akun/me', [AuthController::class, 'me'])->withoutMiddleware([CheckStatus::class]);

            // END GROUP USER

            // ===========================================================================================
            // GROUP PERUMAHAN

            // Get All Kecamatan
            Route::get('/kecamatan', [PerumahanController::class, 'getAllKecamatan']);

            // Get All Kelurahan by Id Kecamatan
            Route::get('/kelurahan/{id_kecamatan}', [PerumahanController::class, 'getAllKelurahan']);

            // Search Data Perumahan
            Route::get('/perumahan/search', [PerumahanController::class, 'searchPerumahanPengembang']);

            // Add Data Perumahan
            Route::post('/perumahan', [PerumahanController::class, 'addPerumahan']);

            // Update Data Perumahan
            Route::post('/perumahan/{id_perumahan}', [PerumahanController::class, 'updatePerumahanById']);

            // Update Status Perumahan
            Route::put('/perumahan/{id_perumahan}/status', [PerumahanController::class, 'updateStatus']);

            // Get All Perumahan
            Route::get('/perumahan', [PerumahanController::class, 'getAllPerumahan']);

            // Get Perumahan By ID
            Route::get('/perumahan/{id_perumahan}', [PerumahanController::class, 'getById']);

            // Get Foto Perumahan
            Route::get('/perumahan/foto/{filename}', [PerumahanController::class, 'getFotoPerumahan']);

            // Get File Legalitas Perumahan
            Route::get('/perumahan/file/{filename}', [PerumahanController::class, 'getFileLegalitas']);

            // GROUP PERUMAHAN / FOTO

            // Add Foto Perumahan
            Route::post('/perumahan/{id_perumahan}/foto', [PerumahanController::class, 'addFotoPerumahan']);

            // Update Status Utama Foto Perumahan
            Route::put('/perumahan/{id_perumahan}/foto/{id_foto_perumahan}/status', [PerumahanController::class, 'updateStatusFoto']);

            // Delete Foto Perumahan By ID
            Route::delete('/perumahan/{id_perumahan}/foto/{id_foto_perumahan}', [PerumahanController::class, 'deleteFoto']);

            // Get All Foto Perumahan
            Route::get('/perumahan/{id_perumahan}/foto', [PerumahanController::class, 'getAllFoto']);

            // GROUP PERUMAHAN / SARANA DAN PRASARANA

            // Add Sarana dan Prasarana
            Route::post('/perumahan/{id_perumahan}/sarana_prasarana', [PerumahanController::class, 'addSaranaPrasarana']);

            // Get All Sarana dan Prasarana By ID Perumahan
            Route::get('/perumahan/{id_perumahan}/sarana_prasarana', [PerumahanController::class, 'getSaranaPrasarana']);

            // Delete Sarana dan Prasarana By ID
            Route::delete('/perumahan/{id_perumahan}/sarana_prasarana/{id_sarana_prasarana_perumahan}', [PerumahanController::class, 'deleteSaranaPrasarana']);

            // GROUP PERUMAHAN / FASILITAS

            // Add Fasilitas
            Route::post('/perumahan/{id_perumahan}/fasilitas', [PerumahanController::class, 'addFasilitas']);

            // Get All Fasilitas By ID Perumahan
            Route::get('/perumahan/{id_perumahan}/fasilitas', [PerumahanController::class, 'getFasilitas']);

            // Delete Fasilitas By ID
            Route::delete('/perumahan/{id_perumahan}/fasilitas/{id_fasilitas_perumahan}', [PerumahanController::class, 'deleteFasilitas']);

            // GROUP PERUMAHAN / PROPERTI

            // Search Properti By ID Perumahan
            Route::get('perumahan/{id_perumahan}/properti/search', [PerumahanController::class, 'searchProperti']);

            // Add Properti By ID Perumahan
            Route::post('perumahan/{id_perumahan}/properti', [PerumahanController::class, 'addProperti']);

            // Get All Properti
            Route::get('properti', [PerumahanController::class, 'getAllProperti']);

            // Get Properti By ID
            Route::get('properti/{id_properti}', [PerumahanController::class, 'getPropertiById2']);

            // Update Status Publish By ID
            Route::put('properti/{id_properti}/status', [PerumahanController::class, 'updateStatusProperti2']);

            // Get All Properti By ID Perumahan
            Route::get('perumahan/{id_perumahan}/properti', [PerumahanController::class, 'getAllPropertiById']);

            // Get Properti By ID Perumahan & ID Bangunan
            Route::get('perumahan/{id_perumahan}/properti/{id_bangunan}', [PerumahanController::class, 'getPropertiById']);

            // Update Properti By ID
            Route::post('perumahan/{id_perumahan}/properti/{id_bangunan}', [PerumahanController::class, 'updatePropertiById']);

            // Update Status Publish Properti By ID Perumahan & ID Bangunan
            Route::put('perumahan/{id_perumahan}/properti/{id_bangunan}/status', [PerumahanController::class, 'updateStatusProperti']);

            // GROUP PERUMAHAN / PROPERTI / SPESIFIKASI

            // Add Spesifikasi Bangunan
            Route::post('perumahan/{id_perumahan}/properti/{id_bangunan}/spesifikasi', [PerumahanController::class, 'addSpesifikasiProperti']);

            // Get All Spesifikasi By ID Bangunan
            Route::get('properti/{id_bangunan}/spesifikasi', [PerumahanController::class, 'getSpesifikasiProperti']);

            // Delete Spesifikasi Bangunan By ID
            Route::delete('properti/{id_bangunan}/spesifikasi/{id_spesifikasi_rumah}', [PerumahanController::class, 'deleteSpesifikasiProperti']);

            // GROUP PERUMAHAN / PROPERTI / FOTO

            // Get All Foto Bangunan
            Route::get('properti/{id_bangunan}/foto', [PerumahanController::class, 'getFotoBangunan']);

            // Add Foto Bangunan
            Route::post('properti/{id_bangunan}/foto', [PerumahanController::class, 'addFotoBangunan']);

            // Update Status Utama Foto Bangunan
            Route::put('properti/{id_bangunan}/foto/{id_foto}/status', [PerumahanController::class, 'updateStatusFotoBangunan']);

            // Delete Foto Bangunan
            Route::delete('properti/{id_bangunan}/foto/{id_foto}', [PerumahanController::class, 'deleteFotoBangunan']);

            // END GROUP PERUMAHAN

            // ===========================================================================================
            // GROUP BROSUR PENGEMBANG

            // Get All Brosur
            Route::get('brosur/', [BrosurController::class, 'getAllBrosur']);

            // Get Brosur By ID
            Route::get('brosur/{id_brosur}', [BrosurController::class, 'getBrosurById']);

            // Add Brosur
            Route::post('brosur/', [BrosurController::class, 'addBrosur']);

            // Update Brosur By ID

            // Delete Brosur By ID
            Route::delete('brosur/{id_brosur}', [BrosurController::class, 'deleteBrosur']);

            // END GROUP BROSUR PENGEMBANG

            // ===========================================================================================
            // GROUP FORM DATA PERUMAHAN

            // Get Newest Form Admin
            Route::get('form/new', [FormController::class, 'getNewestForm']);

            // Get All Form Data Perumahan
            Route::get('form', [FormController::class, 'getAllForm']);

            // Get Form Data Perumahan By ID
            Route::get('form/{id_form}', [FormController::class, 'getForm']);

            // Add Form Data Perumahan
            Route::post('form', [FormController::class, 'addForm']);

            // Update Form Data Perumahan
            Route::post('form/{id_form}', [FormController::class, 'updateForm']);

            // Delete Form Data Perumahan By ID
            Route::delete('form/{id_form}', [FormController::class, 'deleteForm']);
        });
    });
});

// Login User
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    // For Checking User
    Route::get('/cek_auth', [AuthController::class, 'me']);
});

// Download File
Route::get('/image/{path}/{filename}', [FileController::class, 'image']);
Route::get('/brosur/{path}/{filename}', [FileController::class, 'brosur']);
Route::get('/document/{path}/{filename}', [FileController::class, 'document']);
Route::get('/form/{path}/{filename}', [FileController::class, 'form']);

// API UNTUK BAGIAN HALAMAN WEBSITE E-PERUMAHAN
Route::prefix('v1/')->group(function () {
    // Get All Properti Yang Status Publishnya Aktif
    Route::get('properti', [PropertiController::class, 'getAllProperties']);
    // Get Properti berdasarkan slug
    Route::get('properti/{slug}', [PropertiController::class, 'getPropertiBySlug']);
    // Get All Pengembang Aktif
    Route::get('pengembang', [PengembangController::class, 'getAllPengembang2']);
});
