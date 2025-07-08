<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = Comment::with(['user', 'product', 'replies.user'])
            ->parents(); // chỉ lấy bình luận cha

        // Filter
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }
        if ($request->filled('content')) {
            $query->where('content', 'like', '%' . $request->content . '%');
        }

        $comments = $query->latest()->paginate(10)->withQueryString();

        // Thống kê
        $total = Comment::parents()->count();
        $active = Comment::parents()->where('is_active', 1)->count();
        $inactive = $total - $active;

        // Danh sách user, sản phẩm cho filter
        $users = User::orderBy('name')->get(['id', 'name']);
        $products = Product::orderBy('name')->get(['id', 'name']);

        return view('admin.comments.index', compact(
            'comments',
            'total',
            'active',
            'inactive',
            'users',
            'products'
        ))->with([
            'filter' => $request->only(['user_id', 'product_id', 'is_active', 'content'])
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'product_id' => 'required|exists:products,id',
            'parent_id' => 'required|exists:comments,id',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'parent_id' => $request->parent_id,
            'content' => $request->content,
            'is_active' => true, // Mặc định bình luận mới là hoạt động
        ]);

        return back()->with('success', 'Đã trả lời bình luận thành công!.');
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
