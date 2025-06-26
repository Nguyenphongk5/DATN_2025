<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['user', 'product'])->latest()->get();
        return view('admin.comments.index', compact('comments'));
    }

    public function toggle($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->is_active = !$comment->is_active;
        $comment->save();

        return back()->with('success', 'Đã cập nhật trạng thái bình luận.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Đã xoá bình luận.');
    }
}

