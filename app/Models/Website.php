<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Website extends Model
{
    use HasFactory;

    public static function getPerumahan($limit = null, $kecamatan = null, $kategori = null)
    {
        $tblPerumahan = "perumahan";
        $tblKategori = "kategori";
        $tblFotoPerumahan = "foto_perumahan";
        $tblPengembang = "pengembang";

        $perumahan = "";

        if ($kecamatan && $kategori) {
            $perumahan = Perumahan::where(
                [
                    ["id_kecamatan", "=", $kecamatan],
                    ["$tblPerumahan.id_kategori", "=", $kategori],
                ]
            )->limit($limit)
                ->orderBy("$tblPerumahan.created_at", "desc")
                ->where("$tblPerumahan.status_perumahan", 2)
                ->leftJoin($tblKategori, "$tblKategori.id_kategori", "$tblPerumahan.id_kategori")
                ->leftJoin($tblPengembang, "$tblPengembang.id_pengembang", "=", "$tblPerumahan.id_pengembang")
                ->get();
        } elseif ($kecamatan) {
            $perumahan = Perumahan::where("id_kecamatan", $kecamatan)
                ->limit($limit)
                ->orderBy("$tblPerumahan.created_at", "desc")
                ->where("$tblPerumahan.status_perumahan", 2)
                ->leftJoin($tblKategori, "$tblKategori.id_kategori", "$tblPerumahan.id_kategori")
                ->leftJoin($tblPengembang, "$tblPengembang.id_pengembang", "=", "$tblPerumahan.id_pengembang")
                ->get();
        } elseif ($kategori) {
            $perumahan = Perumahan::where("$tblPerumahan.id_kategori", $kategori)->limit($limit)
                ->orderBy("$tblPerumahan.created_at", "desc")
                ->where("$tblPerumahan.status_perumahan", 2)
                ->leftJoin($tblKategori, "$tblKategori.id_kategori", "$tblPerumahan.id_kategori")
                ->leftJoin($tblPengembang, "$tblPengembang.id_pengembang", "=", "$tblPerumahan.id_pengembang")
                ->get();
        } else {
            $perumahan = Perumahan::limit($limit)
                ->leftJoin($tblKategori, "$tblKategori.id_kategori", "$tblPerumahan.id_kategori")
                ->leftJoin($tblPengembang, "$tblPengembang.id_pengembang", "=", "$tblPerumahan.id_pengembang")
                ->orderBy("$tblPerumahan.created_at", "desc")
                ->where("$tblPerumahan.status_perumahan", 2)
                ->get();
        }

        foreach ($perumahan as $p) {
            // Get Foto Perumahan
            $fotoPerumahan = DB::table($tblFotoPerumahan)
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

        return $perumahan;
    }

    public static function getPerumahanByRequest($req = null)
    {
        // Table
        $tblPerumahan = "perumahan";
        $tblPengembang = "pengembang";
        $tblKategori = "kategori";
        $tblFotoPerumahan = "foto_perumahan";

        $limit = $req->limit ?? 3;
        $perumahan = "";

        if($req)
        {    
            $perumahan = Website::getPerumahan($limit, $req->kecamatan, $req->kategori);
        }
        else
        {
            $perumahan = Perumahan::
                orderBy("$tblPerumahan.created_at", "desc")
                ->leftJoin($tblKategori, "$tblKategori.id_kategori", "$tblPerumahan.id_kategori")
                ->leftJoin($tblPengembang, "$tblPengembang.id_pengembang", "$tblPerumahan.id_pengembang")
                ->where("$tblPerumahan.status_perumahan", 2)
                ->get();
        }

        return $perumahan;
    }
}
