<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TienDoHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::withTrashed()->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'HoTen' => 'required|string|max:100',
            'Email' => 'required|email|max:100|unique:user,Email',
            'MatKhau' => 'required|string|min:6|max:18',
            'Diem' => 'required|integer',
            'SoGioOnline' => 'required|integer',
        ]);

        $data['MatKhau'] = Hash::make($data['MatKhau']);

        $user = User::create($data);

        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = User::withTrashed()->find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy chương'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'HoTen' => 'sometimes|required|string|max:100',
            'Email' => 'sometimes|required|email|max:100|unique:user,Email,' . $user->ID_User . ',ID_User',
            'MatKhau' => 'sometimes|required|string|min:6|max:18',
            'Diem' => 'sometimes|required|integer',
            'SoGioOnline' => 'sometimes|required|integer',
        ]);

        if (isset($data['MatKhau'])) {
            $data['MatKhau'] = Hash::make($data['MatKhau']);
        }

        $user->update($data);

        return response()->json($user);
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'message' => 'Đã khóa tài khoản!'
        ]);
    }

    public function top5UserDiemCaoNhat()
{
    $users = User::select([
        'ID_User',
        'HoTen',
        'Email',
        'Diem'
    ])
        ->orderBy('Diem', 'desc')
        ->limit(5)
        ->get()
        ->map(function ($user, $index) {
            $user->stt = $index + 1;
            return $user;
        });

    return response()->json([
        'message' => 'Top 5 user có điểm cao nhất',
        'data' => $users
    ], 200);
}public function AddPoints(int $point, string $id, int $idbaihoc)
{
    $user = User::findOrFail($id);
    $tiendohoccuaUser = TienDoHoc::where('ID_User', $id)->firstOrFail();

    // KIỂM TRA: Nếu bài học đã hoàn thành rồi, không cho cộng điểm nữa
    if ($idbaihoc < $tiendohoccuaUser->ID_BaiHoc) {
        return response()->json([
            'success' => false,
            'message' => 'Bài học này đã được hoàn thành trước đó. Không thể cộng điểm lại.'
        ], 400);
    }

    // KIỂM TRA: Chỉ cho phép làm bài hiện tại (đang học)
    if ($idbaihoc != $tiendohoccuaUser->ID_BaiHoc) {
        return response()->json([
            'success' => false,
            'message' => 'Bạn chỉ có thể làm bài đang học hiện tại.'
        ], 400);
    }

    // Cộng điểm
    $user->Diem += $point;
    $user->save();

    // Nếu đạt điểm >= 30 (đạt yêu cầu), chuyển sang bài tiếp theo
    if ($point >= 30) {
        $tiendohoccuaUser->ID_BaiHoc += 1;
        $tiendohoccuaUser->save();
    }

    return response()->json([
        'success' => true,
        'message' => 'Cộng điểm thành công',
        'Diem' => $user->Diem,
        'BaiHocTiepTheo' => $tiendohoccuaUser->ID_BaiHoc
    ]);
}
public function restore(string $id)
{
    $user = User::withTrashed()->findOrFail($id);
    $user->restore();

    return response()->json([
        'message' => 'Đã khôi phục tài khoản!'
    ]);
}
public function updateOnlineTime(Request $request, string $id)
{
    $data = $request->validate([
        'SoGioOnline' => 'required|numeric|min:0'
    ]);

    $user = User::findOrFail($id);
    
    // Cộng số giây vào
    $user->SoGioOnline += $data['SoGioOnline'];
    $user->save();

    return response()->json([
        'success' => true,
        'message' => 'Cập nhật thời gian online thành công',
        'SoGioOnline' => $user->SoGioOnline,
    ]);
}
}
