<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


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
        // Sử dụng Eloquent, findOrFail sẽ tự động báo lỗi 404 nếu không tìm thấy
        $product = Product::findOrFail($id);

        // Lấy danh mục và thương hiệu (vẫn có thể dùng DB::table nếu chưa có model)
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();

        // Lấy gallery thông qua relationship đã định nghĩa trong model
        // View sẽ truy cập qua biến $product->galleries
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            // ... giữ nguyên các rule validate ...
        ]);

        try {
            DB::beginTransaction();

            // 1. Xóa ảnh gallery được chọn
            if ($request->filled('delete_galleries')) {
                $galleriesToDelete = ProductGallery::whereIn('id', $request->delete_galleries)->get();
                foreach ($galleriesToDelete as $gallery) {
                    Storage::disk('public')->delete($gallery->image);
                }
                // Xóa bản ghi trong DB, có thể dùng destroy cho mảng ID
                ProductGallery::destroy($request->delete_galleries);
            }

            // 2. Thêm ảnh gallery mới (sử dụng relationship)
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $file) {
                    $path = $file->store('products/gallery', 'public');
                    // Tự động gán product_id khi tạo qua relationship
                    $product->galleries()->create(['image' => $path]);
                }
            }

            // 3. Cập nhật ảnh thumbnail
            if ($request->hasFile('img_thumb')) {
                if ($product->img_thumb) {
                    Storage::disk('public')->delete($product->img_thumb);
                }
                $validatedData['img_thumb'] = $request->file('img_thumb')->store('products/thumbnails', 'public');
            }
            $product->touch();
            // 4. Cập nhật sản phẩm bằng phương thức update của Eloquent
            $product->update($validatedData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Lỗi khi cập nhật: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Tìm sản phẩm trong DB
        $product = DB::table('products')->where('id', $id)->first();

        if (!$product) {
            return redirect()->route('admin.products.index')->with('error', 'Không tìm thấy sản phẩm.');
        }

        try {
            DB::beginTransaction();

            // 1. Tìm và xóa tất cả ảnh trong gallery
            $galleries = DB::table('product_galleries')->where('product_id', $id)->get();
            foreach ($galleries as $gallery) {
                // Xóa file ảnh vật lý khỏi storage
                if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                    Storage::disk('public')->delete($gallery->image);
                }
            }
            // Xóa các bản ghi gallery khỏi DB
            DB::table('product_galleries')->where('product_id', $id)->delete();

            // 2. Xóa ảnh thumbnail của sản phẩm
            if ($product->img_thumb && Storage::disk('public')->exists($product->img_thumb)) {
                Storage::disk('public')->delete($product->img_thumb);
            }

            // 3. Xóa sản phẩm chính
            // Lưu ý: Migration của bạn có `softDeletes()`. Nếu bạn muốn xóa tạm thời,
            // hãy dùng `update(['deleted_at' => now()])`.
            // Ở đây chúng ta sẽ xóa vĩnh viễn để đồng bộ với việc xóa file.
            DB::table('products')->where('id', $id)->delete();

            DB::commit(); // Hoàn tất giao dịch

        } catch (\Exception $e) {
            DB::rollBack(); // Hoàn tác nếu có lỗi
            return back()->with('error', 'Đã xảy ra lỗi khi xóa sản phẩm: ' . $e->getMessage());
        }

        return redirect()->route('admin.products.index')->with('success', 'Đã xóa sản phẩm thành công.');
    }
}
