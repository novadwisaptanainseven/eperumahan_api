<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengembang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengembangController extends Controller
{
    // Search Pengembang
    public function searchPengembang(Request $request)
    {
        $search_value = ($request->value) ? $request->value : '';

        $data_pengembang = Pengembang::searchPengembangByValue($search_value);

        // Cek apakah data bangunan ditemukan
        if ($data_pengembang) {
            // Jika ditemukan, tampilkan response 200 OK
            return response()->json([
                "message" => "Get Data Pengembang dengan data pencarian: $search_value, Berhasil",
                "data"    => $data_pengembang
            ], 200);
        } else {
            // Jika tidak, tetap tampilkan response 200 OK
            return response()->json([
                "message" => "Get Data Pengembang dengan data pencarian: $search_value, Gagal",
                "data"    => $data_pengembang
            ], 200);
        }
    }

    // Add Pengembang
    public function addPengembang(Request $request)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!",
            "unique" => ":attribute sudah ada yang punya"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                'nik_pengembang'     => 'required',
                'nama_pengembang'    => 'required',
                'telepon_pengembang' => 'required',
                'email_pengembang'   => 'required',
                'alamat_pengembang'  => 'required',
                'username'           => 'required|unique:users',
                // 'id_user'            => 'required',
                'foto_pengembang'    => 'mimes:jpg,jpeg,png|max:5048',
                'ijin_perusahaan'    => 'mimes:pdf|max:10048'
            ],
            $messages
        );
        // Cek Validasi
        if ($validator->fails()) {
            // Jika Validasi Gagal, tampilkan response 400
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        // Jika Validasi Berhasil

        // Cek Apakah Tidak ada file foto
        if (!$request->file('foto_pengembang'))
            $foto = '';
        else
            $foto = $request->foto_pengembang->store('pengembang/foto');


        // Cek Apakah Tidak ada file ijin perusahaan
        if (!$request->file('ijin_perusahaan'))
            $ijin = '';
        else
            $ijin = $request->ijin_perusahaan->store('pengembang/file');

        // Tambah Data User
        $user = new User;
        $user->username = $request->username;
        $user->password = $request->password;
        $konf_pass      = $request->konf_pass;
        $user->level    = 2;
        $user->status   = 1;

        // Cek Apakah Konfimasi Password Cocok
        if ($user->password === $konf_pass) {
            // Hashing Password
            $user->password = Hash::make($user->password);

            // Simpan data user baru ke database
            $user->save();

            // Dapatkan ID User untuk diintegrasikan dengan tabel Pengembang
            $id_user = User::where('username', $user->username)->first()->id;
        } else
            return response()->json([
                "message" => "Konfirmasi Password Tidak Sesuai!"
            ], 400);

        // Tambah Data Pengembang
        $pengembang = new Pengembang;
        $pengembang->nik_pengembang     = $request->nik_pengembang;
        $pengembang->nama_pengembang    = $request->nama_pengembang;
        $pengembang->telepon_pengembang = $request->telepon_pengembang;
        $pengembang->alamat_pengembang  = $request->alamat_pengembang;
        $pengembang->email_pengembang   = $request->email_pengembang;

        // Pembuatan Slug -> id-nama_pengembang
        // Dapatkan data terakhir di tabel pengembang
        $last_data                      = DB::table('pengembang')->orderBy('id_pengembang', 'DESC')->first();
        $slug                           = Str::of($last_data->id_pengembang + 1 . ' ' . $pengembang->nama_pengembang)->slug('-');
        $pengembang->pengembang_slug    = $slug;
        // End Pembuatan Slug

        $pengembang->ijin_perusahaan    = $ijin;
        $pengembang->foto_pengembang    = $foto;
        $pengembang->status_aktif       = 0;
        $pengembang->id_user            = $id_user;
        $pengembang->status_deleted     = 0;
        // Simpan Data Pengembag ke database
        $pengembang->save();
        return response()->json([
            "message" => "Tambah Data Pengembang Berhasil",
            "data"    => $pengembang
        ], 201);
    }

    // Update Pengembang Level Admin
    public function updatePengembang(Request $request, $id_pengembang)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                'foto_pengembang'    => 'mimes:jpg,jpeg,png|max:5048',
                'ijin_perusahaan'    => 'mimes:pdf,xls,xlsx|max:10048'
            ],
            $messages
        );
        // Cek Validasi
        if ($validator->fails()) {
            // Jika Validasi Gagal, tampilkan response 400
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        // Jika Validasi Berhasil

        // Cek Apakah Tidak ada file foto
        if (!$request->file('foto_pengembang'))
            $foto = '';
        else
            $foto = $request->foto_pengembang->store('pengembang/foto');


        // Cek Apakah Tidak ada file ijin perusahaan
        if (!$request->file('ijin_perusahaan'))
            $ijin = '';
        else
            $ijin = $request->ijin_perusahaan->store('pengembang/file');

        // Mengambil data pengembang yang akan diupdate berdasarkan ID
        $pengembang = Pengembang::where('id_pengembang', $id_pengembang)->first();

        if ($pengembang) {
            // Lakukan proses update
            $pengembang->nik_pengembang     = ($request->nik_pengembang !== null) ? $request->nik_pengembang : $pengembang->nik_pengembang;
            $pengembang->nama_pengembang    = ($request->nama_pengembang !== null) ? $request->nama_pengembang : $pengembang->nama_pengembang;
            $pengembang->telepon_pengembang = ($request->telepon_pengembang !== null) ? $request->telepon_pengembang : $pengembang->telepon_pengembang;
            $pengembang->alamat_pengembang  = ($request->alamat_pengembang !== null) ? $request->alamat_pengembang : $pengembang->alamat_pengembang;
            $pengembang->email_pengembang   = ($request->email_pengembang !== null) ? $request->email_pengembang : $pengembang->email_pengembang;

            // Pembuatan Slug -> id-nama_pengembang
            // Dapatkan data terakhir di tabel pengembang
            $slug                           = Str::of($pengembang->id_pengembang . ' ' . $pengembang->nama_pengembang)->slug('-');
            $pengembang->pengembang_slug    = $slug;
            // End Pembuatan Slug

            // Hapus Foto lama jika user update foto
            // Get path foto untuk keperluan menghapus file foto di storage
            if ($foto !== '') {
                $path_foto = $pengembang->foto_pengembang;
                Storage::delete("$path_foto");
            }
            // Hapus File Ijin Perusahaan lama jika user update file ijin perusahaan
            // Get path file ijin perusahaan untuk keperluan menghapus file di storage
            if ($ijin !== '') {
                $path_ijin = $pengembang->ijin_perusahaan;
                Storage::delete("$path_ijin");
            }

            $pengembang->ijin_perusahaan = ($ijin !== '') ? $ijin : $pengembang->ijin_perusahaan;
            $pengembang->foto_pengembang = ($foto !== '') ? $foto : $pengembang->foto_pengembang;

            // Insert data to database
            $pengembang->save();

            return response()->json([
                "message" => "Update Data Pengembang with id: $id_pengembang, Berhasil",
                "data"    => $pengembang
            ], 201);
        } else {
            return response()->json([
                "message" => "Update Data Gagal, Data Tidak Ditemukan!"
            ], 404);
        }
    }

    // Update Pengembang Level Pengembang
    public function updatePengembang2(Request $request)
    {
        $konf_pass_rules = '';
        $pass_baru_rules = '';

        // Cek username
        $user = Auth::user();
        // if ($user->username === $request->username) {
        //     $username_rules = 'required';
        // } else {
        //     $username_rules = 'unique:users|required';
        // }

        if ($request->password_lama) {
            $konf_pass_rules = 'required';
            $pass_baru_rules = 'required';
        }

        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                'foto_pengembang'    => 'mimes:jpg,jpeg,png|max:5048',
                'ijin_perusahaan'    => 'mimes:pdf,xls,xlsx|max:10048',
                'konf_pass'          => $konf_pass_rules,
                'password_baru'      => $pass_baru_rules,
                // 'username'           => $username_rules
            ],
            $messages
        );
        // Cek Validasi
        if ($validator->fails()) {
            // Jika Validasi Gagal, tampilkan response 400
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        // Jika Validasi Berhasil

        // Cek Apakah Tidak ada file foto
        if (!$request->file('foto_pengembang'))
            $foto = '';
        else
            $foto = $request->foto_pengembang->store('pengembang/foto');


        // Cek Apakah Tidak ada file ijin perusahaan
        if (!$request->file('ijin_perusahaan'))
            $ijin = '';
        else
            $ijin = $request->ijin_perusahaan->store('pengembang/file');

        // Proses Update Password User
        $table_user = 'users';
        $table_pengembang = 'pengembang';

        $pengembang = Pengembang::where(["$table_pengembang.id_user" => $user->id])
            ->select("$table_pengembang.*", "$table_user.username")
            ->leftJoin($table_user, "$table_user.id", "=", "$table_pengembang.id_user")
            ->first();
        // $user = User::where(["id" => $pengembang->id_user])->first();

        if (!empty($request->password_lama)) {
            if (Hash::check($request->password_lama, $user->password)) {
                if ($request->password_baru === $request->konf_pass) {
                    $hash = Hash::make($request->password_baru);
                    $user->password = $hash;
                    $user->save();

                    // return response()->json([
                    //     "message" => "Update Berhasil"
                    // ]);
                } else {
                    return response()->json([
                        'errors' => ['Konfirmasi password tidak sesuai']
                    ], 400);
                }
            } else {
                return response()->json([
                    'errors' => ['Password lama salah']
                ], 400);
            }
        }

        // Update Data Pengembang
        $request->ijin = $ijin;
        $request->foto = $foto;
        $data = Pengembang::updatePengembang($request, $pengembang);
        if ($data) {
            return response()->json([
                "message" => "Update Data Pengembang Berhasil",
                "data"    => $data
            ]);
        }
    }

    // Get All Pengembang
    public function getAllPengembang(Request $req)
    {
        // Pagination
        $req->page = ($req->page) ? $req->page : '1';
        $req->per_page = ($req->per_page) ? $req->per_page : '8';
        $req->order = ($req->order) ? $req->order : 'desc';
        // End Pagination

        $pengembang = Pengembang::getAll($req);

        return response()->json([
            "message" => "Get All Data Pengembang Berhasil",
            "data"    => $pengembang
        ], 200);
    }

    // Get All Pengembang 2
    public function getAllPengembang2(Request $req)
    {
        $limit = $req->limit ? $req->limit : 3;

        $pengembang = Pengembang::getAll2($limit);

        $total_data = Pengembang::where('status_aktif', '=', '1')->count();

        if ($pengembang) {
            return response()->json([
                "message" => "Get All Pengembange Success",
                "total_data" => $total_data,
                "data" => $pengembang
            ], 200);
        } else {
            return response()->json([
                "message" => "Belum Ada Pengembang yang Aktif",
                "total_data" => $total_data,
                "data" => $pengembang
            ], 200);
        }
    }

    // Get Pengembang By ID
    public function getPengembangById($id_pengembang)
    {
        $pengembang = Pengembang::getById($id_pengembang);

        if ($pengembang) {
            return response()->json([
                "message" => "Get Data Pengembang with id: $id_pengembang Berhasil",
                "data"    => $pengembang
            ], 200);
        } else {
            return response()->json([
                "message" => "Data Pengembang Tidak Ditemukan!"
            ], 404);
        }
    }

    // Get Pengembang By Slug
    public function getPengembangBySlug($slug)
    {
        $pengembang = Pengembang::getBySlug($slug);

        if ($pengembang) {
            return response()->json([
                "message" => "Get Data Pengembang with slug: $slug Berhasil",
                "data"    => $pengembang
            ], 200);
        } else {
            return response()->json([
                "message" => "Data Pengembang Tidak Ditemukan!"
            ], 404);
        }
    }

    // Get Akun Pengembang
    public function getAkun()
    {
        $table_user = 'users';
        $table_pengembang = 'pengembang';
        $user = Auth::user();

        $pengembang = Pengembang::where(["$table_pengembang.id_user" => $user->id])
            ->select("$table_pengembang.*", "$table_user.username")
            ->leftJoin($table_user, "$table_user.id", "=", "$table_pengembang.id_user")
            ->first();

        if ($pengembang) {
            return response()->json([
                "message" => "Get Akun Pengembang Berhasil",
                "data"    => $pengembang
            ], 200);
        } else {
            return response()->json([
                "message" => "Get Akun Pengembang Gagal, Data Tidak Ditemukan",
                "data"    => $pengembang
            ], 404);
        }
    }

    // Delete Pengembang
    public function deletePengembang($id_pengembang)
    {
        $delete = Pengembang::softDelete($id_pengembang);

        if ($delete) {
            return response()->json([
                "message" => "Delete Data Pengembang beserta akun user with id: $id_pengembang, Berhasil"
            ], 201);
        } else {
            return response()->json([
                "message" => "Data Tidak Ditemukan atau Telah Terhapus"
            ], 404);
        }
    }

    // Delete Permanent Pengembang
    public function destroy($id_pengembang)
    {
        $pengembang = Pengembang::find($id_pengembang);

        if ($pengembang) {
            $pengembang->delete();
            Storage::delete([$pengembang->foto_pengembang, $pengembang->ijin_perusahaan]);

            return response()->json([
                "message" => "Data pengembang dengan id: $id_pengembang berhasil dihapus",
                "deleted_data" => $pengembang
            ], 201);
        } else {
            return response()->json([
                "message" => "Data pengembang dengan id: $id_pengembang tidak ditemukan",
            ], 404);
        }
    }

    // Update status pengemban
    public function updateStatusPengembang(Request $request, $id_pengembang)
    {
        $pengembang = Pengembang::updateStatusPengembang($id_pengembang, $request->status_aktif);

        // Cek Apakah update data berhasil
        if ($pengembang) {
            // Jika berhasil, tampilkan response 201 CREATED
            return response()->json([
                "message" => "Update Status pengembang dengan id: $id_pengembang Berhasil",
                "data"    => $pengembang
            ], 201);
        } else {
            // Jika gagal, tampilkan response 404 NOT FOUND
            return response()->json([
                "message" => "Data dengan id: $id_pengembang, Tidak Ditemukan",
            ], 404);
        }
    }

    // Get Select Pengembang
    public function getSelectPengembang()
    {
        $pengembang = Pengembang::all();

        return response()->json([
            "message" => "Berhasil mendapatkan semua data pengembang",
            "data" => $pengembang
        ], 200);
    }
}
