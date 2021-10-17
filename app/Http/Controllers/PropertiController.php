<?php

namespace App\Http\Controllers;

use App\Exports\BangunanExport;
use App\Models\Properti;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PropertiController extends Controller
{
    // Search Properti
    public function searchProperti(Request $request)
    {
        $bangunan = Properti::searchProperti($request);

        if ($bangunan) {
            return response()->json([
                "message" => "Get Properties, success",
                "total_pencarian" => count($bangunan),
                "data" => $bangunan,
            ], 200);
        } else {
            return response()->json([
                "message" => "Properti Tidak Ditemukan",
                "data" => $bangunan
            ], 404);
        }

        // return response()->json([
        //     "message" => "Get Properties, Success",
        //     "request" => [
        //         "id_kelurahan" => $request->id_kelurahan,
        //         "id_kecamatan" => $request->id_kecamatan,
        //         "min_harga" => $request->min_harga,
        //         "max_harga" => $request->max_harga,
        //         "min_luas_bangunan" => $request->min_luas_bangunan,
        //         "max_luas_bangunan" => $request->max_luas_bangunan,
        //         "min_luas_tanah" => $request->min_luas_tanah,
        //         "max_luas_tanah" => $request->max_luas_tanah,
        //     ]
        // ], 200);
    }

    // Get All Properties
    public function getAllProperties(Request $request)
    {
        $limit = $request->limit ? $request->limit : 3;
        $bangunan = Properti::getAllProperties($limit);
        $total_data = Properti::where('status_publish', '=', '2')->count();

        if ($bangunan) {
            return response()->json([
                "message" => "Get All Properties Success",
                "total_data" => $total_data,
                "data" => $bangunan
            ], 200);
        } else {
            return response()->json([
                "message" => "Belum Ada Properti yang Aktif",
                "total_data" => $total_data,
                "data" => $bangunan
            ], 200);
        }
    }

    // Get Properti by slug
    public function getPropertiBySlug($slug)
    {
        $bangunan = Properti::getPropertiBySlug($slug);

        if ($bangunan) {
            return response()->json([
                "message" => "Get Properti By Slug Success",
                "data" => $bangunan
            ], 200);
        } else {
            return response()->json([
                "message" => "Properti Tidak Ditemukan",
                "data" => $bangunan
            ], 404);
        }
    }

    // Get Properti by ID Pengembang
    public function getPropertiByIdPengembang($id_pengembang)
    {
        $bangunan = Properti::getPropertiByIdPengembang($id_pengembang);
        $total_data = Properti::where('status_publish', '=', '2')->get()->count();

        if ($bangunan) {
            return response()->json([
                "message" => "Get Properti By ID Pengembang: $id_pengembang, Success",
                "total_data" => $total_data,
                "data" => $bangunan
            ], 200);
        } else {
            return response()->json([
                "message" => "Get Properti By ID Pengembang: $id_pengembang, Gagal. Data Tidak Ditemukan",
                "total_data" => $total_data,
                "data" => $bangunan
            ], 404);
        }
    }

    // Export Bangunan Verifikasi
    public function exportBangunanVerifikasi(Request $req, $id_user)
    {
        $user = User::find($id_user);

        return Excel::download(new BangunanExport($user, $req), 'verifikasi-bangunan.xlsx');
    }
}
