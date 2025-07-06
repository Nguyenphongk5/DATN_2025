<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductGalleryController extends Controller
{
    /**
     * Hiển thị danh sách ảnh của sản phẩm
     */
    public function index(Product $product)
    {
        $galleries = $product->galleries()->orderBy('sort_order')->get();
        
        return view('admin.product_galleries.index', compact('product', 'galleries'));
    }

    /**
     * Hiển thị form thêm ảnh
     */
    public function create(Product $product)
    {
        return view('admin.product_galleries.create', compact('product'));
    }

    /**
     * Lưu ảnh mới
     */
    public function store(Request $request, Product $product)
    {
        $productId = $product->id;
        
        $validator = Validator::make($request->all(), [
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'alt_text.*' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $uploadedImages = [];
        $maxSortOrder = $product->galleries()->max('sort_order') ?? 0;

        foreach ($request->file('images') as $index => $image) {
            // Tạo tên file duy nhất
            $fileName = ProductGallery::generateUniqueFileName($image->getClientOriginalName(), $productId);
            
            // Kiểm tra tên file đã tồn tại chưa
            while (ProductGallery::isFileNameExists($fileName)) {
                $fileName = ProductGallery::generateUniqueFileName($image->getClientOriginalName(), $productId);
            }

            // Upload file
            $path = $image->storeAs('product_galleries', $fileName, 'public');

            // Lưu vào database
            $gallery = ProductGallery::create([
                'product_id' => $productId,
                'image' => $fileName,
                'alt_text' => $request->alt_text[$index] ?? null,
                'sort_order' => $maxSortOrder + $index + 1,
                'is_active' => true,
            ]);

            $uploadedImages[] = $gallery;
        }

        return redirect()->route('admin.products.galleries.index', $product)
            ->with('success', 'Đã thêm ' . count($uploadedImages) . ' ảnh thành công!');
    }

    /**
     * Hiển thị form chỉnh sửa ảnh
     */
    public function edit(Product $product, $galleryId)
    {
        $gallery = ProductGallery::where('product_id', $product->id)
            ->findOrFail($galleryId);
        
        return view('admin.product_galleries.edit', compact('product', 'gallery'));
    }

    /**
     * Cập nhật ảnh
     */
    public function update(Request $request, Product $product, $galleryId)
    {
        $gallery = ProductGallery::where('product_id', $product->id)
            ->findOrFail($galleryId);

        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Xử lý upload ảnh mới nếu có
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ
            if ($gallery->image && Storage::disk('public')->exists('product_galleries/' . $gallery->image)) {
                Storage::disk('public')->delete('product_galleries/' . $gallery->image);
            }

            // Upload ảnh mới
            $image = $request->file('image');
            $fileName = ProductGallery::generateUniqueFileName($image->getClientOriginalName(), $product->id);
            
            // Kiểm tra tên file đã tồn tại chưa
            while (ProductGallery::isFileNameExists($fileName)) {
                $fileName = ProductGallery::generateUniqueFileName($image->getClientOriginalName(), $product->id);
            }

            $image->storeAs('product_galleries', $fileName, 'public');
            $gallery->image = $fileName;
        }

        // Cập nhật thông tin khác
        $gallery->alt_text = $request->alt_text;
        $gallery->sort_order = $request->sort_order ?? $gallery->sort_order;
        $gallery->is_active = $request->has('is_active');
        $gallery->save();

        return redirect()->route('admin.products.galleries.index', $product)
            ->with('success', 'Cập nhật ảnh thành công!');
    }

    /**
     * Xóa ảnh
     */
    public function destroy(Product $product, $galleryId)
    {
        $gallery = ProductGallery::where('product_id', $product->id)
            ->findOrFail($galleryId);

        // Xóa file ảnh
        if ($gallery->image && Storage::disk('public')->exists('product_galleries/' . $gallery->image)) {
            Storage::disk('public')->delete('product_galleries/' . $gallery->image);
        }

        $gallery->delete();

        return redirect()->route('admin.products.galleries.index', $product)
            ->with('success', 'Đã xóa ảnh thành công!');
    }

    /**
     * Cập nhật thứ tự ảnh (AJAX)
     */
    public function updateOrder(Request $request, Product $product)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*' => 'integer|exists:product_galleries,id'
        ]);

        foreach ($request->orders as $index => $galleryId) {
            ProductGallery::where('id', $galleryId)
                ->where('product_id', $product->id)
                ->update(['sort_order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Toggle trạng thái active (AJAX)
     */
    public function toggleActive(Product $product, $galleryId)
    {
        $gallery = ProductGallery::where('product_id', $product->id)
            ->findOrFail($galleryId);

        $gallery->is_active = !$gallery->is_active;
        $gallery->save();

        return response()->json([
            'success' => true,
            'is_active' => $gallery->is_active
        ]);
    }
} 