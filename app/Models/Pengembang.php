<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class Pengembang extends Model
{
    use HasApiTokens, HasFactory;
    protected $table = 'pengembang';
    protected $primaryKey = 'id_pengembang';

    // Get All Pengembang
    public static function getAll()
    {
        $pengembang = DB::table('pengembang')
            ->where([
                'status_deleted' => 0
            ])
            ->orderBy('id_pengembang', 'DESC')
            ->get();

        return $pengembang;
    }

    // Get Pengembang By ID
    public static function getById($id_pengembang)
    {
        $pengembang = DB::table('pengembang')
            ->where(['id_pengembang' => $id_pengembang])
            ->first();

        if ($pengembang)
            return $pengembang;
        else
            return false;
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
            return false;
    }
}
