<?php

namespace App\Http\Controllers;

use App\Models\Properti;
use Illuminate\Http\Request;

class PropertiController extends Controller
{
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
}
