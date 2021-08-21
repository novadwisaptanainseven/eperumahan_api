<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IsPengembang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get Current User
        $user = Auth::user();

        // Cek Apakah User adalah Pengembang
        if ($user->level == 3) {
            // Jika Iya, maka access url diteruskan
            return $next($request);
        }
        // Jika Bukan maka access forbidden 403
        return response()->json([
            "message" => "Akses Ditolak, Anda Bukan Pengembang!"
        ], 403);
    }
}
