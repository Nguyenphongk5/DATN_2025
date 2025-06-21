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
        $banners = DB::table('banners')->where('is_active', true)->get();

        // Lấy sản phẩm mới nhất (giả sử là 5 sản phẩm mới nhất)
        $latestProducts = Product::orderBy('created_at', 'desc')->take(5)->get();

        // Lấy tất cả các danh mục để lọc
        $categories = Category::all();

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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product = DB::table('products')->where('id', $id)->first();
        return view('user.product-detail', compact('product'));
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
