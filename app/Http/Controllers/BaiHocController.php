<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\BaiHoc;

class BaiHocController extends Controller
{
    public function index()
    {
        $baihoc = BaiHoc::orderBy('ID_BaiHoc')->get();

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

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'ID_Chuong' => 'required|exists:chuong,ID_Chuong',
            'TenBaiHoc' => 'required|string|max:100',
            'IconBaiHoc' => 'required|string|max:100',
            'ThuTu' => 'required|integer'
        ]);

        $baihoc = BaiHoc::create($data);

        return response()->json([
            'success' => true,
            'data' => $baihoc
        ], 201);
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        $baihoc = BaiHoc::find($id);

        if (!$baihoc) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy bài học'
            ], 404);
        }

        $data = $request->validate([
            'ID_Chuong' => 'sometimes|required|exists:chuong,ID_Chuong',
            'TenBaiHoc' => 'sometimes|required|string|max:100',
            'IconBaiHoc' => 'sometimes|required|string|max:100',
            'ThuTu' => 'sometimes|required|integer'
        ]);

        $baihoc->update($data);

        return response()->json([
            'success' => true,
            'data' => $baihoc
        ]);
    }

    public function destroy($id)
    {
        $baihoc = BaiHoc::find($id);

        if (!$baihoc) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy bài học'
            ], 404);
        }

        $baihoc->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xóa bài học thành công'
        ]);
    }
}
