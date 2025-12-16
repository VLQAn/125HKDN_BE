<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CauHoi extends Model
{
    protected $table = 'cauhoi';
    protected $primaryKey = 'ID_Cau';
    public $timestamps = true;

    protected $fillable = [
        'ID_BaiHoc',
        'LoaiCauHoi',
        'ThuTu'
    ];
}
