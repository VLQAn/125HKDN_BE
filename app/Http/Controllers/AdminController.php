<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'TenDangNhap' => 'required|string',
            'MatKhau' => 'required|string',
        ]);

        $admin = Admin::where('TenDangNhap', $request->TenDangNhap)->first();

        if (!$admin || !Hash::check($request->MatKhau, $admin->MatKhau)) {
            return response()->json([
                'success' => false,
                'message' => 'Tên đăng nhập hoặc mật khẩu không chính xác'
            ], 401);
        }

        // Return admin info
        return response()->json([
            'success' => true,
            'message' => 'Đăng nhập thành công',
            'data' => $admin
        ]);
    }
}
