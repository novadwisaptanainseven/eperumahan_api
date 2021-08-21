<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckStatus
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

        // Cek Apakah User adalah Admin atau Super Administrator
        if ($user->level == 1 || $user->level == 2) {
            // Jika Iya, maka access url diteruskan
            return $next($request);
        }
        // Jika Bukan maka access forbidden 403
        return response()->json([
            "message" => "Akses Ditolak, Anda Bukan Admin!"
        ], 403);
    }
}
