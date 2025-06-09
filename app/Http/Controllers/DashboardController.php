<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all(); // Lấy tất cả dữ liệu từ bảng users
        return view('dashboard', compact('users'));
    }
}
