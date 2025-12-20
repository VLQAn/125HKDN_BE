<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chuong;

class ChuongController extends Controller
{
    public function index()
    {
        $chuong = Chuong::orderBy('ThuTu')->get();

        return response()->json([
            'success' => true,
            'data' => $chuong
        ]);
    }

    public function show($id)
    {
        $chuong = Chuong::find($id);

        if (!$chuong) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy chương'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $chuong
        ]);
    }
}
