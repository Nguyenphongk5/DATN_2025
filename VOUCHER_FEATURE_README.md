# Tính Năng Voucher - Hướng Dẫn Sử Dụng

## Tổng Quan
Tính năng voucher cho phép admin tạo và quản lý các mã giảm giá, đồng thời cho phép người dùng áp dụng mã giảm giá khi thanh toán.

## Tính Năng Chính

### 1. Quản Lý Voucher (Admin)
- **Tạo voucher mới**: Admin có thể tạo voucher với các thông tin:
  - Mã voucher (unique)
  - Loại giảm giá (phần trăm hoặc cố định)
  - Giá trị giảm giá
  - Ngày bắt đầu và kết thúc
  - Số lượng voucher
  - Giới hạn giá trị đơn hàng (tối thiểu/tối đa)
  - Giới hạn sử dụng per user
  - Trạng thái hoạt động

- **Quản lý voucher**: 
  - Xem danh sách tất cả voucher
  - Chỉnh sửa thông tin voucher
  - Xóa voucher
  - Bật/tắt trạng thái hoạt động

### 2. Sử Dụng Voucher (User)
- **Xem danh sách voucher**: Người dùng có thể xem tất cả voucher đang hoạt động
- **Sao chép mã**: Click để copy mã voucher vào clipboard
- **Áp dụng khi thanh toán**: Nhập mã voucher trong form checkout

### 3. Validation Voucher
- Kiểm tra mã voucher có tồn tại và đang hoạt động
- Kiểm tra thời gian hiệu lực
- Kiểm tra số lượng còn lại
- Kiểm tra điều kiện giá trị đơn hàng
- Tính toán giảm giá tự động

## Cấu Trúc Database

### Bảng `vouchers`
```sql
- id (Primary Key)
- code (Unique, 50 chars)
- discount_type (enum: 'percent', 'fixed')
- discount_value (decimal 10,2)
- start_date (date)
- end_date (date)
- quantity (integer)
- used_count (integer, default 0)
- user_limit (integer, default 1)
- min_money (decimal 10,2)
- max_money (decimal 10,2)
- is_active (tinyint, default 1)
- created_at, updated_at
```

## Routes

### Admin Routes
```
GET    /admin/vouchers              - Danh sách voucher
GET    /admin/vouchers/create       - Form tạo voucher
POST   /admin/vouchers              - Lưu voucher mới
GET    /admin/vouchers/{id}/edit    - Form chỉnh sửa
PUT    /admin/vouchers/{id}         - Cập nhật voucher
DELETE /admin/vouchers/{id}         - Xóa voucher
```

### User Routes
```
GET    /vouchers                    - Xem danh sách voucher
POST   /validate-voucher            - Validate voucher (AJAX)
```

## Controllers

### Admin\VoucherController
- `index()` - Hiển thị danh sách voucher
- `create()` - Form tạo voucher
- `store()` - Lưu voucher mới
- `edit()` - Form chỉnh sửa
- `update()` - Cập nhật voucher
- `destroy()` - Xóa voucher

### VoucherController (User)
- `index()` - Hiển thị danh sách voucher cho user
- `validateVoucher()` - Validate voucher qua AJAX

## Models

### Voucher Model
```php
protected $fillable = [
    'code', 'discount_type', 'discount_value', 'start_date', 
    'end_date', 'quantity', 'used_count', 'user_limit', 
    'min_money', 'max_money', 'is_active'
];

protected $casts = [
    'is_active' => 'boolean',
    'start_date' => 'date',
    'end_date' => 'date'
];
```

## Validation Rules

### StoreVoucherRequest
- `code`: required, unique:vouchers, max:50
- `discount_type`: required, in:percent,fixed
- `discount_value`: required, numeric, min:0
- `start_date`: required, date
- `end_date`: required, date, after:start_date
- `quantity`: required, integer, min:1
- `user_limit`: required, integer, min:1
- `min_money`: required, numeric, min:0
- `max_money`: required, numeric, min:min_money
- `is_active`: required, boolean

### UpdateVoucherRequest
- Tương tự StoreVoucherRequest nhưng code có thể trùng với chính nó

## Views

### Admin Views
- `admin/vouchers/index.blade.php` - Danh sách voucher
- `admin/vouchers/create.blade.php` - Form tạo voucher
- `admin/vouchers/edit.blade.php` - Form chỉnh sửa

### User Views
- `user/vouchers/index.blade.php` - Danh sách voucher cho user

## JavaScript Features

### Voucher Validation (Checkout)
```javascript
// Validate voucher via AJAX
function validateVoucher(code) {
    fetch('/validate-voucher', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            code: code,
            total_amount: total
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showVoucherInfo(data.message, 'success');
            updateTotalWithDiscount(data.discount_amount, total);
        } else {
            showVoucherInfo(data.message, 'error');
        }
    });
}
```

### Copy Voucher Code
```javascript
function copyVoucherCode(code) {
    navigator.clipboard.writeText(code).then(function() {
        // Show success notification
    });
}
```

## Seeder

### VoucherSeeder
Tạo 5 voucher mẫu:
- `WELCOME10`: Giảm 10% cho đơn hàng từ 100k-5M
- `SAVE50K`: Giảm 50k cho đơn hàng từ 200k-3M
- `SUMMER20`: Giảm 20% cho đơn hàng từ 300k-2M
- `NEWUSER`: Giảm 100k cho đơn hàng từ 500k-10M
- `FLASH15`: Giảm 15% cho đơn hàng từ 150k-1M (7 ngày)

## Dashboard Integration

### Thống Kê Voucher
- Tổng số voucher
- Số voucher đang hoạt động
- Số voucher đã hết hạn
- Tổng số lượng và đã sử dụng
- Top voucher được sử dụng nhiều nhất

## Cách Sử Dụng

### Cho Admin
1. Truy cập Admin Panel → Vouchers
2. Click "Thêm Voucher" để tạo voucher mới
3. Điền đầy đủ thông tin và lưu
4. Quản lý voucher trong danh sách

### Cho User
1. Truy cập "Mã Giảm Giá" từ menu
2. Xem danh sách voucher khả dụng
3. Click "Sao chép mã" để copy
4. Khi thanh toán, paste mã vào ô "Mã giảm giá"
5. Click "Áp dụng" để validate và tính giảm giá

## Lưu Ý
- Voucher chỉ áp dụng cho đơn hàng đáp ứng điều kiện giá trị
- Mỗi voucher có giới hạn số lần sử dụng
- Voucher có thời hạn sử dụng
- Giảm giá không vượt quá tổng tiền đơn hàng
- Mỗi user có giới hạn sử dụng voucher 