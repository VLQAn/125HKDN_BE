<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaiHoc extends Model
{
    protected $table = 'baihoc';
    protected $primaryKey = 'ID_BaiHoc';
    public $timestamps = true;

    protected $fillable = [
        'ID_Chuong',
        'TenBaiHoc',
        'IconBaiHoc',
        'ThuTu'
    ];
}
