<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Logo;
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
        $blogs = Blog::where('is_active', true)->latest()->take(3)->get();

        // Lấy logos
        $logos = Logo::all();

        // Trả về view với các thông tin cần thiết
        return view('user.index', compact('banners', 'latestProducts', 'categories', 'blogs', 'logos'));
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
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('products.price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('products.price', '<=', $request->max_price);
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

        $product = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->where('products.id', $id)->first();
            
        // Lấy ảnh gallery
        $galleryImages = DB::table('product_galleries')
            ->where('product_id', $id)
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->get();
            
        $products = DB::table('products')
            ->where('category_id', "=", $product->category_id)
            ->limit(8)
            ->get();
            
        return view('user.product-detail', compact('product', 'categories', 'productVariants', 'products', 'galleryImages'));
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
