<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Form extends Model
{
    use HasApiTokens, HasFactory;
    protected $table = 'form_data_perumahan';
    protected $primaryKey = 'id_form_data_perumahan';

    // Get All Form Data Perumahan
    public static function getAllForm()
    {
        // Tabel - Tabel
        $form = 'form_data_perumahan';
        $pengembang = 'pengembang';

        // Get current user untuk mendapatkan data pengembang sekarang
        $user = Auth::user();

        // Get pengembang sekarang
        $data_pengembang = DB::table($pengembang)
            ->where('id_user', $user->id)
            ->first();

        // Get all form by id pengembang
        $id_pengembang = $data_pengembang->id_pengembang;
        $data_form = DB::table($form)
            ->where('id_pengembang', $id_pengembang)
            ->orderBy('id_form_data_perumahan', 'DESC')
            ->get();

        // Cek apakah ada data form
        if ($data_form)
            return $data_form;
        else
            return null;
    }

    // Get Form Data Perumahan By ID
    public static function getForm($id_form)
    {
        // Tabel - Tabel
        $pengembang = 'pengembang';
        $form = 'form_data_perumahan';

        // Get current user untuk mencari akun pengembang sekarang
        $user = Auth::user();

        // Get pengembang sekarang
        $data_pengembang = DB::table($pengembang)
            ->where('id_user', $user->id)
            ->first();

        // Get data brosur by id
        $data_form = DB::table($form)
            ->where([
                ['id_pengembang', '=', $data_pengembang->id_pengembang],
                ['id_form_data_perumahan', '=', $id_form]
            ])
            ->first();

        // Cek apakah ada data brosur ditemukan
        if ($data_form)
            return $data_form;
        else
            return null;
    }

    // Add Form Data Perumahan
    public static function addForm($req)
    {
        // Tabel - Tabel
        $form = 'form_data_perumahan';
        $pengembang = 'pengembang';

        // Get current user untuk mendapatkan akun pengembang sekarang
        $user = Auth::user();

        // Get akun pengembang sekarang
        $data_pengembang = DB::table($pengembang)
            ->where('id_user', $user->id)
            ->first();

        // Cek Apakah ada file form / Validasi ekstensi file apakah sesuai dengan ext_allowed
        if ($req->hasFile('form_data_perumahan')) {
            $ext_allowed = $req->ext_allowed;
            foreach ($req->form_data_perumahan as $b) {
                $ext_file = $b->extension();
                if (!in_array($ext_file, $ext_allowed)) {
                    return 'WRONG_EXTENSION';
                }
            }
        }
        // Akhir validasi

        // Proses tambah data form
        foreach ($req->form_data_perumahan as $f) {

            // Sanitize nama file
            $file_name = pathinfo($f->getClientOriginalName(), PATHINFO_FILENAME);
            $file_ext = pathinfo($f->getClientOriginalName(), PATHINFO_EXTENSION);
            $sanitize = Str::of($file_name)->slug('-');
            $sanitize = $sanitize . '.' . $file_ext;

            // Simpan file ke storage
            $ff = $f->storeAs("pengembang/form", rand(0, 9999) . '-' . date('Ymd') . '-' . $sanitize);

            $data_form = [
                "id_pengembang" => $data_pengembang->id_pengembang,
                "file" => $ff
            ];

            // Insert Data form ke Database
            DB::table($form)->insert($data_form);
        }

        // Tampilkan form hasil proses tambah
        $data_form = DB::table($form)
            ->where('id_pengembang', $data_pengembang->id_pengembang)
            ->orderBy('id_form_data_perumahan', 'DESC')
            ->get();

        return $data_form;
    }

    // Update Form Data Perumahan By ID
    public static function updateForm($req, $id_form)
    {
    }

    // Delete Form Data Perumahan By ID
    public static function deleteForm($id_form)
    {
        // Tabel - Tabel
        $form = 'form_data_perumahan';
        $pengembang = 'pengembang';

        // Get current user untuk mendapatkan data pengembang sekarang
        $user = Auth::user();

        // Get data pengembang sekarang
        $data_pengembang = DB::table($pengembang)
            ->where('id_user', $user->id)
            ->first();

        // Get data form
        $data_form = DB::table($form)
            ->where('id_form_data_perumahan', $id_form)
            ->first();

        // Cek apakah data form ditemukan
        if (!$data_form)
            return 'NOT_FOUND';

        // Proses delete
        $id_pengembang = $data_pengembang->id_pengembang;
        $delete = DB::table($form)
            ->where([
                ['id_form_data_perumahan', '=', $id_form],
                ['id_pengembang', '=', $id_pengembang]
            ])
            ->delete();

        // Cek apakah proses delete berhasil
        if ($delete) {
            // Hapus file form yang ada di storage
            $path = $data_form->file;
            Storage::delete($path);

            return $data_form;
        } else
            return null;
    }
}
