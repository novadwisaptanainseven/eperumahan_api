<?php

namespace App\Http\Controllers;

use App\Models\Pengembang;
use App\Models\Perumahan;
use App\Models\Properti;
use App\Models\SocialMedia;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebsiteController extends Controller
{
    private $tblKategori = "kategori";
    private $tblPerumahan = "perumahan";
    private $tblKecamatan = "kecamatan";
    private $tblFotoPerumahan = "foto_perumahan";
    private $tblFotoProperti = "foto_bangunan";
    private $tblProperti = "bangunan";

    public function getInformasiBeranda()
    {
        // Get jumlah perumahan tersedia
        $rumah_mbr = Perumahan::where("id_kategori", 1)->count();
        $rumah_komersial = Perumahan::where("id_kategori", 2)->count();
        $rumah_campuran = Perumahan::where("id_kategori", 3)->count();

        // Get Daftar Perumahan
        $perumahan = Perumahan::limit(3)
            ->join($this->tblKategori, "$this->tblKategori.id_kategori", "$this->tblPerumahan.id_kategori")
            ->orderBy("created_at", "desc")
            ->get();
        foreach ($perumahan as $p) {
            // Get Foto Perumahan
            $fotoPerumahan = DB::table($this->tblFotoPerumahan)
                ->where([
                    ["id_perumahan", "=", $p->id_perumahan],
                    ["status_foto", "=", 1]
                ])
                ->first();

            if ($fotoPerumahan) {
                $p->foto = $fotoPerumahan->foto_perumahan;
            } else {
                $p->foto = "";
            }

            // Get Jumlah Properti
            $total_properti = Properti::where("id_perumahan", $p->id_perumahan)->count();
            $p->total_properti = $total_properti;
        }

        // Get Properti
        $properti = Properti::limit(6)
            ->where("status_publish", 2)
            ->join($this->tblKategori, "$this->tblKategori.id_kategori", "$this->tblProperti.id_kategori")
            ->orderBy("id_bangunan", "desc")
            ->get();

        foreach ($properti as $p) {
            // Get Foto Properti
            $fotoProperti = DB::table($this->tblFotoProperti)
                ->where([
                    ["id_bangunan", "=", $p->id_bangunan],
                    ["level_foto", "=", 1]
                ])
                ->first();

            if ($fotoProperti) {
                $p->foto = $fotoProperti->foto_bangunan;
            } else {
                $p->foto = "";
            }
        }

        // Get Social Media
        $socialMedia = SocialMedia::all();

        $output = [
            "jumlah_perumahan" => [
                "mbr" => $rumah_mbr,
                "komersial" => $rumah_komersial,
                "campuran" => $rumah_campuran,
            ],
            "perumahan" => $perumahan,
            "properti" => $properti,
            "socialMedia" => $socialMedia,
        ];

        return response()->json([
            "message" => "Get Informasi Beranda Berhasil",
            "data" => $output
        ], 200);
    }

    public function getInformasiPerumahan()
    {
        // Get jumlah perumahan tersedia
        $rumah_mbr = Perumahan::where("id_kategori", 1)->count();
        $rumah_komersial = Perumahan::where("id_kategori", 2)->count();
        $rumah_campuran = Perumahan::where("id_kategori", 3)->count();
        $pengembang = Pengembang::get()->count();

        // Get Jumlah Perumahan Berdasarkan Kecamatan
        $kecamatan = DB::table($this->tblKecamatan)->get();
        foreach ($kecamatan as $k) {
            $totalRumah = Perumahan::where("id_kecamatan", $k->id_kecamatan)->count();
            $totalRumahMBR = Perumahan::where([
                ["id_kecamatan", $k->id_kecamatan],
                ["id_kategori", 1],
            ])->count();
            $totalRumahKomersial = Perumahan::where([
                ["id_kecamatan", $k->id_kecamatan],
                ["id_kategori", 2],
            ])->count();
            $totalRumahCampuran = Perumahan::where([
                ["id_kecamatan", $k->id_kecamatan],
                ["id_kategori", 3],
            ])->count();

            $k->rumah = [
                "mbr" => $totalRumahMBR,
                "komersial" => $totalRumahKomersial,
                "campuran" => $totalRumahCampuran,
                "total" => $totalRumah,
            ];
        }

        $perumahan = Perumahan::all();

        $output = [
            "perumahan" => $perumahan,
            "jumlah_perumahan" => [
                "mbr" => $rumah_mbr,
                "komersial" => $rumah_komersial,
                "campuran" => $rumah_campuran,
                "pengembang" => $pengembang,
            ],
            "kecamatan" => $kecamatan
        ];

        return response()->json([
            "message" => "Get Informasi Perumahan Berhasil",
            "data" => $output
        ], 200);
    }

    public function getPerumahan(Request $req)
    {
        $req2 = count($req->all()) > 0 ? $req : null;

        $perumahan = Website::getPerumahanByRequest($req2);

        return response()->json([
            "message" => "Get All Perumahan Berhasil",
            "data" => $perumahan,
        ], 200);
    }

    public function getListPerumahan(Request $req)
    {
        $perumahan = Website::getPerumahanByRequest($req);

        return response()->json([
            "message" => "Get All Perumahan Berhasil",
            "data" => $perumahan,
        ], 200);
    }
}
