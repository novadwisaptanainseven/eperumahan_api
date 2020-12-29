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
        $total_data = Properti::where('status_publish', '=', '1')->count();

        if ($bangunan) {
            return response()->json([
                "message" => "Get All Properties Success",
                "total_data" => $total_data,
                "data" => $bangunan
            ]);
        } else {
            return response()->json([
                "message" => "Belum Ada Properti yang Aktif",
                "total_data" => $total_data,
                "data" => $bangunan
            ]);
        }
    }
}
