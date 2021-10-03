<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Pengembang extends Model
{
    use HasApiTokens, HasFactory;
    protected $table = 'pengembang';
    protected $primaryKey = 'id_pengembang';

    // Search Pengembang By Value
    public static function searchPengembangByValue($search_value)
    {
        // Tabel - tabel
        $pengembang = 'pengembang';

        $data_pengembang = DB::table($pengembang)
            ->where([
                ['status_deleted', '=', 0],
                ['nama_pengembang', 'like', "%$search_value%"]
            ])
            ->orWhere([
                ['status_deleted', '=', 0],
                ['nama_perusahaan', 'like', "%$search_value%"]
            ])
            ->orWhere([
                ['status_deleted', '=', 0],
                ['telepon_pengembang', 'like', "%$search_value%"]
            ])
            ->orWhere([
                ['status_deleted', '=', 0],
                ['email_pengembang', 'like', "%$search_value%"]
            ])
            ->orWhere([
                ['status_deleted', '=', 0],
                ['alamat_pengembang', 'like', "%$search_value%"]
            ])
            ->get();

        if (count($data_pengembang) === 0) {
            $total_data_pencarian = 0;
            $data_pengembang = null;
        } else {
            $total_data_pencarian = count($data_pengembang);
        }

        $data = [
            "total_data" => ($total_data_pencarian !== 0) ? count($data_pengembang) : 0,
            "data" => $data_pengembang
        ];

        return $data;
    }

    // Get All Pengembang
    public static function getAll($req)
    {
        // Tabel - Tabel 
        $pengembang = 'pengembang';

        $page = intval($req->page);
        $per_page = intval($req->per_page);
        $order = $req->order;

        $total = DB::table($pengembang)
            ->where([
                'status_deleted' => 0
            ])
            ->orderBy('id_pengembang', 'DESC')
            ->get()
            ->count();

        // Pagination
        $offset = ($page - 1) * $per_page;
        $last_page = ceil($total / $per_page);

        $data_pengembang = DB::table($pengembang)
            ->where('status_deleted', 0)
            ->offset($offset)
            ->limit($per_page)
            // ->orderBy('id_pengembang', $order)
            ->orderBy('status_aktif', $order)
            ->get();
        // End Pagination

        if (count($data_pengembang) == 0)
            $data_pengembang = "Data Tidak Tersedia";

        $data = [
            "total_data"   => $total,
            "per_page"     => $per_page,
            "current_page" => $page,
            "last_page"    => $last_page,
            "order"        => $order,
            "data"         => $data_pengembang
        ];

        return $data;
    }
    // Get All Pengembang
    public static function getAll2($limit)
    {
        // Tabel - Tabel 
        $tbl_pengembang = 'pengembang';

        $data_pengembang = DB::table($tbl_pengembang)
            ->where('status_aktif', '=', '1')
            ->orderBy('id_pengembang', 'DESC')
            ->limit($limit)
            ->get();

        if ($data_pengembang) {
            return $data_pengembang;
        } else {
            return null;
        }
    }

    // Get List Pengembang
    public static function getAll3()
    {
        // Tabel - Tabel 
        $tbl_pengembang = 'pengembang';

        $data_pengembang = DB::table($tbl_pengembang)
            ->where('status_aktif', '=', '1')
            ->get();

        return $data_pengembang;
    }

    // Get Pengembang By ID
    public static function getById($id_pengembang)
    {
        // Tabel - Tabel
        $pengembang = 'pengembang';
        $user       = 'users';

        $data_pengembang = DB::table($pengembang)
            ->select("$pengembang.*", "$user.username")
            ->where([
                ["$pengembang.status_deleted", '=', 0],
                ['id_pengembang', '=', $id_pengembang]
            ])
            ->leftJoin($user, "$user.id", "=", "$pengembang.id_user")
            ->first();

        if ($data_pengembang)
            return $data_pengembang;
        else
            return null;
    }

    // Get Pengembang By Slug
    public static function getBySlug($slug)
    {
        // Tabel - Tabel
        $pengembang = 'pengembang';
        $tbl_perumahan = 'perumahan';
        $tbl_bangunan = 'bangunan';
        $tbl_foto_perumahan = 'foto_perumahan';
        $tbl_foto_bangunan = 'foto_bangunan';
        $tblKategori = "kategori";

        $data_pengembang = DB::table($pengembang)
            ->where([
                ["$pengembang.status_deleted", '=', 0],
                ['pengembang_slug', '=', $slug]
            ])
            ->first();

        if (!$data_pengembang) {
            return null;
        }

        // Get Perumahan by Id Pengembang
        $perumahan = Perumahan::where([
            ["id_pengembang", "=", $data_pengembang->id_pengembang],
            ["status_perumahan", "=", 2],
        ])
            ->leftJoin($tblKategori, "$tblKategori.id_kategori", "=", "$tbl_perumahan.id_kategori")
            ->get();
        $rumahMbr = Perumahan::where([
            ["id_pengembang", "=", $data_pengembang->id_pengembang],
            ["status_perumahan", "=", 2],
            ["id_kategori", "=", 1],
        ])
            ->get()->count();
        $rumahKomersial = Perumahan::where([
            ["id_pengembang", "=", $data_pengembang->id_pengembang],
            ["status_perumahan", "=", 2],
            ["id_kategori", "=", 2],
        ])
            ->get()->count();
        $rumahCampuran = Perumahan::where([
            ["id_pengembang", "=", $data_pengembang->id_pengembang],
            ["status_perumahan", "=", 2],
            ["id_kategori", "=", 3],
        ])
            ->get()->count();

        foreach ($perumahan as $p) {
            $fotoPerumahan = DB::table($tbl_foto_perumahan)
                ->where([
                    ["id_perumahan", "=", $p->id_perumahan],
                    ["status_foto", "=", 1],
                ])
                ->first();
            $totProperti = DB::table($tbl_bangunan)
                ->where("id_perumahan", $p->id_perumahan)
                ->get()
                ->count();
            $p->foto_perumahan = $fotoPerumahan ? $fotoPerumahan->foto_perumahan : "";
            $p->jumlah_properti = $totProperti;
        }
        // End of Perumahan

        // Get Properti by Id Pengembang
        $properti = DB::table($tbl_bangunan)
            ->where([
                ["id_pengembang", "=", $data_pengembang->id_pengembang],
                ["status_publish", "=", 2],
            ])
            ->leftJoin($tblKategori, "$tblKategori.id_kategori", "=", "$tbl_bangunan.id_kategori")
            ->get();
        foreach ($properti as $p) {
            $fotoProperti = DB::table($tbl_foto_bangunan)
                ->where([
                    ["id_bangunan", "=", $p->id_bangunan],
                    ["level_foto", "=", 1],
                ])
                ->first();
            $p->foto_bangunan = $fotoProperti ? $fotoProperti->foto_bangunan : "";
        }
        // End of Properti

        // Get Brosur by Id Pengembang
        $brosur = Brosur::where("id_pengembang", $data_pengembang->id_pengembang)->get();
        // End of Brosur

        $data_pengembang->perumahan = $perumahan;
        $data_pengembang->tot_rumah = [
            "mbr" => $rumahMbr,
            "komersial" => $rumahKomersial,
            "campuran" => $rumahCampuran,
        ];
        $data_pengembang->properti = $properti;
        $data_pengembang->brosur = $brosur;

        return $data_pengembang;
    }

    // 
    // Update Pengembang
    public static function updatePengembang($req, $pengembang)
    {
        $pengembang->nama_perusahaan  = ($req->nama_perusahaan) ? $req->nama_perusahaan : $pengembang->nama_perusahaan;
        $pengembang->nama_pengembang = ($req->nama_pengembang) ? $req->nama_pengembang : $pengembang->nama_pengembang;
        $pengembang->telepon_pengembang = ($req->telepon_pengembang) ? $req->telepon_pengembang : $pengembang->telepon_pengembang;
        $pengembang->alamat_pengembang = ($req->alamat_pengembang) ? $req->alamat_pengembang : $pengembang->alamat_pengembang;
        $pengembang->email_pengembang = ($req->email_pengembang) ? $req->email_pengembang : $pengembang->email_pengembang;

        // Pembuatan Slug
        // Dapatkan data terakhir di tabel pengembang
        $slug                           = Str::of($pengembang->id_pengembang . ' ' . $pengembang->nama_perusahaan)->slug('-');
        $pengembang->pengembang_slug    = $slug;
        // End Pembuatan Slug

        // Hapus foto lama jika user update foto
        // Get path foto untuk keperluan menghapus file foto di storage
        if ($req->foto !== '') {
            $path_foto = $pengembang->foto_pengembang;
            Storage::delete($path_foto);
        }
        // Hapus file ijin perusahaan lama jika user update file ijin perusahaan
        // Get path file ijin perusahaan untuk keperluan menghapus file di storage
        if ($req->ijin !== '') {
            $path_ijin = $pengembang->ijin_perusahaan;
            Storage::delete($path_ijin);
        }

        $pengembang->ijin_perusahaan = ($req->ijin !== '') ? $req->ijin : $pengembang->ijin_perusahaan;
        $pengembang->foto_pengembang = ($req->foto !== '') ? $req->foto : $pengembang->foto_pengembang;

        $pengembang->save();

        return $pengembang;
    }

    // Soft Deleted
    public static function softDelete($id_pengembang)
    {
        // Tabel - tabel
        $pengembang = 'pengembang';
        $users = 'users';

        // Mencari data pengembang berdasarkan id pengembang
        $data_pengembang = DB::table($pengembang)
            ->where('id_pengembang', '=', $id_pengembang)
            ->first();

        // Cek apakah data pengembang ditemukan
        if (!$data_pengembang)
            return null;

        // Soft delete data user 
        $data_user = DB::table($users)
            ->where('id', '=', $data_pengembang->id_user)
            ->update(['status_deleted' => 1]);

        // Soft delete data pengembang
        $data_pengembang = DB::table($pengembang)
            ->where('id_pengembang', $id_pengembang)
            ->update(['status_deleted' => 1]);

        if ($pengembang)
            return true;
        else
            return null;
    }

    // Update status aktif pengemban
    public static function updateStatusPengembang($id_pengembang, $status_aktif)
    {
        // Tabel - tabel
        $pengembang = 'pengembang';

        // Get data pengembang by id
        $data = DB::table($pengembang)
            ->where(['id_pengembang' => $id_pengembang])
            ->first();

        $status_aktif = $status_aktif !== null ? $status_aktif : $data->status_aktif;

        // Cek apakah data pengembang ditemukan
        if (!$data)
            return null;

        // Proses update status_aktif pengembang
        DB::table($pengembang)
            ->where(['id_pengembang' => $id_pengembang])
            ->update(['status_aktif' => $status_aktif]);

        // Tampilkan data hasil update
        $data = DB::table($pengembang)
            ->where(['id_pengembang' => $id_pengembang])
            ->first();

        return $data;
    }
}
