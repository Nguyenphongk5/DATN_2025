# Debug CRUD Gallery - Hướng dẫn kiểm tra

## Các bước kiểm tra:

### 1. **Kiểm tra Console trình duyệt (F12)**
- Mở Developer Tools (F12)
- Vào tab Console
- Thử thực hiện các thao tác CRUD
- Xem có lỗi JavaScript nào không

### 2. **Kiểm tra Network tab**
- Vào tab Network trong Developer Tools
- Thử thực hiện thao tác CRUD
- Xem request có được gửi không
- Xem response từ server

### 3. **Kiểm tra Laravel Logs**
- Mở file: `storage/logs/laravel.log`
- Xem có lỗi nào liên quan đến gallery không

### 4. **Test từng chức năng:**

#### **Test Edit (Sửa):**
- Click nút bút chì trên ảnh
- Xem có chuyển đến trang edit không
- Nếu không, kiểm tra URL trong href

#### **Test Delete (Xóa):**
- Click nút thùng rác
- Xem modal có hiện không
- Click "Xóa ảnh"
- Xem có lỗi gì trong console

#### **Test Toggle Active:**
- Click nút con mắt
- Xem có lỗi gì trong console

### 5. **Kiểm tra Route:**
```bash
php artisan route:list | findstr "galleries"
```

### 6. **Nếu vẫn lỗi, hãy:**
1. Gửi screenshot lỗi từ console
2. Gửi URL đang truy cập
3. Gửi thông báo lỗi cụ thể

## Các file đã sửa:
- ✅ `app/Http/Controllers/Admin/ProductGalleryController.php`
- ✅ `resources/views/admin/product_galleries/index.blade.php`
- ✅ `routes/web.php` (đã có sẵn)

## Các chức năng đã có:
- ✅ Thêm ảnh (Create)
- ✅ Sửa ảnh (Update) 
- ✅ Xóa ảnh (Delete)
- ✅ Đổi thứ tự (Sort)
- ✅ Bật/tắt trạng thái (Toggle)
