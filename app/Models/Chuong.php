<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chuong extends Model
{
    protected $table = 'chuong';
    protected $primaryKey = 'ID_Chuong';
    public $timestamps = true;

    protected $fillable = [
        'TenChuong',
        'ThuTu'
    ];
}
