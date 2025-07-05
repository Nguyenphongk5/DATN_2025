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
        if ($request->has('is_active') && $request->is_active !== '') {
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

        // 1. Validate dữ liệu đầu vào
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'img_thumb' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'price_sale' => 'nullable|numeric|min:0|lt:price', // Giá sale phải nhỏ hơn giá gốc
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            // Validate mảng ảnh gallery
            'image' => 'nullable|array', // "image" là một mảng
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Mỗi phần tử trong mảng phải là ảnh
        ]);

        // 2. Sử dụng DB Transaction để đảm bảo an toàn dữ liệu
        try {
            DB::beginTransaction();

            // Chuẩn bị dữ liệu cho bảng products
            $productData = [
                'name' => $validatedData['name'],
                'slug' => $validatedData['slug'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'price_sale' => $validatedData['price_sale'],
                'category_id' => $validatedData['category_id'],
                'brand_id' => $validatedData['brand_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Xử lý ảnh thumbnail
            if ($request->hasFile('img_thumb')) {
                $productData['img_thumb'] = $request->file('img_thumb')->store('products/thumbnails', 'public');
            }

            // 3. Thêm sản phẩm vào DB và lấy ID
            $productId = DB::table('products')->insertGetId($productData);

            // 4. Xử lý thư viện ảnh (gallery)
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $file) {
                    $path = $file->store('products/gallery', 'public');
                    DB::table('product_galleries')->insert([
                        'product_id' => $productId,
                        'image' => $path,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            DB::commit(); // Hoàn tất giao dịch nếu mọi thứ thành công
        } catch (\Exception $e) {
            DB::rollBack(); // Hoàn tác lại mọi thay đổi nếu có lỗi
            // Tùy chọn: Ghi log lỗi
            // Log::error('Failed to create product: ' . $e->getMessage());
            return back()->with('error', 'Đã xảy ra lỗi khi tạo sản phẩm. Vui lòng thử lại.')->withInput();
        }

        return redirect()->route('admin.products.index')->with('success', 'Tạo sản phẩm thành công!');
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
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $product = DB::table('products')->where('id', $id)->first();
        if (!$product) {
            return redirect()->route('admin.products.index')->with('error', 'Product not found.');
        }
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
            'is_active' => 'boolean'
        ]);
        if ($request->hasFile('img_thumb')) {
            $data['img_thumb'] = $request->file('img_thumb')->store('product_images', 'public');
        } else {
            $data['img_thumb'] = DB::table('products')->where('id', $id)->value('img_thumb');
        }
        DB::table('products')->where('id', $id)->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
