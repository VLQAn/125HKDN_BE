<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChonAnh;
use Illuminate\Http\Request;

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

    public function getByCau($id)
    {
        $chonAnh = ChonAnh::where('ID_Cau', $id)
                        ->get();

        return response()->json([
            'success' => true,
            'data' => $chonAnh
        ]);
    }
}
