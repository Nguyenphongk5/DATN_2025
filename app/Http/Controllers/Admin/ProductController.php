<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = DB::table('products');
        if($request->has('is_active') && $request->is_active !== ''){
            $query->where('products.is_active', $request->is_active);
        }
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $products = $query
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.name as category_name', 'categories.is_active as cate_is_active', 'brands.name as brand_name', 'brands.is_active as brand_is_active')
            ->paginate(10);
        return view('admin.products.index', compact('products', 'categories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'img_thumb' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'price_sale' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'view' => 'nullable|integer|min:0',
            'quantity' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'gallery_images' => 'nullable|array|max:6',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        if ($request->hasFile('img_thumb')) {
            $data['img_thumb'] = $request->file('img_thumb')->store('product_images', 'public');
        } else {
            $data['img_thumb'] = null;
        }

        // Loại bỏ gallery_images khỏi data trước khi insert vào products
        unset($data['gallery_images']);

        // Tạo sản phẩm
        $productId = DB::table('products')->insertGetId($data);

        // Xử lý upload ảnh gallery
        if ($request->hasFile('gallery_images')) {
            $galleryImages = $request->file('gallery_images');
            $sortOrder = 1;

            foreach ($galleryImages as $image) {
                // Tạo tên file duy nhất
                $fileName = $this->generateUniqueFileName($image->getClientOriginalName(), $productId);

                // Upload file
                $image->storeAs('product_galleries', $fileName, 'public');

                // Lưu vào database
                DB::table('product_galleries')->insert([
                    'product_id' => $productId,
                    'image' => $fileName,
                    'alt_text' => pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME),
                    'sort_order' => $sortOrder,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                $sortOrder++;
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.name as category_name', 'categories.is_active as cate_is_active', 'brands.name as brand_name', 'brands.is_active as brand_is_active')
            ->where('products.id', $id)
            ->first();
        if (!$product) {
            return redirect()->route('admin.products.index')->with('error', 'Product not found.');
        }

        // Lấy ảnh gallery
        $galleryImages = DB::table('product_galleries')
            ->where('product_id', $id)
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('admin.products.show', compact('product', 'galleryImages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $product = DB::table('products')->where('id', $id)->first();
        if (!$product) {
            return redirect()->route('admin.products.index')->with('error', 'Product not found.');
        }

        // Lấy ảnh gallery hiện tại
        $currentGallery = DB::table('product_galleries')
            ->where('product_id', $id)
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands', 'currentGallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $id,
            'img_thumb' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'price_sale' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'view' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'gallery_images' => 'nullable|array|max:6',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        if ($request->hasFile('img_thumb')) {
            $data['img_thumb'] = $request->file('img_thumb')->store('product_images', 'public');
        } else {
            $data['img_thumb'] = DB::table('products')->where('id', $id)->value('img_thumb');
        }

        // Loại bỏ gallery_images khỏi data trước khi update products
        unset($data['gallery_images']);

        // Cập nhật sản phẩm
        DB::table('products')->where('id', $id)->update($data);

        // Xử lý thêm ảnh gallery mới
        if ($request->hasFile('gallery_images')) {
            $galleryImages = $request->file('gallery_images');

            // Kiểm tra số ảnh hiện tại
            $currentGalleryCount = DB::table('product_galleries')
                ->where('product_id', $id)
                ->where('is_active', 1)
                ->count();

            // Kiểm tra tổng số ảnh không vượt quá 6
            if ($currentGalleryCount + count($galleryImages) > 6) {
                return redirect()->back()->withErrors(['gallery_images' => 'Tổng số ảnh gallery không được vượt quá 6 ảnh. Hiện tại có ' . $currentGalleryCount . ' ảnh.']);
            }

            // Lấy sort_order cao nhất hiện tại
            $maxSortOrder = DB::table('product_galleries')
                ->where('product_id', $id)
                ->max('sort_order') ?? 0;

            foreach ($galleryImages as $image) {
                // Tạo tên file duy nhất
                $fileName = $this->generateUniqueFileName($image->getClientOriginalName(), $id);

                // Upload file
                $image->storeAs('product_galleries', $fileName, 'public');

                // Lưu vào database
                DB::table('product_galleries')->insert([
                    'product_id' => $id,
                    'image' => $fileName,
                    'alt_text' => pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME),
                    'sort_order' => ++$maxSortOrder,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Tạo tên file duy nhất
     */
    private function generateUniqueFileName($originalName, $productId)
    {
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $baseName = pathinfo($originalName, PATHINFO_FILENAME);

        // Loại bỏ ký tự đặc biệt và thay thế bằng dấu gạch ngang
        $cleanName = \Illuminate\Support\Str::slug($baseName);

        // Tạo tên file với timestamp để đảm bảo duy nhất
        $fileName = $cleanName . '_' . time() . '_' . $productId . '.' . $extension;

        return $fileName;
    }
}
