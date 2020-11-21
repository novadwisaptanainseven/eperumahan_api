<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Login
    public function login(Request $request)
    {

        // Request Validation
        $messages = [
            'required' => ':attribute harus diisi!',
        ];
        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required',
                'password' => 'required'
            ],
            $messages
        );
        // Cek Validasi
        if ($validator->fails()) {
            // Jika Validasi Gagal
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        // Jika Validasi Berhasil
        $user = User::where('username', $request->username)->first();


        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        // Cek Apakah User Statusnya Aktif
        if ($user->status === 0) {
            // Jika user tidak aktif maka tampilkan response 
            return response()->json([
                'message' => "Status Akun User dengan id: $user->id, Belum Aktif, Silahkan konfirmasi ke Administrator"
            ], 403);
        }

        $token = $user->createToken('user-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    // Cek User saat ini
    public function me()
    {
        $user = Auth::user();

        return response()->json([
            'message' => 'success',
            'user'    => $user
        ], 200);
    }

    // Logout
    public function logout(Request $request)
    {
        // $user = Auth::user();
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "message" => "Logout Success",
            "user"    => $request->user()
        ]);
    }
}
