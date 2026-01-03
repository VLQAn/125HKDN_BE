<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'admin';
    protected $primaryKey = 'ID_Admin';

    protected $fillable = [
        'TenDangNhap',
        'MatKhau',
        'HoTen',
    ];

    protected $hidden = [
        'MatKhau',
    ];
}
