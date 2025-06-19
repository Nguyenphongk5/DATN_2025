<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Khởi tạo query builder cho Product
        $query = Product::query();

        // Tìm kiếm theo tên sản phẩm
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Lọc theo danh mục
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Lọc theo giá nếu có, nếu người dùng nhập giá trị
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }

        // Sắp xếp theo giá (tăng dần hoặc giảm dần) hoặc theo ngày
        if ($request->has('sort_by')) {
            if ($request->sort_by == 'asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort_by == 'desc') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort_by == 'newest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->sort_by == 'oldest') {
                $query->orderBy('created_at', 'asc');
            }
        }

        // Phân trang
        $products = $query->paginate(10);  // Hiển thị 10 sản phẩm mỗi trang

        // Lấy tất cả các danh mục
        $categories = Category::all();

        // Trả về view với sản phẩm và danh mục
        return view('products.index', compact('products', 'categories'));
    }
}
