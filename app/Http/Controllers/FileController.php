<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    // Download Image
    public function image($path, $filename)
    {
        $fullpath = "/app/$path/foto/$filename";
        $message = "Data Image Tidak Ditemukan";

        return $this->downloads($fullpath, $message);
    }

    // Download Brosur
    public function brosur($path, $filename)
    {
        $fullpath = "/app/$path/brosur/$filename";
        $message = "Data Brosur Tidak Ditemukan";

        return $this->downloads($fullpath, $message);
    }

    // Download Document
    public function document($path, $filename)
    {
        $fullpath = "/app/$path/file/$filename";
        $message = "Data Document Tidak Ditemukan";

        return $this->downloads($fullpath, $message);
    }

    // Download Form Data Perumahan
    public function form($path, $filename)
    {
        $fullpath = "/app/$path/form/$filename";
        $message = "Form Data Perumahan Tidak Ditemukan";

        return $this->downloads($fullpath, $message);
    }

    public function downloads($fullpath, $message)
    {
        if (file_exists(storage_path($fullpath))) {
            return response()->download(storage_path($fullpath));
        } else {
            return response()->json([
                "message" => $message
            ]);
        }
    }
}
