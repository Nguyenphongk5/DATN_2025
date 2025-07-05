# Hướng dẫn sử dụng chức năng Ảnh Gallery Sản phẩm

## Tổng quan
Chức năng này cho phép quản lý nhiều ảnh cho mỗi sản phẩm, tránh tình trạng trùng tên file và cung cấp trải nghiệm xem sản phẩm tốt hơn.

## Tính năng chính

### 1. Tạo tên file unique
- Sử dụng `FileHelper` class để tạo tên file không bị trùng
- Format: `{prefix}_{clean_name}_{timestamp}_{random_string}.{extension}`
- Ví dụ: `product_thumb_iphone-15_20250705174532_aB3cD4eF.jpg`

### 2. Upload nhiều ảnh
- Hỗ trợ upload nhiều ảnh cùng lúc
- Định dạng hỗ trợ: JPG, PNG, GIF, SVG
- Kích thước tối đa: 2MB mỗi ảnh

### 3. Quản lý ảnh gallery
- Xem ảnh gallery hiện tại
- Thêm ảnh mới
- Xóa ảnh không mong muốn
- Sắp xếp thứ tự ảnh

## Cấu trúc Database

### Bảng `product_galleries`
```sql
- id (primary key)
- product_id (foreign key)
- image (string) - đường dẫn ảnh
- sort_order (integer) - thứ tự sắp xếp
- created_at, updated_at
```

## Cách sử dụng

### 1. Tạo sản phẩm mới
1. Vào trang "Thêm sản phẩm mới"
2. Upload ảnh thumbnail (bắt buộc)
3. Upload ảnh gallery (tùy chọn, có thể chọn nhiều ảnh)
4. Điền thông tin sản phẩm
5. Nhấn "Thêm sản phẩm"

### 2. Chỉnh sửa sản phẩm
1. Vào trang "Cập nhật sản phẩm"
2. Xem ảnh gallery hiện tại
3. Xóa ảnh không mong muốn bằng cách nhấn nút "×"
4. Thêm ảnh mới nếu cần
5. Cập nhật thông tin sản phẩm
6. Nhấn "Cập nhật sản phẩm"

### 3. Xem chi tiết sản phẩm (Frontend)
- Ảnh thumbnail và gallery sẽ hiển thị trong slider
- Người dùng có thể xem tất cả ảnh của sản phẩm
- Hỗ trợ zoom ảnh

## API Endpoints

### Xóa ảnh gallery
```
DELETE /admin/gallery/{id}
```

### Cập nhật thứ tự ảnh
```
POST /admin/gallery/update-order
Body: { "gallery_ids": [1, 2, 3, ...] }
```

## File Helper Functions

### `FileHelper::generateUniqueFileName($file, $prefix)`
Tạo tên file unique cho ảnh upload.

### `FileHelper::uploadFile($file, $path, $prefix)`
Upload file với tên unique.

### `FileHelper::deleteFile($filePath)`
Xóa file từ storage.

## Lưu ý quan trọng

1. **Tên file unique**: Mỗi ảnh sẽ có tên file khác nhau để tránh trùng lặp
2. **Storage**: Ảnh được lưu trong `storage/app/public/product_galleries/`
3. **Quan hệ**: Mỗi sản phẩm có thể có nhiều ảnh gallery
4. **Sắp xếp**: Ảnh được sắp xếp theo `sort_order`
5. **Xóa cascade**: Khi xóa sản phẩm, tất cả ảnh gallery sẽ bị xóa

## Troubleshooting

### Lỗi upload ảnh
- Kiểm tra quyền ghi thư mục storage
- Kiểm tra kích thước file (tối đa 2MB)
- Kiểm tra định dạng file

### Ảnh không hiển thị
- Chạy `php artisan storage:link` để tạo symbolic link
- Kiểm tra đường dẫn ảnh trong database
- Kiểm tra file có tồn tại trong storage không

## Migration và Seeder

### Chạy migration
```bash
php artisan migrate
```

### Chạy seeder (tạo dữ liệu mẫu)
```bash
php artisan db:seed --class=ProductGallerySeeder
```

### Chạy tất cả seeder
```bash
php artisan db:seed
``` 