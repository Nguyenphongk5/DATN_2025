<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Logo;
use App\Models\Order;
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
        $userId = Auth::id(); // null nếu chưa đăng nhập

        // Lấy các banner đang hoạt động
        $banners = DB::table('banners')->get();

        // Lấy sản phẩm mới nhất và thêm thuộc tính is_favorited
        $latestProducts = Product::where('is_active', 1)
            ->latest()
            ->take(8)
            ->get()
            ->map(function ($product) use ($userId) {
                $product->is_favorited = false;

                if ($userId) {
                    $product->is_favorited = DB::table('favorites')
                        ->where('user_id', $userId)
                        ->where('product_id', $product->id)
                        ->exists();
                }

                return $product;
            });

        // Lấy tất cả danh mục để lọc
        $categories = DB::table('categories')->get();

        // Bài viết mới
        $blogs = Blog::where('is_active', true)->latest()->take(4)->get();

        // Lấy sản phẩm bán chạy nhất
        $bestSalerProducts = Product::select(
            'products.id',
            'products.name',
            'products.price', // Add other columns you need
            DB::raw('SUM(order_details.quantity) as total_sold')
        )
            ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->join('order_details', 'product_variants.id', '=', 'order_details.product_variant_id')
            ->groupBy('products.id', 'products.name', 'products.price') // Include all selected columns
            ->orderByDesc('total_sold')
            ->take(8)
            ->get()
            ->map(function ($product) use ($userId) {
                $product->is_favorited = false;
                if ($userId) {
                    $product->is_favorited = DB::table('favorites')
                        ->where('user_id', $userId)
                        ->where('product_id', $product->id)
                        ->exists();
                }
                return $product;
            });
        // Trả về view
        return view('user.index', compact('banners', 'latestProducts', 'categories', 'blogs', 'bestSalerProducts'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // $categories = Category::all();
        // return view('user.product-detail', compact('categories'));
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

    public function allProducts(Request $request)
    {
        // Khởi tạo query builder cho Product
        $query = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.name as category_name', 'brands.name as brand_name')
            ->where('products.is_active', 1);

        // Lọc theo danh mục nếu có
        if ($request->has('category') && $request->category != '') {
            $query->where('products.category_id', $request->category);
        }

        // Lọc theo thương hiệu nếu có
        if ($request->has('brand') && $request->brand != '') {
            $query->where('products.brand_id', $request->brand);
        }

        // Lọc theo giá nếu có
        if ($request->has('price_range') && $request->price_range != '') {
            $priceRange = explode('-', $request->price_range);
            if (count($priceRange) == 2) {
                $query->whereBetween('products.price', [$priceRange[0], $priceRange[1]]);
            } else {
                $query->where('products.price', '>=', $priceRange[0]);
            }
        }
        // Sắp xếp
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('products.price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('products.price', 'desc');
                break;
            case 'name':
                $query->orderBy('products.name', 'asc');
                break;
            case 'popular':
                $query->orderBy('products.view', 'desc');
                break;
            default:
                $query->orderBy('products.created_at', 'desc');
                break;
        }

        // Lấy sản phẩm và phân trang (12 sản phẩm mỗi trang)
        $products = $query->paginate(12);

        // Lấy tất cả các danh mục để lọc
        $categories = DB::table('categories')->where('is_active', 1)->get();

        // Lấy tất cả các thương hiệu để lọc
        $brands = DB::table('brands')->where('is_active', 1)->get();

        // Lấy thống kê
        $totalProducts = DB::table('products')->where('is_active', 1)->count();
        $totalCategories = DB::table('categories')->where('is_active', 1)->count();
        $totalBrands = DB::table('brands')->where('is_active', 1)->count();

        return view('user.all-products', compact('products', 'categories', 'brands', 'totalProducts', 'totalCategories', 'totalBrands'));
    }
    public function show(string $id)
    {
        $categories = Category::all();
        $productVariants = DB::table('product_variants')
            ->where('product_id', $id)
            ->get();

        // Lấy ảnh gallery
        $galleryImages = DB::table('product_galleries')
            ->where('product_id', $id)
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

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
        $hasCommented = false;
        if (Auth::check()) {
            // Kiểm tra đã mua sản phẩm chưa
            $hasPurchased = DB::table('orders')
                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                ->join('product_variants', 'order_details.product_variant_id', '=', 'product_variants.id')
                ->where('orders.user_id', Auth::id())
                ->whereIn('orders.status', ['completed', 'paid'])
                ->where('product_variants.product_id', $id)
                ->exists();

            // Kiểm tra đã comment chưa
            $hasCommented = Comment::hasUserCommented(Auth::id(), $id);

            // Chỉ cho phép comment nếu đã mua và chưa comment
            $canComment = $hasPurchased && !$hasCommented;
        }

        return view('user.product-detail', compact('product', 'categories', 'productVariants', 'products', 'comments', 'canComment', 'hasCommented', 'galleryImages'));
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

        // Kiểm tra xem user có quyền comment không
        $hasPurchased = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('product_variants', 'order_details.product_variant_id', '=', 'product_variants.id')
            ->where('orders.user_id', Auth::id())
            ->whereIn('orders.status', ['completed', 'paid'])
            ->where('product_variants.product_id', $request->product_id)
            ->exists();

        // Admin có thể comment bất kỳ sản phẩm nào
        $isAdmin = Auth::user()->role === 'admin';

        if (!$hasPurchased && !$isAdmin) {
            if ($request->ajax() || $request->expectsJson() || $request->has('ajax_request')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn chỉ có thể bình luận sau khi đã mua sản phẩm này.'
                ]);
            }
            return back()->with('error', 'Bạn chỉ có thể bình luận sau khi đã mua sản phẩm này.');
        }

        // Kiểm tra đã comment chưa (chỉ cho comment chính, không phải reply)
        if (!$request->parent_id && !$isAdmin) {
            $hasCommented = Comment::hasUserCommented(Auth::id(), $request->product_id);
            if ($hasCommented) {
                if ($request->ajax() || $request->expectsJson() || $request->has('ajax_request')) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Bạn đã bình luận sản phẩm này rồi.'
                    ]);
                }
                return back()->with('error', 'Bạn đã bình luận sản phẩm này rồi.');
            }
        }

        if (
            !$request->filled('content') &&
            !$request->filled('rating') &&
            !$request->hasFile('image')
        ) {
            if ($request->ajax() || $request->expectsJson() || $request->has('ajax_request')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn phải nhập ít nhất một trong các trường: nội dung, hình ảnh hoặc đánh giá.'
                ]);
            }
            return back()->with('error', 'Bạn phải nhập ít nhất một trong các trường: nội dung, hình ảnh hoặc đánh giá.');
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('comments', 'public');
        }

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'content' => $request->content ?? '',
            'rating' => $request->input('rating', 0),
            'image' => $imagePath,
            'parent_id' => $request->parent_id,
        ]);

        if ($request->ajax() || $request->expectsJson() || $request->has('ajax_request')) {
            // Lấy comment vừa tạo để trả về
            $newComment = Comment::with(['user', 'replies.user'])
                ->where('id', $comment->id)
                ->first();

            $message = $request->has('parent_id') ? '✅ Phản hồi đã được gửi!' : '✅ Bình luận đã được gửi!';

            return response()->json([
                'success' => true,
                'message' => $message,
                'comment' => $newComment
            ]);
        }

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
