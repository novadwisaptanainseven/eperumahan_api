<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KontakController extends Controller
{
    // Sending Message
    public function sendMessage(Request $request)
    {
        // Validation
        $err_message = [
            'required' => ':attribute harus diisi'
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "kontak_nama" => 'required',
                "kontak_telepon" => 'required',
                "kontak_pesan" => 'required'
            ],
            $err_message
        );

        // Cek Validasi
        if ($validator->fails()) {
            // Jika validasi gagal, maka tampilkan response 400 BAD REQUEST
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        $send_message = Kontak::sendMessage($request);

        if ($send_message) {
            return response()->json([
                'message' => 'Kirim pesan berhasil'
            ], 201);
        } else {
            return response()->json([
                'message' => 'Kirim pesan gagal, ada kesalahan dalam penginputan',
            ], 400);
        }
    }

    // Get All Messages
    public function getAllMessages()
    {
        $message = Kontak::orderBy('id_kontak', 'desc')->get();

        if (count($message) > 0) {
            return response()->json([
                "message" => "Get All Messages, Success",
                "data" => $message
            ], 200);
        } else {
            return response()->json([
                "message" => "Message Belum Tersedia",
            ], 200);
        }
    }

    // Delete Message
    public function deleteMessage($id)
    {
        $delete = Kontak::deleteMessage($id);

        if ($delete !== 'INTERNAL_SERVER_ERROR') {
            return response()->json([
                "message" => "Pesan dengan id: $id berhasil dihapus"
            ], 201);
        } elseif ($delete === 'INTERNAL_SERVER_ERROR') {
            return response()->json([
                "message" => "Pesan dengan id: $id gagal dihapus, terjadi kesalahan server"
            ], 500);
        } else {
            return response()->json([
                "message" => "Pesan dengan id: $id gagal dihapus, id tidak ditemukan"
            ], 201);
        }
    }
}
