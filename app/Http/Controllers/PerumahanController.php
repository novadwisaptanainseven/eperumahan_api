<?php

namespace App\Http\Controllers;

use App\Exports\KonfirmasiPerumahanExport;
use App\Exports\PerumahanExport;
use App\Exports\RekapPerumahanExport;
use Illuminate\Http\Request;
use App\Models\Perumahan;
use App\Models\Properti;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PerumahanController extends Controller
{
    // Insert Perumahan Master
    public function insertPerumahanMaster(Request $req)
    {
        // Validation
        $message = [
            "required" => ":attribute harus diisi",
            "max" => ":attribute maksimal 5 MB",
        ];

        $validator = Validator::make(
            $req->all(),
            [
                "nama_perumahan"      => "required",
                "deskripsi_perumahan" => "required",
                "lokasi"              => "required",
                "tahun"               => "required",
                "luas"                => "required",
                "luas_mbr"            => "required",
                "luas_komersial"      => "required",
                'foto_perumahan'      => 'max:5048',
                'legalitas'           => 'mimes:pdf,xls,xlsx|max:5048',
                'siteplan'            => 'mimes:pdf,xls,xlsx|max:5048',
                "longitude"           => "required",
                "latitude"            => "required",
                "id_kecamatan"        => 'required',
                "id_kelurahan"        => 'required',
                "id_kategori"         => 'required',
                "id_pengembang"       => 'required',
            ],
            $message
        );

        // Set ekstensi yang diizinkan untuk upload foto bangunan
        $req->ext_allowed = ['jpg', 'jpeg', 'png'];

        // Cek Validasi
        if ($validator->fails()) {
            // Jika Validasi Gagal, tampilkan response 400 BAD REQUEST
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        // Proses Tambah Data
        $tambah = Perumahan::addPerumahanMaster($req);

        // Cek apakah proses tambah data berhasil
        if ($tambah !== 'WRONG_EXTENSION') {
            // Jika berhasil, maka tampilkan response 201 CREATED
            return response()->json([
                "message" => "Tambah Data Perumahan Berhasil",
                "data"    => $tambah
            ], 201);
        } else if ($tambah === 'WRONG_EXTENSION') {
            // Jika ekstensi file yang dimasukkan tidak diizinkan, tampilkan response 400 BAD REQUEST
            return response()->json([
                "message" => "Ekstensi file foto / gambar harus bertipe jpg, jpeg, atau png!",
                "status_response" => "400 BAD REQUEST"
            ], 400);
        }
    }

    // Update Perumahan Master
    public function updatePerumahanMaster(Request $req, $id_perumahan)
    {
        $validator = Validator::make(
            $req->all(),
            [
                "foto_perumahan" => 'mimes:jpg,jpeg,png|max:5048',
                "legalitas"      => 'mimes:pdf,xls,xlsx|max:5048'
            ]
        );
        // Cek Validasi
        if ($validator->fails()) {
            // Jika Validasi Gagal, maka tampilkan response 400 BAD REQUEST
            return response()->json([
                "errors" => $validator->errors()
            ], 400);
        }
        // Jika Validasi Berhasil, lakukan proses dibawah
        // Proses Update Data
        $updateData = Perumahan::updatePerumahanMaster($req, $id_perumahan);

        // Cek apakah proses update data berhasil
        if ($updateData) {
            // Jika berhasil, maka tampilkan response 201 CREATED
            return response()->json([
                "message" => "Update Data Perumahan dengan id: $id_perumahan, Berhasil",
                "data"    => $updateData
            ], 201);
        } else {
            // Jika gagal, maka tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Update Data Perumahan Gagal, Data Tidak Ditemukan"
            ], 404);
        }
    }

    // Get Select Perumahan
    public function getSelectPerumahan()
    {
        $perumahan = Perumahan::all();

        return response()->json([
            "message" => "Get All Perumahan Berhasil",
            "data"    => $perumahan
        ], 200);
    }

    // Get All Kategori
    public function getAllKategori()
    {
        $kategori = Perumahan::getAllKategori();

        return response()->json([
            "message" => "Get All Kategori Berhasil",
            "data"    => $kategori
        ], 200);
    }

    // Get All Kecamatan
    public function getAllKecamatan()
    {
        $kecamatan = Perumahan::getAllKecamatan();

        foreach ($kecamatan as $i => $k) {
            $k->no = $i + 1;
        }

        return response()->json([
            "message" => "Get All Kecamatan Berhasil",
            "data"    => $kecamatan
        ], 200);
    }

    // Get Kecamatan by ID
    public function getKecamatanById($id_kecamatan)
    {
        $kecamatan = Perumahan::getKecamatanById($id_kecamatan);

        if ($kecamatan) {
            return response()->json([
                "message" => "Berhasil mendapatkan data kecamatan dengan id: $id_kecamatan",
                "data" => $kecamatan
            ], 200);
        } else {
            return response()->json([
                "message" => "Data kecamatan dengan id: $id_kecamatan tidak ditemukan",
            ], 404);
        }
    }

    // Insert Kecamatan
    public function insertKecamatan(Request $req)
    {
        $message = [
            "required" => ":attribute harus diisi"
        ];

        $validator = Validator::make(
            $req->all(),
            [
                "nama_kecamatan" => "required"
            ],
            $message
        );
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        $insert = Perumahan::insertKecamatan($req);

        return response()->json([
            "message" => "Berhasil menambahkan data kecamatan",
            "input_data" => $req->all()
        ], 201);
    }

    // Edit Kecamatan
    public function editKecamatan(Request $req, $id_kecamatan)
    {
        $message = [
            "required" => ":attribute harus diisi"
        ];

        $validator = Validator::make(
            $req->all(),
            [
                "nama_kecamatan" => "required"
            ],
            $message
        );
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        // Cek apakah kecamatan ditemukan
        $kecamatan = Perumahan::getKecamatanById($id_kecamatan);
        if (!$kecamatan) {
            return response()->json([
                "message" => "Data kecamatan dengan id: $id_kecamatan tidak ditemukan",
            ], 404);
        }
        $update = Perumahan::updateKecamatan($req, $id_kecamatan);

        return response()->json([
            "message" => "Berhasil mengubah data kecamatan dengan id: $id_kecamatan",
            "input_data" => $req->all()
        ], 201);
    }

    // Delete Kecamatan by ID
    public function deleteKecamatan($id_kecamatan)
    {
        // Cek apakah data kecamatan ditemukan
        $kecamatan = Perumahan::getKecamatanById($id_kecamatan);
        if ($kecamatan) {
            $delete = Perumahan::deleteKecamatanById($id_kecamatan);

            return response()->json([
                "message" => "Berhasil menghapus data kecamatan dengan id: $id_kecamatan",
                "deleted_data" => $kecamatan
            ], 200);
        } else {
            return response()->json([
                "message" => "Data kecamatan dengan id: $id_kecamatan tidak ditemukan",
            ], 404);
        }
    }

    // Get All Kelurahan By ID Kecamatan
    public function getAllKelurahan($id_kecamatan = '')
    {
        // Get Data Kecamatan
        $kecamatan = Perumahan::getKecamatanById($id_kecamatan);
        $kelurahan = Perumahan::getAllKelurahan($id_kecamatan);

        if ($kelurahan != "ID_REQUIRED") {
            foreach ($kelurahan as $i => $k) {
                $k->no = $i + 1;
            }

            return response()->json([
                "message" => "Get All Kelurahan dengan id kecamatan: $id_kecamatan Berhasil",
                "kecamatan" => $kecamatan->nama_kecamatan,
                "data"    => $kelurahan
            ], 200);
        } elseif ($kelurahan == "ID_REQUIRED") {
            return response()->json([
                "message" => "ID Kecamatan dibutuhkan untuk pencarian data kelurahan",
                "data"    => $kelurahan
            ], 400);
        } else {
            return response()->json([
                "message" => "Data Kelurahan Tidak Tersedia",
                "data"    => $kelurahan
            ], 404);
        }
    }

    // Get Kelurahan By ID
    public function getKelurahanById($id_kelurahan)
    {
        $kelurahan = Perumahan::getKelurahanById($id_kelurahan);

        if ($kelurahan) {
            return response()->json([
                "message" => "Berhasil mendapatkan data kelurahan dengan id: $id_kelurahan",
                "data" => $kelurahan
            ], 200);
        } else {
            return response()->json([
                "message" => "Data kelurahan dengan id: $id_kelurahan tidak ditemukan",
            ], 404);
        }
    }

    // Insert Kelurahan
    public function insertKelurahan(Request $req, $id_kecamatan)
    {
        $message = [
            "required" => ":attribute harus diisi"
        ];

        $validator = Validator::make(
            $req->all(),
            [
                "nama_kelurahan" => "required"
            ],
            $message
        );
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        // Cek apakah data kecamatan ditemukan
        $kecamatan = Perumahan::getKecamatanById($id_kecamatan);
        if (!$kecamatan) {
            return response()->json([
                "message" => "Data kecamatan dengan id: $id_kecamatan tidak ditemukan",
            ], 404);
        }

        $insert = Perumahan::insertKelurahan($req, $id_kecamatan);

        return response()->json([
            "message" => "Berhasil menambahkan data kelurahan untuk kecamatan dengan id: $id_kecamatan",
            "input_data" => $req->all()
        ], 201);
    }

    // Edit Kelurahan
    public function editKelurahan(Request $req, $id_kelurahan)
    {
        $message = [
            "required" => ":attribute harus diisi"
        ];

        $validator = Validator::make(
            $req->all(),
            [
                "nama_kelurahan" => "required"
            ],
            $message
        );
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        // Cek apakah data kelurahan ditemukan
        $kelurahan = Perumahan::getKelurahanById($id_kelurahan);
        if (!$kelurahan) {
            return response()->json([
                "message" => "Data kelurahan dengan id: $id_kelurahan tidak ditemukan",
            ], 404);
        }

        $update = Perumahan::updateKelurahan($req, $id_kelurahan);

        return response()->json([
            "message" => "Berhasil mengubah data kelurahan  dengan id: $id_kelurahan",
            "input_data" => $req->all()
        ], 201);
    }

    // Delete Kelurahan by ID
    public function deleteKelurahan($id_kelurahan)
    {
        // Cek apakah data kelurahan ditemukan
        $kelurahan = Perumahan::getKelurahanById($id_kelurahan);
        if ($kelurahan) {
            $delete = Perumahan::deleteKelurahanById($id_kelurahan);

            return response()->json([
                "message" => "Berhasil menghapus data kelurahan dengan id: $id_kelurahan",
                "deleted_data" => $kelurahan
            ], 200);
        } else {
            return response()->json([
                "message" => "Data kelurahan dengan id: $id_kelurahan tidak ditemukan",
            ], 404);
        }
    }

    // GROUP PERUMAHAN

    // Search Perumahan
    public function searchPerumahan(Request $request)
    {
        $search_value = ($request->value) ? $request->value : '';

        $data_perumahan = Perumahan::searchPerumahanByValue($search_value);

        // Cek apakah data perumahan ditemukan
        if ($data_perumahan) {
            // Jika ditemukan, tampilkan response 200 OK
            return response()->json([
                "message" => "Get Data Perumahan dengan data pencarian: $search_value, Berhasil",
                "data"    => $data_perumahan
            ], 200);
        } else {
            // Jika tidak, tetap tampilkan response 200 OK
            return response()->json([
                "message" => "Get Data Perumahan dengan data pencarian: $search_value, Gagal",
                "data"    => $data_perumahan
            ], 200);
        }
    }

    // Search Perumahan Pengembang
    public function searchPerumahanPengembang(Request $request)
    {
        $search_value = ($request->value) ? $request->value : '';

        $data_perumahan = Perumahan::searchPerumahanPengembang($search_value);

        // Cek apakah data perumahan ditemukan
        if ($data_perumahan) {
            // Jika ditemukan, tampilkan response 200 OK
            return response()->json([
                "message" => "Get Data Perumahan Pengembang dengan data pencarian: $search_value, Berhasil",
                "data"    => $data_perumahan
            ], 200);
        } else {
            // Jika tidak, tetap tampilkan response 200 OK
            return response()->json([
                "message" => "Get Data Perumahan Pengembang dengan data pencarian: $search_value, Gagal",
                "data"    => $data_perumahan
            ], 200);
        }
    }

    // Add Data Perumahan 
    public function addPerumahan(Request $request)
    {
        // Validation
        $message = [
            "required" => ":attribute harus diisi",
            "max" => ":attribute maksimal 5 MB",
        ];

        $validator = Validator::make(
            $request->all(),
            [
                "nama_perumahan"      => "required",
                "deskripsi_perumahan" => "required",
                "lokasi"              => "required",
                "tahun"               => "required",
                "luas"                => "required",
                "luas_mbr"            => "required",
                "luas_komersial"      => "required",
                'foto_perumahan'      => 'max:5048',
                'legalitas'           => 'mimes:pdf,xls,xlsx|max:5048',
                'siteplan'            => 'mimes:pdf,xls,xlsx|max:5048',
                "longitude"           => "required",
                "latitude"            => "required",
                "id_kecamatan"        => 'required',
                "id_kelurahan"        => 'required',
                "id_kategori"         => 'required',
            ],
            $message
        );

        // Set ekstensi yang diizinkan untuk upload foto bangunan
        $request->ext_allowed = ['jpg', 'jpeg', 'png'];

        // Cek apakah ada data request fasilitas perumahan, dibuat pengecekan tersendiri karena fitur validasi request Laravel belum bisa menangani request tipe array
        // if (in_array(null, $request->fasilitas_perumahan)) {
        //     return response()->json([
        //         "message" => "Fasilitas perumahan harus diisi!",
        //         "status_response" => "400 BAD REQUEST"
        //     ], 400);
        // }
        // Cek apakah ada data request sarana prasarana perumahan
        // if (in_array(null, $request->sarana_prasarana_perumahan)) {
        //     return response()->json([
        //         "message" => "Sarana prasarana perumahan harus diisi!",
        //         "status_response" => "400 BAD REQUEST"
        //     ], 400);
        // }

        // Cek Validasi
        if ($validator->fails()) {
            // Jika Validasi Gagal, tampilkan response 400 BAD REQUEST
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        // Jika Validasi Berhasil, lakukan proses dibawah ini

        // Proses Tambah Data
        $tambah = Perumahan::addPerumahan($request);

        // Cek apakah proses tambah data berhasil
        if ($tambah !== 'WRONG_EXTENSION') {
            // Jika berhasil, maka tampilkan response 201 CREATED
            return response()->json([
                "message" => "Tambah Data Perumahan Berhasil",
                "data"    => $tambah
            ], 201);
        } else if ($tambah === 'WRONG_EXTENSION') {
            // Jika ekstensi file yang dimasukkan tidak diizinkan, tampilkan response 400 BAD REQUEST
            return response()->json([
                "message" => "Ekstensi file foto / gambar harus bertipe jpg, jpeg, atau png!",
                "status_response" => "400 BAD REQUEST"
            ], 400);
        } else {
            // Jika gagal, maka tampilkan response 500 INTERNAL SERVER ERROR
            return response()->json([
                "message" => "Tambah Data Perumahan Gagal"
            ], 500);
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
                "legalitas"      => 'mimes:pdf,xls,xlsx|max:5048'
            ]
        );
        // Cek Validasi
        if ($validator->fails()) {
            // Jika Validasi Gagal, maka tampilkan response 400 BAD REQUEST
            return response()->json([
                "errors" => $validator->errors()
            ], 400);
        }
        // Jika Validasi Berhasil, lakukan proses dibawah
        // Proses Update Data
        $updateData = Perumahan::updatePerumahanById($request, $id_perumahan);

        // Cek apakah proses update data berhasil
        if ($updateData) {
            // Jika berhasil, maka tampilkan response 201 CREATED
            return response()->json([
                "message" => "Update Data Perumahan dengan id: $id_perumahan, Berhasil",
                "data"    => $updateData
            ], 201);
        } else {
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
    public function getAll(Request $request)
    {
        // Pagination
        $request->page = ($request->page) ? $request->page : '1';
        $request->per_page = ($request->per_page) ? $request->per_page : '8';
        $request->order = ($request->order) ? $request->order : 'desc';
        // End Pagination

        $perumahan = Perumahan::getAll($request);

        return response()->json([
            "message" => "Get All Perumahan Berhasil",
            "data"    => $perumahan
        ], 200);
    }

    // Get All Perumahan By Pengembang
    public function getAllPerumahan(Request $request)
    {
        // Pagination
        $request->page = ($request->page) ? $request->page : '1';
        $request->per_page = ($request->per_page) ? $request->per_page : '0';
        $request->order = ($request->order) ? $request->order : 'desc';
        // End Pagination

        $perumahan = Perumahan::getAllPerumahan($request);

        return response()->json([
            "message" => "Get All Perumahan Berhasil",
            "data"    => $perumahan
        ], 200);
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

    // Get Data Perumahan By ID
    public function getPerumahanByIdPengembang($id_pengembang)
    {
        $perumahan = Perumahan::getPerumahanByIdPengembang($id_pengembang);
        $total_data = Perumahan::where('status_perumahan', '=', '2')->get()->count();

        if ($perumahan) {
            return response()->json([
                "message" => "Get Perumahan with id pengembang: $id_pengembang, Success",
                "total_data" => $total_data,
                "data" => $perumahan
            ], 200);
        } else {
            return response()->json([
                "message" => "Perumahan Tidak Ditemukan",
                "total_data" => $total_data,
                "data" => $perumahan
            ], 404);
        }
    }

    // Get Data Perumahan By Slug
    public function getPerumahanBySlug($slug)
    {
        $perumahan = Perumahan::getPerumahanBySlug($slug);

        if ($perumahan) {
            return response()->json([
                "message" => "Get Perumahan with slug: $slug, Success",
                "data" => $perumahan
            ], 200);
        } else {
            return response()->json([
                "message" => "Perumahan Tidak Ditemukan",
                "data" => $perumahan
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

    // Delete Perumahan
    public function deletePerumahan($id_perumahan)
    {
        $tbl_foto = "foto_bangunan";
        $tbl_foto_perumahan = "foto_perumahan";
        $perumahan = Perumahan::find($id_perumahan);
        if ($perumahan) {
            // Hapus tabel children (relasi) dari tabel parent (perumahan)
            // --- Delete Properti ---
            // Delete Properti
            $properti = Properti::where("id_perumahan", $id_perumahan)->get();
            // Delete Foto Bangunan
            foreach ($properti as $p) {
                $foto_properti = DB::table($tbl_foto)->where("id_bangunan", $p->id_bangunan)->get();

                foreach ($foto_properti as $foto) {
                    $path = $foto->foto_bangunan;
                    Storage::delete($path);
                }
            }

            // --- Data Perumahan ---
            // Delete Foto Perumahan
            $foto_perumahan = DB::table($tbl_foto_perumahan)->where("id_perumahan", $id_perumahan)->get();
            foreach ($foto_perumahan as $foto) {
                $path = $foto->foto_perumahan;
                Storage::delete($path);
            }
            // Delete Perumahan
            // Hapus file legalitas
            Storage::delete($perumahan->legalitas);
            $perumahan->delete();

            return response()->json([
                "message" => "Data perumahan dengan id_perumahan: $id_perumahan berhasil dihapus",
                "data" => $perumahan,
            ], 201);
        } else {
            return response()->json([
                "message" => "Data perumahan dengan id_perumahan: $id_perumahan tidak ditemukan",
            ], 404);
        }
    }

    // GROUP PERUMAHAN / PROPERTI

    // Add Properti
    public function addProperti(Request $request, $id_perumahan)
    {
        // Validation
        $message = [
            "required" => ":attribute harus diisi!",
            "numeric"  => ":attribute harus berupa angka!",
        ];

        $validator = Validator::make($request->all(), [
            "nama_bangunan"      => "required",
            "deskripsi_bangunan" => "required",
            "kategori_bangunan"  => "required",
            "id_kategori"        => "required",
            "tipe_bangunan"      => "required",
            "jumlah_tersedia"    => "required|numeric",
            "jumlah_terhuni"     => "required|numeric",
            "jumlah_tidak_terhuni"  => "required|numeric",
            "harga_bangunan"     => "required|numeric",
            "luas_bangunan"      => "required|numeric",
            "dimensi_bangunan"   => "required",
            "luas_tanah"         => "required|numeric",
            "dimensi_tanah"      => "required",
            "jumlah_lantai"      => "required",
            "jumlah_kamar"       => "required",
            "jumlah_kamar_mandi" => "required",
            "jumlah_garasi"      => "required",
            "listrik"            => "required",
            // "spesifikasi_rumah"  => "required",
            "foto_bangunan"      => "max:5048"
        ], $message);

        // Set ekstensi yang diizinkan untuk upload foto bangunan
        $request->ext_allowed = ['jpg', 'jpeg', 'png'];

        // Cek apakah ada data request spesifikasi rumah, dibuat pengecekan tersendiri karena fitur validasi request Laravel belum bisa menangani request tipe array
        // if (in_array(null, $request->spesifikasi_rumah)) {
        //     return response()->json([
        //         "message" => "Spesifikasi rumah harus diisi!",
        //         "status_response" => "400 BAD REQUEST"
        //     ], 400);
        // }

        // Cek Validasi
        if ($validator->fails()) {
            // Jika validasi gagal, tampilkan response 400 BAD REQUEST
            return response()->json([
                "errors" => $validator->errors()
            ], 400);
        }

        // Jika validasi berhasil, lanjutkan proses di bawah ini
        // Proses Tambah Data 


        $tambah = Perumahan::addProperti($request, $id_perumahan);

        if ($tambah === 'WRONG_EXTENSION') {
            // Jika ekstensi file yang dimasukkan tidak diizinkan, tampilkan response 400 BAD REQUEST
            return response()->json([
                "message" => "Ekstensi file foto / gambar harus bertipe jpg, jpeg, atau png!",
                "status_response" => "400 BAD REQUEST"
            ], 400);
        } else if ($tambah !== 'NOT_FOUND') {
            // Jika berhasil dan data perumahan ditemukan, maka tampilkan response 201 CREATED
            return response()->json([
                "message" => "Tambah data properti dengan id perumahan: $id_perumahan, Berhasil",
                "data"    => $tambah
            ], 201);
        } else if ($tambah === 'NOT_FOUND') {
            // Jika data perumahan tidak ditemukan, maka tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Data dengan id perumahan: $id_perumahan, Tidak Ditemukan!",
                "status"  => "404 NOT FOUND"
            ], 404);
        } else {
            // Jika gagal, tampilkan response 500 INTERNAL SERVER ERROR
            return response()->json([
                "message" => "Tambah data properti dengan id perumahan: $id_perumahan, Gagal.",
                "status"  => "500 INTERNAL SERVER ERROR"
            ], 500);
        }
    }

    // Get All Data Properti
    public function getAllProperti(Request $request)
    {
        // Pagination
        $request->page = ($request->page) ? $request->page : '1';
        $request->per_page = $request->per_page ? $request->per_page : '0';
        $request->order = ($request->order) ? $request->order : 'desc';
        // End Pagination

        $properti = Perumahan::getAllProperti($request);

        // Cek Apakah properti ada isinya
        return response()->json([
            "message"    => "Get All Properti Berhasil",
            "data"       => $properti
        ], 200);
    }

    // Get All Data Properti By ID Perumahan
    public function getAllPropertiById(Request $request, $id_perumahan)
    {
        // Pagination
        $request->page = ($request->page) ? $request->page : '1';
        $request->per_page = ($request->per_page) ? $request->per_page : '0';
        $request->order = ($request->order) ? $request->order : 'desc';
        // End Pagination

        $properti = Perumahan::getAllPropertiById($request, $id_perumahan);

        if ($properti !== 'NOT_FOUND') {
            return response()->json([
                "message" => "Get All Properti dengan id perumahan: $id_perumahan Berhasil",
                "data"    => $properti
            ], 200);
        } else {
            return response()->json([
                "message" => "Data perumahan tidak ditemukan",
                "data"    => $properti
            ], 404);
        }
    }

    // Search Properti
    public function searchProperti(Request $request, $id_perumahan = '')
    {
        $search_value = ($request->value) ? $request->value : '';

        if ($id_perumahan) {
            $data_bangunan = Perumahan::searchPropertiByIdPerumahan($id_perumahan, $search_value);
        } else {
            $data_bangunan = Perumahan::searchProperti($search_value);
        }

        // Cek apakah data bangunan ditemukan
        if ($data_bangunan) {
            // Jika ditemukan, tampilkan response 200 OK
            return response()->json([
                "message" => "Get Data Properti dengan data pencarian: $search_value, Berhasil",
                "data"    => $data_bangunan
            ], 200);
        } else {
            // Jika tidak, tetap tampilkan response 200 OK
            return response()->json([
                "message" => "Get Data Properti dengan data pencarian: $search_value, Gagal",
                "data"    => $data_bangunan
            ], 200);
        }
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
    public function getPropertiById($id_perumahan = '', $id_bangunan = "")
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

    // Update Properti By ID
    public function updatePropertiById(Request $request, $id_perumahan, $id_bangunan)
    {
        // Validation
        $message = [
            "required" => ":attribute harus diisi!",
            "numeric"  => ":attribute harus berupa angka!",
        ];

        $validator = Validator::make($request->all(), [
            "jumlah_tersedia"    => "numeric",
            "harga_bangunan"     => "numeric",
            "luas_bangunan"      => "numeric",
            "luas_tanah"         => "numeric",
        ], $message);

        // Cek Validasi
        if ($validator->fails()) {
            // Jika validasi gagal, tampilkan response 400 BAD REQUEST
            return response()->json([
                "errors" => $validator->errors()
            ]);
        }
        // Jika validasi berhasil, lanjutkan proses di bawah ini
        // Proses Update Data Properti
        $update = Perumahan::updatePropertiById($request, $id_perumahan, $id_bangunan);

        if ($update !== 'NOT_FOUND') {
            // Jika berhasil dan data perumahan ditemukan, maka tampilkan response 201 CREATED
            return response()->json([
                "message" => "Update properti dengan id: $id_bangunan dari perumahan: $id_perumahan, Berhasil",
                "data"    => $update
            ], 201);
        } else if ($update === 'NOT_FOUND') {
            // Jika data perumahan tidak ditemukan, maka tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Data dengan id perumahan: $id_perumahan, Tidak Ditemukan!",
                "status"  => "404 NOT FOUND"
            ], 404);
        } else {
            // Jika gagal, tampilkan response 500 INTERNAL SERVER ERROR
            return response()->json([
                "message" => "Update data properti dengan id perumahan: $id_perumahan, Gagal.",
                "status"  => "500 INTERNAL SERVER ERROR"
            ], 500);
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
            ], 404);
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
            ], 404);
        }
    }

    // GROUP PERUMAHAN / PROPERTI / SPESIFIKASI

    // Add Spesifikasi Properti
    public function addSpesifikasiProperti(Request $request, $id_perumahan, $id_bangunan)
    {
        // Validation 
        $message = [
            'required' => ':attribute harus diisi!'
        ];

        $validator = Validator::make(
            $request->all(),
            [
                "spesifikasi_rumah" => "required"
            ],
            $message
        );

        // Cek Validasi
        if ($validator->fails()) {
            // Jika validasi gagal, tampilkan response 400 BAD REQUEST
            return response()->json([
                "error" => $validator->errors()
            ], 400);
        }
        // Jika berhasil, lanjutkan proses di bawah ini

        $spesifikasi = Perumahan::addSpesifikasiProperti($request, $id_perumahan, $id_bangunan);

        // Cek apakah proses tambah berhasil
        if ($spesifikasi !== 'NOT_FOUND') {
            // Jika iya, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Tambah data spesifikasi properti dengan id bangunan: $id_bangunan, Berhasil",
                "data"    => $spesifikasi
            ], 201);
        } else if ($spesifikasi === 'NOT_FOUND') {
            // Jika tidak ditemukan, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Gagal tambah data, Data Tidak Ditemukan"
            ], 404);
        } else {
            // Jika tidak, tampilkan response 400 BAD REQUEST
            return response()->json([
                "message" => "Tambah data spesifikasi properti dengan id bangunan: $id_bangunan, Gagal"
            ], 400);
        }
    }

    // Get All Spesifikasi Properti by ID Bangunan
    public function getSpesifikasiProperti($id_bangunan)
    {
        // Get All Spesifikasi
        $spesifikasi = Perumahan::getSpesifikasiProperti($id_bangunan);

        // Cek proses
        if ($spesifikasi !== 'NOT_FOUND') {
            // Jika berhasil, tampilkan response 200 OK
            return response()->json([
                "message" => "Get all spesifikasi dengan id bangunan: $id_bangunan, Berhasil",
                "data"    => $spesifikasi
            ], 200);
        } else if ($spesifikasi === 'NOT_FOUND') {
            // Jika perumahan atau bangunan tidak ditemukan, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Data tidak ditemukan",
                "data"    => $spesifikasi
            ], 404);
        } else {
            // Jika bangunan belum memiliki spesifikasi, tetap tampilkan response 200 OK
            return response()->json([
                "message" => "Bangunan dengan id: $id_bangunan, Belum Spesifikasi Rumah",
                "data"    => $spesifikasi
            ], 200);
        }
    }

    // Delete Spesifikasi Properti By ID
    public function deleteSpesifikasiProperti($id_bangunan, $id_spesifikasi_rumah)
    {
        // Delete Spesifikasi Properti
        $spesifikasi = Perumahan::deleteSpesifikasiProperti($id_bangunan, $id_spesifikasi_rumah);

        // Cek proses
        if ($spesifikasi !== 'NOT_FOUND') {
            // Jika berhasil, tampilkan response 200 OK
            return response()->json([
                "message" => "Delete spesifikasi rumah dengan id: $id_spesifikasi_rumah dari bangunan: $id_bangunan, Berhasil",
                "data_deleted"    => $spesifikasi
            ], 201);
        } else if ($spesifikasi === 'NOT_FOUND') {
            // Jika perumahan, properti, atau spesifikasi tidak ditemukan, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Data Tidak Ditemukan, id bangunan: $id_bangunan, id spesifikasi: $id_spesifikasi_rumah",
                "data"    => $spesifikasi
            ], 404);
        } else {
            // Jika ada terjadi kesalahan dalam proses delete, tampilkan response 500 INTERNAL SERVER ERROR
            return response()->json([
                "message" => "Delete spesifikasi rumah dengan id: $id_spesifikasi_rumah dari bangunan: $id_bangunan, Gagal"
            ], 500);
        }

        return response()->json([
            "message" => "Delete spesifikasi rumah dengan id bangunan: $id_bangunan, Berhasil",

        ], 201);
    }

    // Add Fasilitas Properti
    public function addFasilitasProperti(Request $request, $id_perumahan, $id_bangunan)
    {
        // Validation 
        $message = [
            'required' => ':attribute harus diisi!'
        ];

        $validator = Validator::make(
            $request->all(),
            [
                "fasilitas" => "required"
            ],
            $message
        );

        // Cek Validasi
        if ($validator->fails()) {
            // Jika validasi gagal, tampilkan response 400 BAD REQUEST
            return response()->json([
                "error" => $validator->errors()
            ], 400);
        }
        // Jika berhasil, lanjutkan proses di bawah ini

        $fasilitas = Perumahan::addFasilitasProperti($request, $id_perumahan, $id_bangunan);

        // Cek apakah proses tambah berhasil
        if ($fasilitas !== 'NOT_FOUND') {
            // Jika iya, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Tambah data fasilitas properti dengan id bangunan: $id_bangunan, Berhasil",
                "data"    => $fasilitas
            ], 201);
        } else if ($fasilitas === 'NOT_FOUND') {
            // Jika tidak ditemukan, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Gagal tambah data, Data Tidak Ditemukan"
            ], 404);
        } else {
            // Jika tidak, tampilkan response 400 BAD REQUEST
            return response()->json([
                "message" => "Tambah data fasilitas properti dengan id bangunan: $id_bangunan, Gagal"
            ], 400);
        }
    }

    // Get All Fasilitas Properti by ID Bangunan
    public function getFasilitasProperti($id_bangunan)
    {
        // Get All Fasilitas
        $fasilitas = Perumahan::getFasilitasProperti($id_bangunan);

        // Cek proses
        if ($fasilitas !== 'NOT_FOUND') {
            // Jika berhasil, tampilkan response 200 OK
            return response()->json([
                "message" => "Get all fasilitas dengan id bangunan: $id_bangunan, Berhasil",
                "data"    => $fasilitas
            ], 200);
        } else if ($fasilitas === 'NOT_FOUND') {
            // Jika perumahan atau bangunan tidak ditemukan, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Data tidak ditemukan",
                "data"    => $fasilitas
            ], 404);
        } else {
            // Jika bangunan belum memiliki fasilitas, tetap tampilkan response 200 OK
            return response()->json([
                "message" => "Bangunan dengan id: $id_bangunan, Belum Fasilitas Rumah",
                "data"    => $fasilitas
            ], 200);
        }
    }

    // Delete Fasilitas Properti By ID
    public function deleteFasilitasProperti($id_bangunan, $id_fasilitas)
    {
        // Delete Fasilitas Properti
        $fasilitas = Perumahan::deleteFasilitasProperti($id_bangunan, $id_fasilitas);

        // Cek proses
        if ($fasilitas !== 'NOT_FOUND') {
            // Jika berhasil, tampilkan response 200 OK
            return response()->json([
                "message" => "Delete fasilitas rumah dengan id: $id_fasilitas dari bangunan: $id_bangunan, Berhasil",
                "data_deleted"    => $fasilitas
            ], 201);
        } else if ($fasilitas === 'NOT_FOUND') {
            // Jika perumahan, properti, atau fasilitas tidak ditemukan, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Data Tidak Ditemukan, id bangunan: $id_bangunan, id fasilitas: $id_fasilitas",
                "data"    => $fasilitas
            ], 404);
        } else {
            // Jika ada terjadi kesalahan dalam proses delete, tampilkan response 500 INTERNAL SERVER ERROR
            return response()->json([
                "message" => "Delete fasilitas rumah dengan id: $id_fasilitas dari bangunan: $id_bangunan, Gagal"
            ], 500);
        }

        return response()->json([
            "message" => "Delete fasilitas rumah dengan id bangunan: $id_bangunan, Berhasil",

        ], 201);
    }

    // GROUP PERUMAHAN / PROPERTI / FOTO

    // Get Foto Bangunan by ID Bangunan
    public static function getFotoBangunan($id_bangunan)
    {
        // Proses get all
        $foto = Perumahan::getAllFotoBangunan($id_bangunan);

        // Cek apakah ada data foto
        if ($foto !== 'NOT_FOUND') {
            // Jika ada, tampilkan response 200 OK
            return response()->json([
                "message" => "Get All Foto Bangunan dengan id: $id_bangunan, Berhasil",
                "data"    => $foto
            ], 200);
        }
        // Cek apakah data foto perumahan ditemukan
        else if ($foto === 'NOT_FOUND') {
            // Jika tidak, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Bangunan dengan id: $id_bangunan, Tidak Ditemukan"
            ], 404);
        } else {
            // Jika tidak, tampilkan response 200 OK karena bukan error hanya belum memiliki foto
            return response()->json([
                "message" => "Bangunan dengan id: $id_bangunan, Belum Memiliki Foto",
                "data"    => $foto
            ], 200);
        }
    }

    // Add Foto Bangunan
    public static function addFotoBangunan(Request $request,  $id_bangunan)
    {
        // Validation 
        $message = [
            "required" => ":attribute belum ada file!"
        ];

        $validator = Validator::make(
            $request->all(),
            [
                'foto_bangunan' => 'max:5048|required',
            ],
            $message
        );

        // Set ekstensi yang diizinkan untuk upload foto bangunan
        $request->ext_allowed = ['jpg', 'jpeg', 'png'];

        // Cek Validation
        if ($validator->fails()) {
            // Jika validasi gagal, tampilkan response 400 BAD REQUEST
            return response()->json([
                "errors" => $validator->errors()
            ], 400);
        }
        // Jika validasi berhasil, lanjutkan proses di bawah ini

        // Tambah Foto
        $tambahFoto = Perumahan::addFotoBangunan($request, $id_bangunan);

        // Cek apakah proses tambah berhasil
        if ($tambahFoto === 'WRONG_EXTENSION') {
            // Jika ekstensi file yang dimasukkan tidak diizinkan, tampilkan response 400 BAD REQUEST
            return response()->json([
                "message" => "Ekstensi file foto / gambar harus bertipe jpg, jpeg, atau png!",
                "status_response" => "400 BAD REQUEST"
            ], 400);
        } else if ($tambahFoto !== 'NOT_FOUND') {
            // Jika berhasil, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Tambah foto dengan id bangunan: $id_bangunan, Berhasil",
                "data"    => $tambahFoto
            ], 201);
        } else if ($tambahFoto === 'NOT_FOUND') {
            // Jika data bangunan tidak ditemukan, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Data properti tidak ditemukan!"
            ], 404);
        } else {
            // Jika gagal, tampilkan response 500 INTERNAL SERVER ERROR
            return response()->json([
                "message" => "Tambah foto dengan id bangunan: $id_bangunan, Gagal",
                "data"    => $tambahFoto
            ], 500);
        }
    }

    // Update Status Utama Foto Bangunan
    public static function updateStatusFotoBangunan(Request $request, $id_bangunan, $id_foto)
    {
        $status = $request->status_foto;

        // Proses Update Status Utama
        $foto = Perumahan::updateStatusFotoBangunan($status, $id_bangunan, $id_foto);

        // Cek Apakah hasil update status foto ditemukan
        if ($foto) {
            // Jika iya, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Update status utama foto bangunan: $id_bangunan dengan id foto: $id_foto, Berhasil",
                "data"    => $foto
            ], 201);
        } else {
            // Jika tidak, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Update status utama foto bangunan Gagal, Data Tidak Ditemukan"
            ], 404);
        }
    }

    // Delete Foto Bangunan by ID Foto
    public static function deleteFotoBangunan($id_bangunan, $id_foto)
    {
        // Proses delete
        $deleteFoto = Perumahan::deleteFotoBangunan($id_bangunan, $id_foto);

        // Cek apakah proses delete berhasil
        if ($deleteFoto !== 'NOT_FOUND') {
            // Jika berhasil, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Delete data foto bangunan: $id_bangunan dengan id foto: $id_foto, Berhasil"
            ], 201);
        } else if ($deleteFoto === 'NOT_FOUND') {
            // Jika bangunan atau foto tidak ditemukan, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Delete data foto bangunan Gagal. Data Tidak Ditemukan"
            ], 404);
        } else {
            // Jika gagal, tampilkan response 500 INTERNAL SERVER ERROR
            return response()->json([
                "message" => "Delete data foto bangunan Gagal. Terjadi kesalahan server"
            ], 500);
        }
    }

    // GROUP PERUMAHAN / FOTO

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

        // Set ekstensi yang diizinkan untuk upload file
        $request->ext_allowed = ['jpg', 'jpeg', 'png'];

        // Cek Validation
        if ($validator->fails()) {
            // Jika validasi gagal, tampilkan response 400 BAD REQUEST
            return response()->json([
                "errors" => $validator->errors()
            ], 400);
        }
        // Jika validasi berhasil, lanjutkan proses di bawah ini

        // Tambah Foto
        $tambahFoto = Perumahan::addFotoPerumahan($request, $id_perumahan);

        // Cek apakah proses tambah berhasil
        if ($tambahFoto === 'WRONG_EXTENSION') {
            // Jika ekstensi file yang dimasukkan tidak diizinkan, tampilkan response 400 BAD REQUEST
            return response()->json([
                "message" => "Ekstensi file foto / gambar harus bertipe jpg, jpeg, atau png!",
                "status_response" => "400 BAD REQUEST"
            ], 400);
        } else if ($tambahFoto !== 'NOT_FOUND') {
            // Jika berhasil, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Tambah foto dengan id perumahan: $id_perumahan, Berhasil",
                "data"    => $tambahFoto
            ], 201);
        } else if ($tambahFoto === 'NOT_FOUND') {
            // Jika data perumahan tidak ditemukan, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Data perumahan dengan id perumahan: $id_perumahan, Tidak Ditemukan",
                "data"    => $tambahFoto
            ], 404);
        } else {
            // Jika gagal, tampilkan response 500 INTERNAL SERVER ERROR
            return response()->json([
                "message" => "Tambah foto dengan id perumahan: $id_perumahan, Gagal",
                "data"    => $tambahFoto
            ], 500);
        }
    }

    // Update Status Utama Foto Perumahan By ID Foto
    public function updateStatusFoto(Request $request, $id_perumahan, $id_foto)
    {
        $status = $request->status_foto;

        // Proses Update Status Utama
        $foto = Perumahan::updateStatusFoto($status, $id_perumahan, $id_foto);

        // Cek Apakah hasil update status foto ditemukan
        if ($foto !== 'NOT_FOUND') {
            // Jika iya, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Update status utama foto perumahan: $id_perumahan dengan id foto: $id_foto, Berhasil",
                "data"    => $foto
            ], 201);
        } else if ($foto === 'NOT_FOUND') {
            // Jika data perumahan atau foto tidak ditemukan, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Data tidak ditemukan!"
            ], 404);
        } else {
            // Jika tidak, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Update status utama foto perumahan Gagal, Data Tidak Ditemukan"
            ], 404);
        }
    }

    // Delete Foto Perumahan By ID Foto
    public function deleteFoto($id_perumahan, $id_foto)
    {
        // Proses delete
        $deleteFoto = Perumahan::deleteFoto($id_perumahan, $id_foto);

        // Cek apakah proses delete berhasil
        if ($deleteFoto) {
            // Jika berhasil, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Delete data foto perumahan: $id_perumahan dengan id foto: $id_foto, Berhasil",
                "data"    => $deleteFoto
            ], 201);
        } else {
            // Jika gagal, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Delete data foto perumahan Gagal. Data Tidak Ditemukan"
            ], 404);
        }
    }

    // Get All Foto Perumahan by ID Perumahan
    public function getAllFoto(Request $request, $id_perumahan)
    {
        // Pagination
        // $request->page = ($request->page) ? $request->page : '1';
        // $request->per_page = ($request->per_page) ? $request->per_page : '8';
        $request->order = ($request->order) ? $request->order : 'desc';
        // End Pagination

        // Proses get all
        $foto = Perumahan::getAllFoto($request, $id_perumahan);

        // Cek apakah ada data foto
        if ($foto !== 'NOT_FOUND') {
            // Jika ada, tampilkan response 200 OK
            return response()->json([
                "message" => "Get All Foto Perumahan dengan id: $id_perumahan, Berhasil",
                "data"    => $foto
            ], 200);
        }
        // Cek apakah data foto perumahan ditemukan
        else if ($foto === 'NOT_FOUND') {
            // Jika tidak, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Perumahan dengan id: $id_perumahan, Tidak Ditemukan"
            ], 404);
        }
    }

    // GROUP PERUMAHAN / SARANA DAN PRASARANA

    // Add Sarana dan Prasarana Perumahan
    public function addSaranaPrasarana(Request $request, $id_perumahan)
    {
        // Validation 
        $message = [
            'required' => ':attribute harus diisi!'
        ];

        $validator = Validator::make(
            $request->all(),
            [
                "sarana_prasarana_perumahan" => "required"
            ],
            $message
        );

        // Cek Validasi
        if ($validator->fails()) {
            // Jika validasi gagal, tampilkan response 400 BAD REQUEST
            return response()->json([
                "error" => $validator->errors()
            ], 400);
        }
        // Jika berhasil, lanjutkan proses di bawah ini

        $sarana_prasarana = Perumahan::addSaranaPrasarana($request, $id_perumahan);

        // Cek apakah proses tambah berhasil
        if ($sarana_prasarana !== 'NOT_FOUND') {
            // Jika iya, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Tambah data sarana dan prasarana dengan id perumahan: $id_perumahan, Berhasil",
                "data"    => $sarana_prasarana
            ], 201);
        } else if ($sarana_prasarana === 'NOT_FOUND') {
            // Jika tidak ditemukan, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Gagal tambah data, Perumahan Tidak Ditemukan"
            ], 404);
        } else {
            // Jika tidak, tampilkan response 400 BAD REQUEST
            return response()->json([
                "message" => "Tambah data sarana dan prasarana dengan id perumahan: $id_perumahan, Gagal"
            ], 400);
        }
    }

    // Get All Sarana dan Prasarana By ID Perumahan
    public function getSaranaPrasarana($id_perumahan)
    {
        // Get All Sarana dan Prasarana
        $sarana_prasarana = Perumahan::getSaranaPrasarana($id_perumahan);

        // Cek proses
        if ($sarana_prasarana !== 'NOT_FOUND') {
            // Jika berhasil, tampilkan response 200 OK
            return response()->json([
                "message" => "Get all sarana dan prasarana dengan id perumahan : $id_perumahan, Berhasil",
                "data"    => $sarana_prasarana
            ], 200);
        } else if ($sarana_prasarana === 'NOT_FOUND') {
            // Jika perumahan tidak ditemukan, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Perumahan dengan id: $id_perumahan, Tidak Ditemukan",
                "data"    => $sarana_prasarana
            ], 404);
        } else {
            // Jika perumahan belum memiliki sarana dan prasarana, tetap tampilkan response 200 OK
            return response()->json([
                "message" => "Perumahan dengan id: $id_perumahan, Belum Memiliki Sarana dan Prasarana",
                "data"    => $sarana_prasarana
            ], 200);
        }
    }

    // Delete Sarana dan Prasarana by ID
    public function deleteSaranaPrasarana($id_perumahan, $id_sarana_prasarana_perumahan)
    {
        // Delete Sarana dan Prasarana
        $sarana_prasarana = Perumahan::deleteSaranaPrasarana($id_perumahan, $id_sarana_prasarana_perumahan);

        // Cek proses
        if ($sarana_prasarana !== 'NOT_FOUND') {
            // Jika berhasil, tampilkan response 200 OK
            return response()->json([
                "message" => "Delete sarana dan prasarana dengan id: $id_sarana_prasarana_perumahan dari perumahan: $id_perumahan, Berhasil",
                "data_deleted"    => $sarana_prasarana
            ], 201);
        } else if ($sarana_prasarana === 'NOT_FOUND') {
            // Jika perumahan tidak ditemukan, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Data Tidak Ditemukan",
                "data"    => $sarana_prasarana
            ], 404);
        } else {
            // Jika ada terjadi kesalahan dalam proses delete, maka tampilkan response 500 INTERNAL SERVER ERROR
            return response()->json([
                "message" => "Delete sarana dan prasarana dengan id: $id_sarana_prasarana_perumahan dari perumahan: $id_perumahan, Gagal"
            ], 500);
        }
    }

    // GROUP PERUMAHAN / FASILITAS

    // Add Fasilitas Perumahan
    public function addFasilitas(Request $request, $id_perumahan)
    {
        // Validation 
        $message = [
            'required' => ':attribute harus diisi!'
        ];

        $validator = Validator::make(
            $request->all(),
            [
                "fasilitas_perumahan" => "required"
            ],
            $message
        );

        // Cek Validasi
        if ($validator->fails()) {
            // Jika validasi gagal, tampilkan response 400 BAD REQUEST
            return response()->json([
                "error" => $validator->errors()
            ], 400);
        }
        // Jika berhasil, lanjutkan proses di bawah ini

        $fasilitas = Perumahan::addFasilitas($request, $id_perumahan);

        // Cek apakah proses tambah berhasil
        if ($fasilitas !== 'NOT_FOUND') {
            // Jika iya, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Tambah data fasilitas dengan id perumahan: $id_perumahan, Berhasil",
                "data"    => $fasilitas
            ], 201);
        } else if ($fasilitas === 'NOT_FOUND') {
            // Jika tidak ditemukan, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Gagal tambah data, Perumahan Tidak Ditemukan"
            ], 404);
        } else {
            // Jika tidak, tampilkan response 400 BAD REQUEST
            return response()->json([
                "message" => "Tambah data fasilitas dengan id perumahan: $id_perumahan, Gagal"
            ], 400);
        }
    }

    // Get All Fasilitas By ID Perumahan
    public function getFasilitas($id_perumahan)
    {
        // Get All Fasilitas
        $fasilitas = Perumahan::getFasilitas($id_perumahan);

        // Cek proses
        if ($fasilitas !== 'NOT_FOUND') {
            // Jika berhasil, tampilkan response 200 OK
            return response()->json([
                "message" => "Get all fasilitas dengan id perumahan : $id_perumahan, Berhasil",
                "data"    => $fasilitas
            ], 200);
        } else if ($fasilitas === 'NOT_FOUND') {
            // Jika perumahan tidak ditemukan, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Perumahan dengan id: $id_perumahan, Tidak Ditemukan",
                "data"    => $fasilitas
            ], 404);
        } else {
            // Jika perumahan belum memiliki fasilitas, tetap tampilkan response 200 OK
            return response()->json([
                "message" => "Perumahan dengan id: $id_perumahan, Belum Memiliki Fasilitas",
                "data"    => $fasilitas
            ], 200);
        }
    }

    // Delete Fasilitas by ID
    public function deleteFasilitas($id_perumahan, $id_fasilitas_perumahan)
    {
        // Delete Fasilitas
        $fasilitas = Perumahan::deleteFasilitas($id_perumahan, $id_fasilitas_perumahan);

        // Cek proses
        if ($fasilitas !== 'NOT_FOUND') {
            // Jika berhasil, tampilkan response 200 OK
            return response()->json([
                "message" => "Delete fasilitas dengan id: $id_fasilitas_perumahan dari perumahan: $id_perumahan, Berhasil",
                "data_deleted"    => $fasilitas
            ], 201);
        } else if ($fasilitas === 'NOT_FOUND') {
            // Jika perumahan atau fasilitas tidak ditemukan, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Data Tidak Ditemukan",
                "data"    => $fasilitas
            ], 404);
        } else {
            // Jika proses update gagal, tampilkan response 500 INTERNAL SERVER ERROR
            return response()->json([
                "message" => "Delete fasilitas dengan id: $id_fasilitas_perumahan dari perumahan: $id_perumahan, Gagal"
            ], 500);
        }
    }

    // Delete Properti
    public function deleteProperti($id_perumahan, $id_bangunan)
    {
        $tbl_foto = "foto_bangunan";
        $properti = Properti::where([
            ["id_perumahan", '=', $id_perumahan],
            ["id_bangunan", '=', $id_bangunan],
        ])
            ->first();

        if ($properti) {
            // Delete Sertifikat Rumah dan denah
            Storage::delete($properti->sertifikat);
            Storage::delete($properti->denah);

            // Delete Foto Bangunan
            $foto_properti = DB::table($tbl_foto)->where("id_bangunan", $id_bangunan)->get();
            foreach ($foto_properti as $foto) {
                $path = $foto->foto_bangunan;
                Storage::delete($path);
            }

            // Delete Properti
            $properti->delete();

            return response()->json([
                "message" => "Data bangunan dengan id_perumahan: $id_perumahan & id_bangunan: $id_bangunan berhasil dihapus",
                "data" => $properti,
                "foto_properti" => $foto_properti,
            ], 200);
        } else {
            return response()->json([
                "message" => "Data bangunan dengan id_perumahan: $id_perumahan & id_bangunan: $id_bangunan tidak ditemukan",
            ], 404);
        }
    }

    // Export Rekap Perumahan
    public function exportRekapPerumahan()
    {
        return Excel::download(new RekapPerumahanExport, 'rekap-perumahan.xlsx');
    }

    // Export Perumahan
    public function exportPerumahan(Request $req, $id_user)
    {
        $user = User::find($id_user);

        return Excel::download(new PerumahanExport($user, $req), 'perumahan.xlsx');

        // $perumahan = Perumahan::getAllPerumahanExport($req);
        // return response()->json($perumahan);
    }

    // Export Perumahan Verifikasi
    public function exportPerumahanVerifikasi(Request $req, $id_user)
    {
        $user = User::find($id_user);

        return Excel::download(new KonfirmasiPerumahanExport($user, $req), 'verifikasi-perumahan.xlsx');
    }

    // Testing
    public function getPerumahanTest(Request $req, $id_user)
    {
        $perumahan = Perumahan::getAllPerumahanExport($req);
        return response()->json($perumahan);
    }
}
