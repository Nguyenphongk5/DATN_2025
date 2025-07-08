<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class ChatController extends Controller
{
    // Hiển thị danh sách user đã chat
    public function index()
    {
        $users = User::whereHas('messages')->get();
        return view('admin.chat.index', compact('users'));
    }

    // Lấy tin nhắn với 1 user
    public function messages(User $user)
    {
        $messages = Message::where('user_id', $user->id)->orderBy('created_at')->get();
        return response()->json($messages);
    }

    // Gửi tin nhắn từ admin
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);
        $message = Message::create([
            'user_id' => $request->user_id,
            'message' => $request->message,
            'is_admin' => true,
            'admin_id' => auth()->id(),
        ]);
        return response()->json($message, 201);
    }
}
