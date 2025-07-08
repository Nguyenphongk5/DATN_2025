<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Lấy danh sách tin nhắn giữa user và admin
     */
    public function index(Request $request)
    {
        $userId = $request->input('user_id') ?? Auth::id();
        $messages = Message::where('user_id', $userId)
            ->orderBy('created_at', 'asc')
            ->get();
        return response()->json($messages);
    }

    /**
     * Gửi tin nhắn mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'is_admin' => 'required|boolean',
        ]);

        $data = [
            'user_id' => $request->user_id,
            'message' => $request->message,
            'is_admin' => $request->is_admin,
        ];

        if ($request->is_admin) {
            $data['admin_id'] = Auth::id();
        } else {
            $data['admin_id'] = null;
        }

        $message = Message::create($data);
        return response()->json($message, 201);
    }
}