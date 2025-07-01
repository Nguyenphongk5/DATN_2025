<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Hiển thị danh sách user
    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    // Hiển thị form chỉnh sửa role
    public function editRole($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit-role', compact('user'));
    }

    // Xử lý cập nhật role
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|string|in:' . implode(',', User::roles()),
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.index')->with('success', 'User role updated successfully.');
    }
}
