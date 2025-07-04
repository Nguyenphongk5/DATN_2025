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
    public function store(Request $request, Product $product)
    {
        // 1. Validate dữ liệu (giữ nguyên)
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'image' => 'required|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ], [
            'product_id.required' => 'Vui lòng chọn một sản phẩm.',
            'image.required' => 'Vui lòng chọn ít nhất một ảnh.',
        ]);
        // dd($request);
        // 2. Lặp và lưu từng ảnh với tên tùy chỉnh
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                // Lấy tên gốc của file
                $originalName = $file->getClientOriginalName();

                // Tạo tên file mới: kết hợp timestamp và tên gốc (đã được làm sạch)
                // Ví dụ: 1720064691_ten-file-goc.jpg
                $newFileName = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

                // Lưu file với tên mới vào thư mục 'uploads/products' trên disk 'public'
                $path = $file->storeAs('products', $newFileName, 'public');

                // 3. Tạo bản ghi trong database
                ProductGallery::create([
                    'product_id' => $request->product_id,
                    'image'      => $path
                ]);
            }
        }

        // 4. Redirect về trang danh sách với thông báo
        return redirect()->route('admin.products-galleries.index')
            ->with('success', 'Thêm ảnh vào thư viện thành công!');
    }

    // Trong ProductGalleryController.php

    /**
     * Cập nhật một tài nguyên cụ thể trong bộ nhớ.
     */
    public function update(Request $request, ProductGallery $products_gallery)
    {
        // Đổi tên biến để code dễ đọc và nhất quán
        $gallery = $products_gallery;

        // 1. Validate dữ liệu gửi lên
        $request->validate([
            'product_id' => 'required|exists:products,id',
            // 'image' là nullable vì người dùng có thể không muốn thay đổi ảnh
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ], [
            'product_id.required' => 'Vui lòng chọn một sản phẩm.',
            'image.image' => 'Tệp tải lên phải là một hình ảnh.',
            'image.max' => 'Kích thước ảnh không được vượt quá 2MB.',
        ]);

        // 2. Cập nhật ID của sản phẩm liên kết
        $gallery->product_id = $request->product_id;

        // 3. Kiểm tra xem người dùng có tải lên ảnh mới để thay thế không
        if ($request->hasFile('image')) {

            // Xóa ảnh cũ khỏi storage để tránh rác
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }

            // Lưu ảnh mới vào storage
            $file = $request->file('image');
            $newFileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('products', $newFileName, 'public');

            // Cập nhật đường dẫn ảnh mới vào model
            $gallery->image = $path;
        }

        // 4. Lưu tất cả các thay đổi vào cơ sở dữ liệu
        $gallery->save();

        // 5. Chuyển hướng về trang danh sách với thông báo thành công
        return redirect()->route('admin.products-galleries.index')->with('success', 'Cập nhật ảnh thành công!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductGallery $products_gallery)
    {
        // Đổi tất cả các biến $gallery bên trong thành $products_gallery
        if ($products_gallery->image && Storage::disk('public')->exists($products_gallery->image)) {
            Storage::disk('public')->delete($products_gallery->image);
        }

        $products_gallery->delete();

        return redirect()->route('admin.products-galleries.index')->with('success', 'Đã xóa ảnh thành công!');
    }
}
