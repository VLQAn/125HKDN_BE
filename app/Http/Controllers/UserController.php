<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
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
        $user = User::find($id);

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
            'message' => 'User deleted successfully'
        ]);
    }

    public function top5UserDiemCaoNhat()
    {
        $users = User::orderBy('Diem', 'desc')
            ->take(5)
            ->get([
                'ID_User',
                'HoTen',
                'Email',
                'Diem'
            ]);

        return response()->json([
            'message' => 'Top 5 user có điểm cao nhất',
            'data' => $users
        ], 200);
    }
}
