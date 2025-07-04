<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $galleries = ProductGallery::with('product')->latest()->paginate(10);
        $products = Product::all();

        // Trả về view và truyền dữ liệu sang
        return view('admin.product_galleries.list', compact('galleries', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   
}
