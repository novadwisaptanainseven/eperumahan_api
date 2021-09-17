<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Dashboard extends Model
{
    use HasFactory;

    protected static $tbl_perumahan = "perumahan";
    protected static $tbl_properti = "bangunan";

    // Get All Dashboard Information Super Admin
    public static function getDashboardInfoSuperAdmin()
    {
        // Tabel - tabel
        $tbl_users = 'users';
        $tbl_pengembang = 'pengembang';

        // Get total users
        $user_super_admin = DB::table($tbl_users)
            ->where("level", 1)
            ->get()
            ->count();
        $user_admin = DB::table($tbl_users)
            ->where("level", 2)
            ->get()
            ->count();
        $user_pengembang = DB::table($tbl_users)
            ->where("level", 3)
            ->get()
            ->count();
        $pengembang = DB::table($tbl_pengembang)
            ->get()
            ->count();


        $data = [
            "total_super_admin"     => $user_super_admin,
            "total_admin"           => $user_admin,
            "total_user_pengembang" => $user_pengembang,
            "total_pengembang"      => $pengembang,
        ];

        return $data;
    }

    // Get All Dashboard Information Admin
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

        // Get total properti berdasarkan MBR dan NON MBR
        $properti_mbr = DB::table($bangunan)
            ->where("kategori_bangunan", "MBR")
            ->get()
            ->count();
        $properti_non_mbr = DB::table($bangunan)
            ->where("kategori_bangunan", "NON MBR")
            ->get()
            ->count();


        $data = [
            "total_perumahan"  => $total_perumahan,
            "total_properti"   => $total_bangunan,
            "total_perumahan_menunggu_konfirmasi"   => $total_perumahan_menunggu_konfirmasi,
            "total_properti_menunggu_konfirmasi"   => $total_bangunan_menunggu_konfirmasi,
            "properti"   => [
                "total_mbr" => $properti_mbr,
                "total_non_mbr" => $properti_non_mbr,
            ],
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
                ["id_pengembang", "=", $user_pengembang->id_pengembang],
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

        // Get total perumahan berdasarkan kategori
        $tot_mbr = DB::table(self::$tbl_perumahan)->where([
            ["id_pengembang", "=", $user_pengembang->id_pengembang],
            ["id_kategori", "=", 1],
        ])->get()->count();
        $tot_komersial = DB::table(self::$tbl_perumahan)->where([
            ["id_pengembang", "=", $user_pengembang->id_pengembang],
            ["id_kategori", "=", 2],
        ])->get()->count();
        $tot_campuran = DB::table(self::$tbl_perumahan)->where([
            ["id_pengembang", "=", $user_pengembang->id_pengembang],
            ["id_kategori", "=", 3],
        ])->get()->count();
        $tot_perumahan = DB::table(self::$tbl_perumahan)->where("id_pengembang", $user_pengembang->id_pengembang)->get()->count();

        // Get total properti berdasarkan kategori
        $tot_mbr2 = DB::table(self::$tbl_properti)->where([
            ["id_pengembang", "=", $user_pengembang->id_pengembang],
            ["id_kategori", "=", 1],
        ])->get()->count();
        $tot_komersial2 = DB::table(self::$tbl_properti)->where([
            ["id_pengembang", "=", $user_pengembang->id_pengembang],
            ["id_kategori", "=", 2],
        ])->get()->count();
        $tot_campuran2 = DB::table(self::$tbl_properti)->where([
            ["id_pengembang", "=", $user_pengembang->id_pengembang],
            ["id_kategori", "=", 3],
        ])->get()->count();
        $tot_properti = DB::table(self::$tbl_properti)->where("id_pengembang", $user_pengembang->id_pengembang)->get()->count();

        $total_grafik = [
            "perumahan" => [
                "tot_mbr" => $tot_mbr,
                "tot_komersial" => $tot_komersial,
                "tot_campuran" => $tot_campuran,
                "tot_perumahan" => $tot_perumahan,
            ],
            "properti" => [
                "tot_mbr" => $tot_mbr2,
                "tot_komersial" => $tot_komersial2,
                "tot_campuran" => $tot_campuran2,
                "tot_properti" => $tot_properti,
            ],
        ];

        $data = [
            "id_pengembang"                         => $user_pengembang->id_pengembang,
            "total_perumahan"                       => $total_perumahan,
            "total_properti"                        => $total_bangunan,
            "total_perumahan_menunggu_konfirmasi"   => $total_perumahan_menunggu_konfirmasi,
            "total_properti_menunggu_konfirmasi"    => $total_bangunan_menunggu_konfirmasi,
            "total_perumahan_ditayangkan"           => $total_perumahan_ditayangkan,
            "total_perumahan_tidak_ditayangkan"     => $total_perumahan_tidak_ditayangkan,
            "total_properti_ditayangkan"            => $total_bangunan_ditayangkan,
            "total_properti_tidak_ditayangkan"      => $total_bangunan_tidak_ditayangkan,
            "total_grafik"                          => $total_grafik,
        ];

        return $data;
    }
}
