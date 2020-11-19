<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengembang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PengembangController extends Controller
{
    // Add Pengembang
    public function addPengembang(Request $request){

        // Validation
        $messages = [
            "required" => ":attribute is required!"
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
                'ijin_perusahaan'    => 'mimes:pdf,xls,xlsx|max:10048'
            ],
            $messages
        );
        // Cek Validasi
        if($validator->fails()){
            // Jika Validasi Gagal, tampilkan response 400
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        // Jika Validasi Berhasil

        // Cek Apakah Tidak ada file foto
        if(!$request->file('foto_pengembang'))
            $foto = '';
        else
            $foto = $request->foto_pengembang->store('pengembang/foto');
        

        // Cek Apakah Tidak ada file ijin perusahaan
        if(!$request->file('ijin_perusahaan'))
            $ijin = '';
        else
            $ijin = $request->ijin_perusahaan->store('pengembang/file');

        // Tambah Data User
        $user = new User;
        $user->username = $request->username;
        $user->password = $request->password;
        $konf_pass      = $request->konf_pass;
        $user->level    = 2;
        $user->status   = 0;
        
        // Cek Apakah Konfimasi Password Cocok
        if($user->password === $konf_pass)
        {
            // Hashing Password
            $user->password = Hash::make($user->password);
            
            // Simpan data user baru ke database
            $user->save();

            // Dapatkan ID User untuk diintegrasikan dengan tabel Pengembang
            $id_user = User::where('username', $user->username)->first()->id;
        }
        else
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

        $pengembang->ijin_perusahaan    = '/api/' . $ijin;
        $pengembang->foto_pengembang    = '/api/' . $foto;
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

    // Update Pengembang
    public function updatePengembang($id_pengembang){
        return response()->json([
            "message" => "Update Data Pengembang with id: $id_pengembang, Berhasil"
        ], 201);
    }

    // Get All Pengembang
    public function getAllPengembang(){
        return response()->json([
            "message" => "Get All Data Pengembang Berhasil"
        ], 200);
    }

    // Get Pengembang By ID
    public function getPengembangById($id_pengembang){
        return response()->json([
            "message" => "Get Data Pengembang with id: $id_pengembang Berhasil"
        ], 200);
    }

    // Delete Pengembang
    public function deletePengembang($id_pengembang){
        return response()->json([
            "message" => "Delete Data Pengembang with id: $id_pengembang, Berhasil"
        ], 201);
    }
}
