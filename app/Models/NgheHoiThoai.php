<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NgheHoiThoai extends Model
{
    protected $table = 'nghehoithoai';
    protected $primaryKey = 'ID_Cau';
    public $timestamps = true;

    protected $fillable = [
        'DuongDanAudio',
        'PhuDe',
        'CauHoi',
        'DapAnA',
        'DapAnB',
        'DapAnDung'
    ];
}
