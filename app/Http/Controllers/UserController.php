<?php

namespace App\Http\Controllers;

use App\Exports\AkunExport;
use App\Http\Requests\UserStoreRequest;
use App\Models\Pengembang;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

    // Search User
    public function searchUser(Request $request)
    {
        $search_value = ($request->value) ? $request->value : '';

        $data_user = User::searchUserByValue($search_value);

        // Cek apakah data user ditemukan
        if ($data_user) {
            // Jika ditemukan, tampilkan response 200 OK
            return response()->json([
                "message" => "Get Data user dengan data pencarian: $search_value, Berhasil",
                "data"    => $data_user
            ], 200);
        } else {
            // Jika tidak, tetap tampilkan response 200 OK
            return response()->json([
                "message" => "Get Data user dengan data pencarian: $search_value, Gagal",
                "data"    => $data_user
            ], 200);
        }
    }

    // Get All Users
    public function getAllUsers(Request $request)
    {
        // Pagination
        $request->page = ($request->page) ? $request->page : '1';
        $request->per_page = ($request->per_page) ? $request->per_page : '8';
        $request->order = ($request->order) ? $request->order : 'desc';
        // End Pagination

        $users = User::getAllUsers($request);

        return response()->json([
            'message' => "Get All Users Succcess",
            "data"    => $users
        ]);
    }

    // Get User By ID
    public function getUserById($id_user)
    {
        $user = User::where('id', $id_user)->first();
        return response()->json([
            "message" => "Get User with id: $id_user, Success",
            "data"    => $user
        ], 200);
    }

    // Tambah User
    public function register(Request $request)
    {
        // Validation
        $messages = [
            'required'     => ':attribute is required!',
            'unique'       => ':attribute sudah ada yang punya'
        ];
        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required|unique:users',
                'password' => 'required',
                'level'    => 'required',
                'status'   => 'required',
            ],
            $messages
        );
        // Jika Validasi Gagal
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        // Jika Validasi Berhasil
        $user = new User;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->level = $request->level;
        $user->status = $request->status;
        $user->save();

        // Cek apakah akun dibuatkan untuk pengembang (id_pengembang)
        if ($request->id_pengembang) {
            $pengembang = Pengembang::find($request->id_pengembang);

            // Hapus Akun Lama dari database
            User::find($pengembang->id_user)->delete();

            $pengembang->id_user = $user->id;
            $pengembang->save();

            return response()->json([
                "message" => "Register user untuk pengembang berhasil",
                "data_akun"    => $user,
                "pengembang" => $pengembang
            ], 201);
        }

        return response()->json([
            "message" => "Register User Berhasil",
            "data"    => $user
        ], 201);
    }

    // Update Data User
    public function updateUser(Request $request, $id_user)
    {
        $konf_pass_rules = '';
        $pass_baru_rules = '';
        $pass_lama_rules = '';

        // Cek username
        $user = User::where('id', $id_user)->first();
        if ($user->username === $request->username) {
            $username_rules = 'required';
        } else {
            $username_rules = 'unique:users|required';
        }

        if ($request->password_lama) {
            $konf_pass_rules = 'required';
            $pass_baru_rules = 'required';
        } else {
            if ($request->password_baru || $request->konf_pass) {
                $pass_lama_rules = 'required';
                $konf_pass_rules = 'required';
                $pass_baru_rules = 'required';
            }
        }

        // Validation
        $message = [
            "required" => ":attribute harus diisi",
            "unique"   => ":attribute sudah ada yang punya"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "username"      => $username_rules,
                "password_lama" => $pass_lama_rules,
                'konf_pass'     => $konf_pass_rules,
                'password_baru' => $pass_baru_rules,
                "status"        => 'required',
                "level"         => 'required',
            ],
            $message
        );
        if ($validator->fails()) {
            // Jika Validasi Gagal
            return response()->json([
                "errors" => $validator->errors()
            ], 400);
        }

        $password_baru = "";
        if (!empty($request->password_lama)) {
            if (Hash::check($request->password_lama, $user->password)) {
                if ($request->password_baru === $request->konf_pass) {
                    $password_baru = Hash::make($request->password_baru);

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
        // // Cek password lama
        // if (!Hash::check($request->password_lama, $user->password)) {
        //     return response([
        //         'errors' => ['Password lama salah']
        //     ], 400);
        // }

        // // Cek apakah konfirmasi password cocok
        // if ($request->password_baru === $request->konf_pass) {
        //     // Hashing password
        //     $password_baru = Hash::make($request->password_baru);
        // } else {
        //     return response([
        //         'errors' => ['Konfirmasi password tidak sesuai']
        //     ], 400);
        // }
        // Jika Validasi Berhasil
        // Lakukan Update Data

        $user->username = ($request->username !== null) ? $request->username : $user->username;
        $user->password = $password_baru ? $password_baru : $user->password;
        $user->level    = ($request->level !== null) ? $request->level : $user->level;
        $user->status   = ($request->status !== null) ? $request->status : $user->status;
        $user->save();
        // $name = $request->input('name', 'Sally');

        return response()->json([
            "message" => "Update Data User with id: $id_user, Success",
            "data"    => $user
        ]);
    }

    // Update Status User
    public function updateStatusUser(Request $request, $id_user)
    {
        $user = User::where('id', $id_user)->first();

        // Cek apakah user ditemukan
        if (!$user) {
            // Jika User tidak ditemukan maka tampilkan response 404
            return response()->json([
                "message" => "User with id:$id_user, tidak ditemukan"
            ], 404);
        }
        // Jika User Ditemukan maka lanjutkan proses update Status
        $user->status = ($request->status !== null) ? $request->status : $user->status;
        $user->save();

        return response()->json([
            "message" => "Update Status User Berhasil",
            "data"    => [
                "id_user" => $user->id,
                "status"  => $user->status
            ]
        ], 201);
    }

    public function destroy($id_user)
    {
        $user = User::find($id_user);

        if ($user) {
            $user->delete();

            return response()->json([
                "message" => "Berhasil menghapus data user dengan id: {$id_user}",
                "deleted_data" => $user
            ], 201);
        } else {
            return response()->json([
                "message" => "Data user dengan id: {$id_user} tidak ditemukan",
            ], 404);
        }
    }

    // Export Akun ke Excel
    public function exportUser(Request $req, $id_user)
    {
        $user = User::find($id_user);

        return Excel::download(new AkunExport($user, $req), 'data-user.xlsx');
    }
}
