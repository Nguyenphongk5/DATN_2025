<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail($slug)
    {
        $product = Product::with([
            'category',
            'brand',
            'variants',
            'galleries'
        ])->where('slug', $slug)
            ->where('is_active', 1)
            ->firstOrFail();

        $relatedProducts = Product::with(['category', 'brand', 'variants'])
            ->where('is_active', 1)
            ->where('id', '!=', $product->id)
            ->where(function ($query) use ($product) {
                $query->where('category_id', $product->category_id)
                    ->orWhere('brand_id', $product->brand_id);
            })
            ->latest()
            ->take(12)
            ->get();

        return view('user.product-detail', compact('product', 'relatedProducts'));
    }
}
