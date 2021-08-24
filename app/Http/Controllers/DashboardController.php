<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Get All Dashboard Information Super Admin
    public function getDashboardInfoSuperAdmin()
    {
        $dashboard_info = Dashboard::getDashboardInfoSuperAdmin();

        return response()->json([
            "message" => "Get All Dashboard Information untuk Super Administrator Berhasil",
            "data"    => $dashboard_info
        ], 200);
    }

    // Get All Dashboard Information Admin
    public function getDashboardInfo()
    {
        $dashboard_info = Dashboard::getDashboardInfo();

        return response()->json([
            "message" => "Get All Dashboard Information Berhasil",
            "data"    => $dashboard_info
        ], 200);
    }

    // Get All Dashboard Pengembang Information
    public function getDashboardPengembangInfo()
    {
        $dashboard_info = Dashboard::getDashboardPengembangInfo();

        if ($dashboard_info) {
            return response()->json([
                "message" => "Get All Dashboard Pengembang Information Berhasil",
                "data"    => $dashboard_info
            ], 200);
        } else if ($dashboard_info === 'PERUMAHAN_EMPTY') {
            return response()->json([
                "message" => "Get All Dashboard Pengembang Information Gagal, User belum memiliki perumahan",
                "data"    => null
            ], 404);
        }
    }
}
