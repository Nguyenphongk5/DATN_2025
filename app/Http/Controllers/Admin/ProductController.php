<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\FileHelper;
use App\Models\Product;
use App\Models\ProductGallery;
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
        //
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'img_thumb' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'price_sale' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'view' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        // Kiểm tra số lượng ảnh gallery
        if ($request->hasFile('gallery_images')) {
            $galleryCount = count($request->file('gallery_images'));
            if ($galleryCount > 6) {
                return back()->withErrors(['gallery_images' => 'Tối đa chỉ được upload 6 ảnh gallery.'])->withInput();
            }
        }

        if ($request->hasFile('img_thumb')) {
            $data['img_thumb'] = FileHelper::uploadFile($request->file('img_thumb'), 'product_images', 'product_thumb');
        } else {
            $data['img_thumb'] = null;
        }

        // Tạo sản phẩm
        $product = Product::create($data);

        // Xử lý ảnh gallery
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $image) {
                $imagePath = FileHelper::uploadFile($image, 'product_galleries', 'product_gallery');
                ProductGallery::create([
                    'product_id' => $product->id,
                    'image' => $imagePath,
                    'sort_order' => $index
                ]);
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
        $product = Product::with(['category', 'brand', 'galleries'])->findOrFail($id);
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
        $product = Product::with('galleries')->findOrFail($id);
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $product = Product::findOrFail($id);
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $id,
            'img_thumb' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'price_sale' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'view' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        // Kiểm tra số lượng ảnh gallery
        if ($request->hasFile('gallery_images')) {
            $currentGalleryCount = $product->galleries()->count();
            $newGalleryCount = count($request->file('gallery_images'));
            $totalCount = $currentGalleryCount + $newGalleryCount;
            
            if ($totalCount > 6) {
                return back()->withErrors(['gallery_images' => 'Tổng số ảnh gallery không được vượt quá 6 ảnh. Hiện tại có ' . $currentGalleryCount . ' ảnh, chỉ có thể thêm tối đa ' . (6 - $currentGalleryCount) . ' ảnh nữa.'])->withInput();
            }
        }

        if ($request->hasFile('img_thumb')) {
            // Xóa ảnh cũ nếu có
            if ($product->img_thumb) {
                FileHelper::deleteFile($product->img_thumb);
            }
            $data['img_thumb'] = FileHelper::uploadFile($request->file('img_thumb'), 'product_images', 'product_thumb');
        } else {
            $data['img_thumb'] = $product->img_thumb;
        }

        // Cập nhật sản phẩm
        $product->update($data);

        // Xử lý ảnh gallery mới
        if ($request->hasFile('gallery_images')) {
            $maxSortOrder = $product->galleries()->max('sort_order') ?? -1;
            
            foreach ($request->file('gallery_images') as $image) {
                $imagePath = FileHelper::uploadFile($image, 'product_galleries', 'product_gallery');
                ProductGallery::create([
                    'product_id' => $product->id,
                    'image' => $imagePath,
                    'sort_order' => ++$maxSortOrder
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
        $product = Product::with('galleries')->findOrFail($id);
        
        // Xóa ảnh thumb
        if ($product->img_thumb) {
            FileHelper::deleteFile($product->img_thumb);
        }
        
        // Xóa ảnh gallery
        foreach ($product->galleries as $gallery) {
            FileHelper::deleteFile($gallery->image);
        }
        
        $product->delete();
        
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    /**
     * Xóa ảnh gallery
     */
    public function deleteGalleryImage($id)
    {
        $gallery = ProductGallery::findOrFail($id);
        FileHelper::deleteFile($gallery->image);
        $gallery->delete();
        
        return response()->json(['success' => true]);
    }

    /**
     * Cập nhật thứ tự ảnh gallery
     */
    public function updateGalleryOrder(Request $request)
    {
        $request->validate([
            'gallery_ids' => 'required|array',
            'gallery_ids.*' => 'exists:product_galleries,id'
        ]);

        foreach ($request->gallery_ids as $index => $id) {
            ProductGallery::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
