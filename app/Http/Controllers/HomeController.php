<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('user.search', compact('products', 'categories'));  // Trả về kết quả tìm kiếm
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $categories = Category::all();
        $product = DB::table('products')->where('id', $id)->first();
        return view('user.product-detail', compact('product', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
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
