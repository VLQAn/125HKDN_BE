<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Register a new user and log them in using session auth.
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'HoTen'   => 'required|string|max:100',
            'Email'   => 'required|email|max:100|unique:user,Email',
            'MatKhau' => 'required|string|min:6|max:18',
        ]);

        // Set default values for optional fields
        $data['Diem'] = 0;
        $data['SoGioOnline'] = 0;

        $data['MatKhau'] = Hash::make($data['MatKhau']);
        $user = User::create($data);

        // Log the user in via the default session guard
        Auth::login($user);

        return response()->json(['user' => $user], 201);
    }

    /**
     * Log in an existing user using session auth.
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'Email'   => 'required|email',
            'MatKhau' => 'required|string',
        ]);

        $user = User::where('Email', $data['Email'])->first();
        if (!$user || !Hash::check($data['MatKhau'], $user->MatKhau)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        Auth::login($user);

        return response()->json(['user' => $user], 200);
    }
}
