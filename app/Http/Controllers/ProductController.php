<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm với các bộ lọc và phân trang.
     */
    public function index(Request $request)
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

        // Phân trang sản phẩm
        $products = $query->paginate(10);

        // Lấy tất cả các danh mục để lọc
        $categories = Category::all();

        // Trả về view với các sản phẩm tìm kiếm và danh mục
        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Hiển thị chi tiết sản phẩm theo ID.
     */
    public function show($id)
    {
        // Lấy thông tin chi tiết sản phẩm theo ID
        $product = Product::findOrFail($id);

        // Trả về view chi tiết sản phẩm
        return view('products.show', compact('product'));
    }

    /**
     * Phương thức tìm kiếm sản phẩm (được gọi từ HomeController)
     */
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
        return view('products.index', compact('products', 'categories'));  // Trả về kết quả tìm kiếm
    }
}


