<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

        
        $user = Auth::user();
        $data_pengembang = DB::table($pengembang)->where(['id_user' => $user->id])->first();

        // Cek Apakah ada file foto
        $foto = [];
        if(!$req->hasFile('foto_perumahan'))
            $foto = '';
        else
        {
            $images = $req->file('foto_perumahan');
            foreach($images as $image)
            {
                $foto[] = $image->storeAs("perumahan/foto", rand(0,9999) . '-' . date('Ymd') . '-' . $image->getClientOriginalName());
            }
        }

        // Cek Apakah ada file legalitas
        if(!$req->hasFile('legalitas'))
            $legalitas = '';
        else {
            $file = $req->file('legalitas');
            $legalitas = $file->storeAs("perumahan/file", rand(0,9999) . '-' . date('Ymd') . '-' . $file->getClientOriginalName());
        }

        // Lakukan Proses Tambah Data
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
    }

    // Update Data Perumahan By ID
    public static function updatePerumahanById($req, $id_perumahan)
    {
        // Tabel - tabel
        $perumahan  = 'perumahan';
        $kelurahan  = 'kelurahan';
        $kecamatan  = 'kecamatan';
        $pengembang = 'pengembang';

        // Cari data perumahan yang akan diupdate berdasarkan ID
        $data_perumahan = DB::table($perumahan)->where(['id_perumahan' => $id_perumahan])->first();

        // Cari data id pengembang berdasarkan id user yang sedang aktif sekarang
        $user = Auth::user();
        $id_pengembang = DB::table($pengembang)->where(['id_user' => $user->id])->first()->id_pengembang;

        // Cek apakah ada data perumahan ditemukan
        if($data_perumahan)
        {
            // Jika ada, lakukan proses update

            // Persiapan data perumahan

            // Cek apakah ada file legalitas
            if(!$req->hasFile('legalitas'))
            {
                $legalitas = $data_perumahan->legalitas;
            }
            else
            {
                $file = $req->file('legalitas');
                $legalitas = $file->storeAs("perumahan/file", $user->username . rand(0,9999) . time() . '-' .     $file->getClientOriginalName());
            }

            $data = [
                'id_pengembang' => $id_pengembang,
                'nama_perumahan' => ($req->nama_perumahan !== null) ? $req->nama_perumahan : $data_perumahan->nama_perumahan,
                'deskripsi_perumahan' => ($req->deskripsi_perumahan !== null) ? $req->deskripsi_perumahan : $data_perumahan->deskripsi_perumahan,
                'lokasi' => ($req->lokasi !== null) ? $req->lokasi : $data_perumahan->lokasi,
                'legalitas' => $legalitas,
                'latitude' => ($req->latitude !== null) ? $req->latitude : $data_perumahan->latitude,
                'longitude' => ($req->longitude !== null) ? $req->longitude : $data_perumahan->longitude,
                'id_kelurahan' => ($req->id_kelurahan !== null) ? $req->id_kelurahan : $data_perumahan->id_kelurahan,
                'id_kecamatan' => ($req->id_kecamatan !== null) ? $req->id_kecamatan : $data_perumahan->id_kecamatan,
            ];
            // Update data in database
            DB::table($perumahan)->where('id_perumahan', $id_perumahan)->update($data);

            $data_perumahan = DB::table($perumahan)
                                ->where('id_perumahan', $id_perumahan)
                                ->leftJoin($kelurahan, "$kelurahan.id_kelurahan", "=", "$perumahan.id_kelurahan")
                                ->leftJoin($kecamatan, "$kecamatan.id_kecamatan", "=", "$perumahan.id_kecamatan")
                                ->first();
            return $data_perumahan;
        }
        else
        {
            return null;
        }
    }

    // Get All Data Perumahan
    public static function getAll()
    {
        // Tabel - Tabel
        $perumahan = 'perumahan';
        $pengembang = 'pengembang';
        $kelurahan = 'kelurahan';
        $kecamatan = 'kecamatan';

        // Get data perumahan
        $data_perumahan = DB::table($perumahan)
            ->leftJoin($pengembang, "$perumahan.id_pengembang", '=', "$pengembang.id_pengembang")
            ->leftJoin($kelurahan, "$kelurahan.id_kelurahan", "=", "$perumahan.id_kelurahan")
            ->leftJoin($kecamatan, "$kecamatan.id_kecamatan", "=", "$perumahan.id_kecamatan")
            ->get();

        //  Get data belum konfirmasi
        $belum_konfirmasi = DB::table($perumahan)
            ->where(["status_perumahan" => 0])
            ->count();

        //  Gabungkan data perumahan, belum konfirmasi, dan sudah konfirmasi
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
        // Tabel - Tabel
        $bangunan = 'bangunan';

        // Get data hasil sebelum update status publish
        $data = DB::table($bangunan)
            ->where('id_bangunan', $id_bangunan)
            ->first();

        // Untuk mengatasi error jika status bernilai null
        $status = ($status !== null) ? $status : $data->status_publish; 

        // Proses Update
        DB::table($bangunan)
            ->where(['id_bangunan' => $id_bangunan])
            ->update(['status_publish' => $status]);

        // Get data hasil setelah update status publish
        $data = DB::table($bangunan)
            ->where('id_bangunan', $id_bangunan)
            ->first();

        return $data;
    }

    // GROUP PERUMAHAN / FOTO

    // Add Foto Perumahan
    public static function addFotoPerumahan($req, $id_perumahan)
    {
        // Tabel - Tabel
        $foto = 'foto_perumahan';

        // Get Current User
        $user = Auth::user();

        // Cek Apakah ada file foto
        if($req->hasFile('foto_perumahan'))
        {
            $data_foto = [];
            $status = 0;
            $i = 0;
            $images = $req->file('foto_perumahan');
            foreach($images as $image)
            {
                $data_foto[] = $image->storeAs('perumahan/foto', rand(0,9999) . '-' . date('Ymd') . '-' . $image->getClientOriginalName());

                // Persiapan Data Foto
                $data = [
                    "id_perumahan"   => $id_perumahan,
                    "foto_perumahan" => $data_foto[$i++],
                    "status_foto"    => $status
                ];
                // Insert foto to database
                DB::table($foto)->insert($data);
            }
        }
        else
        {
            return null;
        }

        // Tampilkan foto hasil proses tambah
        $data_foto = DB::table($foto)
            ->where('id_perumahan', $id_perumahan)
            ->orderBy('id_foto_perumahan', 'DESC')->get();

        return $data_foto;
    }

    // Update Status Utama Foto
    public static function updateStatusFoto($status, $id_perumahan, $id_foto)
    {
        // Tabel - Tabel
        $foto = 'foto_perumahan';

         // Get foto hasil sebelum update status utama
         $data_foto = DB::table($foto)
         ->where([
             'id_perumahan' => $id_perumahan,
             'id_foto_perumahan' => $id_foto
         ])
         ->first();
        
        // Untuk mengatasi error jika status bernilai null
        $status = ($status !== null) ? $status : $data_foto->status_foto;

        // Proses update status foto utama
        DB::table($foto)->where(
            [
                'id_perumahan' => $id_perumahan,
                'id_foto_perumahan'      => $id_foto
            ])
            ->update(['status_foto' => $status]);
        
        // Get foto hasil setelah update status utama
        $data_foto = DB::table($foto)
                        ->where([
                            'id_perumahan' => $id_perumahan,
                            'id_foto_perumahan' => $id_foto
                        ])
                        ->first();
        
        // Cek apakah ada foto yang ditemukan
        if($data_foto)
            return $data_foto;
        else
            return null;
    }

    // Delete Foto Menggunakan
    public static function deleteFoto($id_perumahan, $id_foto)
    {
        // Tabel - Tabel
        $foto = 'foto_perumahan';

        // Get data yang akan dihapus
        $data_foto = DB::table($foto)
                        ->where([
                            "id_perumahan"      => $id_perumahan,
                            "id_foto_perumahan" => $id_foto
                        ])
                        ->first();
        
        // Cek apakah ada data foto yang ditemukan
        if(!$data_foto)
        {
            // Jika tidak ada, kembalikan nilai null
            return null;
        }
        // Jika ada, lanjutkan proses dibawah

        // Proses Delete
        DB::table($foto)
            ->where([
                "id_perumahan"      => $id_perumahan,
                "id_foto_perumahan" => $id_foto
            ])
            ->delete();
        
        // Get path foto untuk keperluan menghapus file foto di storage
        $path_foto = $data_foto->foto_perumahan;

        Storage::delete("$path_foto");

        return true;
    }

    // Get All Foto By ID Perumahan
    public static function getAllFoto($id_perumahan)
    {
        // Tabel - Tabel
        $foto = 'foto_perumahan';
        $perumahan = 'perumahan';

        // Get Data Perumahan By ID
        $data_perumahan = DB::table($perumahan)->where('id_perumahan', $id_perumahan)->first();
        
        // Get All Foto
        $data_foto = DB::table($foto)->where('id_perumahan', $id_perumahan)->get();

        // Cek apakah ada data Perumahan
        if(!$data_perumahan)
        {
            return 'NOT_FOUND';
        }

        // Cek apakah ada data Foto
        if($data_foto)
        {
            $data_foto->total = $data_foto->count();

            return $data_foto;
        }
        else
            return null;
    }

    // GROUP PERUMAHAN / SARANA DAN PRASARANA

    // Add Sarana dan Prasarana By ID Perumahan
    public static function addSaranaPrasarana($req, $id_perumahan)
    {
        // Tabel - Tabel
        $sarana_prasarana = 'sarana_prasarana_perumahan';
        $perumahan = 'perumahan';

        // Get data perumahan
        $data_perumahan = DB::table($perumahan)->where('id_perumahan', $id_perumahan)->first();

        // Cek apakah ada data perumahan
        if(!$data_perumahan)
            return 'NOT_FOUND';

        $data_sarana_prasarana = $req->sarana_prasarana_perumahan;

        // Dilakukan perulangan FOREACH dikarenakan request bertipe Array
        foreach($data_sarana_prasarana as $data)
        {
            // Proses update
            $tambah = DB::table($sarana_prasarana)->insert([
                "id_perumahan" => $id_perumahan,
                "nama_sarana_prasarana_perumahan" => $data
            ]);

            if(!$tambah)
                return null;
        }
        
        // Get data sarana prasarana setelah ditambahkan
        $data_sarana_prasarana = DB::table($sarana_prasarana)
                                    ->select("$sarana_prasarana.id_sarana_prasarana_perumahan", "$sarana_prasarana.nama_sarana_prasarana_perumahan")
                                    ->where('id_perumahan', $id_perumahan)
                                    ->orderBy('id_sarana_prasarana_perumahan', 'DESC')
                                    ->get();

        // Gabungkan semua hasil proses ke dalam 1 variabel
        $data = [
            "id_perumahan" => $id_perumahan,
            "sarana_prasarana_perumahan" => $data_sarana_prasarana
        ];

        return $data;
    }

    // Get All Sarana dan Prasarana By ID Perumahan
    public static function getSaranaPrasarana($id_perumahan)
    {
        // Tabel - Tabel
        $sarana_prasarana = 'sarana_prasarana_perumahan';
        $perumahan = 'perumahan';

        // Get data perumahan
        $data_perumahan = DB::table($perumahan)->where('id_perumahan', $id_perumahan)->first();

        // Cek apakah ada data perumahan
        if(!$data_perumahan)
            return 'NOT_FOUND';

        // Get all data sarana prasarana by id perumahan
        $data_sarana_prasarana = DB::table($sarana_prasarana)
                                    ->select("$sarana_prasarana.id_sarana_prasarana_perumahan", "$sarana_prasarana.nama_sarana_prasarana_perumahan")
                                    ->where('id_perumahan', $id_perumahan)
                                    ->orderBy('id_sarana_prasarana_perumahan', 'desc')
                                    ->get();

        // Gabungkan semua hasil proses ke dalam 1 variabel
        $data = [
            "id_perumahan" => $id_perumahan,
            "sarana_prasarana_perumahan" => $data_sarana_prasarana
        ];

        return $data;
    }

    // Delete Sarana dan Prasarana By ID Perumahan
    public static function deleteSaranaPrasarana($id_perumahan, $id_sarana_prasarana)
    {
        // Tabel - Tabel
        $sarana_prasarana = 'sarana_prasarana_perumahan';
        $perumahan = 'perumahan';

        // Get data perumahan dan sarana prasarana
        $data_perumahan = DB::table($perumahan)->where('id_perumahan', $id_perumahan)->first();
        $data_sarana_prasarana = DB::table($sarana_prasarana)
                                    ->where([
                                            "id_perumahan" => $id_perumahan,
                                            "id_sarana_prasarana_perumahan" => $id_sarana_prasarana
                                    ])
                                    ->first();

        // Cek apakah ada data perumahan dan sarana prasarana ditemukan
        if(!$data_perumahan || !$data_sarana_prasarana)
            return 'NOT_FOUND';

        // Proses delete
        $delete = DB::table($sarana_prasarana)
                    ->where([
                            "id_perumahan" => $id_perumahan,
                            "id_sarana_prasarana_perumahan" => $id_sarana_prasarana
                        ])
                    ->delete();
       
        if($delete)
        {
            $data = [
                "id_sarana_prasarana_perumahan" => $data_sarana_prasarana->id_sarana_prasarana_perumahan
            ];
    
            return $data;
        }
        else 
            return null;
    }

     // GROUP PERUMAHAN / FASILITAS

    // Add Fasilitas By ID Perumahan
    public static function addFasilitas($req, $id_perumahan)
    {
        // Tabel - Tabel
        $fasilitas = 'fasilitas_perumahan';
        $perumahan = 'perumahan';

        // Get data perumahan
        $data_perumahan = DB::table($perumahan)->where('id_perumahan', $id_perumahan)->first();

        // Cek apakah ada data perumahan
        if(!$data_perumahan)
            return 'NOT_FOUND';

        $data_fasilitas = $req->fasilitas_perumahan;

        // Dilakukan perulangan FOREACH dikarenakan request bertipe Array
        foreach($data_fasilitas as $data)
        {
            // Proses update
            $tambah = DB::table($fasilitas)->insert([
                "id_perumahan" => $id_perumahan,
                "nama_fasilitas_perumahan" => $data
            ]);

            if(!$tambah)
                return null;
        }
        
        // Get data fasilitas setelah ditambahkan
        $data_fasilitas = DB::table($fasilitas)
                                    ->select("$fasilitas.id_fasilitas_perumahan", "$fasilitas.nama_fasilitas_perumahan")
                                    ->where('id_perumahan', $id_perumahan)
                                    ->orderBy('id_fasilitas_perumahan', 'DESC')
                                    ->get();

        // Gabungkan semua hasil proses ke dalam 1 variabel
        $data = [
            "id_perumahan" => $id_perumahan,
            "fasilitas_perumahan" => $data_fasilitas
        ];

        return $data;
    }

    // Get All Fasilitas By ID Perumahan
    public static function getFasilitas($id_perumahan)
    {
        // Tabel - Tabel
        $fasilitas = 'fasilitas_perumahan';
        $perumahan = 'perumahan';

        // Get data perumahan
        $data_perumahan = DB::table($perumahan)->where('id_perumahan', $id_perumahan)->first();

        // Cek apakah ada data perumahan
        if(!$data_perumahan)
            return 'NOT_FOUND';

        // Get all data fasilitas by id perumahan
        $data_fasilitas = DB::table($fasilitas)
                                    ->select("$fasilitas.id_fasilitas_perumahan", "$fasilitas.nama_fasilitas_perumahan")
                                    ->where('id_perumahan', $id_perumahan)
                                    ->orderBy('id_fasilitas_perumahan', 'desc')
                                    ->get();

        // Gabungkan semua hasil proses ke dalam 1 variabel
        $data = [
            "id_perumahan" => $id_perumahan,
            "fasilitas_perumahan" => $data_fasilitas
        ];

        return $data;
    }

    // Delete Fasilitas By ID Perumahan
    public static function deleteFasilitas($id_perumahan, $id_fasilitas)
    {
        // Tabel - Tabel
        $fasilitas = 'fasilitas_perumahan';
        $perumahan = 'perumahan';

        // Get data perumahan dan fasilitas
        $data_perumahan = DB::table($perumahan)->where('id_perumahan', $id_perumahan)->first();
        $data_fasilitas = DB::table($fasilitas)
                                    ->where([
                                            "id_perumahan" => $id_perumahan,
                                            "id_fasilitas_perumahan" => $id_fasilitas
                                    ])
                                    ->first();

        // Cek apakah ada data perumahan dan fasilitas ditemukan
        if(!$data_perumahan || !$data_fasilitas)
            return 'NOT_FOUND';

        // Proses delete
        $delete = DB::table($fasilitas)
                    ->where([
                            "id_perumahan" => $id_perumahan,
                            "id_fasilitas_perumahan" => $id_fasilitas
                        ])
                    ->delete();
       
        if($delete)
        {
            $data = [
                "id_fasilitas_perumahan" => $data_fasilitas->id_fasilitas_perumahan
            ];
    
            return $data;
        }
        else 
            return null;
    }
}
