<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Properti extends Model
{
    use HasFactory;

    protected $table = 'bangunan';

    public static function getAllProperties($limit)
    {
        // Tabel - tabel
        $tbl_bangunan = 'bangunan';
        $tbl_foto = "foto_bangunan";

        $data_bangunan = DB::table($tbl_bangunan)
            ->where('status_publish', '=', '1')
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
}
