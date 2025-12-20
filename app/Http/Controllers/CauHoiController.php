<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CauHoi;

class CauHoiController extends Controller
{
    public function index()
    {
        $cauHoi = CauHoi::orderBy('ThuTu')->get();

        return response()->json([
            'success' => true,
            'data' => $cauHoi
        ]);
    }

    public function show($id)
    {
        $cauHoi = CauHoi::find($id);

        if (!$cauHoi) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy câu hỏi'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $cauHoi
        ]);
    }

    public function getByBaiHoc($id)
    {
        $cauHoi = CauHoi::where('ID_BaiHoc', $id)
                        ->orderBy('ThuTu')
                        ->get();

        return response()->json([
            'success' => true,
            'data' => $cauHoi
        ]);
    }
    public function getChitietCauHoiByBaiHoc($id)
{
    $cauHoi = CauHoi::where('ID_BaiHoc', $id)
        ->orderBy('ThuTu')
        ->get();

    $result = [];

    foreach ($cauHoi as $ch) {

        $chiTiet = [
            'ID_Cau' => $ch->ID_Cau,
            'ID_BaiHoc' => $ch->ID_BaiHoc,
            'LoaiCauHoi' => $ch->LoaiCauHoi,
            'ThuTu' => $ch->ThuTu,
            'created_at' => $ch->created_at,
            'updated_at' => $ch->updated_at,
            'data' => null
        ];

        switch ($ch->LoaiCauHoi) {

            case 'dientu':
                $chiTiet['data'] = $ch->dientu;
                break;

            case 'tracnghiem':
                $chiTiet['data'] = $ch->tracnghiem;
                break;

            case 'chonanh':
                $chiTiet['data'] = $ch->chonanh;
                break;

            case 'nghehoithoai':
                $chiTiet['data'] = $ch->nghehoithoai;
                break;

            case 'nghexepcau':
                $chiTiet['data'] = $ch->nghexepcau;
                break;

            case 'video':
                $chiTiet['data'] = $ch->video;
                break;
        }

        $result[] = $chiTiet;
    }

    return response()->json([
        'success' => true,
        'data' => $result
    ]);
}


}