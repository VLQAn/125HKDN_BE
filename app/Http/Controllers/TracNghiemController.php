<?php

namespace App\Http\Controllers;

use App\Models\TracNghiem;

class TracNghiemController extends Controller
{
    public function show($id)
    {
        $tracNhiem = TracNghiem::find($id);

        if (!$tracNhiem) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy câu hỏi'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $tracNhiem
        ]);
    }
}
