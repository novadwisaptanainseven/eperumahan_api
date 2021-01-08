<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brosur;
use App\Models\Pengembang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BrosurController extends Controller
{
    // Get All Brosur Pengembang
    public function getAllBrosur()
    {
        // Get Brosur
        $brosur = Brosur::getAllBrosur();

        // Cek apakah ada data brosur
        if (count($brosur) != 0) {
            // Jika ada, tampilkan response 200 OK
            return response()->json([
                "message" => "Get all brosur pengembang Berhasil",
                "data"    => $brosur,
            ], 200);
        } else {
            // Jika tidak ada, tetap tampilkan response 200 OK dengan ketrangang
            return response()->json([
                "message" => "Belum ada data brosur",
                "data"    => $brosur
            ], 200);
        }
    }

    // Get All Brosur Umum
    public function getAllBrosurUmum()
    {
        // Get Brosur
        $brosur = Brosur::getAllBrosurUmum();

        // Cek apakah ada data brosur
        if (count($brosur) != 0) {
            // Jika ada, tampilkan response 200 OK
            return response()->json([
                "message" => "Get all brosur pengembang Berhasil",
                "data"    => $brosur,
            ], 200);
        } else {
            // Jika tidak ada, tetap tampilkan response 200 OK dengan keteranang
            return response()->json([
                "message" => "Belum ada data brosur",
                "data"    => $brosur
            ], 200);
        }
    }

    // Get Brosur Pengembang By ID untuk keperluan Front End Website E-Perumahan
    public function getBrosurByIdPengembang($id_pengembang)
    {
        // Get Brosur
        $brosur = Brosur::getBrosurByIdPengembang($id_pengembang);

        // Cek apakah ada data brosur
        if (count($brosur) != 0) {
            // Jika ada, tampilkan response 200 OK
            return response()->json([
                "message" => "Get all brosur dengan id pengembang : $id_pengembang Berhasil",
                "data"    => $brosur,
            ], 200);
        } else {
            // Jika tidak ada, tetap tampilkan response 200 OK dengan keteranang
            return response()->json([
                "message" => "Belum ada data brosur",
                "data"    => $brosur
            ], 200);
        }
    }


    // Get Brosur Pengembang By ID
    public function getBrosurById($id_brosur)
    {
        // Get brosur
        $brosur = Brosur::getBrosurById($id_brosur);

        // Cek apakah ada data brosur
        if ($brosur) {
            // Jika ada, tampilkan response 200 OK
            return response()->json([
                "message" => "Get brosur pengembang dengan id brosur: $id_brosur, Berhasil",
                "data"    => $brosur
            ], 200);
        } else {
            // Jika tidak ada, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Brosur pengembang dengan id brosur: $id_brosur, Tidak Ditemukan"
            ], 404);
        }
    }

    // Add Brosur Pengembang
    public function addBrosur(Request $request)
    {
        // Validation
        $message = [
            'required' => ':attribute belum ada file'
        ];
        $validator = Validator::make($request->all(), [
            'brosur_pengembang' => "required|max:5048"
        ], $message);

        // Set ekstensi file yang diizinkan untuk upload brosur
        $request->ext_allowed = ['jpg', 'jpeg', 'png'];

        // Cek validasi
        if ($validator->fails()) {
            // Jika validasi gagal, tampilkan response 400 BAD REQUEST
            return response()->json([
                "errors" => $validator->errors()
            ], 400);
        }

        // End Validation

        // Jika validasi berhasil lakukan proses di bawah ini
        // Tambah data brosur pengembang
        $tambah = Brosur::addBrosur($request);

        // Cek apakah proses tambah berhasil
        if ($tambah === 'WRONG_EXTENSION') {
            // Jika ekstensi file yang dimasukkan tidak diizinkan, tampilkan response 400 BAD REQUEST
            return response()->json([
                "message" => "Ekstensi file foto / gambar harus bertipe jpg, jpeg, atau png!",
                "status_response" => "400 BAD REQUEST"
            ], 400);
        } else if ($tambah !== 'NOT_FOUND') {
            // Jika berhasil, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Tambah brosur pengembang, Berhasil",
                "data"    => $tambah
            ], 201);
        } else if ($tambah === 'NOT_FOUND') {
            // Jika data bangunan tidak ditemukan, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Data properti tidak ditemukan!"
            ], 404);
        } else {
            // Jika gagal, tampilkan response 500 INTERNAL SERVER ERROR
            return response()->json([
                "message" => "Tambah brosur pengembang, Gagal",
                "data"    => $tambah
            ], 500);
        }
    }

    // Delete Brosur Pengembang
    public function deleteBrosur($id_brosur)
    {
        $delete = Brosur::deleteBrosur($id_brosur);

        // Cek apakah proses delete berhasil
        if ($delete !== 'NOT_FOUND') {
            // Jika berhasil, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Delete brosur pengembang dengan id brosur: $id_brosur, Berhasil",
                "data_deleted" => $delete
            ], 201);
        } else if ($delete === 'NOT_FOUND') {
            // Jika data brosur tidak ditemukan, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Delete brosur pengembang Gagal. Data Tidak Ditemukan"
            ], 404);
        } else {
            // Jika gagal, tampilkan response 500 INTERNAL SERVER ERROR
            return response()->json([
                "message" => "Delete brosur pengembang Gagal. Terjadi Kesalahan Internal Server"
            ], 500);
        }
    }
}
