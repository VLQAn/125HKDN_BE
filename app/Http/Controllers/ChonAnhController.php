<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChonAnh;

class ChonAnhController extends Controller
{
    public function show($id)
    {
        $chonAnh = ChonAnh::find($id);

        if (!$chonAnh) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy câu hỏi'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $chonAnh
        ]);
    }
}