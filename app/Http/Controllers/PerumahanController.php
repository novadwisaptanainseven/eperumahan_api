<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perumahan;
use App\Models\Pengembang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PerumahanController extends Controller
{
    // GROUP PERUMAHAN

    // Add Data Perumahan 
    public function addPerumahan(Request $request)
    {
        // Validation
        $message = [
            "required" => ":attribute harus diisi",
        ];

        $validator = Validator::make(
            $request->all(),
            [
                "nama_perumahan"      => "required",
                "deskripsi_perumahan" => "required",
                "lokasi"              => "required",
                // 'foto_perumahan'      => 'mimes:jpg,jpeg,png|max:5048',
                'legalitas'           => 'mimes:pdf,xls,xlsx|max:10048',
                "longitude"           => "required",
                "latitude"            => "required",
                "fasilitas_perumahan" => "required",
                "sarana_prasarana_perumahan" => "required",
                "id_kecamatan"        => 'required',
                "id_kelurahan"        => 'required'
            ],
            $message
        );
        // Cek Validasi
        if($validator->fails())
        {
            // Jika Validasi Gagal, tampilkan response 400 BAD REQUEST
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        // Jika Validasi Berhasil, lakukan proses dibawah
        // Proses Tambah Data
        $tambahData = Perumahan::addPerumahan($request); 

        // Cek apakah proses tambah data berhasil
        if($tambahData)
        {
            // Jika berhasil, maka tampilkan response 201 CREATED
            return response()->json([
                "message" => "Tambah Data Perumahan Berhasil",
                "data"    => $tambahData
            ], 201);
        }
        else
        {
            // Jika gagal, maka tampilkan response 500 INTERNAL SERVER ERROR
            return response()->json([
                "message" => "Tambah Data Perumahan Gagal"
            ], 400);
        }
    }

     // Update Data Perumahan By ID
    public function updatePerumahanById(Request $request, $id_perumahan)
    {
        // Validation
        $validator = Validator::make(
            $request->all(),
            [
                "foto_perumahan" => 'mimes:jpg,jpeg,png|max:5048',
                "legalitas"      => 'mimes:pdf,xls,xlsx|max:10048'
            ]
        );
        // Cek Validasi
        if($validator->fails()){
            // Jika Validasi Gagal, maka tampilkan response 400 BAD REQUEST
            return response()->json([
                "errors" => $validator->errors()
            ], 400);
        }
        // Jika Validasi Berhasil, lakukan proses dibawah
        // Proses Update Data
        $updateData = Perumahan::updatePerumahanById($request, $id_perumahan);
        
        // Cek apakah proses update data berhasil
        if($updateData)
        {
            // Jika berhasil, maka tampilkan response 201 CREATED
            return response()->json([
                "message" => "Update Data Perumahan dengan id: $id_perumahan, Berhasil",
                "data"    => $updateData
            ], 201);
        }
        else
        {
             // Jika gagal, maka tampilkan response 404 NOT FOUND
             return response()->json([
                "message" => "Update Data Perumahan Gagal, Data Tidak Ditemukan"
            ], 404);
        }
    }

    // Get Foto Perumahan
    public function getFotoPerumahan($filename)
    {
        return response()->download(storage_path("/app/perumahan/foto/$filename"));
        
    }

     // Get File Legalitas Perumahan
     public function getFileLegalitas($filename)
     {
         return response()->download(storage_path("/app/perumahan/file/$filename"));
         
     }

    // Get All Data Perumahan
    public function getAll()
    {
        $perumahan = Perumahan::getAll();

        return response()->json([
            "message" => "Get All Perumahan Berhasil",
            "total_data"   => $perumahan->total,
            "total_sudah_konfirmasi" => $perumahan->total_sudah_konfirmasi,
            "total_belum_konfirmasi" => $perumahan->total_belum_konfirmasi,
            "data"    => $perumahan
        ]);
    }

    // Get All Perumahan By Pengembang
    public function getAllPerumahan()
    {
        // Get Current User untuk mendapatkan id pengembang
        $user = Auth::user();
        $pengembang = Pengembang::where('id_user', $user->id)->first();

        // Get Perumahan By ID Pengembang
        $perumahan = Perumahan::where('id_pengembang', $pengembang->id_pengembang)->get();

        // Cek apakah pengembang sudah memiliki perumahan
        if($perumahan)
        {
            // Jika sudah, tampilkan response 200 OK
            return response()->json([
                "message" => "Get All Perumahan dari Pengembang: $pengembang->nama_pengembang",
                "data"    => $perumahan
            ], 200);
        }
        else
        {
            // Jika belum, tetap tampilkan response 200 OK dengan alasan
            return response()->json([
                "message" => "Pengembang: $pengembang->nama_pengembang, belum memiliki perumahan",
                "data"    => $perumahan
            ], 200);
        }
    }

    // Get Data Perumahan By ID
    public function getById($id_perumahan)
    {
        $perumahan = Perumahan::getById($id_perumahan);

        // Cek apakah data perumahan ditemukan
        if ($perumahan) {
            // Jika ditemukan, tampilkan response 200
            return response()->json([
                "message" => "Get Perumahan dengan id: $id_perumahan Berhasil",
                "data"    => $perumahan
            ], 200);
        } else {
            // Jika tidak, tampilkan response 404
            return response()->json([
                "message" => "Data Perumahan dengan id: $id_perumahan Tidak Ditemukan",
                "data"    => $perumahan
            ], 404);
        }
    }

    // Update Status Perumahan By ID
    public function updateStatus(Request $request, $id_perumahan)
    {
        $perumahan = Perumahan::updateStatusById($id_perumahan, $request->status_perumahan);

        // Cek Apakah update data berhasil
        if ($perumahan) {
            // Jika berhasil, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Update Status Perumahan dengan id: $id_perumahan Berhasil",
                "data"    => $perumahan
            ], 201);
        } else {
            // Jika gagal, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Data dengan id: $id_perumahan, Tidak Ditemukan",
            ], 404);
        }
    }

    // GROUP PERUMAHAN / PROPERTI

    // Get All Data Properti
    public function getAllProperti()
    {
        $properti = Perumahan::getAllProperti();

        // Cek Apakah properti ada isinya
        if ($properti) {
            return response()->json([
                "message"    => "Get All Properti Berhasil",
                "total_data" => $properti->total,
                "total_sudah_konfirmasi" => $properti->total_sudah_konfirmasi,
                "total_belum_konfirmasi" => $properti->total_belum_konfirmasi,
                "data"       => $properti
            ], 200);
        } else {
            return response()->json([
                "message" => "Properti Belum Memiliki Data",
                "data"    => $properti
            ], 200);
        }
    }

    // Get All Data Properti By ID Perumahan
    public function getAllPropertiById($id_perumahan)
    {
        $properti = Perumahan::getAllPropertiById($id_perumahan);

        return response()->json([
            "message" => "Get All Properti dengan id perumahan: $id_perumahan Berhasil",
            "data"    => $properti
        ], 200);
    }

    public function getPropertiById2($id_bangunan)
    {
        $data_bangunan = Perumahan::getPropertiById($id_bangunan);

        // Cek apakah data bangunan ditemukan
        if ($data_bangunan) {
            // Jika ditemukan, tampilkan response 200 OK
            return response()->json([
                "message" => "Get Data Properti dengan id: $id_bangunan, Berhasil",
                "data"    => $data_bangunan
            ], 200);
        } else {
            // Jika tidak, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Data Properti Tidak Ditemukan"
            ], 404);
        }
    }

    // Get Data Properti/Bangunan By ID
    public function getPropertiById($id_perumahan = '', $id_bangunan)
    {
        $data_bangunan = Perumahan::getPropertiById($id_bangunan);

        // Cek apakah data bangunan ditemukan
        if ($data_bangunan) {
            // Jika ditemukan, tampilkan response 200 OK
            return response()->json([
                "message" => "Get Data Properti dengan id: $id_bangunan dari perumahan: $id_perumahan, Berhasil",
                "data"    => $data_bangunan
            ], 200);
        } else {
            // Jika tidak, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Data Properti Tidak Ditemukan"
            ], 404);
        }
    }

    // Update Status Publish Properti/Bangunan By ID
    public function updateStatusProperti(Request $request, $id_perumahan, $id_bangunan)
    {
        $bangunan = Perumahan::updateStatusProperti($id_bangunan, $request->status_publish);

        // Cek apakah data ada dan berhasil diupdate
        if ($bangunan) {
            // Jika iya, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Update Status Publish Properti dengan id: $id_bangunan dari perumahan: $id_perumahan, Berhasil",
                "data"    => $bangunan
            ], 201);
        } else {
            // Jika tidak, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Gagal Update, Data Tidak Ditemukan"
            ], 201);
        }
    }

    public function updateStatusProperti2(Request $request, $id_bangunan)
    {
        $bangunan = Perumahan::updateStatusProperti($id_bangunan, $request->status_publish);

        // Cek apakah data ada dan berhasil diupdate
        if ($bangunan) {
            // Jika iya, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Update Status Publish Properti dengan id: $id_bangunan, Berhasil",
                "data"    => $bangunan
            ], 201);
        } else {
            // Jika tidak, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Gagal Update, Data Tidak Ditemukan"
            ], 201);
        }
    }

    // Tambah Foto by ID Perumahan
    public function addFotoPerumahan(Request $request, $id_perumahan)
    {
        // Validation 
        $message = [
            "required" => ":attribute belum ada file!"
        ];

        $validator = Validator::make(
            $request->all(),
            [
                
                'foto_perumahan' => 'max:5048|required',
            ],
            $message
        );
        // Cek Validation
        if($validator->fails())
        {
            // Jika validasi gagal, tampilkan response 400 BAD REQUEST
            return response()->json([
                "errors" => $validator->errors()
            ], 400);
        }
        // Jika validasi berhasil, lanjutkan proses di bawah ini

        // Tambah Foto
        $tambahFoto = Perumahan::addFotoPerumahan($request, $id_perumahan);

        // Cek apakah proses tambah berhasil
        if($tambahFoto)
        {
            // Jika berhasil, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Tambah foto dengan id perumahan: $id_perumahan, Berhasil",
                "data"    => $tambahFoto
            ], 201);
        }
        else
        {
            // Jika gagal, tampilkan response 400 BAD REQUEST
            return response()->json([
                "message" => "Tambah foto dengan id perumahan: $id_perumahan, Gagal",
                "data"    => $tambahFoto
            ], 400);
        }
    }

    
    // Update Status Utama Foto Perumahan By ID Foto
    public function updateStatusFoto(Request $request, $id_perumahan, $id_foto)
    {
        return response()->json([
            "message" => "Update status utama foto perumahan: $id_perumahan dengan id foto: $id_foto"
        ]);
    }

    // Delete Foto Perumahan By ID Foto
    public function deleteFoto(Request $request, $id_perumahan, $id_foto)
    {
        return response()->json([
            "message" => "Delete data foto perumahan: $id_perumahan dengan id foto: $id_foto_perumahan, Berhasil"
        ]);
    }

    // Get All Foto Perumahan by ID Perumahan
    public function getAllFoto($id_perumahan)
    {
        return response()->json([
            "message" => "Get All Foto Perumahan dengan id: $id_perumahan, Berhasil"
        ]);
    }
}
