<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'user';        
    protected $primaryKey = 'ID_User';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'HoTen',
        'Email',
        'MatKhau',
        'Diem',
        'SoGioOnline',
    ];
}