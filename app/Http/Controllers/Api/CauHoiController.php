<?php

namespace App\Http\Controllers\Api;

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
}
