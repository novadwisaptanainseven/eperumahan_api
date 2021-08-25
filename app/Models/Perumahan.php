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
    protected $primaryKey = "id_perumahan";
    protected static $tblKecamatan = "kecamatan";

    // Get All Kecamatan
    public static function getAllKecamatan()
    {
        // Tabel
        $kecamatan = 'kecamatan';

        // Get Data Kecamatan
        $data_kecamatan = DB::table($kecamatan)->get();

        if (count($data_kecamatan) > 0) {
            return $data_kecamatan;
        } else {
            return null;
        }
    }

    // Get Kecamatan By ID
    public static function getKecamatanById($id_kecamatan)
    {
        return DB::table(self::$tblKecamatan)->where("id_kecamatan", $id_kecamatan)->first();
    }

    // Insert Kecamatan
    public static function insertKecamatan($req)
    {
        return DB::table(self::$tblKecamatan)->insert($req->all());
    }

    // Edit Kecamatan
    public static function updateKecamatan($req, $id_kecamatan)
    {
        return DB::table(self::$tblKecamatan)
            ->where("id_kecamatan", $id_kecamatan)
            ->update($req->all());
    }

    // Delete Kecamatan By ID
    public static function deleteKecamatanById($id_kecamatan)
    {
        return DB::table(self::$tblKecamatan)
            ->where("id_kecamatan", $id_kecamatan)
            ->delete();
    }
    // Get All Kelurahan By ID Kecamatan
    public static function getAllKelurahan($id_kecamatan)
    {
        // Tabel
        $kelurahan = 'kelurahan';
        if ($id_kecamatan == '') {
            return 'ID_REQUIRED';
        }

        // Get Data Kecamatan
        $data_kelurahan = DB::table($kelurahan)->where('id_kecamatan', $id_kecamatan)->get();

        if (count($data_kelurahan) > 0) {
            return $data_kelurahan;
        } else {
            return null;
        }
    }

    // GROUP PERUMAHAN

    // Search Perumahan By Value
    public static function searchPerumahanByValue($search_value)
    {
        // Tabel - tabel
        $kelurahan = 'kelurahan';
        $kecamatan = 'kecamatan';
        $pengembang = 'pengembang';
        $perumahan = 'perumahan';
        $bangunan = 'bangunan';

        $data_perumahan = DB::table($perumahan)
            ->select(
                "$perumahan.*",
                "$pengembang.nama_pengembang",
                "$kecamatan.nama_kecamatan",
                "$kelurahan.nama_kelurahan"
            )
            ->where('nama_perumahan', 'like', "%$search_value%")
            ->orWhere('lokasi', 'like', "%$search_value%")
            ->orWhere('nama_pengembang', 'like', "%$search_value%")
            ->leftJoin($pengembang, "$pengembang.id_pengembang", "=", "$perumahan.id_pengembang")
            ->leftJoin($kelurahan, "$kelurahan.id_kelurahan", "=", "$perumahan.id_kelurahan")
            ->leftJoin($kecamatan, "$kecamatan.id_kecamatan", "=", "$perumahan.id_kecamatan")
            ->get();

        if (count($data_perumahan) === 0) {
            $total_data_pencarian = 0;
            $data_perumahan = null;
        } else {
            $total_data_pencarian = count($data_perumahan);
            // Get jumlah bangunan by id perumahan
            foreach ($data_perumahan as $i => $data) {
                $jumlah_properti = DB::table($bangunan)
                    ->where('id_perumahan', $data->id_perumahan)
                    ->get()
                    ->count();
                $data_perumahan[$i++]->jumlah_properti = $jumlah_properti;
            }
        }

        $data = [
            "total_data_pencarian" => ($total_data_pencarian !== 0) ? count($data_perumahan) : 0,
            "data" => $data_perumahan
        ];

        return $data;
    }

    // Search Perumahan Pengembang By Value
    public static function searchPerumahanPengembang($search_value)
    {
        // Tabel - tabel
        $kelurahan = 'kelurahan';
        $kecamatan = 'kecamatan';
        $pengembang = 'pengembang';
        $perumahan = 'perumahan';
        $bangunan = 'bangunan';

        // Get user saat ini
        $user = Auth::user();

        // Get pengembang berdasarkan user saat ini
        $user_pengembang = DB::table($pengembang)
            ->where('id_user', '=', $user->id)
            ->first();

        $data_perumahan = DB::table($perumahan)
            ->select(
                "$perumahan.*",
                "$pengembang.nama_pengembang",
                "$kecamatan.nama_kecamatan",
                "$kelurahan.nama_kelurahan"
            )
            ->where([
                ['nama_perumahan', 'like', "%$search_value%"],
                ["$perumahan.id_pengembang", '=', $user_pengembang->id_pengembang],
            ])
            ->orWhere([
                ['lokasi', 'like', "%$search_value%"],
                ["$perumahan.id_pengembang", '=', $user_pengembang->id_pengembang],
            ])
            ->leftJoin($pengembang, "$pengembang.id_pengembang", "=", "$perumahan.id_pengembang")
            ->leftJoin($kelurahan, "$kelurahan.id_kelurahan", "=", "$perumahan.id_kelurahan")
            ->leftJoin($kecamatan, "$kecamatan.id_kecamatan", "=", "$perumahan.id_kecamatan")
            ->get();

        if (count($data_perumahan) === 0) {
            $total_data_pencarian = 0;
            $data_perumahan = [];
        } else {
            $total_data_pencarian = count($data_perumahan);
            // Get jumlah bangunan by id perumahan
            foreach ($data_perumahan as $i => $data) {
                $jumlah_properti = DB::table($bangunan)
                    ->where('id_perumahan', $data->id_perumahan)
                    ->get()
                    ->count();
                $data_perumahan[$i++]->jumlah_properti = $jumlah_properti;
            }
        }

        $data = [
            "total_data" => ($total_data_pencarian !== 0) ? count($data_perumahan) : 0,
            "data" => $data_perumahan
        ];

        return $data;
    }
    // Add Data Perumahan
    public static function addPerumahan($req)
    {
        // Tabel - Tabel
        $perumahan = 'perumahan';
        $kelurahan = 'kelurahan';
        $kecamatan = 'kecamatan';
        $pengembang = 'pengembang';
        $foto_perumahan = 'foto_perumahan';
        $sarana_prasarana = 'sarana_prasarana_perumahan';
        $fasilitas = 'fasilitas_perumahan';

        // Get pengembang
        $user = Auth::user();
        $data_pengembang = DB::table($pengembang)->where(['id_user' => $user->id])->first();

        // Cek Apakah ada file foto / Validasi ekstensi file apakah sesuai dengan ext_allowed
        $foto = [];
        if (!$req->hasFile('foto_perumahan'))
            $foto = '';
        else {
            $images = $req->file('foto_perumahan');
            foreach ($images as $image) {
                $ext_allowed = $req->ext_allowed;
                $ext_file = $image->extension();
                if (!in_array($ext_file, $ext_allowed)) {
                    return 'WRONG_EXTENSION';
                }
            }
        }
        // Akhir validasi

        // Cek Apakah ada file legalitas
        if (!$req->hasFile('legalitas'))
            $legalitas = '';
        else {

            $file = $req->file('legalitas');

            // Sanitize nama file
            $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $file_ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $sanitize = Str::of($file_name)->slug('-');
            $sanitize = $sanitize . '.' . $file_ext;

            $legalitas = $file->storeAs("perumahan/file", rand(0, 9999) . '-' . date('Ymd') . '-' . $sanitize);
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
            "status_perumahan"    => 0,
            "status_deleted"      => 0
        ];
        // Insert Data Perumahan to Database
        $cek_insert = DB::table($perumahan)->insert($data_perumahan);

        // Persiapan Data Foto
        $get_latest_id_perumahan = DB::table($perumahan)->orderBy('id_perumahan', 'DESC')->first()->id_perumahan;
        $i = 0;
        $status = 0;
        foreach ($req->foto_perumahan as $foto) {

            // Sanitize nama file
            $file_name = pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME);
            $file_ext = pathinfo($foto->getClientOriginalName(), PATHINFO_EXTENSION);
            $sanitize = Str::of($file_name)->slug('-');
            $sanitize = $sanitize . '.' . $file_ext;

            $f = $foto->storeAs("perumahan/foto", rand(0, 9999) . '-' . date('Ymd') . '-' . $sanitize);

            // Request foto pertama akan menjadi status utama
            if ($i == 0)
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
        foreach ($req->sarana_prasarana_perumahan as $s) {
            $data_sarana = [
                "id_perumahan" => $get_latest_id_perumahan,
                "nama_sarana_prasarana_perumahan" => $s
            ];
            // Insert Data Sarana Prasarana ke Database
            DB::table($sarana_prasarana)->insert($data_sarana);
        }

        // Persiapan Data Fasilitas
        foreach ($req->fasilitas_perumahan as $f) {
            $data_fasilitas = [
                "id_perumahan" => $get_latest_id_perumahan,
                "nama_fasilitas_perumahan" => $f
            ];
            // Insert Data Fasilitas ke Database
            DB::table($fasilitas)->insert($data_fasilitas);
        }

        $getPerumahan = DB::table($perumahan)
            ->where('id_perumahan', $get_latest_id_perumahan)
            ->leftJoin($kelurahan, "$kelurahan.id_kelurahan", "=", "$perumahan.id_kelurahan")
            ->leftJoin($kecamatan, "$kecamatan.id_kecamatan", "=", "$perumahan.id_kecamatan")
            ->first();
        $getFoto      = DB::table($foto_perumahan)->where('id_perumahan', $get_latest_id_perumahan)->get();
        $getFasilitas = DB::table($fasilitas)->where('id_perumahan', $get_latest_id_perumahan)->get();
        $getSarana    = DB::table($sarana_prasarana)->where('id_perumahan', $get_latest_id_perumahan)->get();

        if ($cek_insert) {
            // Gabungkan Semua Data untuk ditampilkan pada response
            $getPerumahan->foto_perumahan = $getFoto;
            $getPerumahan->sarana_prasarana_perumahan = $getSarana;
            $getPerumahan->fasilitas_perumahan = $getFasilitas;

            return $getPerumahan;
        } else
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
        if ($data_perumahan) {
            // Jika ada, lakukan proses update

            // Persiapan data perumahan

            // Cek apakah ada file legalitas
            if (!$req->hasFile('legalitas')) {
                $legalitas = $data_perumahan->legalitas;
            } else {
                $file = $req->file('legalitas');

                // Hapus file legalitas lama jika user update file legalitas
                // Get path file legalitas untuk keperluan menghapus file legalitas di storage
                $path_legalitas = $data_perumahan->legalitas;
                Storage::delete("$path_legalitas");

                // Sanitize nama file
                $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $file_ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                $sanitize = Str::of($file_name)->slug('-');
                $sanitize = $sanitize . '.' . $file_ext;

                $legalitas = $file->storeAs("perumahan/file", rand(0, 9999) . '-' . date('Ymd') . '-' . $sanitize);
            }

            // Lakukan Proses Tambah Data
            // Pembuatan Slug
            $slug                = Str::of($data_perumahan->id_perumahan . ' ' . $req->nama_perumahan)->slug('-');
            // End Pembuatan Slug

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
                'slug' => $slug
            ];
            // Update data in database
            DB::table($perumahan)->where('id_perumahan', $id_perumahan)->update($data);

            $data_perumahan = DB::table($perumahan)
                ->where('id_perumahan', $id_perumahan)
                ->leftJoin($kelurahan, "$kelurahan.id_kelurahan", "=", "$perumahan.id_kelurahan")
                ->leftJoin($kecamatan, "$kecamatan.id_kecamatan", "=", "$perumahan.id_kecamatan")
                ->first();
            return $data_perumahan;
        } else {
            return null;
        }
    }

    // Get All Perumahan Level Admin
    public static function getAll($req)
    {
        // Tabel - Tabel
        $perumahan = 'perumahan';
        $bangunan = 'bangunan';
        $pengembang = 'pengembang';
        $kelurahan = 'kelurahan';
        $kecamatan = 'kecamatan';

        // Inisialisasi Pagination
        $page = intval($req->page);
        $per_page = intval($req->per_page);
        $order = $req->order;

        // Get total data
        $total = DB::table($perumahan)
            ->leftJoin($pengembang, "$perumahan.id_pengembang", '=', "$pengembang.id_pengembang")
            ->leftJoin($kelurahan, "$kelurahan.id_kelurahan", "=", "$perumahan.id_kelurahan")
            ->leftJoin($kecamatan, "$kecamatan.id_kecamatan", "=", "$perumahan.id_kecamatan")
            ->get()
            ->count();

        // Pagination
        $offset = ($page - 1) * $per_page;
        $last_page = ceil($total / $per_page);

        $data_perumahan = DB::table($perumahan)
            // ->where("$perumahan.status_deleted", 0)
            ->leftJoin($pengembang, "$perumahan.id_pengembang", '=', "$pengembang.id_pengembang")
            ->leftJoin($kelurahan, "$kelurahan.id_kelurahan", "=", "$perumahan.id_kelurahan")
            ->leftJoin($kecamatan, "$kecamatan.id_kecamatan", "=", "$perumahan.id_kecamatan")
            ->offset($offset)
            ->limit($per_page)
            ->orderBy("$perumahan.status_perumahan", $order)
            ->get();
        // End Pagination

        // Cek apakah data perumahan ada isinya
        if (count($data_perumahan) <= 0)
            $data_perumahan = "Data Tidak Tersedia";

        $nomor = $offset;
        // Get jumlah bangunan by id perumahan
        foreach ($data_perumahan as $i => $data) {
            $jumlah_properti = DB::table($bangunan)
                ->where([
                    ['id_perumahan', '=', $data->id_perumahan],
                    ['status_deleted', '=', 0],
                ])
                ->get()
                ->count();
            $data_perumahan[$i++]->jumlah_properti = $jumlah_properti;
            $nomor = $nomor + 1;
            $data->no = $nomor;
        }

        $data_perumahan->jumlah_properti = $jumlah_properti;

        //  Get data belum konfirmasi
        $belum_konfirmasi = DB::table($perumahan)
            ->where(["status_perumahan" => 0])
            ->count();

        $data = [
            "total_data"   => $total,
            "total_sudah_konfirmasi" => $total - $belum_konfirmasi,
            "total_belum_konfirmasi" => $belum_konfirmasi,
            "per_page"     => $per_page,
            "current_page" => $page,
            "last_page"    => $last_page,
            "order"        => $order,
            "data"         => $data_perumahan
        ];

        return $data;
    }

    // Get All Perumahan Level Pengembang
    public static function getAllPerumahan($req)
    {
        // Tabel - Tabel
        $perumahan = 'perumahan';
        $pengembang = 'pengembang';
        $kelurahan = 'kelurahan';
        $kecamatan = 'kecamatan';
        $bangunan = 'bangunan';

        // Get data pengembang sekarang berdasarkan current user
        $user = Auth::user();
        $data_pengembang = DB::table($pengembang)
            ->where('id_user', $user->id)
            ->first();

        // Inisialisasi Pagination
        $page = intval($req->page);
        $per_page = intval($req->per_page);
        $order = $req->order;

        // Get total data
        $total = DB::table($perumahan)
            ->where("$perumahan.id_pengembang", $data_pengembang->id_pengembang)
            ->get()
            ->count();

        // Pagination
        $offset = ($page - 1) * $per_page;
        $last_page = $per_page != 0 ? ceil($total / $per_page) : 1;
        $limit = $per_page != 0 ? $per_page : $total;

        $data_perumahan = DB::table($perumahan)
            ->where("$perumahan.id_pengembang", $data_pengembang->id_pengembang)
            ->leftJoin($kelurahan, "$kelurahan.id_kelurahan", "=", "$perumahan.id_kelurahan")
            ->leftJoin($kecamatan, "$kecamatan.id_kecamatan", "=", "$perumahan.id_kecamatan")
            ->offset($offset)
            ->limit($limit)
            ->orderBy("$perumahan.id_perumahan", $order)
            ->get();
        // End Pagination

        // Cek apakah data perumahan ada isinya
        // if (count($data_perumahan) == 0) {

        //     $data_perumahan = "Data Tidak Tersedia";
        // }

        // Get jumlah bangunan by id perumahan
        $jumlah_properti = 0;
        foreach ($data_perumahan as $i => $data) {
            $jumlah_properti = DB::table($bangunan)
                ->where([
                    ['id_perumahan', '=', $data->id_perumahan],
                    ['status_deleted', '=', 0],
                ])
                ->get()
                ->count();
            $data_perumahan[$i++]->jumlah_properti = $jumlah_properti;
        }

        $data_perumahan->jumlah_properti = $jumlah_properti;


        //  Get data belum konfirmasi
        $belum_konfirmasi = DB::table($perumahan)
            ->where([
                ['id_pengembang', '=', $data_pengembang->id_pengembang],
                ['status_perumahan', '=', 0],
                ['status_deleted', '=', 0]
            ])
            ->count();

        $data = [
            "id_pengembang"          => $data_pengembang->id_pengembang,
            "nama_pengembang"        => $data_pengembang->nama_pengembang,
            "total_data"             => $total,
            "total_sudah_konfirmasi" => $total - $belum_konfirmasi,
            "total_belum_konfirmasi" => $belum_konfirmasi,
            "per_page"               => $per_page,
            "current_page"           => $page,
            "last_page"              => $last_page,
            "order"                  => $order,
            "data"                   => $data_perumahan
        ];

        return $data;
    }

    // Get Data Perumahan By ID
    public static function getById($id_perumahan)
    {
        // Tabel - tabel
        $sarana_prasarana_perumahan = "sarana_prasarana_perumahan";
        $fasilitas_perumahan = "fasilitas_perumahan";
        $foto_perumahan = "foto_perumahan";

        // Get Data Fasilitas
        $fasilitas = DB::table($fasilitas_perumahan)
            ->where(['id_perumahan' => $id_perumahan])
            ->get();

        // Get Data Sarana Prasarana
        $sarana_prasarana = DB::table($sarana_prasarana_perumahan)
            ->where(['id_perumahan' => $id_perumahan])
            ->get();

        // Get Foto Perumahan
        $foto = DB::table($foto_perumahan)
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
            $perumahan->fasilitas_perumahan = $fasilitas;
            $perumahan->sarana_prasarana_perumahan = $sarana_prasarana;
            $perumahan->foto_perumahan = $foto;
            return $perumahan;
        } else
            return null;
    }

    // Get Data Perumahan By ID Pengembang
    public static function getPerumahanByIdPengembang($id_pengembang)
    {
        // Tabel - tabel
        $tbl_perumahan = 'perumahan';
        $tbl_kecamatan = 'kecamatan';
        $tbl_kelurahan = 'kelurahan';
        $foto_perumahan = "foto_perumahan";
        $tbl_sarana_prasarana = "sarana_prasarana_perumahan";
        $tbl_fasilitas = "fasilitas_perumahan";
        $tbl_pengembang = "pengembang";
        $tbl_bangunan = 'bangunan';

        // Cek Id Pengembang
        $pengembang = DB::table($tbl_pengembang)
            ->where('id_pengembang', '=', $id_pengembang)
            ->first();
        if (!$pengembang) {
            return null;
        }

        // Get Data Perumahan
        $perumahan = DB::table($tbl_perumahan)
            ->where([
                ["$tbl_perumahan.id_pengembang", '=', $id_pengembang],
                ["$tbl_perumahan.status_perumahan", '=', "2"]
            ])
            ->leftJoin($tbl_kecamatan, "$tbl_perumahan.id_kecamatan", '=', "$tbl_kecamatan.id_kecamatan")
            ->leftJoin($tbl_kelurahan, "$tbl_perumahan.id_kelurahan", '=', "$tbl_kelurahan.id_kelurahan")
            ->orderBy("$tbl_perumahan.id_perumahan", 'DESC')
            ->get();

        if (count($perumahan) > 0) {

            foreach ($perumahan as $data) {
                // Get Foto Perumahan
                $foto = DB::table($foto_perumahan)
                    ->where([
                        ['id_perumahan', '=', $data->id_perumahan],
                        ['status_foto', '=', "1"]
                    ])
                    ->first();

                // Get Sarana Prasarana
                $sarana_prasarana = DB::table($tbl_sarana_prasarana)
                    ->where('id_perumahan', '=', $data->id_perumahan)
                    ->get();

                // Get Fasilitas
                $fasilitas = DB::table($tbl_fasilitas)
                    ->where('id_perumahan', '=', $data->id_perumahan)
                    ->get();

                // Get Total Properti
                $jumlah_bangunan = DB::table($tbl_bangunan)
                    ->where('id_perumahan', '=', $data->id_perumahan)
                    ->get()
                    ->count();

                $data->foto_perumahan = $foto->foto_perumahan;
                $data->sarana_prasarana = $sarana_prasarana;
                $data->fasilitas = $fasilitas;
                $data->jumlah_bangunan = $jumlah_bangunan;
            }

            return $perumahan;
        } else {
            return [];
        }
    }

    // Update Status Perumahan By ID
    public static function updateStatusById($id_perumahan, $status)
    {
        // Tabel - tabel
        $perumahan = 'perumahan';

        // Get data perumahan by id
        $data = DB::table($perumahan)
            ->where(['id_perumahan' => $id_perumahan])
            ->first();

        $status = $status !== null ? $status : $data->status_perumahan;

        // Cek apakah data perumahan ditemukan
        if (!$data)
            return null;

        // Proses update status perumahan
        DB::table($perumahan)
            ->where(['id_perumahan' => $id_perumahan])
            ->update(['status_perumahan' => $status]);

        // Tampilkan data hasil update
        $data = DB::table($perumahan)
            ->where(['id_perumahan' => $id_perumahan])
            ->first();

        return $data;
    }

    // Get Data Perumahan By ID
    public static function getPerumahanBySlug($slug)
    {
        // Tabel - tabel
        $sarana_prasarana_perumahan = "sarana_prasarana_perumahan";
        $fasilitas_perumahan = "fasilitas_perumahan";
        $foto_perumahan = "foto_perumahan";
        $tbl_bangunan = 'bangunan';
        $tbl_foto_bangunan = 'foto_bangunan';
        $tbl_perumahan = 'perumahan';
        $tbl_pengembang = 'pengembang';
        $tbl_kelurahan = 'kelurahan';
        $tbl_kecamatan = 'kecamatan';

        // Get Data Perumahan
        $perumahan = DB::table($tbl_perumahan)
            ->select(
                "$tbl_perumahan.*",
                "$tbl_kelurahan.*",
                "$tbl_kecamatan.*",
                "$tbl_pengembang.nama_pengembang",
                "$tbl_pengembang.email_pengembang",
                "$tbl_pengembang.telepon_pengembang",
                "$tbl_pengembang.pengembang_slug",
                "$tbl_pengembang.foto_pengembang",
            )
            ->where(['slug' => $slug])
            ->leftJoin($tbl_kecamatan, "$tbl_perumahan.id_kecamatan", '=', "$tbl_kecamatan.id_kecamatan")
            ->leftJoin($tbl_kelurahan, "$tbl_perumahan.id_kelurahan", '=', "$tbl_kelurahan.id_kelurahan")
            ->leftJoin($tbl_pengembang, "$tbl_perumahan.id_pengembang", '=', "$tbl_pengembang.id_pengembang")
            ->first();

        if ($perumahan) {
            // Get Data Bangunan
            $bangunan = DB::table($tbl_bangunan)
                ->where('id_perumahan', '=', $perumahan->id_perumahan)
                ->get();

            foreach ($bangunan as $data) {
                // Get Foto Bangunan
                $foto_bangunan = DB::table($tbl_foto_bangunan)
                    ->where([
                        ['id_bangunan', '=', $data->id_bangunan],
                        ['level_foto', '=', '1']
                    ])
                    ->first();
                $data->foto_bangunan = $foto_bangunan->foto_bangunan;
            }

            // Get Data Fasilitas
            $fasilitas = DB::table($fasilitas_perumahan)
                ->where(['id_perumahan' => $perumahan->id_perumahan])
                ->get();

            // Get Data Sarana Prasarana
            $sarana_prasarana = DB::table($sarana_prasarana_perumahan)
                ->where(['id_perumahan' => $perumahan->id_perumahan])
                ->get();

            // Get Foto Perumahan
            $foto = DB::table($foto_perumahan)
                ->where(['id_perumahan' => $perumahan->id_perumahan])
                ->orderBy('status_foto', 'DESC')
                ->get();
            // Gabungkan semua hasil pencarian data dengan id yang sama
            $perumahan->fasilitas_perumahan = $fasilitas;
            $perumahan->sarana_prasarana_perumahan = $sarana_prasarana;
            $perumahan->foto_perumahan = $foto;
            $perumahan->bangunan = $bangunan;
            return $perumahan;
        } else
            return null;
    }

    // GROUP PERUMAHAN / PROPERTI

    // Add Properti By ID Perumahan
    public static function addProperti($req, $id_perumahan)
    {
        // Tabel - Tabel
        $perumahan = 'perumahan';
        $pengembang = 'pengembang';
        $foto_bangunan = 'foto_bangunan';
        $spesifikasi = 'spesifikasi_rumah';
        $bangunan = 'bangunan';
        $kelurahan = 'kelurahan';
        $kecamatan = 'kecamatan';

        // Get Data Perumahan by ID Perumahan
        $data_perumahan = DB::table($perumahan)->where('id_perumahan', $id_perumahan)->first();

        // Get data pengembang yang sedang aktif sekarang
        $user = Auth::user();
        $data_pengembang = DB::table($pengembang)->where('id_user', $user->id)->first();

        // Cek apakah ada data perumahan
        if (!$data_perumahan)
            return 'NOT_FOUND';

        // Proses tambah data properti / bangunan
        // Persiapan data

        // Cek apakah ada file foto
        if ($req->hasFile('foto_bangunan')) {
            $path_foto = [];
            foreach ($req->foto_bangunan as $foto) {
                $ext_allowed = $req->ext_allowed;
                $ext_file = $foto->extension();
                if (!in_array($ext_file, $ext_allowed)) {
                    return 'WRONG_EXTENSION';
                }
            }
        }

        // Pembuatan Slug
        $last_data           = DB::table($bangunan)->orderBy('id_bangunan', 'DESC')->first();
        $bangunan_slug       = Str::of($last_data->id_bangunan + 1 . ' ' . $req->nama_bangunan)->slug('-');
        // End Pembuatan Slug

        $data_bangunan = [
            "id_perumahan"       => $id_perumahan,
            "id_pengembang"      => $data_pengembang->id_pengembang,
            "id_kecamatan"       => $data_perumahan->id_kecamatan,
            "id_kelurahan"       => $data_perumahan->id_kelurahan,
            "lokasi_bangunan"    => $data_perumahan->lokasi,
            "longitude"          => $data_perumahan->longitude,
            "latitude"           => $data_perumahan->latitude,
            "nama_bangunan"      => $req->nama_bangunan,
            "kategori_bangunan"  => $req->kategori_bangunan,
            "tipe_bangunan"      => $req->tipe_bangunan,
            "deskripsi_bangunan" => $req->deskripsi_bangunan,
            "harga_bangunan"     => $req->harga_bangunan,
            "jumlah_tersedia"    => $req->jumlah_tersedia,
            "luas_bangunan"      => $req->luas_bangunan,
            "luas_tanah"         => $req->luas_tanah,
            "dimensi_bangunan"   => $req->dimensi_bangunan,
            "dimensi_tanah"      => $req->dimensi_tanah,
            "jumlah_lantai"      => $req->jumlah_lantai,
            "jumlah_kamar"       => $req->jumlah_kamar,
            "jumlah_kamar_mandi" => $req->jumlah_kamar_mandi,
            "jumlah_garasi"      => $req->jumlah_garasi,
            "listrik"            => $req->listrik,
            "bangunan_slug"      => $bangunan_slug,
            "sertifikat"         => '',
            "status_publish"     => 0
        ];

        // Insert data bangunan to database
        $tambah = DB::table($bangunan)->insert($data_bangunan);

        // Cek apakah proses tambah data berhasil
        if ($tambah) {
            // Jika berhasil, lakukan proses tambah foto dan spesifikasi

            // Get id bangunan terbaru
            $id_bangunan = DB::table($bangunan)->orderBy('id_bangunan', 'DESC')->first()->id_bangunan;

            // Foto Bangunan
            $i = 0;
            $status = 0;
            $path_foto = [];
            foreach ($req->foto_bangunan as $foto) {
                if ($i == 0)
                    $status = 1;
                else
                    $status = 0;

                // Sanitize nama file
                $file_name = pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME);
                $file_ext = pathinfo($foto->getClientOriginalName(), PATHINFO_EXTENSION);
                $sanitize = Str::of($file_name)->slug('-');
                $sanitize = $sanitize . '.' . $file_ext;

                $path = $foto->storeAs("bangunan/foto", rand(0, 9999) . '-' . date('Ymd') . '-' . $sanitize);
                $path_foto[] = $path;

                $data_foto = [
                    "id_bangunan" => $id_bangunan,
                    "foto_bangunan" => $path,
                    "level_foto" => $status
                ];

                // Insert Data Foto Bangunan ke Database
                DB::table($foto_bangunan)->insert($data_foto);
                $i++;
            }

            // Spesifikasi Rumah
            foreach ($req->spesifikasi_rumah as $spek) {
                $data_spek = [
                    "id_bangunan" => $id_bangunan,
                    "nama_spesifikasi_rumah" => $spek,
                ];

                // Insert Data Spesifikasi ke database
                DB::table($spesifikasi)->insert($data_spek);
            }

            // Get data bangunan terbaru
            $data_bangunan = DB::table($bangunan)
                ->where('id_bangunan', $id_bangunan)
                ->leftJoin($kelurahan, "$kelurahan.id_kelurahan", "=", "$bangunan.id_kelurahan")
                ->leftJoin($kecamatan, "$kecamatan.id_kecamatan", "=", "$bangunan.id_kecamatan")
                ->first();


            $data_spek = $req->spesifikasi_rumah;
            $data_foto = $path_foto;

            // Gabungkan semua data untuk ditampilkan dalam response
            $data_bangunan->spesifikasi_rumah = $data_spek;
            $data_bangunan->foto_bangunan = $data_foto;

            return $data_bangunan;
        } else {
            null;
        }
    }

    // Get All Properti
    public static function getAllProperti($req)
    {
        // Tabel - Tabel
        $bangunan   = 'bangunan';
        $pengembang = 'pengembang';
        $kelurahan  = 'kelurahan';
        $kecamatan  = 'kecamatan';

        // Inisialisasi Pagination
        $page = intval($req->page);
        $per_page = intval($req->per_page);
        $order = $req->order;

        // Get total data
        $total = DB::table($bangunan)
            ->leftJoin($pengembang, "$bangunan.id_pengembang", "=", "$pengembang.id_pengembang")
            ->leftJoin($kelurahan, "$bangunan.id_kelurahan", "=", "$kelurahan.id_kelurahan")
            ->leftJoin($kecamatan, "$bangunan.id_kecamatan", "=", "$kecamatan.id_kecamatan")
            ->get()
            ->count();

        // Pagination
        $offset = ($page - 1) * $per_page;
        $last_page = $per_page != 0 ? ceil($total / $per_page) : 1;
        $limit = $per_page != 0 ? $per_page : $total;

        $data_bangunan = DB::table($bangunan)
            // ->where("$bangunan.status_deleted", 0)
            ->leftJoin($pengembang, "$bangunan.id_pengembang", "=", "$pengembang.id_pengembang")
            ->leftJoin($kelurahan, "$bangunan.id_kelurahan", "=", "$kelurahan.id_kelurahan")
            ->leftJoin($kecamatan, "$bangunan.id_kecamatan", "=", "$kecamatan.id_kecamatan")
            ->offset($offset)
            ->limit($limit)
            // ->orderBy("$bangunan.id_bangunan", $order)
            ->orderBy("$bangunan.status_publish", $order)
            ->get();
        // End Pagination

        // Cek apakah data perumahan ada isinya
        if (count($data_bangunan) == 0)
            $data_bangunan = "Data Tidak Tersedia";

        $properti_belum_konfirmasi = DB::table($bangunan)
            ->where(["status_publish" => 0])
            ->count();

        $data = [
            "total_data"   => $total,
            "total_sudah_konfirmasi" => $total - $properti_belum_konfirmasi,
            "total_belum_konfirmasi" => $properti_belum_konfirmasi,
            "per_page"     => $per_page,
            "current_page" => $page,
            "last_page"    => $last_page,
            "order"        => $order,
            "data"         => $data_bangunan
        ];

        // Cek Apakah properti ada isinya
        return $data;
    }

    // Get All Properti By ID Perumahan
    public static function getAllPropertiById($req, $id_perumahan)
    {
        // Tabel - Tabel
        $bangunan   = 'bangunan';
        $perumahan  = 'perumahan';
        $pengembang = 'pengembang';

        // Inisialisasi Pagination
        $page = intval($req->page);
        $per_page = intval($req->per_page);
        $order = $req->order;

        // Get data perumahan
        $data_perumahan = DB::table($perumahan)
            ->where('id_perumahan', $id_perumahan)
            ->first();
        // Cek apakah ada data perumahan
        if (!$data_perumahan)
            return 'NOT_FOUND';


        // Get total data
        $total = DB::table($bangunan)
            ->where("id_perumahan", $id_perumahan)
            ->get()
            ->count();

        // Pagination
        $offset = ($page - 1) * $per_page;
        $last_page = $per_page != 0 ? ceil($total / $per_page) : 1;
        $limit = $per_page != 0 ? $per_page : $total;

        // Mengambil data properti berdasarkan ID Perumahan
        $data_bangunan = DB::table($bangunan)
            ->where(['id_perumahan' => $id_perumahan])
            ->offset($offset)
            ->limit($limit)
            ->orderBy('id_bangunan', $order)
            ->get();
        // End Pagination

        // Cek apakah data perumahan ada isinya
        if (count($data_bangunan) == 0)
            $data_bangunan = "Data Tidak Tersedia";

        // Mengambil Data Perumahan berdasarkan ID Perumahan
        $data_perumahan = DB::table($perumahan)
            ->select("$perumahan.id_perumahan", "$perumahan.nama_perumahan", "$pengembang.id_pengembang", "$pengembang.nama_pengembang")
            ->where(['id_perumahan' => $id_perumahan])
            ->leftJoin("$pengembang", "$perumahan.id_pengembang", '=', "$pengembang.id_pengembang")
            ->first();

        $data = [
            "total_data"   => $total,
            "per_page"     => $per_page,
            "current_page" => $page,
            "last_page"    => $last_page,
            "order"        => $order,
            "data"         => $data_bangunan
        ];

        // Gabungkan hasil pencarian data
        $data_perumahan->bangunan = $data;

        return $data_perumahan;
    }

    // Search Properti By ID Perumahan
    public static function searchPropertiByIdPerumahan($id_perumahan, $search_value)
    {
        // Tabel - tabel
        $bangunan = 'bangunan';
        $kelurahan = 'kelurahan';
        $kecamatan = 'kecamatan';
        $pengembang = 'pengembang';
        $perumahan = 'perumahan';

        $data_perumahan = DB::table($perumahan)
            ->where('id_perumahan', $id_perumahan)
            ->first();

        if (!$data_perumahan)
            return "Data Tidak Tersedia, data perumahan dengan id: $id_perumahan, Tidak Ditemukan";


        $data_bangunan = DB::table($bangunan)
            ->select(
                "$bangunan.*",
                "$pengembang.nama_pengembang",
                "$kecamatan.nama_kecamatan",
                "$kelurahan.nama_kelurahan"
            )

            ->where([
                ["$perumahan.id_perumahan", '=', $id_perumahan],
                ['nama_bangunan', 'like', "%$search_value%"]
            ])
            ->orWhere([
                ["$perumahan.id_perumahan", '=', $id_perumahan],
                ['kategori_bangunan', 'like', "%$search_value%"]
            ])
            ->orWhere([
                ["$perumahan.id_perumahan", '=', $id_perumahan],
                ['nama_pengembang', 'like', "%$search_value%"]
            ])
            ->orWhere([
                ["$perumahan.id_perumahan", '=', $id_perumahan],
                ['harga_bangunan', 'like', "%$search_value%"]
            ])
            ->orWhere([
                ["$perumahan.id_perumahan", '=', $id_perumahan],
                ['jumlah_tersedia', 'like', "%$search_value%"]
            ])
            ->leftJoin($pengembang, "$pengembang.id_pengembang", "=", "$bangunan.id_pengembang")
            ->leftJoin($kelurahan, "$kelurahan.id_kelurahan", "=", "$bangunan.id_kelurahan")
            ->leftJoin($kecamatan, "$kecamatan.id_kecamatan", "=", "$bangunan.id_kecamatan")
            ->leftJoin($perumahan, "$perumahan.id_perumahan", "=", "$bangunan.id_perumahan")
            ->get();


        if (count($data_bangunan) === 0) {
            $total_data_pencarian = 0;
            $data_bangunan = "Data Tidak Tersedia";
        } else {
            $total_data_pencarian = count($data_bangunan);
        }

        $data = [
            "total_data_pencarian" => ($total_data_pencarian !== 0) ? count($data_bangunan) : 0,
            "nama_perumahan" => $data_perumahan->nama_perumahan,
            "data" => $data_bangunan
        ];

        return $data;
    }

    // Search Properti
    public static function searchProperti($search_value)
    {
        // Tabel - tabel
        $bangunan = 'bangunan';
        $kelurahan = 'kelurahan';
        $kecamatan = 'kecamatan';
        $pengembang = 'pengembang';
        $perumahan = 'perumahan';

        $data_bangunan = DB::table($bangunan)
            ->select(
                "$bangunan.*",
                "$pengembang.nama_pengembang",
                "$kecamatan.nama_kecamatan",
                "$kelurahan.nama_kelurahan"
            )
            ->where('nama_bangunan', 'like', "%$search_value%")
            ->orWhere('kategori_bangunan', 'like', "%$search_value%")
            ->orWhere('nama_pengembang', 'like', "%$search_value%")
            ->orWhere('harga_bangunan', 'like', "%$search_value%")
            ->orWhere('jumlah_tersedia', 'like', "%$search_value%")
            ->leftJoin($pengembang, "$pengembang.id_pengembang", "=", "$bangunan.id_pengembang")
            ->leftJoin($kelurahan, "$kelurahan.id_kelurahan", "=", "$bangunan.id_kelurahan")
            ->leftJoin($kecamatan, "$kecamatan.id_kecamatan", "=", "$bangunan.id_kecamatan")
            ->leftJoin($perumahan, "$perumahan.id_perumahan", "=", "$bangunan.id_perumahan")
            ->get();

        if (count($data_bangunan) === 0) {
            $total_data_pencarian = 0;
            $data_bangunan = "Data Tidak Tersedia";
        } else {
            $total_data_pencarian = count($data_bangunan);
        }

        $data = [
            "total_data_pencarian" => ($total_data_pencarian !== 0) ? count($data_bangunan) : 0,
            "data" => $data_bangunan
        ];

        return $data;
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

    // Update Properti By ID
    public static function updatePropertiById($req, $id_perumahan, $id_bangunan)
    {
        // Tabel - Tabel
        $perumahan = 'perumahan';
        $pengembang = 'pengembang';
        $bangunan = 'bangunan';
        $kelurahan = 'kelurahan';
        $kecamatan = 'kecamatan';

        // Get Data Perumahan by ID Perumahan
        $data_perumahan = DB::table($perumahan)->where('id_perumahan', $id_perumahan)->first();

        // Get data pengembang yang sedang aktif sekarang
        $user = Auth::user();
        $data_pengembang = DB::table($pengembang)->where('id_user', $user->id)->first();

        // Get data bangunan sebelum diupdate
        $data_bangunan = DB::table($bangunan)
            ->where([
                "id_perumahan" => $id_perumahan,
                "id_bangunan"  => $id_bangunan
            ])
            ->first();

        // Cek apakah ada data perumahan
        if (!$data_perumahan)
            return 'NOT_FOUND';

        // Proses update data properti / bangunan
        // Persiapan data

        // Pembuatan Slug
        $bangunan_slug       = Str::of($data_bangunan->id_bangunan . ' ' . ($req->nama_bangunan !== null ? $req->nama_bangunan : $data_bangunan->nama_bangunan))->slug('-');
        // End Pembuatan Slug

        $data = [
            "nama_bangunan"      => ($req->nama_bangunan !== null) ? $req->nama_bangunan : $data_bangunan->nama_bangunan,
            "kategori_bangunan"  => ($req->kategori_bangunan !== null) ? $req->kategori_bangunan : $data_bangunan->kategori_bangunan,
            "tipe_bangunan"      => ($req->tipe_bangunan !== null) ? $req->tipe_bangunan : $data_bangunan->tipe_bangunan,
            "deskripsi_bangunan" => ($req->deskripsi_bangunan !== null) ? $req->deskripsi_bangunan : $data_bangunan->deskripsi_bangunan,
            "harga_bangunan"     => ($req->harga_bangunan !== null) ? $req->harga_bangunan : $data_bangunan->harga_bangunan,
            "jumlah_tersedia"    => ($req->jumlah_tersedia !== null) ? $req->jumlah_tersedia : $data_bangunan->jumlah_tersedia,
            "luas_bangunan"      => ($req->luas_bangunan !== null) ? $req->luas_bangunan : $data_bangunan->luas_bangunan,
            "luas_tanah"         => ($req->luas_tanah !== null) ? $req->luas_tanah : $data_bangunan->luas_tanah,
            "dimensi_bangunan"   => ($req->dimensi_bangunan !== null) ? $req->dimensi_bangunan : $data_bangunan->dimensi_bangunan,
            "dimensi_tanah"      => ($req->dimensi_tanah !== null) ? $req->dimensi_tanah : $data_bangunan->dimensi_tanah,
            "jumlah_lantai"      => ($req->jumlah_lantai !== null) ? $req->jumlah_lantai : $data_bangunan->jumlah_lantai,
            "jumlah_kamar"       => ($req->jumlah_kamar !== null) ? $req->jumlah_kamar : $data_bangunan->jumlah_kamar,
            "jumlah_kamar_mandi" => ($req->jumlah_kamar_mandi !== null) ? $req->jumlah_kamar_mandi : $data_bangunan->jumlah_kamar_mandi,
            "jumlah_garasi"      => ($req->jumlah_garasi !== null) ? $req->jumlah_garasi : $data_bangunan->jumlah_garasi,
            "listrik"            => ($req->listrik !== null) ? $req->listrik : $data_bangunan->listrik,
            "bangunan_slug"      => $bangunan_slug,
            "status_publish"     => $data_bangunan->status_publish
        ];

        // Insert data bangunan to database
        $update = DB::table($bangunan)
            ->where([
                "id_perumahan" => $id_perumahan,
                "id_bangunan"  => $id_bangunan
            ])
            ->update($data);

        // Get data bangunan setelah update
        $data_bangunan = DB::table($bangunan)
            ->where('id_bangunan', $id_bangunan)
            ->leftJoin($kelurahan, "$kelurahan.id_kelurahan", "=", "$bangunan.id_kelurahan")
            ->leftJoin($kecamatan, "$kecamatan.id_kecamatan", "=", "$bangunan.id_kecamatan")
            ->first();

        if ($data_bangunan)
            return $data_bangunan;
        else
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
        // Cek apakah data bangunan ditemukan
        if (!$data)
            return null;

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

    // GROUP PERUMAHAN / PROPERTI / SPESIFIKASI

    // Add Spesifikasi Properti
    public static function addSpesifikasiProperti($req, $id_perumahan, $id_bangunan)
    {
        // Tabel - Tabel
        $spesifikasi = 'spesifikasi_rumah';
        $bangunan = 'bangunan';
        $perumahan = 'perumahan';

        // Get data perumahan
        $data_perumahan = DB::table($perumahan)->where('id_perumahan', $id_perumahan)->first();

        // Get data bangunan
        $data_bangunan = DB::table($bangunan)->where('id_bangunan', $id_bangunan)->first();

        // Cek apakah ada data perumahan atau data bangunan
        if (!$data_perumahan || !$data_bangunan)
            return 'NOT_FOUND';

        $data_spesifikasi = $req->spesifikasi_rumah;

        // Dilakukan perulangan FOREACH dikarenakan request bertipe Array
        foreach ($data_spesifikasi as $data) {
            // Proses update
            $tambah = DB::table($spesifikasi)->insert([
                "id_bangunan" => $id_bangunan,
                "nama_spesifikasi_rumah" => $data
            ]);

            if (!$tambah)
                return null;
        }

        // Get data spesifikasi rumah setelah ditambahkan
        $data_spesifikasi = DB::table($spesifikasi)
            ->select("$spesifikasi.id_spesifikasi_rumah", "$spesifikasi.nama_spesifikasi_rumah")
            ->where('id_bangunan', $id_bangunan)
            ->orderBy('id_spesifikasi_rumah', 'DESC')
            ->get();

        // Gabungkan semua hasil proses ke dalam 1 variabel
        $data = [
            "id_perumahan" => $id_perumahan,
            "id_bangunan" => $id_bangunan,
            "spesifikasi_rumah" => $data_spesifikasi
        ];

        return $data;
    }

    // Get All Spesifikasi Properti by ID Bangunan
    public static function getSpesifikasiProperti($id_bangunan)
    {
        // Tabel - Tabel
        $spesifikasi = 'spesifikasi_rumah';
        $bangunan = 'bangunan';

        // Get data bangunan
        $data_bangunan = DB::table($bangunan)->where('id_bangunan', $id_bangunan)->first();

        // Cek apakah ada data perumahan atau data bangunan
        if (!$data_bangunan)
            return 'NOT_FOUND';

        // Get id perumahan
        $id_perumahan = $data_bangunan->id_perumahan;

        // Get all data fasilitas by id bangunan
        $data_bangunan = DB::table($spesifikasi)
            ->select("$spesifikasi.id_spesifikasi_rumah", "$spesifikasi.nama_spesifikasi_rumah")
            ->where('id_bangunan', $id_bangunan)
            ->orderBy('id_spesifikasi_rumah', 'desc')
            ->get();

        // Gabungkan semua hasil proses ke dalam 1 variabel
        $data = [
            "id_perumahan" => $id_perumahan,
            "id_bangunan"  => $id_bangunan,
            "spesifikasi_rumah" => $data_bangunan
        ];

        return $data;
    }

    // Delete Spesifikasi Properti
    public static function deleteSpesifikasiProperti($id_bangunan, $id_spesifikasi)
    {
        // Tabel - Tabel
        $spesifikasi = 'spesifikasi_rumah';
        $bangunan = 'bangunan';

        // Get data bangunan dan spesifikasi properti
        $data_bangunan = DB::table($bangunan)->where('id_bangunan', $id_bangunan)->first();
        $data_spesifikasi = DB::table($spesifikasi)
            ->where([
                'id_spesifikasi_rumah' => $id_spesifikasi,
                'id_bangunan' => $id_bangunan
            ])
            ->first();

        if (!$data_bangunan || !$data_spesifikasi)
            return 'NOT_FOUND';

        // Proses delete
        $delete = DB::table($spesifikasi)
            ->where([
                "id_spesifikasi_rumah" => $id_spesifikasi,
                "id_bangunan" => $id_bangunan
            ])
            ->delete();

        if ($delete) {
            $data = [
                "id_spesifikasi_properti" => $data_spesifikasi->id_spesifikasi_rumah
            ];

            return $data;
        } else
            return null;
    }

    // GROUP PERUMAHAN / PROPERTI / FOTO
    public static function getAllFotoBangunan($id_bangunan)
    {
        // Tabel - Tabel
        $foto = 'foto_bangunan';
        $bangunan = 'bangunan';

        // Get Data Perumahan By ID
        $data_bangunan = DB::table($bangunan)->where('id_bangunan', $id_bangunan)->first();

        // Cek apakah ada data Perumahan
        if (!$data_bangunan)
            return 'NOT_FOUND';

        // Get All Foto
        $data_foto = DB::table($foto)->where('id_bangunan', $id_bangunan)->orderBy('level_foto', 'DESC')->get();


        // Cek apakah ada data Foto
        if ($data_foto) {
            $data = [
                "id_perumahan" => $data_bangunan->id_perumahan,
                "id_bangunan" => $data_bangunan->id_bangunan,
                "id_pengembang" => $data_bangunan->id_pengembang,
                "total_foto"    => $data_foto->count(),
                "foto_bangunan" => $data_foto
            ];

            return $data;
        } else
            return null;
    }

    // Add Foto Bangunan
    public static function addFotoBangunan($req, $id_bangunan)
    {
        // Tabel - Tabel
        $foto_bangunan = 'foto_bangunan';
        $bangunan = 'bangunan';

        // Get Bangunan
        $data_bangunan = DB::table($bangunan)->where('id_bangunan', $id_bangunan)->first();

        // Cek apakah ada data bangunan
        if (!$data_bangunan)
            return 'NOT_FOUND';

        // Cek Apakah ada file foto / Validasi apakah sudah sesuai dengan ekstensi yang diizinkan
        if ($req->hasFile('foto_bangunan')) {
            $data_foto = [];
            $status = 0;
            $i = 0;
            $images = $req->file('foto_bangunan');
            foreach ($images as $image) {
                $ext_allowed = $req->ext_allowed;
                $ext_file = $image->extension();
                if (!in_array($ext_file, $ext_allowed)) {
                    return 'WRONG_EXTENSION';
                }
            }
        }

        // Proses tambah foto bangunan
        $path = [];
        foreach ($req->foto_bangunan as $foto) {
            // Sanitize nama file
            $file_name = pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME);
            $file_ext = pathinfo($foto->getClientOriginalName(), PATHINFO_EXTENSION);
            $sanitize = Str::of($file_name)->slug('-');
            $sanitize = $sanitize . '.' . $file_ext;

            // Simpan file ke storage
            $f = $foto->storeAs('bangunan/foto', rand(0, 9999) . '-' . date('Ymd') . '-' . $sanitize);
            $path[] = $f;

            $data = [
                'id_bangunan' => $data_bangunan->id_bangunan,
                'foto_bangunan' => $f,
                'level_foto' => 0
            ];
            // Insert foto to database
            DB::table($foto_bangunan)->insert($data);
        }

        // Tampilkan foto hasil proses tambah
        $data_foto = DB::table($foto_bangunan)
            ->where('id_bangunan', $id_bangunan)
            ->orderBy('id_foto_bangunan', 'DESC')->get();

        return $data_foto;
    }

    // Update Status Utama Foto Bangunan
    public static function updateStatusFotoBangunan($status, $id_bangunan, $id_foto)
    {
        // Tabel - Tabel
        $foto = 'foto_bangunan';
        $bangunan = 'bangunan';

        // Get data bangunan
        $data_bangunan = DB::table($bangunan)->where('id_bangunan', $id_bangunan)->first();

        // Get foto hasil sebelum update status utama
        $data_foto = DB::table($foto)
            ->where([
                'id_bangunan' => $id_bangunan,
                'id_foto_bangunan' => $id_foto
            ])
            ->first();

        // Cek apakah terdapat data bangunan dan foto
        if (!$data_bangunan || !$data_foto)
            return null;

        // Untuk mengatasi error jika status bernilai null
        $status = ($status !== null) ? $status : $data_foto->level_foto;

        // Proses update status foto utama
        DB::table($foto)->where(
            [
                'id_bangunan'      => $id_bangunan,
                'id_foto_bangunan' => $id_foto
            ]
        )
            ->update(['level_foto' => $status]);

        // Setelah update status utama foto dengan id yang bersangkutan
        // Maka perlu mengupdate semua status foto menjadi 0 karena status utama tidak boleh lebih dari 2 foto
        if ($status == 1) {
            DB::table($foto)->where([
                ['id_bangunan', '=', $id_bangunan],
                ['id_foto_bangunan', '<>', $id_foto]
            ])
                ->update(['level_foto' => 0]);
        }

        // Get foto hasil setelah update status utama
        $data_foto = DB::table($foto)
            ->where([
                'id_bangunan' => $id_bangunan,
                'id_foto_bangunan' => $id_foto
            ])
            ->first();

        // Cek apakah ada foto yang ditemukan
        if ($data_foto)
            return $data_foto;
        else
            return null;
    }

    // Delete Foto Bangunan
    public static function deleteFotoBangunan($id_bangunan, $id_foto)
    {
        // Tabel - Tabel
        $foto = 'foto_bangunan';

        // Get data yang akan dihapus
        $data_foto = DB::table($foto)
            ->where([
                "id_bangunan"      => $id_bangunan,
                "id_foto_bangunan" => $id_foto
            ])
            ->first();

        // Cek apakah ada data foto yang ditemukan
        if (!$data_foto) {
            // Jika tidak ada, kembalikan nilai null
            return 'NOT_FOUND';
        }
        // Jika ada, lanjutkan proses dibawah

        // Proses Delete
        DB::table($foto)
            ->where([
                "id_bangunan"      => $id_bangunan,
                "id_foto_bangunan" => $id_foto
            ])
            ->delete();

        // Get path foto untuk keperluan menghapus file foto di storage
        $path_foto = $data_foto->foto_bangunan;

        Storage::delete("$path_foto");

        return true;
    }

    // GROUP PERUMAHAN / FOTO

    // Add Foto Perumahan
    public static function addFotoPerumahan($req, $id_perumahan)
    {
        // Tabel - Tabel
        $tbl_foto_perumahan = 'foto_perumahan';
        $perumahan = 'perumahan';

        // Get data perumahan
        $data_perumahan = DB::table($perumahan)
            ->where('id_perumahan', $id_perumahan)
            ->first();

        // Cek apakah data perumahan ditemukan
        if (!$data_perumahan)
            return 'NOT_FOUND';

        // Cek Apakah ada file foto / Validasi apakah sudah sesuai dengan ekstensi yang diizinkan
        if ($req->hasFile('foto_perumahan')) {
            $data_foto = [];
            $status = 0;
            $i = 0;
            $images = $req->file('foto_perumahan');
            foreach ($images as $image) {
                $ext_allowed = $req->ext_allowed;
                $ext_file = $image->extension();
                if (!in_array($ext_file, $ext_allowed)) {
                    return 'WRONG_EXTENSION';
                }
            }
        }

        $status = 0;
        foreach ($req->foto_perumahan as $foto) {

            // Sanitize nama file
            $file_name = pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME);
            $file_ext = pathinfo($foto->getClientOriginalName(), PATHINFO_EXTENSION);
            $sanitize = Str::of($file_name)->slug('-');
            $sanitize = $sanitize . '.' . $file_ext;

            $f = $foto->storeAs('perumahan/foto', rand(0, 9999) . '-' . date('Ymd') . '-' . $sanitize);

            // Persiapan Data Foto
            $data = [
                "id_perumahan"   => $id_perumahan,
                "foto_perumahan" => $f,
                "status_foto"    => $status
            ];
            // Insert foto to database
            DB::table($tbl_foto_perumahan)->insert($data);
        }


        // Tampilkan foto hasil proses tambah
        $data_foto = DB::table($tbl_foto_perumahan)
            ->where('id_perumahan', $id_perumahan)
            ->orderBy('id_foto_perumahan', 'DESC')->get();

        return $data_foto;
    }

    // Update Status Utama Foto
    public static function updateStatusFoto($status, $id_perumahan, $id_foto)
    {
        // Tabel - Tabel
        $foto = 'foto_perumahan';
        $perumahan = 'perumahan';

        // Get data perumahan
        $data_perumahan = DB::table($perumahan)->where('id_perumahan', $id_perumahan)->first();

        // Get foto hasil sebelum update status utama
        $data_foto = DB::table($foto)
            ->where([
                'id_perumahan' => $id_perumahan,
                'id_foto_perumahan' => $id_foto
            ])
            ->first();

        // Cek apakah data perumahan atau foto ditemuan
        if (!$data_perumahan || !$data_foto)
            return 'NOT_FOUND';

        // Untuk mengatasi error jika status bernilai null
        $status = ($status !== null) ? $status : $data_foto->status_foto;

        // Proses update status foto utama
        DB::table($foto)->where(
            [
                'id_perumahan' => $id_perumahan,
                'id_foto_perumahan' => $id_foto
            ]
        )
            ->update(['status_foto' => $status]);

        // Setelah update status utama foto dengan id yang bersangkutan
        // Maka perlu mengupdate semua status foto menjadi 0 karena status utama tidak boleh lebih dari 2 foto
        if ($status >= 1) {
            DB::table($foto)->where([
                ['id_perumahan', '=', $id_perumahan],
                ['id_foto_perumahan', '<>', $id_foto]
            ])
                ->update(['status_foto' => 0]);
        }

        // Get foto hasil setelah update status utama
        $data_foto = DB::table($foto)
            ->where([
                'id_perumahan' => $id_perumahan,
                'id_foto_perumahan' => $id_foto
            ])
            ->first();

        // Cek apakah ada foto yang ditemukan
        if ($data_foto)
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
        if (!$data_foto) {
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
    public static function getAllFoto($req, $id_perumahan)
    {
        // Tabel - Tabel
        $foto = 'foto_perumahan';
        $perumahan = 'perumahan';

        // Inisialisasi Pagination
        $page = intval($req->page);
        $per_page = intval($req->per_page);
        $order = $req->order;

        // Get Data Perumahan By ID
        $data_perumahan = DB::table($perumahan)->where('id_perumahan', $id_perumahan)->first();

        // Cek apakah ada data Perumahan
        if (!$data_perumahan) {
            return 'NOT_FOUND';
        }

        // Get total data
        $total = DB::table($foto)->where('id_perumahan', $id_perumahan)->get()->count();

        // Pagination
        // $offset = ($page - 1) * $per_page;
        // $last_page = ceil($total / $per_page);

        // Get All Foto
        $data_foto = DB::table($foto)
            ->where('id_perumahan', $id_perumahan)
            // ->offset($offset)
            // ->limit($per_page)
            ->orderBy('status_foto', $order)
            ->get();
        // End Pagination

        // Cek apakah ada data Foto Perumahan
        if (count($data_foto) == 0)
            $data_foto = 'Data Tidak Tersedia';

        $data = [
            "total_data"   => $total,
            // "per_page"     => $per_page,
            // "current_page" => $page,
            // "last_page"    => $last_page,
            "order"        => $order,
            "data"         => $data_foto
        ];

        return $data;
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
        if (!$data_perumahan)
            return 'NOT_FOUND';

        $data_sarana_prasarana = $req->sarana_prasarana_perumahan;

        // Dilakukan perulangan FOREACH dikarenakan request bertipe Array
        foreach ($data_sarana_prasarana as $data) {
            // Proses update
            $tambah = DB::table($sarana_prasarana)->insert([
                "id_perumahan" => $id_perumahan,
                "nama_sarana_prasarana_perumahan" => $data
            ]);

            if (!$tambah)
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
        if (!$data_perumahan)
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
        if (!$data_perumahan || !$data_sarana_prasarana)
            return 'NOT_FOUND';

        // Proses delete
        $delete = DB::table($sarana_prasarana)
            ->where([
                "id_perumahan" => $id_perumahan,
                "id_sarana_prasarana_perumahan" => $id_sarana_prasarana
            ])
            ->delete();

        if ($delete) {
            $data = [
                "id_sarana_prasarana_perumahan" => $data_sarana_prasarana->id_sarana_prasarana_perumahan
            ];

            return $data;
        } else
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
        if (!$data_perumahan)
            return 'NOT_FOUND';

        $data_fasilitas = $req->fasilitas_perumahan;

        // Dilakukan perulangan FOREACH dikarenakan request bertipe Array
        foreach ($data_fasilitas as $data) {
            // Proses update
            $tambah = DB::table($fasilitas)->insert([
                "id_perumahan" => $id_perumahan,
                "nama_fasilitas_perumahan" => $data
            ]);

            if (!$tambah)
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
        if (!$data_perumahan)
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
        if (!$data_perumahan || !$data_fasilitas)
            return 'NOT_FOUND';

        // Proses delete
        $delete = DB::table($fasilitas)
            ->where([
                "id_perumahan" => $id_perumahan,
                "id_fasilitas_perumahan" => $id_fasilitas
            ])
            ->delete();

        if ($delete) {
            $data = [
                "id_fasilitas_perumahan" => $data_fasilitas->id_fasilitas_perumahan
            ];

            return $data;
        } else
            return null;
    }
}
