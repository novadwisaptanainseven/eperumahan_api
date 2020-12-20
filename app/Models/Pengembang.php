<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
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
            ->orderBy('id_pengembang', $order)
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

    // Update Pengembang
    public static function updatePengembang($req, $pengembang)
    {
        $pengembang->nik_pengembang  = ($req->nik_pengembang) ? $req->nik_pengembang : $pengembang->nik_pengembang;
        $pengembang->nama_pengembang = ($req->nama_pengembang) ? $req->nama_pengembang : $pengembang->nama_pengembang;
        $pengembang->telepon_pengembang = ($req->telepon_pengembang) ? $req->telepon_pengembang : $pengembang->telepon_pengembang;
        $pengembang->alamat_pengembang = ($req->alamat_pengembang) ? $req->alamat_pengembang : $pengembang->alamat_pengembang;
        $pengembang->email_pengembang = ($req->email_pengembang) ? $req->email_pengembang : $pengembang->email_pengembang;

        // Pembuatan Slug
        // Dapatkan data terakhir di tabel pengembang
        $slug                           = Str::of($pengembang->id_pengembang + 1 . ' ' . $pengembang->nama_pengembang)->slug('-');
        $pengembang->pengembang_slug    = $slug;
        // End Pembuatan Slug

        $pengembang->ijin_perusahaan = ($req->ijin !== '') ? "$req->ijin" : $pengembang->ijin_perusahaan;
        $pengembang->foto_pengembang = ($req->foto !== '') ? "$req->foto" : $pengembang->foto_pengembang;

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
