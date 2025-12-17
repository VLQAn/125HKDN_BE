<?php

namespace App\Http\Controllers;

use App\Models\DienTu;

class DienTuController extends Controller
{
    public function show($id)
    {
        $dienTu = DienTu::find($id);

        if (!$dienTu) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy câu hỏi'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $dienTu
        ]);
    }
}
