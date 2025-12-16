<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChonAnh extends Model
{
    protected $table = 'chonanh';
    protected $primaryKey = 'ID_Cau';
    public $timestamps = true;

    protected $fillable = [
        'ID_Cau',
        'CauHoi',
        'DuongDanA',
        'DuongDanB',
        'DuongDanC',
        'DuongDanD',
        'DapAnDung'
    ];
}
