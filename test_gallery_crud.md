# Hướng dẫn Test CRUD Gallery

## Các chức năng đã được sửa:

### 1. **Thêm ảnh mới (Create)**
- Route: `POST /admin/products/{product}/galleries`
- Controller: `ProductGalleryController@store`
- Hỗ trợ cả AJAX và form thường
- Trả về JSON nếu là AJAX request

### 2. **Sửa ảnh (Update)**
- Route: `PUT /admin/products/{product}/galleries/{gallery}`
- Controller: `ProductGalleryController@update`
- Hỗ trợ cả AJAX và form thường
- Trả về JSON nếu là AJAX request

### 3. **Xóa ảnh (Delete)**
- Route: `DELETE /admin/products/{product}/galleries/{gallery}`
- Controller: `ProductGalleryController@destroy`
- Trả về JSON response cho AJAX

### 4. **Đổi thứ tự ảnh (Sort)**
- Route: `POST /admin/products/{product}/galleries/update-order`
- Controller: `ProductGalleryController@updateOrder`
- Kéo thả để sắp xếp

### 5. **Bật/tắt trạng thái ảnh (Toggle Active)**
- Route: `POST /admin/products/{product}/galleries/{gallery}/toggle-active`
- Controller: `ProductGalleryController@toggleActive`
- Click nút eye/eye-slash

## Cách test:

1. **Truy cập trang quản lý gallery:**
   - Vào admin → Products → Chọn một sản phẩm → Gallery

2. **Test thêm ảnh:**
   - Click "Thêm màu sắc mới"
   - Upload ảnh và submit

3. **Test sửa ảnh:**
   - Click nút bút chì trên ảnh
   - Sửa thông tin và submit

4. **Test xóa ảnh:**
   - Click nút thùng rác trên ảnh
   - Xác nhận xóa

5. **Test đổi thứ tự:**
   - Kéo thả ảnh để sắp xếp

6. **Test bật/tắt:**
   - Click nút con mắt để ẩn/hiện ảnh

## Nếu vẫn lỗi:

1. **Kiểm tra console trình duyệt** để xem lỗi JavaScript
2. **Kiểm tra Network tab** để xem request/response
3. **Kiểm tra Laravel logs** tại `storage/logs/laravel.log`
4. **Đảm bảo đã đăng nhập admin và xác thực OTP**

## Các file đã sửa:

- `app/Http/Controllers/Admin/ProductGalleryController.php`
- `resources/views/admin/product_galleries/index.blade.php`
- `routes/web.php` (đã có sẵn)
