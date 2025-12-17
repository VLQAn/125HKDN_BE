<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DienTu extends Model
{
    protected $table = 'dientu';
    protected $primaryKey = 'ID_Cau';
    public $timestamps = true;

    protected $fillable = [
        'CauHoi',
        'CauMau',
        'ManhGhepA',
        'ManhGhepB',
        'ManhGhepC',
        'ManhGhepD',
        'DapAnDung'
    ];
}
