<?php

namespace App\Http\Controllers;

use App\Models\NgheHoiThoai;

class NgheHoiThoaiController extends Controller
{
    public function show($id)
    {
        $ngheHoiThoai = NgheHoiThoai::find($id);

        if (!$ngheHoiThoai) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy câu hỏi'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $ngheHoiThoai
        ]);
    }
}
