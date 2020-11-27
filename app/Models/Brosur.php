<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Brosur extends Model
{
    use HasApiTokens, HasFactory;

    protected $table = 'brosur_pengembang';
    protected $primaryKey = 'id_brosur_pengembang';

    // Get Brosur By ID
    public static function getBrosurById($id_brosur)
    {
        // Tabel - Tabel
        $pengembang = 'pengembang';
        $brosur = 'brosur_pengembang';

        // Get current user untuk mencari akun pengembang sekarang
        $user = Auth::user();

        // Get pengembang sekarang
        $data_pengembang = DB::table($pengembang)
            ->where('id_user', $user->id)
            ->first();

        // Get data brosur by id
        $data_brosur = DB::table($brosur)
            ->where([
                ['id_pengembang', '=', $data_pengembang->id_pengembang],
                ['id_brosur_pengembang', '=', $id_brosur]
            ])
            ->first();

        // Cek apakah ada data brosur ditemukan
        if ($data_brosur)
            return $data_brosur;
        else
            return null;
    }

    // Add Brosur
    public static function addBrosur($req)
    {
        // Tabel - Tabel
        $brosur = 'brosur';
        $pengembang = 'pengembang';

        // Get current user untuk mendapatkan akun pengembang sekarang
        $user = Auth::user();

        // Get akun pengembang sekarang
        $data_pengembang = DB::table($pengembang)
            ->where('id_user', $user->id)
            ->first();

        // Cek Apakah ada file brosur / Validasi ekstensi file apakah sesuai dengan ext_allowed
        if ($req->hasFile('brosur_pengembang')) {
            $ext_allowed = $req->ext_allowed;
            foreach ($req->brosur_pengembang as $b) {
                $ext_file = $b->extension();
                if (!in_array($ext_file, $ext_allowed)) {
                    return 'WRONG_EXTENSION';
                }
            }
        }
        // Akhir validasi

        foreach ($req->brosur_pengembang as $b) {
            $bb = $b->storeAs("pengembang/brosur", rand(0, 9999) . '-' . date('Ymd') . '-' . $b->getClientOriginalName());

            $data_brosur = [
                "id_pengembang" => $data_pengembang->id_pengembang,
                "brosur_pengembang" => $bb
            ];

            // Insert Data Foto Perumahan ke Database
            DB::table($brosur)->insert($data_brosur);
        }

        // Tampilkan brosur hasil proses tambah
        $data_brosur = DB::table($brosur)
            ->orderBy('id_brosur_pengembang', 'DESC')
            ->get();

        return $data_brosur;
    }
}
