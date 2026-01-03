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

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'TenChuong' => 'required|string|max:100',
            'ThuTu' => 'required|integer'
        ]);

        $chuong = Chuong::create($data);

        return response()->json([
            'success' => true,
            'data' => $chuong
        ], 201);
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        $chuong = Chuong::find($id);

        if (!$chuong) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy chương'
            ], 404);
        }

        $data = $request->validate([
            'TenChuong' => 'sometimes|required|string|max:100',
            'ThuTu' => 'sometimes|required|integer'
        ]);

        $chuong->update($data);

        return response()->json([
            'success' => true,
            'data' => $chuong
        ]);
    }

    public function destroy($id)
    {
        $chuong = Chuong::find($id);

        if (!$chuong) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy chương'
            ], 404);
        }

        $chuong->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xóa chương thành công'
        ]);
    }
}
