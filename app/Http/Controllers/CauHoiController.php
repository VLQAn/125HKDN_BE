<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CauHoi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CauHoiController extends Controller
{
    public function index()
    {
        $cauHoiList = CauHoi::join('baihoc', 'cauhoi.ID_BaiHoc', '=', 'baihoc.ID_BaiHoc')
            ->join('chuong', 'baihoc.ID_Chuong', '=', 'chuong.ID_Chuong')
            ->orderBy('cauhoi.ID_Cau')
            ->get([
                'cauhoi.ID_Cau',
                'cauhoi.ID_BaiHoc',
                'cauhoi.LoaiCauHoi',
                'cauhoi.ThuTu',
                'cauhoi.created_at as cauhoi_created_at',
                'cauhoi.updated_at as cauhoi_updated_at',
                'baihoc.ID_Chuong',
                'baihoc.TenBaiHoc',
                'chuong.TenChuong',
            ]);

        $result = [];

        foreach ($cauHoiList as $ch) {

            $item = [
                'ID_Cau'       => $ch->ID_Cau,
                'ID_BaiHoc'    => $ch->ID_BaiHoc,
                'LoaiCauHoi'   => $ch->LoaiCauHoi,
                'ThuTu'        => $ch->ThuTu,
                'created_at'   => $ch->cauhoi_created_at,
                'updated_at'   => $ch->cauhoi_updated_at,
                'TenBaiHoc'    => $ch->TenBaiHoc,
                'ID_Chuong'    => $ch->ID_Chuong,
                'TenChuong'    => $ch->TenChuong,
                'data'         => null
            ];

            // Load chi tiet bang con
            $cauHoi = CauHoi::find($ch->ID_Cau);

            if ($cauHoi) {
                switch ($cauHoi->LoaiCauHoi) {
                    case 'tracnghiem':
                        $item['data'] = $cauHoi->tracnghiem;
                        break;
                    case 'dientu':
                        $item['data'] = $cauHoi->dientu;
                        break;
                    case 'chonanh':
                        $item['data'] = $cauHoi->chonanh;
                        break;
                    case 'nghehoithoai':
                        $item['data'] = $cauHoi->nghehoithoai;
                        break;
                    case 'nghexepcau':
                        $item['data'] = $cauHoi->nghexepcau;
                        break;
                    case 'video':
                        $item['data'] = $cauHoi->video;
                        break;
                }
            }

            $result[] = $item;
        }

        return response()->json([
            'success' => true,
            'data' => $result
        ]);
    }

    public function show($id)
    {
        $cauHoi = CauHoi::find($id);

        if (!$cauHoi) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy câu hỏi'
            ], 404);
        }

        if (method_exists($cauHoi, $cauHoi->LoaiCauHoi)) {
            $cauHoi->load($cauHoi->LoaiCauHoi);
        }

        return response()->json([
            'success' => true,
            'data' => $cauHoi
        ]);
    }

    public function getByBaiHoc($id)
    {
        $cauHoi = CauHoi::where('ID_BaiHoc', $id)
            ->orderBy('ThuTu')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $cauHoi
        ]);
    }

    public function getChitietCauHoiByBaiHoc($id)
    {
        $cauHoiList = CauHoi::where('ID_BaiHoc', $id)
            ->orderBy('ID_Cau')
            ->get();

        $result = [];

        foreach ($cauHoiList as $ch) {

            $item = [
                'ID_Cau' => $ch->ID_Cau,
                'ID_BaiHoc' => $ch->ID_BaiHoc,
                'LoaiCauHoi' => $ch->LoaiCauHoi,
                'ThuTu' => $ch->ThuTu,
                'created_at' => $ch->created_at,
                'updated_at' => $ch->updated_at,
                'data' => null
            ];

            switch ($ch->LoaiCauHoi) {
                case 'tracnghiem':
                    $item['data'] = $ch->tracnghiem;
                    break;
                case 'dientu':
                    $item['data'] = $ch->dientu;
                    break;
                case 'chonanh':
                    $item['data'] = $ch->chonanh;
                    break;
                case 'nghehoithoai':
                    $item['data'] = $ch->nghehoithoai;
                    break;
                case 'nghexepcau':
                    $item['data'] = $ch->nghexepcau;
                    break;
                case 'video':
                    $item['data'] = $ch->video;
                    break;
            }

            $result[] = $item;
        }

        return response()->json([
            'success' => true,
            'data' => $result
        ]);
    }
    public function store(\Illuminate\Http\Request $request)
    {
        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            $data = $request->validate([
                'ID_BaiHoc' => 'required|exists:baihoc,ID_BaiHoc',
                'LoaiCauHoi' => 'required|string|in:tracnghiem,dientu,chonanh,nghehoithoai,nghexepcau,video',
                'ThuTu' => 'required|integer',
                'data' => 'required|array'
            ]);

            // 1. Tao bang cha CauHoi
            $cauHoi = CauHoi::create([
                'ID_BaiHoc' => $data['ID_BaiHoc'],
                'LoaiCauHoi' => $data['LoaiCauHoi'],
                'ThuTu' => $data['ThuTu']
            ]);

            // 2. Tao bang con tuong ung
            $detailData = $data['data'];
            $detailData['ID_Cau'] = $cauHoi->ID_Cau;

            switch ($data['LoaiCauHoi']) {
                case 'tracnghiem':
                    \App\Models\TracNghiem::create($detailData);
                    break;
                case 'dientu':
                    \App\Models\DienTu::create($detailData);
                    break;
                case 'chonanh':
                    \App\Models\ChonAnh::create($detailData);
                    break;
                case 'nghehoithoai':
                    \App\Models\NgheHoiThoai::create($detailData);
                    break;
                case 'nghexepcau':
                    \App\Models\NgheXepCau::create($detailData);
                    break;
                case 'video':
                    \App\Models\Video::create($detailData);
                    break;
            }

            \Illuminate\Support\Facades\DB::commit();

            if (method_exists($cauHoi, $cauHoi->LoaiCauHoi)) {
                $cauHoi->load($cauHoi->LoaiCauHoi);
            }

            return response()->json([
                'success' => true,
                'data' => $cauHoi,
                'message' => 'Tạo câu hỏi thành công'
            ], 201);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi tạo câu hỏi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            $cauHoi = CauHoi::find($id);
            if (!$cauHoi) {
                return response()->json(['success' => false, 'message' => 'Không tìm thấy câu hỏi'], 404);
            }

            // Validate du lieu chung
            $data = $request->validate([
                'ThuTu' => 'sometimes|required|integer',
                'ID_BaiHoc' => 'sometimes|exists:baihoc,ID_BaiHoc',
                'data' => 'sometimes|array'
            ]);

            // Update bang cha neu co thay doi
            $fieldToUpdate = [];
            if (isset($data['ThuTu'])) $fieldToUpdate['ThuTu'] = $data['ThuTu'];
            if (isset($data['ID_BaiHoc'])) $fieldToUpdate['ID_BaiHoc'] = $data['ID_BaiHoc'];
            
            if (!empty($fieldToUpdate)) {
                $cauHoi->update($fieldToUpdate);
            }

            // Update bang con
            $detailData = null;
            if ($request->has('data')) {
                $detailData = $request->input('data');
            } elseif ($request->has($cauHoi->LoaiCauHoi)) {
                $detailData = $request->input($cauHoi->LoaiCauHoi);
            }

            if ($detailData) {
                // Remove fields that should not be updated or cause errors
                unset($detailData['ID_Cau']);
                unset($detailData['created_at']);
                unset($detailData['updated_at']);

                // Su dung switch case de update chinh xac bang chi tiet
                switch ($cauHoi->LoaiCauHoi) {
                    case 'tracnghiem':
                        \App\Models\TracNghiem::where('ID_Cau', $id)->update($detailData);
                        break;
                    case 'dientu':
                        \App\Models\DienTu::where('ID_Cau', $id)->update($detailData);
                        break;
                    case 'chonanh':
                        \App\Models\ChonAnh::where('ID_Cau', $id)->update($detailData);
                        break;
                    case 'nghehoithoai':
                        \App\Models\NgheHoiThoai::where('ID_Cau', $id)->update($detailData);
                        break;
                    case 'nghexepcau':
                        \App\Models\NgheXepCau::where('ID_Cau', $id)->update($detailData);
                        break;
                    case 'video':
                        \App\Models\Video::where('ID_Cau', $id)->update($detailData);
                        break;
                }
            }

            \Illuminate\Support\Facades\DB::commit();
            
            // Reload data
            if (method_exists($cauHoi, $cauHoi->LoaiCauHoi)) {
                $cauHoi->load($cauHoi->LoaiCauHoi);
            }

            return response()->json([
                'success' => true,
                'data' => $cauHoi,
                'message' => 'Cập nhật câu hỏi thành công'
            ]);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi cập nhật: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $cauHoi = CauHoi::find($id);
        if (!$cauHoi) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy câu hỏi'], 404);
        }

        $cauHoi->delete();

        return response()->json(['success' => true, 'message' => 'Xóa câu hỏi thành công']);
    }
}
