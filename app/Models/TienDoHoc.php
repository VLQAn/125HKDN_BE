<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TienDoHoc extends Model
{
    protected $table = 'tiendohoc';
    protected $primaryKey = 'ID_TienDo';
    public $timestamps = true;

    protected $fillable = [
        'ID_User',
        'ID_BaiHoc',
        'TrangThai'
    ];

    public function baiHoc()
    {
        return $this->belongsTo(BaiHoc::class, 'ID_BaiHoc', 'ID_BaiHoc');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_User', 'ID_User');
    }
}
