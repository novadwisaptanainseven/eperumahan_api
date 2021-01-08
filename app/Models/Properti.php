<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Properti extends Model
{
    use HasFactory;

    protected $table = 'bangunan';

    // Get All Properties
    public static function getAllProperties($limit)
    {
        // Tabel - tabel
        $tbl_bangunan = 'bangunan';
        $tbl_foto = "foto_bangunan";

        $data_bangunan = DB::table($tbl_bangunan)
            ->where('status_publish', '=', '2')
            ->limit($limit)
            ->orderBy('id_bangunan', 'DESC')
            ->get();

        if (count($data_bangunan) > 0) {

            foreach ($data_bangunan as $i => $data) {
                $data_foto = DB::table($tbl_foto)
                    ->where([
                        ['id_bangunan', '=', $data->id_bangunan],
                        ['level_foto', '=', '1'],
                    ])
                    ->first();
                $data->foto_bangunan = $data_foto->foto_bangunan;
            }

            return $data_bangunan;
        } else {
            return null;
        }
    }

    // Get Properti By ID Pengembang
    public static function getPropertiByIdPengembang($id_pengembang)
    {
        // Tabel - tabel
        $tbl_bangunan = 'bangunan';
        $tbl_foto = "foto_bangunan";

        $data_bangunan = DB::table($tbl_bangunan)
            ->where([
                ['status_publish', '=', '2'],
                ['id_pengembang', '=', $id_pengembang]
            ])
            ->orderBy('id_bangunan', 'DESC')
            ->get();

        if (count($data_bangunan) > 0) {

            foreach ($data_bangunan as $i => $data) {
                $data_foto = DB::table($tbl_foto)
                    ->where([
                        ['id_bangunan', '=', $data->id_bangunan],
                        ['level_foto', '=', '1'],
                    ])
                    ->first();
                $data->foto_bangunan = $data_foto->foto_bangunan;
            }

            return $data_bangunan;
        } else {
            return null;
        }
    }

    // Get Properti By Slug
    public static function getPropertiBySlug($slug)
    {
        // Tabel - tabel
        $tbl_bangunan = 'bangunan';
        $tbl_foto = "foto_bangunan";
        $tbl_spesifikasi = "spesifikasi_rumah";
        $tbl_pengembang = "pengembang";
        $tbl_sarana_prasarana = 'sarana_prasarana_perumahan';
        $tbl_fasilitas = 'fasilitas_perumahan';
        $tbl_perumahan = 'perumahan';

        $data_bangunan = DB::table($tbl_bangunan)
            ->where('bangunan_slug', '=', $slug)
            ->first();

        if ($data_bangunan) {
            // Get Latitude and Longitude dari tabel perumahan
            $lngLat = DB::table($tbl_perumahan)
                ->select('longitude', 'latitude')
                ->where('id_perumahan', '=', $data_bangunan->id_perumahan)
                ->first();

            // Get Legalitas
            $data_legalitas = DB::table($tbl_perumahan)
                ->where('id_perumahan', '=', $data_bangunan->id_perumahan)
                ->first()
                ->legalitas;

            // Get Fasilitas
            $data_fasilitas = DB::table($tbl_fasilitas)
                ->where('id_perumahan', '=', $data_bangunan->id_perumahan)
                ->get();

            // Get Sarana Prasarana
            $data_sarana_prasarana = DB::table($tbl_sarana_prasarana)
                ->where('id_perumahan', '=', $data_bangunan->id_perumahan)
                ->get();

            // Get Pengembang
            $data_pengembang = DB::table($tbl_pengembang)
                ->where('id_pengembang', '=', $data_bangunan->id_pengembang)
                ->first();

            // Get Spesifikasi Properti
            $data_spesifikasi = DB::table($tbl_spesifikasi)
                ->where('id_bangunan', '=', $data_bangunan->id_bangunan)
                ->get();

            // Get Foto Bangunan
            $data_foto = DB::table($tbl_foto)
                ->where('id_bangunan', '=', $data_bangunan->id_bangunan)
                ->orderBy('level_foto', 'desc')
                ->get();

            $data_bangunan->id_pengembang = $data_pengembang->id_pengembang;
            $data_bangunan->nama_pengembang = $data_pengembang->nama_pengembang;
            $data_bangunan->foto_pengembang = $data_pengembang->foto_pengembang;
            $data_bangunan->email_pengembang = $data_pengembang->email_pengembang;
            $data_bangunan->telepon_pengembang = $data_pengembang->telepon_pengembang;
            $data_bangunan->pengembang_slug = $data_pengembang->pengembang_slug;
            $data_bangunan->spesifikasi = $data_spesifikasi;
            $data_bangunan->foto_bangunan = $data_foto;
            $data_bangunan->sarana_prasarana = $data_sarana_prasarana;
            $data_bangunan->fasilitas = $data_fasilitas;
            $data_bangunan->legalitas = $data_legalitas;
            $data_bangunan->latitude = $lngLat->latitude;
            $data_bangunan->longitude = $lngLat->longitude;

            return $data_bangunan;
        } else {
            return null;
        }
    }
}
