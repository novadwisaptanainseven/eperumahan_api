<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Dashboard extends Model
{
    use HasFactory;

    // Get All Dashboard Information
    public static function getDashboardInfo()
    {
        // Tabel - tabel
        $perumahan = 'perumahan';
        $bangunan = 'bangunan';

        // Get total perumahan
        $total_perumahan = DB::table($perumahan)
            ->where("status_deleted", "=", 0)
            ->get()
            ->count();

        // Get total perumahan menunggu konfirmasi
        $total_perumahan_menunggu_konfirmasi = DB::table($perumahan)
            ->where("status_perumahan", '=', 0)
            ->get()
            ->count();

        // Get total properti
        $total_bangunan = DB::table($bangunan)
            ->where("status_deleted", "=", 0)
            ->get()
            ->count();

        // Get total properti menunggu konfirmasi
        $total_bangunan_menunggu_konfirmasi = DB::table($bangunan)
            ->where("status_publish", '=', 0)
            ->get()
            ->count();

        $data = [
            "total_perumahan"  => $total_perumahan,
            "total_properti"   => $total_bangunan,
            "total_perumahan_menunggu_konfirmasi"   => $total_perumahan_menunggu_konfirmasi,
            "total_properti_menunggu_konfirmasi"   => $total_bangunan_menunggu_konfirmasi
        ];

        return $data;
    }

    // Get All Dashboard Pengembang Information
    public static function getDashboardPengembangInfo()
    {
        // Tabel - tabel
        $perumahan = 'perumahan';
        $bangunan = 'bangunan';
        $pengembang = 'pengembang';

        // Get user saat ini
        $user = Auth::user();

        // Get pengembang berdasarkan id user
        $user_pengembang = DB::table($pengembang)
            ->where('id_user', '=', $user->id)
            ->first();
            
       

        // Get perumahan berdasarkan id pengembang
        $data_perumahan = DB::table($perumahan)
            ->where([
                ["id_pengembang", "=", $user_pengembang->id_pengembang],
                ["status_deleted", "=", 0],
            ])
            ->get();

        // Cek apakah data perumahan ditemukan
        if (count($data_perumahan) === 0) {
            return "PERUMAHAN_EMPTY";
        }

        // Get total perumahan
        $total_perumahan = $data_perumahan->count();

        // Get total perumahan menunggu konfirmasi
        $total_perumahan_menunggu_konfirmasi = DB::table($perumahan)
            ->where([
                ["id_pengembang", "=", $user_pengembang->id_pengembang],
                ["status_perumahan", "=", 0],
            ])
            ->get()
            ->count();

        // Get total perumahan ditayangkan dan tidak ditayangkan
        $total_perumahan_ditayangkan = DB::table($perumahan)
            ->where([
                ["id_pengembang", "=", $user_pengembang->id_pengembang],
                ["status_perumahan", "=", 2],
            ])
            ->get()
            ->count();

        $total_perumahan_tidak_ditayangkan = $total_perumahan - $total_perumahan_ditayangkan;

        // Get All Properti
        // $data_bangunan = DB::table($bangunan)->where('status_deleted', '=', 0)->get();
        // if (count($data_bangunan) > 0) {
        //     return $data_bangunan;
        // }

        // Get total properti
        $total_bangunan = DB::table($bangunan)
            ->where([
                ["id_pengembang", "=", $user_pengembang->id_pengembang],
                ["status_deleted", "=", 0],
            ])
            ->get()
            ->count();

        // Get total properti menunggu konfirmasi
        $total_bangunan_menunggu_konfirmasi = DB::table($bangunan)
            ->where([
                ["status_publish", "=", 0],
                ["status_deleted", "=", 0],
            ])
            ->get()
            ->count();

        // Get total bangunan ditayangkan dan tidak ditayangkan
        $total_bangunan_ditayangkan = DB::table($bangunan)
            ->where([
                ["id_pengembang", "=", $user_pengembang->id_pengembang],
                ["status_publish", "=", 2],
            ])
            ->get()
            ->count();
        $total_bangunan_tidak_ditayangkan = $total_bangunan - $total_bangunan_ditayangkan;

        $data = [
            "id_pengembang"                         => $user_pengembang->id_pengembang,
            "total_perumahan"                       => $total_perumahan,
            "total_properti"                        => $total_bangunan,
            "total_perumahan_menunggu_konfirmasi"   => $total_perumahan_menunggu_konfirmasi,
            "total_properti_menunggu_konfirmasi"    => $total_bangunan_menunggu_konfirmasi,
            "total_perumahan_ditayangkan"           => $total_perumahan_ditayangkan,
            "total_perumahan_tidak_ditayangkan"     => $total_perumahan_tidak_ditayangkan,
            "total_properti_ditayangkan"            => $total_bangunan_ditayangkan,
            "total_properti_tidak_ditayangkan"      => $total_bangunan_tidak_ditayangkan
        ];

        return $data;
    }
}
