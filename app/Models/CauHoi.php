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

    /**
     * ====== QUAN HỆ 1-1 VỚI CÁC BẢNG CHI TIẾT ======
     */

    public function dientu()
    {
        return $this->hasOne(DienTu::class, 'ID_Cau', 'ID_Cau');
    }

    public function tracnghiem()
    {
        return $this->hasOne(TracNghiem::class, 'ID_Cau', 'ID_Cau');
    }

    public function chonanh()
    {
        return $this->hasOne(ChonAnh::class, 'ID_Cau', 'ID_Cau');
    }

    public function nghehoithoai()
    {
        return $this->hasOne(NgheHoiThoai::class, 'ID_Cau', 'ID_Cau');
    }

    public function nghexepcau()
    {
        return $this->hasOne(NgheXepCau::class, 'ID_Cau', 'ID_Cau');
    }

    public function video()
    {
        return $this->hasOne(Video::class, 'ID_Cau', 'ID_Cau');
    }
}
