<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';
    protected $primaryKey = 'ID_Cau';
    public $timestamps = true;

    protected $fillable = [
        'DuongDanVideo',
        'CauHoi',
        'DapAnA',
        'DapAnB',
        'DapAnC',
        'DapAnD',
        'DapAnDung'
    ];
}
