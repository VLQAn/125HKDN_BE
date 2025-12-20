<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\BaiHoc;

class BaiHocController extends Controller
{
    public function index()
    {
        $baihoc = BaiHoc::orderBy('ThuTu')->get();

        return response()->json([
            'success' => true,
            'data' => $baihoc
        ]);
    }

    public function show($id)
    {
        $baihoc = BaiHoc::find($id);

        if (!$baihoc) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy bài học'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $baihoc
        ]);
    }

    public function getByChuong($id)
    {
        $baihoc = BaiHoc::where('ID_Chuong', $id)
                        ->orderBy('ThuTu')
                        ->get();

        return response()->json([
            'success' => true,
            'data' => $baihoc
        ]);
    }
}
