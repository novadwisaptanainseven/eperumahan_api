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
    // Get All Form Data Perumahan
    public function getAllForm()
    {
        $form = Form::getAllForm();

        // Cek apakah ada data brosur
        if (count($form) != 0) {
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
                "message" => "form data perumahan dengan id form: $id_form, Tidak Ditemukan"
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
        $request->ext_allowed = ['pdf'];

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

        return response()->json([
            "message" => "Delete form data perumahan dengan id form: $id_form, Berhasil"
        ], 201);
    }
}
