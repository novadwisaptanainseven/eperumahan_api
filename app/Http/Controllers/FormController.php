<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    // Get All Form Master
    public function getAllFormMaster(Request $req)
    {
        // Pagination
        $req->page = ($req->page) ? $req->page : '1';
        $req->per_page = ($req->per_page) ? $req->per_page : '8';
        $req->order = ($req->order) ? $req->order : 'desc';
        // End Pagination

        $form = Form::getAllFormMaster($req);

        // $form = Form::all();

        if (count($form) > 0) {
            return response()->json([
                "message" => "Get all form master data, Berhasil",
                "data"    => $form
            ], 200);
        } else {
            return response()->json([
                "message" => "Belum ada form master data",
                "data"    => $form
            ], 200);
        }
    }

    // Add Form Master
    public function addFormMaster(Request $request)
    {
        $message = [
            'required' => ':attribute belum ada file'
        ];

        $validator = Validator::make($request->all(), [
            'formulir' => "required|max:5048|mimes:pdf"
        ], $message);

        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors()
            ], 400);
        }

        // Jika validasi berhasil lakukan proses di bawah ini
        // Tambah form master data
        $tambah = Form::addFormMaster($request);

        // Cek apakah proses tambah berhasil
        if ($tambah) {
            // Jika berhasil, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Tambah form master data, Berhasil",
                "data"    => $tambah
            ], 201);
        } else if ($tambah === null) {
            // Jika file form belum diinput, tampilkan response 400 BAD REQUEST
            return response()->json([
                "message" => "File formulir belum diinput!"
            ], 400);
        } else {
            // Jika gagal, tampilkan response 500 INTERNAL SERVER ERROR
            return response()->json([
                "message" => "Tambah form master data, Gagal",
                "data"    => $tambah
            ], 500);
        }
    }

    // Update Status Active Form Master By ID
    public function updateStatusActive(Request $request, $id_form)
    {
        $status = $request->status_active;

        $form = Form::updateStatusActive($status, $id_form);

        // Cek apakah data ada dan berhasil diupdate
        if ($form) {
            // Jika iya, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Update status aktif form master data dengan id: $id_form, Berhasil",
                "data"    => $form
            ], 201);
        } else {
            // Jika tidak, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Gagal Update, Data Tidak Ditemukan"
            ], 404);
        }
    }

    // Delete Form Master By ID
    public function deleteFormMaster($id_form)
    {
        $delete = Form::deleteFormMaster($id_form);

        // Cek apakah proses delete berhasil
        if ($delete !== 'NOT_FOUND') {
            // Jika berhasil, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Delete form master data dengan id form: $id_form, Berhasil",
                "data_deleted" => $delete
            ], 201);
        } else if ($delete === 'NOT_FOUND') {
            // Jika form master data tidak ditemukan, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Delete form master data Gagal. Data Tidak Ditemukan"
            ], 404);
        } else {
            // Jika gagal, tampilkan response 500 INTERNAL SERVER ERROR
            return response()->json([
                "message" => "Delete form master data Gagal. Terjadi Kesalahan Internal Server"
            ], 500);
        }
    }

    // Get All Form Pengembang
    public function getAllFormPengembang(Request $request)
    {
        // Pagination
        $request->page = ($request->page) ? $request->page : '1';
        $request->per_page = ($request->per_page) ? $request->per_page : '8';
        $request->order = ($request->order) ? $request->order : 'desc';
        // End Pagination

        $form = Form::getAllFormPengembang($request);

        // Cek Apakah properti ada isinya
        return response()->json([
            "message"    => "Get All Formulir Pengembang, Berhasil",
            "data"       => $form
        ], 200);
    }

    // Get All Form Data Perumahan
    public function getAllForm()
    {
        $form = Form::getAllForm();

        // Cek apakah ada data brosur
        if (count($form) > 0) {
            // Jika ada, tampilkan response 200 OK
            return response()->json([
                "message" => "Get all form data perumahan, Berhasil",
                "data"    => $form,
            ], 200);
        } else {
            // Jika tidak ada, tetap tampilkan response 200 OK dengan ketrangang
            return response()->json([
                "message" => "Belum ada form data perumahan",
                "data"    => $form
            ], 200);
        }
    }

    // Get Form Data Perumahan By ID
    public function getForm($id_form)
    {
        // Get form data perumahan
        $form = Form::getForm($id_form);

        // Cek apakah ada data form data perumahan
        if ($form) {
            // Jika ada, tampilkan response 200 OK
            return response()->json([
                "message" => "Get form data perumahan dengan id form: $id_form, Berhasil",
                "data"    => $form
            ], 200);
        } else {
            // Jika tidak ada, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Form data perumahan dengan id form: $id_form, Tidak Ditemukan"
            ], 404);
        }
    }

    // Get Form Admin By ID
    public function getFormAdminById($id_form)
    {
        // Get form data perumahan
        $form = Form::getFormAdminById($id_form);

        // Cek apakah ada data form data perumahan
        if ($form) {
            // Jika ada, tampilkan response 200 OK
            return response()->json([
                "message" => "Get form data perumahan dengan id form: $id_form, Berhasil",
                "data"    => $form
            ], 200);
        } else {
            // Jika tidak ada, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Form data perumahan dengan id form: $id_form, Tidak Ditemukan"
            ], 404);
        }
    }

    // Add Form Data Perumahan
    public static function addForm(Request $request)
    {
        // Validation
        $message = [
            'required' => ':attribute belum ada file'
        ];
        $validator = Validator::make($request->all(), [
            'form_data_perumahan' => "required|max:5048"
        ], $message);

        // Set ekstensi file yang diizinkan untuk upload brosur
        $request->ext_allowed = ['pdf', 'docx', 'doc', 'xlsx', 'xls'];

        // Cek validasi
        if ($validator->fails()) {
            // Jika validasi gagal, tampilkan response 400 BAD REQUEST
            return response()->json([
                "errors" => $validator->errors()
            ], 400);
        }

        // End Validation

        // Jika validasi berhasil lakukan proses di bawah ini
        // Tambah form data perumahan
        $tambah = Form::addForm($request);

        // Cek apakah proses tambah berhasil
        if ($tambah === 'WRONG_EXTENSION') {
            // Jika ekstensi file yang dimasukkan tidak diizinkan, tampilkan response 400 BAD REQUEST
            return response()->json([
                "message" => "Ekstensi file harus bertipe pdf!",
                "status_response" => "400 BAD REQUEST"
            ], 400);
        } else if ($tambah !== 'NOT_FOUND') {
            // Jika berhasil, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Tambah form data perumahan, Berhasil",
                "data"    => $tambah
            ], 201);
        } else if ($tambah === 'NOT_FOUND') {
            // Jika data bangunan tidak ditemukan, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Data properti tidak ditemukan!"
            ], 404);
        } else {
            // Jika gagal, tampilkan response 500 INTERNAL SERVER ERROR
            return response()->json([
                "message" => "Tambah form data perumahan, Gagal",
                "data"    => $tambah
            ], 500);
        }
    }

    // Update Form Data Perumahan By ID
    public static function updateForm(Request $request, $id_form)
    {
        return response()->json([
            "message" => "Update form data perumahan dengan id form: $id_form, Berhasil"
        ], 201);
    }

    // Delete Form Data Perumahan By ID
    public static function deleteForm($id_form)
    {
        $delete = Form::deleteForm($id_form);

        // Cek apakah proses delete berhasil
        if ($delete !== 'NOT_FOUND') {
            // Jika berhasil, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Delete form data perumahan dengan id form: $id_form, Berhasil",
                "data_deleted" => $delete
            ], 201);
        } else if ($delete === 'NOT_FOUND') {
            // Jika form data perumahan tidak ditemukan, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Delete form data perumahan Gagal. Data Tidak Ditemukan"
            ], 404);
        } else {
            // Jika gagal, tampilkan response 500 INTERNAL SERVER ERROR
            return response()->json([
                "message" => "Delete form data perumahan Gagal. Terjadi Kesalahan Internal Server"
            ], 500);
        }
    }
}
