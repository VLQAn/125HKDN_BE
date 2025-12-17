<?php

namespace App\Http\Controllers;

use App\Models\NgheXepCau;

class NgheXepCauController extends Controller
{
    public function show($id)
    {
        $ngheXepCau = NgheXepCau::find($id);

        if (!$ngheXepCau) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy câu hỏi'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $ngheXepCau
        ]);
    }
}
