<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TienDoHoc;

class TienDoHocController extends Controller
{
    public function baiHocDangHocGanNhat($userId)
    {
        $tienDo = TienDoHoc::with('baiHoc')
            ->where('ID_User', $userId)
            ->where('TrangThai', 1)
            ->orderBy('updated_at', 'desc')
            ->first();

        if (!$tienDo) {
            $tienDo = TienDoHoc::with('baiHoc')
                ->where('ID_User', $userId)
                ->orderBy('updated_at', 'desc')
                ->first();
        }

        if (!$tienDo || !$tienDo->baiHoc) {
            return response()->json([
                'message' => 'User chưa học bài nào hoặc bài học không tồn tại'
            ], 404);
        }

        return response()->json([
            'message' => 'Lấy bài học đang học gần nhất thành công',
            'data' => [
                'ID_BaiHoc'   => $tienDo->baiHoc->ID_BaiHoc,
                'TenBaiHoc'   => $tienDo->baiHoc->TenBaiHoc,
                'ID_Chuong'   => $tienDo->baiHoc->ID_Chuong,
                'TrangThai'   => $tienDo->TrangThai,
                'ThoiDiemHoc' => $tienDo->updated_at
            ]
        ], 200);
    }
     public function getTienDoHocOfUser($userId)
    {
        $tienDo = TienDoHoc::where('ID_User', $userId)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $tienDo
        ]);
    }
}
