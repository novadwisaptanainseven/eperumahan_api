<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kontak extends Model
{
    use HasFactory;

    protected $table = 'kontak';
    protected $primaryKey = 'id_kontak';

    // Sending Message
    public static function sendMessage($req)
    {
        // Tabel
        $tbl_kontak = 'kontak';

        $send_message = DB::table($tbl_kontak)->insert([
            'kontak_nama' => $req->kontak_nama,
            'kontak_telepon' => $req->kontak_telepon,
            'kontak_pesan' => $req->kontak_pesan
        ]);

        if ($send_message) {
            return true;
        } else {
            return false;
        }
    }

    // Delete Message
    public static function deleteMessage($id)
    {
        $tbl_kontak = 'kontak';

        // Cek apakah id ditemukan
        $pesan = DB::table($tbl_kontak)->where('id_kontak', '=', $id)->first();
        if (!$pesan) {
            return null;
        }

        // Delete message by id
        $delete = DB::table($tbl_kontak)->where('id_kontak', '=', $id)->delete();

        if ($delete) {
            return true;
        } else {
            return 'INTERNAL_SERVER_ERROR';
        }
    }
}
