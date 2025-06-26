<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy các banner đang hoạt động
        $banners = DB::table('banners')->get();

        // Lấy sản phẩm mới nhất (giả sử là 5 sản phẩm mới nhất)
        $latestProducts = DB::table('products')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        // Product::orderBy('created_at', 'desc')->take(5)->get();

        // Lấy tất cả các danh mục để lọc
        $categories = DB::table('categories')->get();

        // Trả về view với các thông tin cần thiết
        return view('user.index', compact('banners', 'latestProducts', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('user.product-detail', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    public function search(Request $request)
    {
        // Khởi tạo query builder cho Product
        $query = Product::query();

        // Tìm kiếm theo tên sản phẩm nếu có
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $keywords = $request->input('search');
        // Lọc theo danh mục nếu có
        if ($request->has('category') && $request->category != '') {
            // Lọc theo category_id nếu có
            $query->where('category_id', $request->category);
        }

        // Lọc theo giá nếu có
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }

        // Lấy sản phẩm và phân trang (10 sản phẩm mỗi trang)
        $products = $query->paginate(10);  // Phân trang 10 sản phẩm mỗi trang

        // Lấy tất cả các danh mục để lọc
        $categories = Category::all();

        // Trả về kết quả tìm kiếm
        return view('user.search', compact('products', 'categories', 'keywords'));  // Trả về kết quả tìm kiếm
    }
    /**
     * Display the specified resource.
     */
   public function show(string $id)
{
    $categories = Category::all();
    $productVariants = DB::table('product_variants')->where('product_id', $id)->get();

    $product = DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.*', 'categories.name as category_name')
        ->where('products.id', $id)->first();

    $products = DB::table('products')
        ->where('category_id', $product->category_id)
        ->limit(8)
        ->get();

    $comments = Comment::with(['user', 'replies.user'])
        ->where('product_id', $id)
        ->where('is_active', 1)
        ->whereNull('parent_id')
        ->orderByDesc('created_at')
        ->get();

    $canComment = false;
    if (Auth::check()) {
        $canComment = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('product_variants', 'order_details.product_variant_id', '=', 'product_variants.id')
            ->where('orders.user_id', Auth::id())
            ->whereIn('orders.status', ['completed', 'paid'])
            ->where('product_variants.product_id', $id)
            ->exists();
    }

    return view('user.product-detail', compact('product', 'categories', 'productVariants', 'products', 'comments', 'canComment'));
}


public function storeComment(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'content' => 'nullable|string|max:1000',
        'parent_id' => 'nullable|exists:comments,id',
        'rating' => 'nullable|integer|min:1|max:5',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if (
        !$request->filled('content') &&
        !$request->filled('rating') &&
        !$request->hasFile('image')
    ) {
        return back()->with('error', 'Bạn phải nhập ít nhất một trong các trường: nội dung, hình ảnh hoặc đánh giá.');
    }

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('comments', 'public');
    }

    Comment::create([
        'user_id' => Auth::id(),
        'product_id' => $request->product_id,
        'content' => $request->content ?? '',
       'rating' => $request->input('rating', 0),
        'image' => $imagePath,
        'parent_id' => $request->parent_id,
    ]);

    return back()->with('success', '✅ Bình luận đã được gửi!');
}

public function updateComment(Request $request, $id)
{
    $comment = Comment::findOrFail($id);

    if (Auth::id() !== $comment->user_id) {
        abort(403, 'Bạn không có quyền chỉnh sửa bình luận này.');
    }

    $request->validate([
        'content' => 'nullable|string|max:1000',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Cập nhật nội dung nếu tồn tại (kể cả rỗng, có thể là để xóa)
    if ($request->has('content')) {
        $comment->content = $request->content ?? '';
    }

    // Cập nhật ảnh nếu có file
    if ($request->hasFile('image')) {
        if ($comment->image) {
            Storage::disk('public')->delete($comment->image);
        }
        $comment->image = $request->file('image')->store('comments', 'public');
    }

    $comment->save();

    return back()->with('success', '✅ Bình luận đã được cập nhật!');
}

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
