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

        if(count($data_pengembang) == 0)
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
            ->where(['id_pengembang' => $id_pengembang])
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

        $pengembang->ijin_perusahaan = ($req->ijin !== '') ? "/api/$req->ijin" : $pengembang->ijin_perusahaan;
        $pengembang->foto_pengembang = ($req->foto !== '') ? "/api/$req->foto" : $pengembang->foto_pengembang;

        $pengembang->save();

        return $pengembang;
    }

    // Soft Deleted
    public static function softDelete($id_pengembang)
    {
        $pengembang = DB::table('pengembang')
            ->where('id_pengembang', $id_pengembang)
            ->update(['status_deleted' => 1]);

        if ($pengembang)
            return true;
        else
            return null;
    }
}
