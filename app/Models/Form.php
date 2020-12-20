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
    protected $table = 'file_form_data_perumahan';
    protected $primaryKey = 'id_file_form_data_perumahan';

    // GetAllFormMaster
    public static function getAllFormMaster($req)
    {
        // Tabel - Tabel 
        $file_form_data_perumahan = 'file_form_data_perumahan';

        $page = intval($req->page);
        $per_page = intval($req->per_page);
        $order = $req->order;

        $total = DB::table($file_form_data_perumahan)
            ->where([
                'status_deleted' => 0
            ])
            ->orderBy('id_file_form', 'DESC')
            ->get()
            ->count();

        // Pagination
        $offset = ($page - 1) * $per_page;
        $last_page = ceil($total / $per_page);

        $data_file_form_data_perumahan = DB::table($file_form_data_perumahan)
            ->where('status_deleted', 0)
            ->offset($offset)
            ->limit($per_page)
            ->orderBy('id_file_form', $order)
            ->get();
        // End Pagination

        if (count($data_file_form_data_perumahan) == 0)
            $data_file_form_data_perumahan = null;

        $data = [
            "total_data"   => $total,
            "per_page"     => $per_page,
            "current_page" => $page,
            "last_page"    => $last_page,
            "order"        => $order,
            "data"         => $data_file_form_data_perumahan
        ];

        return $data;
    }

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

    // Add Form Master
    public static function addFormMaster($req)
    {
        // Tabel - Tabel
        $form = 'file_form_data_perumahan';

        // Proses tambah data form
        // Sanitize nama file
        if (!$req->hasFile('formulir'))
            return null;

        $f = $req->file('formulir');
        $file_name = pathinfo($f->getClientOriginalName(), PATHINFO_FILENAME);
        $file_ext = pathinfo($f->getClientOriginalName(), PATHINFO_EXTENSION);
        $sanitize = Str::of($file_name)->slug('-');
        $sanitize = $sanitize . '.' . $file_ext;

        // Simpan file ke storage
        $ff = $f->storeAs("admin/form", rand(0, 9999) . '-' . date('Ymd') . '-' . $sanitize);

        $data_form = [
            "file" => $ff
        ];

        // Insert Data form ke Database
        DB::table($form)->insert($data_form);
        // Tampilkan form hasil proses tambah
        $data_form = DB::table($form)
            ->orderBy('id_file_form', 'DESC')
            ->get();

        return $data_form;
    }

    // Update Status Aktive Form Master
    public static function updateStatusActive($status, $id_form)
    {
        // Tabel - Tabel
        $form = 'file_form_data_perumahan';

        // Get data hasil sebelum update status publish
        $data = DB::table($form)
            ->where('id_file_form_data_perumahan', $id_form)
            ->first();
        // Cek apakah data form master ditemukan
        if (!$data)
            return null;

        // Untuk mengatasi error jika status bernilai null
        $status = ($status !== null) ? $status : $data->status_active;

        // Proses Update
        DB::table($form)
            ->where(['id_file_form_data_perumahan' => $id_form])
            ->update(['status_active' => $status]);

        // Get data hasil setelah update status active
        $data = DB::table($form)
            ->where('id_file_form_data_perumahan', $id_form)
            ->first();

        return $data;
    }

    // Delete Form Master By ID
    public static function deleteFormMaster($id_form)
    {
        // Tabel - Tabel
        $form = 'file_form_data_perumahan';

        // Get data form
        $data_form = DB::table($form)
            ->where('id_file_form', $id_form)
            ->first();

        // Cek apakah data form ditemukan
        if (!$data_form)
            return 'NOT_FOUND';

        // Proses delete
        // $delete = DB::table($form)
        //     ->where([
        //         ['id_file_form_data_perumahan', '=', $id_form],
        //     ])
        //     ->delete();
        // Proses soft delete
        $delete = DB::table($form)
            ->where('id_file_form', '=', $id_form)
            ->update([
                'status_deleted' => 1
            ]);

        // Cek apakah proses delete berhasil
        if ($delete) {
            // Hapus file form yang ada di storage
            $path = $data_form->file;
            Storage::delete($path);

            return $data_form;
        } else
            return null;
    }

    // Get All Form Pengembang
    public static function getAllFormPengembang($req)
    {
        // Tabel - Tabel
        $form = 'form_data_perumahan';
        $pengembang = 'pengembang';

        // Inisialisasi Pagination
        $page = intval($req->page);
        $per_page = intval($req->per_page);
        $order = $req->order;

        // Get total data
        $total = DB::table($form)->get()->count();

        // Pagination
        $offset = ($page - 1) * $per_page;
        $last_page = ceil($total / $per_page);

        $data_form = DB::table($form)
            ->select("$form.*", "$pengembang.nama_pengembang")
            ->leftJoin($pengembang, "$pengembang.id_pengembang", "=", "$form.id_pengembang")
            ->offset($offset)
            ->limit($per_page)
            ->orderBy("$form.id_form_data_perumahan", $order)
            ->get();
        // End Pagination

        // Cek apakah form data perumahan ada isinya
        if (count($data_form) <= 0)
            $data_form = "Data Tidak Tersedia";

        $data = [
            "total_data"   => $total,
            "per_page"     => $per_page,
            "current_page" => $page,
            "last_page"    => $last_page,
            "order"        => $order,
            "data"         => $data_form
        ];

        return $data;
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

        // Get data form by id
        $data_form = DB::table($form)
            ->where([
                ['id_pengembang', '=', $data_pengembang->id_pengembang],
                ['id_form_data_perumahan', '=', $id_form]
            ])
            ->first();

        // Cek apakah ada data form ditemukan
        if ($data_form)
            return $data_form;
        else
            return null;
    }

    // Get Form Admin By ID
    public static function getFormAdminById($id_form)
    {
        $form = 'file_form_data_perumahan';

        // Get data form by id
        $data_form = DB::table($form)
            ->where([
                ['id_file_form', '=', $id_form]
            ])
            ->first();

        // Cek apakah ada data form ditemukan
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
