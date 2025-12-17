<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TracNghiem extends Model
{
    protected $table = 'tracnghiem';
    protected $primaryKey = 'ID_Cau';
    public $timestamps = true;

    protected $fillable = [
        'CauHoi',
        'DapAnA',
        'DapAnB',
        'DapAnC',
        'DapAnD',
        'DapAnDung'
    ];
}
