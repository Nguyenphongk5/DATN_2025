<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Hiển thị danh sách người dùng
    public function index()
    {
        $users = User::all(); // Lấy tất cả dữ liệu từ bảng users
        return view('users.index', compact('users'));
    }

    // Hiển thị form chỉnh sửa role
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Cập nhật role
   public function updateRole(Request $request, User $user)
{
    $request->validate([
        'role' => 'required|in:user,admin,moderator',
    ]);

    $user->role = $request->role;
    $user->save();

    return response()->json(['success' => true]);
}

}
