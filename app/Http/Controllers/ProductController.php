<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Hiển thị sản phẩm thuộc danh mục "Phụ kiện"
     */
    public function accessories()
    {
        // Lấy danh mục có slug là "phu-kien"
        $category = Category::where('slug', 'phu-kien')->first();

        if (!$category) {
            abort(404, 'Không tìm thấy danh mục Phụ kiện.');
        }

        // Lấy sản phẩm thuộc danh mục đó
        $products = $category->products()->latest()->get();

        // Trả về view (ví dụ: resources/views/products/accessories.blade.php)
        return view('user.accessories', compact('products'));
    }
}
