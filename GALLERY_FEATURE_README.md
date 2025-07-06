# Tính năng Gallery Ảnh Sản phẩm

## Tổng quan
Tính năng gallery cho phép admin upload nhiều ảnh cho mỗi sản phẩm, tạo ra trải nghiệm xem sản phẩm phong phú hơn cho khách hàng.

## Tính năng chính

### 1. Upload Ảnh Gallery
- **Form tạo sản phẩm**: Có thể upload nhiều ảnh cùng lúc
- **Form chỉnh sửa sản phẩm**: Có thể thêm ảnh mới vào gallery hiện có
- **Hỗ trợ format**: JPG, PNG, GIF, WebP
- **Kích thước tối đa**: 2MB mỗi ảnh
- **Drag & Drop**: Kéo thả ảnh trực tiếp vào form

### 2. Preview Ảnh
- **Real-time preview**: Xem ảnh ngay khi chọn
- **Thông tin file**: Hiển thị tên file và kích thước
- **Sắp xếp**: Ảnh được đánh số theo thứ tự upload

### 3. Quản lý Gallery
- **Xem gallery hiện tại**: Trong form edit sản phẩm
- **Link quản lý**: Chuyển đến trang quản lý gallery riêng biệt
- **Sắp xếp**: Ảnh được sắp xếp theo sort_order

## Cấu trúc Database

### Bảng `product_galleries`
```sql
- id (Primary Key)
- product_id (Foreign Key)
- image (Tên file ảnh)
- alt_text (Mô tả ảnh)
- sort_order (Thứ tự hiển thị)
- is_active (Trạng thái hoạt động)
- created_at, updated_at
```

## Cách sử dụng

### 1. Tạo sản phẩm với gallery
1. Vào Admin → Products → Create
2. Điền thông tin sản phẩm
3. Chọn ảnh thumbnail
4. **Chọn ảnh gallery**: Click "Chọn ảnh gallery" hoặc kéo thả ảnh
5. Xem preview ảnh đã chọn
6. Submit form

### 2. Thêm ảnh vào sản phẩm hiện có
1. Vào Admin → Products → Edit sản phẩm
2. Xem gallery hiện tại (nếu có)
3. **Thêm ảnh mới**: Click "Thêm ảnh gallery"
4. Chọn ảnh và xem preview
5. Submit form

### 3. Quản lý gallery chi tiết
1. Trong form edit sản phẩm, click "Quản lý gallery"
2. Hoặc vào Admin → Products → [Sản phẩm] → Gallery
3. Thực hiện các thao tác:
   - Thêm ảnh mới
   - Xóa ảnh
   - Sắp xếp lại thứ tự
   - Chỉnh sửa alt text
   - Ẩn/hiện ảnh

## Hiển thị Frontend

### Trang chi tiết sản phẩm
- Hiển thị ảnh thumbnail chính
- Gallery ảnh phụ bên dưới
- Click ảnh để xem full size
- Responsive design

### Trang danh sách sản phẩm
- Hiển thị ảnh thumbnail chính
- Có thể thêm indicator cho sản phẩm có gallery

## Tên file tự động

### Quy tắc đặt tên
```
[ten-file-goc]_[timestamp]_[product-id].[extension]
```

### Ví dụ
```
product-image_1703123456_123.jpg
```

### Lợi ích
- Tránh trùng tên file
- Dễ dàng quản lý
- Có thể trace về sản phẩm gốc

## Validation

### Rules
- `gallery_images.*`: nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048
- Mỗi ảnh tối đa 2MB
- Chỉ chấp nhận format ảnh phổ biến

### Error handling
- Hiển thị lỗi validation trong form
- Rollback nếu có lỗi upload
- Giữ lại ảnh đã upload thành công

## Performance

### Optimization
- Ảnh được lưu trong storage/app/public
- Sử dụng symbolic link cho public access
- Compress ảnh tự động (có thể thêm)

### Storage
- Tổ chức theo thư mục: `product_galleries/`
- Tên file unique để tránh conflict
- Backup strategy cho ảnh quan trọng

## Security

### File upload
- Validate file type
- Giới hạn kích thước
- Sanitize filename
- Store ngoài web root

### Access control
- Chỉ admin có quyền upload
- Middleware authentication
- CSRF protection

## Troubleshooting

### Lỗi thường gặp
1. **"Class 'DB' not found"**: Thêm `use Illuminate\Support\Facades\DB;`
2. **Storage link chưa tạo**: Chạy `php artisan storage:link`
3. **Permission denied**: Kiểm tra quyền thư mục storage

### Debug
- Kiểm tra log Laravel
- Verify database connection
- Test upload với file nhỏ trước

## Future Enhancements

### Tính năng có thể thêm
- Image compression
- Watermark tự động
- Multiple image sizes (thumb, medium, large)
- CDN integration
- Bulk upload/delete
- Image cropping
- EXIF data extraction

### Performance improvements
- Lazy loading
- Image optimization
- Caching strategy
- Background processing cho upload lớn 