<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class Perumahan extends Model
{
    use HasApiTokens, HasFactory;

    // GROUP PERUMAHAN

    // Get All Data Perumahan
    public static function getAll()
    {
        $perumahan = DB::table('perumahan')
            ->leftJoin('pengembang', 'perumahan.id_pengembang', '=', 'pengembang.id_pengembang')
            ->get();

        return $perumahan;
    }

    // Get Data Perumahan By ID
    public static function getById($id_perumahan)
    {
        // Get Data Sarana Prasarana
        $sarana_prasarana = DB::table('sarana_prasarana_perumahan')
            ->where(['id_perumahan' => $id_perumahan])
            ->get();

        // Get Foto Perumahan
        $foto = DB::table('foto_perumahan')
            ->where(['id_perumahan' => $id_perumahan])
            ->get();

        // Get Data Perumahan
        $perumahan = DB::table('perumahan')
            ->where(['id_perumahan' => $id_perumahan])
            ->leftJoin('kecamatan', 'perumahan.id_kecamatan', '=', 'kecamatan.id_kecamatan')
            ->leftJoin('kelurahan', 'perumahan.id_kelurahan', '=', 'kelurahan.id_kelurahan')
            ->first();

        // Gabungkan semua hasil pencarian data dengan id yang sama
        $perumahan->sarana_prasarana_perumahan = $sarana_prasarana;
        $perumahan->foto_perumahan = $foto;

        if ($perumahan)
            return $perumahan;
        else
            return false;
    }

    // Update Status Perumahan By ID
    public static function updateStatusById($id_perumahan, $status)
    {
        DB::table('perumahan')
            ->where(['id_perumahan' => $id_perumahan])
            ->update(['status_perumahan' => $status]);

        $data = DB::table('perumahan')
            ->where(['id_perumahan' => $id_perumahan])
            ->first();

        return $data;
    }

    // GROUP PERUMAHAN / PROPERTI

    // Get All Properti
    public static function getAllProperti($id_perumahan)
    {
        // Tabel - Tabel
        $bangunan   = 'bangunan';
        $perumahan  = 'perumahan';
        $pengembang = 'pengembang';

        // Mengambil Data Perumahan berdasarkan ID Perumahan
        $data_perumahan = DB::table($perumahan)
            ->where(['id_perumahan' => $id_perumahan])
            ->leftJoin("$pengembang", "$perumahan.id_pengembang", '=', "$pengembang.id_pengembang")
            ->first();

        // Mengambil data properti berdasarkan ID Perumahan
        $properti = DB::table($bangunan)
            ->where(['id_perumahan' => $id_perumahan])
            ->get();

        // Gabungkan hasil pencarian data
        $data_perumahan->properti = $properti;

        return $data_perumahan;
    }

    // Get Properti By ID
    public static function getPropertiById($id_perumahan, $id_bangunan)
    {
        // Tabel - Tabel
        $bangunan = 'bangunan';
        $kelurahan = 'kelurahan';
        $kecamatan = 'kecamatan';
        $foto_bangunan = 'foto_bangunan';
        $spesifikasi_rumah = 'spesifikasi_rumah';

        // Get Data Foto Bangunan By ID Bangunan
        $data_foto = DB::table($foto_bangunan)
            ->where(['id_bangunan' => $id_bangunan])
            ->get();

        // Get Data Spesifikasi By ID Bangunan
        $data_spesifikasi = DB::table($spesifikasi_rumah)
            ->where(['id_bangunan' => $id_bangunan])
            ->get();

        // Get Data Bangunan By ID Bangunan

        $data_bangunan = DB::table($bangunan)
            ->where(['id_bangunan' => $id_bangunan])
            ->leftJoin("$kelurahan", "$bangunan.id_kelurahan", "=", "$kelurahan.id_kelurahan")
            ->leftJoin("$kecamatan", "$bangunan.id_kecamatan", "=", "$kecamatan.id_kecamatan")
            ->first();

        // Cek apakah data bangunan ada
        if ($data_bangunan) {
            // Jika ada
            // Gabungkan hasil pencarian data
            $data_bangunan->foto_bangunan = $data_foto;
            $data_bangunan->spesifikasi_rumah = $data_spesifikasi;

            return $data_bangunan;
        } else
            return false;
    }

    // Update Status Publish By ID
    public static function updateStatusProperti($id_perumahan, $id_bangunan, $status)
    {
        $bangunan = 'bangunan';

        DB::table($bangunan)
            ->where(['id_bangunan' => $id_bangunan])
            ->update(['status_publish' => $status]);

        $data = DB::table($bangunan)
            ->where('id_bangunan', $id_bangunan)
            ->first();

        return $data;
    }
}
