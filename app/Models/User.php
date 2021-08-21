<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Search User By Value
    public static function searchUserByValue($search_value)
    {
        // Tabel - tabel
        $users = 'users';

        $data_users = DB::table($users)
            ->where([
                ['status_deleted', '=', 0],
                ['username', 'like', "%$search_value%"]
            ])
            ->get();

        if (count($data_users) === 0) {
            $total_data_pencarian = 0;
            $data_users = null;
        } else {
            $total_data_pencarian = count($data_users);
        }

        $data = [
            "total_data" => ($total_data_pencarian !== 0) ? count($data_users) : 0,
            "data" => $data_users
        ];

        return $data;
    }

    // Get All Users
    public static function getAllUsers($req)
    {
        // Tabel - Tabel
        $users   = 'users';

        // Inisialisasi Pagination
        $page = intval($req->page);
        $per_page = intval($req->per_page);
        $order = $req->order;

        // Get total data
        $total = DB::table($users)
            ->where('status_deleted', '=', '0')
            ->get()
            ->count();

        // Pagination
        $offset = ($page - 1) * $per_page;
        $last_page = ceil($total / $per_page);

        // Mengambil data user
        $data_users = DB::table($users)
            ->where('status_deleted', '=', '0')
            ->offset($offset)
            ->limit($per_page)
            // ->orderBy('id', $order)
            ->orderBy('level', $order)
            ->get();
        // End Pagination

        // Cek apakah data perumahan ada isinya
        if (count($data_users) == 0)
            $data_users = null;

        $data = [
            "total_data"   => $total,
            "per_page"     => $per_page,
            "current_page" => $page,
            "last_page"    => $last_page,
            "order"        => $order,
            "data"         => $data_users
        ];

        return $data;
    }
}
