<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Brosur extends Model
{
    use HasApiTokens, HasFactory;

    protected $table = 'brosur_pengembang';
    protected $primaryKey = 'id_brosur_pengembang';

    // Get All Brosur
    public static function getAllBrosur()
    {
        // Tabel - Tabel
        $brosur = 'brosur_pengembang';
        $pengembang = 'pengembang';

        // Get current user untuk mendapatkan data pengembang sekarang
        $user = Auth::user();

        // Get pengembang sekarang
        $data_pengembang = DB::table($pengembang)
            ->where('id_user', $user->id)
            ->first();

        // Get all brosur by id pengembang
        $id_pengembang = $data_pengembang->id_pengembang;
        $data_brosur = DB::table($brosur)
            ->where('id_pengembang', $id_pengembang)
            ->orderBy('id_brosur_pengembang', 'DESC')
            ->get();

        // Cek apakah ada data brosur
        if ($data_brosur)
            return $data_brosur;
        else
            return null;
    }

    // Get All Brosur Umum
    public static function getAllBrosurUmum()
    {
        // Tabel - Tabel
        $brosur = 'brosur_pengembang';

        $data_brosur = DB::table($brosur)
            ->orderBy('id_brosur_pengembang', 'DESC')
            ->get();

        // Cek apakah ada data brosur
        if ($data_brosur)
            return $data_brosur;
        else
            return null;
    }

    // Get Brosur By ID Pengembang
    public static function getBrosurByIdPengembang($id_pengembang)
    {
        // Tabel - Tabel
        $tbl_brosur = 'brosur_pengembang';

        $data_brosur = DB::table($tbl_brosur)
            ->where('id_pengembang', '=', $id_pengembang)
            ->get();

        if (count($data_brosur) > 0 || $data_brosur) {
            return $data_brosur;
        } else {
            return null;
        }
    }

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
        $brosur = 'brosur_pengembang';
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

        // Proses tambah data brosur
        foreach ($req->brosur_pengembang as $b) {

            // Sanitize nama file
            $file_name = pathinfo($b->getClientOriginalName(), PATHINFO_FILENAME);
            $file_ext = pathinfo($b->getClientOriginalName(), PATHINFO_EXTENSION);
            $sanitize = Str::of($file_name)->slug('-');
            $sanitize = $sanitize . '.' . $file_ext;

            // Simpan file ke storage
            $bb = $b->storeAs("pengembang/brosur", rand(0, 9999) . '-' . date('Ymd') . '-' . $sanitize);

            $data_brosur = [
                "id_pengembang" => $data_pengembang->id_pengembang,
                "brosur_pengembang" => $bb
            ];

            // Insert Data Brosur ke Database
            DB::table($brosur)->insert($data_brosur);
        }

        // Tampilkan brosur hasil proses tambah
        $data_brosur = DB::table($brosur)
            ->where('id_pengembang', $data_pengembang->id_pengembang)
            ->orderBy('id_brosur_pengembang', 'DESC')
            ->get();

        return $data_brosur;
    }

    // Delete Brosur
    public static function deleteBrosur($id_brosur)
    {
        // Tabel - Tabel
        $brosur = 'brosur_pengembang';
        $pengembang = 'pengembang';

        // Get current user untuk mendapatkan data pengembang sekarang
        $user = Auth::user();

        // Get data pengembang sekarang
        $data_pengembang = DB::table($pengembang)
            ->where('id_user', $user->id)
            ->first();

        // Get data brosur
        $data_brosur = DB::table($brosur)
            ->where('id_brosur_pengembang', $id_brosur)
            ->first();

        // Cek apakah data brosur ditemukan
        if (!$data_brosur)
            return 'NOT_FOUND';

        // Proses delete
        $id_pengembang = $data_pengembang->id_pengembang;
        $delete = DB::table($brosur)
            ->where([
                ['id_brosur_pengembang', '=', $id_brosur],
                ['id_pengembang', '=', $id_pengembang]
            ])
            ->delete();

        // Cek apakah proses delete berhasil
        if ($delete) {
            // Hapus file brosur yang ada di storage
            $path = $data_brosur->brosur_pengembang;
            Storage::delete($path);

            return $data_brosur;
        } else
            return null;
    }
}
