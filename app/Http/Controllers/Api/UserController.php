<?php

namespace App\Http\Controllers\Api;

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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }
}
