<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Get All Users
    public function getAllUsers()
    {
        $users = User::all();

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
            'unique'       => ':attribute already exist'
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
            ], 401);
        }
        // Jika Validasi Berhasil
        $user = new User;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->level = $request->level;
        $user->status = $request->status;
        $user->save();

        return response()->json([
            "message" => "Register User Berhasil",
            "data"    => $user
        ], 201);
    }

    // Login
    public function login(Request $request)
    {
        // return 'Hello World';
        // Validation
        $messages = [
            'required' => ':attribute is required!',
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
        // print_r($data);
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $token = $user->createToken('user-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    // Update Data User
    public function updateUser(Request $request, $id_user)
    {
        // Validation
        $message = [
            "required" => ":attribute is required!",
            "unique"   => ":attribute already exist"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "username" => "unique:users",
            ]
        );
        if ($validator->fails()) {
            // Jika Validasi Gagal
            return response()->json([
                "errors" => $validator->errors()
            ]);
        }
        // Jika Validasi Berhasil
        // Lakukan Update Data
        $user = User::where('id', $id_user)->first();

        $user->username = ($request->username !== null) ? $request->username : $user->username;
        $user->password = Hash::make(($request->password !== null) ? $request->password : $user->password);
        $user->level    = ($request->level !== null) ? $request->level : $user->level;
        $user->status   = ($request->status !== null) ? $request->status : $user->status;
        $user->save();
        // $name = $request->input('name', 'Sally');

        return response()->json([
            "message" => "Update Data User with id: $id_user, Success",
            "data"    => $user
        ]);
    }
}
