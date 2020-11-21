<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perumahan;

class PerumahanController extends Controller
{
    // GROUP PERUMAHAN

    // Get All Data Perumahan
    public function getAll()
    {
        $perumahan = Perumahan::getAll();

        return response()->json([
            "message" => "Get All Perumahan Berhasil",
            "data"    => $perumahan
        ]);
    }

    // Get Data Perumahan By ID
    public function getById($id_perumahan)
    {
        $perumahan = Perumahan::getById($id_perumahan);

        // Cek apakah data perumahan ditemukan
        if ($perumahan) {
            // Jika ditemukan, tampilkan response 200
            return response()->json([
                "message" => "Get Perumahan dengan id: $id_perumahan Berhasil",
                "data"    => $perumahan
            ], 200);
        } else {
            // Jika tidak, tampilkan response 404
            return response()->json([
                "message" => "Data Perumahan dengan id: $id_perumahan Tidak Ditemukan",
                "data"    => $perumahan
            ], 404);
        }
    }

    // Update Status Perumahan By ID
    public function updateStatus(Request $request, $id_perumahan)
    {
        $perumahan = Perumahan::updateStatusById($id_perumahan, $request->status_perumahan);

        // Cek Apakah update data berhasil
        if ($perumahan) {
            // Jika berhasil, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Update Status Perumahan dengan id: $id_perumahan Berhasil",
                "data"    => $perumahan
            ], 201);
        } else {
            // Jika gagal, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Data dengan id: $id_perumahan, Tidak Ditemukan",
            ], 404);
        }
    }

    // GROUP PERUMAHAN / PROPERTI

    // Get All Data Properti
    public function getAllProperti($id_perumahan)
    {
        $properti = Perumahan::getAllProperti($id_perumahan);

        return response()->json([
            "message" => "Get All Properti dengan id perumahan: $id_perumahan Berhasil",
            "data"    => $properti
        ], 200);
    }

    // Get Data Properti/Bangunan By ID
    public function getPropertiById($id_perumahan, $id_bangunan)
    {
        $data_bangunan = Perumahan::getPropertiById($id_perumahan, $id_bangunan);

        // Cek apakah data bangunan ditemukan
        if ($data_bangunan) {
            // Jika ditemukan, tampilkan response 200 OK
            return response()->json([
                "message" => "Get Data Properti dengan id: $id_bangunan dari perumahan: $id_perumahan, Berhasil",
                "data"    => $data_bangunan
            ], 200);
        } else {
            // Jika tidak, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Data Properti Tidak Ditemukan"
            ], 404);
        }
    }

    // Update Status Publish Properti/Bangunan By ID
    public function updateStatusProperti(Request $request, $id_perumahan, $id_bangunan)
    {
        $bangunan = Perumahan::updateStatusProperti($id_perumahan, $id_bangunan, $request->status_publish);

        // Cek apakah data ada dan berhasil diupdate
        if ($bangunan) {
            // Jika iya, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Update Status Publish Properti dengan id: $id_bangunan dari perumahan: $id_perumahan, Berhasil",
                "data"    => $bangunan
            ], 201);
        } else {
            // Jika tidak, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Gagal Update, Data Tidak Ditemukan"
            ], 201);
        }
    }
}
