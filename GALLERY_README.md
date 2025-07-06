# 🖼️ Hướng dẫn sử dụng Product Gallery

## 📋 Tổng quan
Chức năng Product Gallery cho phép quản lý nhiều ảnh cho mỗi sản phẩm với tên file không trùng lặp.

## ✨ Tính năng chính

### 🔧 **Quản lý ảnh**
- ✅ Upload nhiều ảnh cùng lúc
- ✅ Tên file tự động không trùng lặp
- ✅ Sắp xếp thứ tự hiển thị (drag & drop)
- ✅ Bật/tắt ảnh (active/inactive)
- ✅ Alt text cho SEO
- ✅ Xóa ảnh an toàn

### 🎨 **Hiển thị**
- ✅ Gallery slider trong trang chi tiết sản phẩm
- ✅ Thumbnail navigation
- ✅ Responsive design
- ✅ Hover effects

## 🚀 Cách sử dụng

### 1. **Truy cập quản lý gallery**
```
Admin Panel → Products → Ấn nút "Ảnh" → Quản lý gallery
```

### 2. **Thêm ảnh mới**
- Vào trang quản lý gallery của sản phẩm
- Click "Thêm ảnh"
- Chọn nhiều file ảnh (jpeg, png, jpg, gif, webp)
- Nhập alt text cho từng ảnh (tùy chọn)
- Click "Lưu"

### 3. **Sắp xếp ảnh**
- Kéo thả các ảnh để thay đổi thứ tự
- Thứ tự sẽ được lưu tự động

### 4. **Chỉnh sửa ảnh**
- Click nút "Sửa" trên ảnh
- Thay đổi ảnh, alt text, thứ tự, trạng thái
- Click "Cập nhật"

### 5. **Xóa ảnh**
- Click nút "Xóa" trên ảnh
- Xác nhận xóa
- Ảnh và file sẽ bị xóa vĩnh viễn

## 📁 Cấu trúc file

### **Models**
- `app/Models/ProductGallery.php` - Model chính
- `app/Models/Product.php` - Relationship với gallery

### **Controllers**
- `app/Http/Controllers/Admin/ProductGalleryController.php` - CRUD operations

### **Views**
- `resources/views/admin/product_galleries/index.blade.php` - Danh sách ảnh
- `resources/views/admin/product_galleries/create.blade.php` - Thêm ảnh
- `resources/views/admin/product_galleries/edit.blade.php` - Sửa ảnh

### **Database**
- `database/migrations/2025_06_12_145227_create_product_galleries_table.php`
- `database/seeders/ProductGallerySeeder.php`

## 🔒 Bảo mật

### **Tên file không trùng lặp**
```php
// Tạo tên file duy nhất
$fileName = ProductGallery::generateUniqueFileName($originalName, $productId);
// Format: clean-name_timestamp_productId.extension
```

### **Validation**
- Chỉ cho phép file ảnh (jpeg, png, jpg, gif, webp)
- Kích thước tối đa: 2MB
- Alt text tối đa: 255 ký tự

### **File storage**
- Lưu trong `storage/app/public/product_galleries/`
- Sử dụng Laravel Storage facade
- Xóa file khi xóa record

## 🎯 Routes

```php
// Admin gallery routes
Route::prefix('products/{product}/galleries')->name('products.galleries.')->group(function () {
    Route::get('/', [ProductGalleryController::class, 'index'])->name('index');
    Route::get('/create', [ProductGalleryController::class, 'create'])->name('create');
    Route::post('/', [ProductGalleryController::class, 'store'])->name('store');
    Route::get('/{gallery}/edit', [ProductGalleryController::class, 'edit'])->name('edit');
    Route::put('/{gallery}', [ProductGalleryController::class, 'update'])->name('update');
    Route::delete('/{gallery}', [ProductGalleryController::class, 'destroy'])->name('destroy');
    Route::post('/update-order', [ProductGalleryController::class, 'updateOrder'])->name('updateOrder');
    Route::post('/{gallery}/toggle-active', [ProductGalleryController::class, 'toggleActive'])->name('toggleActive');
});
```

## 📊 Database Schema

```sql
CREATE TABLE product_galleries (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_id BIGINT UNSIGNED NOT NULL,
    image VARCHAR(255) NOT NULL,
    alt_text VARCHAR(255) NULL,
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);
```

## 🎨 Frontend Integration

### **Trang chi tiết sản phẩm**
```php
// Lấy ảnh gallery
$galleryImages = DB::table('product_galleries')
    ->where('product_id', $product->id)
    ->where('is_active', 1)
    ->orderBy('sort_order', 'asc')
    ->get();

// Tạo mảng ảnh
$thumbs = collect([$product->img_thumb])
    ->merge($galleryImages->pluck('image'))
    ->filter()
    ->take(6)
    ->map(function($img) {
        return asset('storage/' . $img);
    })->toArray();
```

## 🔧 Troubleshooting

### **Lỗi thường gặp**
1. **Ảnh không hiển thị**: Kiểm tra storage link `php artisan storage:link`
2. **Upload lỗi**: Kiểm tra quyền thư mục storage
3. **Tên file trùng**: Hệ thống tự động xử lý

### **Debug**
```php
// Kiểm tra gallery của sản phẩm
$product = Product::find(1);
dd($product->galleries()->get());

// Kiểm tra file tồn tại
Storage::disk('public')->exists('product_galleries/filename.jpg');
```

## 📈 Performance

### **Optimization**
- Sử dụng eager loading: `Product::with('galleries')`
- Lazy loading cho ảnh lớn
- Cache gallery data nếu cần

### **Best Practices**
- Nén ảnh trước khi upload
- Sử dụng WebP format khi có thể
- Giới hạn số lượng ảnh per product

---

**🎉 Chức năng Product Gallery đã sẵn sàng sử dụng!** 