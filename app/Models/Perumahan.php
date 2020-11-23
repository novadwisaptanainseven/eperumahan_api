<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Perumahan extends Model
{
    use HasApiTokens, HasFactory;

    protected $table = 'perumahan';
    // GROUP PERUMAHAN

    // Add Data Perumahan
    public static function addPerumahan($req)
    {
        // Tabel - Tabel
        $perumahan = 'perumahan';
        $pengembang = 'pengembang';
        $foto_perumahan = 'foto_perumahan';
        $sarana_prasarana = 'sarana_prasarana_perumahan';
        $fasilitas = 'fasilitas_perumahan';

        // Cek Apakah ada file foto
        $foto = [];
        if(!$req->hasFile('foto_perumahan'))
            $foto = '';
        else
        {
            $images = $req->file('foto_perumahan');
            foreach($images as $image)
            {
                $foto[] = $image->store('perumahan/foto');
            }
        }

        // Cek Apakah ada file legalitas
        if(!$req->hasFile('legalitas'))
            $legalitas = '';
        else {
            $file = $req->file('legalitas');
            $legalitas = $file->store('perumahan/file');
        }

        // Lakukan Proses Tambah Data
        $user = Auth::user();
        $data_pengembang = DB::table($pengembang)->where(['id_user' => $user->id])->first();

        // Pembuatan Slug
        $last_data           = DB::table($perumahan)->orderBy('id_perumahan', 'DESC')->first();
        $slug                = Str::of($last_data->id_perumahan + 1 . ' ' . $req->nama_perumahan)->slug('-');
        $req->perumahan_slug = $slug;
        // End Pembuatan Slug

        // Persiapan Data Perumahan
        $data_perumahan = [
            "id_pengembang"       => $data_pengembang->id_pengembang,
            "nama_perumahan"      => $req->nama_perumahan,
            "deskripsi_perumahan" => $req->deskripsi_perumahan,
            "lokasi"              => $req->lokasi,
            "longitude"           => $req->longitude,
            "latitude"            => $req->latitude,
            "id_kecamatan"        => $req->id_kecamatan,
            "id_kelurahan"        => $req->id_kelurahan,
            "slug"                => $req->perumahan_slug,
            "legalitas"           => $legalitas,
            "status_perumahan"    => 0
        ];
        // Insert Data Perumahan to Database
        $cek_insert = DB::table($perumahan)->insert($data_perumahan);

        // Persiapan Data Foto
        $get_latest_id_perumahan= DB::table($perumahan)->orderBy('id_perumahan', 'DESC')->first()->id_perumahan;
        $i = 0;
        $status = 0;
        foreach($foto as $f)
        {
            if($i == 0)
                $status = 1;
            else
                $status = 0;
                
            $data_foto = [
                "id_perumahan" => $get_latest_id_perumahan,
                "foto_perumahan" => $f,
                "status_foto" => $status
            ];
            
            // Insert Data Foto Perumahan ke Database
            DB::table($foto_perumahan)->insert($data_foto);
            $i++;
        }

        // Persiapan Data Sarana dan Prasarana
        foreach($req->sarana_prasarana_perumahan as $s)
        {
            $data_sarana = [
                "id_perumahan" => $get_latest_id_perumahan,
                "nama_sarana_prasarana_perumahan" => $s
            ];
            // Insert Data Sarana Prasarana ke Database
            DB::table($sarana_prasarana)->insert($data_sarana);
        }

        // Persiapan Data Fasilitas
        foreach($req->fasilitas_perumahan as $f)
        {
            $data_fasilitas = [
                "id_perumahan" => $get_latest_id_perumahan,
                "nama_fasilitas_perumahan" => $f
            ];
            // Insert Data Fasilitas ke Database
            DB::table($fasilitas)->insert($data_fasilitas);
        }

        $getPerumahan = DB::table($perumahan)->where('id_perumahan', $get_latest_id_perumahan)->first();
        $getFoto      = DB::table($foto_perumahan)->where('id_perumahan', $get_latest_id_perumahan)->get();
        $getFasilitas = DB::table($fasilitas)->where('id_perumahan', $get_latest_id_perumahan)->get();
        $getSarana    = DB::table($sarana_prasarana)->where('id_perumahan', $get_latest_id_perumahan)->get();
        
        if($cek_insert)
        {
            // Gabungkan Semua Data untuk ditampilkan pada response
            $getPerumahan->foto_perumahan = $getFoto;
            $getPerumahan->sarana_prasarana_perumahan = $getSarana;
            $getPerumahan->fasilitas_perumahan = $getFasilitas;
            
            return $getPerumahan;
        }
        else
            return null;

        // return $data_perumahan;

    }

    // Get All Data Perumahan
    public static function getAll()
    {
        $perumahan = 'perumahan';
        $pengembang = 'pengembang';
        $kelurahan = 'kelurahan';
        $kecamatan = 'kecamatan';

        $data_perumahan = DB::table($perumahan)
            ->leftJoin($pengembang, "$perumahan.id_pengembang", '=', "$pengembang.id_pengembang")
            ->leftJoin($kelurahan, "$kelurahan.id_kelurahan", "=", "$perumahan.id_kelurahan")
            ->leftJoin($kecamatan, "$kecamatan.id_kecamatan", "=", "$perumahan.id_kecamatan")
            ->get();

        $belum_konfirmasi = DB::table($perumahan)
            ->where(["status_perumahan" => 0])
            ->count();

        $data_perumahan->total = $data_perumahan->count();
        $data_perumahan->total_sudah_konfirmasi = $data_perumahan->total - $belum_konfirmasi;
        $data_perumahan->total_belum_konfirmasi = $belum_konfirmasi;
        return $data_perumahan;
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


        if ($perumahan) {
            // Gabungkan semua hasil pencarian data dengan id yang sama
            $perumahan->sarana_prasarana_perumahan = $sarana_prasarana;
            $perumahan->foto_perumahan = $foto;
            return $perumahan;
        } else
            return null;
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
    public static function getAllProperti()
    {
        // Tabel - Tabel
        $bangunan   = 'bangunan';
        $pengembang = 'pengembang';
        $kelurahan  = 'kelurahan';
        $kecamatan  = 'kecamatan';

        // Mengambil Semua Data Properti
        $properti = DB::table($bangunan)
            ->leftJoin($pengembang, "$bangunan.id_pengembang", "=", "$pengembang.id_pengembang")
            ->leftJoin($kelurahan, "$bangunan.id_kelurahan", "=", "$kelurahan.id_kelurahan")
            ->leftJoin($kecamatan, "$bangunan.id_kecamatan", "=", "$kecamatan.id_kecamatan")
            ->get();

        $properti_belum_konfirmasi = DB::table($bangunan)
            ->where(["status_publish" => 0])
            ->count();

        $properti->total = $properti->count();
        $properti->total_sudah_konfirmasi = $properti->total - $properti_belum_konfirmasi;
        $properti->total_belum_konfirmasi = $properti_belum_konfirmasi;

        // Cek Apakah properti ada isinya
        if ($properti)
            return $properti;
        else
            return null;
    }

    // Get All Properti By ID Perumahan
    public static function getAllPropertiById($id_perumahan)
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
    public static function getPropertiById($id_bangunan)
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
            return null;
    }

    // Update Status Publish By ID
    public static function updateStatusProperti($id_bangunan, $status)
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
