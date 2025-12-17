<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NgheXepCau extends Model
{
    protected $table = 'nghexepcau';
    protected $primaryKey = 'ID_Cau';
    public $timestamps = true;

    protected $fillable = [
        'DuongDanAudio',
        'ManhGhepA',
        'ManhGhepB',
        'ManhGhepC',
        'ManhGhepD',
        'DapAnDung'
    ];
}
