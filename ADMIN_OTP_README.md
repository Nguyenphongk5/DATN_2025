# Tính Năng Xác Thực OTP Cho Admin - Hướng Dẫn Sử Dụng

## Tổng Quan
Tính năng xác thực OTP cho admin giúp bảo vệ trang quản trị bằng cách yêu cầu mã OTP được gửi qua email trước khi cho phép truy cập.

## Tính Năng Chính

### 1. Xác Thực 2 Lớp (Two-Factor Authentication)
- **Đăng nhập thông thường**: Username/password
- **Xác thực OTP**: Mã 6 số gửi qua email
- **Bảo mật cao**: Chỉ admin mới có thể truy cập

### 2. Quản Lý OTP
- **Tạo OTP tự động**: Khi admin truy cập trang quản trị
- **Gửi email**: OTP được gửi đến email đăng ký
- **Thời gian hết hạn**: 10 phút
- **Sử dụng 1 lần**: OTP chỉ được dùng 1 lần

### 3. Phiên Đăng Nhập
- **Session management**: Lưu trạng thái xác thực
- **Thời gian hiệu lực**: 24 giờ
- **Tự động logout**: Khi hết hạn phiên

## Cấu Trúc Database

### Bảng `admin_otps`
```sql
- id (Primary Key)
- user_id (Foreign Key)
- otp (string, 6 chars) - Mã OTP
- expires_at (timestamp) - Thời gian hết hạn
- is_used (boolean) - Đã sử dụng chưa
- ip_address (string) - IP address
- user_agent (string) - User agent
- created_at, updated_at
```

## Routes

### Admin OTP Routes
```
GET    /admin/otp                    - Form nhập OTP
POST   /admin/otp/send              - Gửi OTP qua email
POST   /admin/otp/verify            - Xác thực OTP
POST   /admin/otp/resend            - Gửi lại OTP
POST   /admin/logout                - Đăng xuất admin
```

### Admin Protected Routes
```
GET    /admin/dashboard             - Dashboard (cần OTP)
GET    /admin/products              - Quản lý sản phẩm (cần OTP)
GET    /admin/orders                - Quản lý đơn hàng (cần OTP)
... (tất cả routes admin khác)
```

## Controllers

### Admin\AdminOtpController
- `showOtpForm()` - Hiển thị form nhập OTP
- `sendOtp()` - Gửi OTP qua email (AJAX)
- `verifyOtp()` - Xác thực OTP
- `resendOtp()` - Gửi lại OTP (AJAX)
- `logout()` - Đăng xuất admin

## Models

### AdminOtp Model
```php
protected $fillable = [
    'user_id', 'otp', 'expires_at', 'is_used', 
    'ip_address', 'user_agent'
];

protected $casts = [
    'expires_at' => 'datetime',
    'is_used' => 'boolean'
];
```

### User Model (Cập nhật)
```php
// Quan hệ với AdminOtp
public function adminOtps()
{
    return $this->hasMany(AdminOtp::class);
}

// Kiểm tra user có phải admin không
public function isAdmin()
{
    return $this->role === 'admin';
}
```

## Middleware

### AdminOtpMiddleware
- Kiểm tra user đã đăng nhập
- Kiểm tra user có phải admin không
- Kiểm tra đã xác thực OTP chưa
- Kiểm tra OTP có hết hạn không (24h)

## Views

### Admin Auth Views
- `admin/auth/otp.blade.php` - Form nhập OTP

### Features
- **Auto focus**: Tự động focus vào input OTP
- **Auto submit**: Tự động submit khi nhập đủ 6 số
- **Timer**: Đếm ngược 60s để gửi lại OTP
- **Real-time validation**: Kiểm tra OTP real-time
- **Responsive design**: Giao diện đẹp, responsive

## Email Template

### AdminOtpMail
- **Template**: `emails/admin-otp.blade.php`
- **Subject**: "Mã xác thực OTP - Trang quản trị"
- **Content**: 
  - Mã OTP 6 số
  - Thông tin bảo mật
  - Thời gian hết hạn
  - IP address và User agent

## Cách Hoạt Động

### 1. Admin Truy Cập Trang Quản Trị
```
User → /admin/dashboard → Middleware kiểm tra → Chưa OTP → /admin/otp
```

### 2. Gửi OTP
```
/admin/otp → Tự động gửi OTP → Email → User nhận OTP
```

### 3. Xác Thực OTP
```
User nhập OTP → Verify → Thành công → /admin/dashboard
```

### 4. Truy Cập Trang Quản Trị
```
User → /admin/* → Middleware kiểm tra → Đã OTP → Cho phép truy cập
```

## Cài Đặt

### 1. Chạy Migration
```bash
php artisan migrate
```

### 2. Cấu Hình Email
Cập nhật file `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 3. Chạy Seeder
```bash
php artisan db:seed --class=AdminOtpSeeder
```

## Cách Sử Dụng

### Cho Admin
1. **Đăng nhập**: Truy cập trang login và đăng nhập
2. **Truy cập admin**: Click vào link "Quản trị" hoặc truy cập `/admin`
3. **Nhận OTP**: Hệ thống tự động gửi OTP qua email
4. **Nhập OTP**: Nhập mã 6 số vào form
5. **Truy cập**: Sau khi xác thực thành công, có thể truy cập trang quản trị

### Tính Năng Bổ Sung
- **Gửi lại OTP**: Click "Gửi lại OTP" nếu không nhận được
- **Auto submit**: Tự động submit khi nhập đủ 6 số
- **Timer**: Đếm ngược 60s trước khi có thể gửi lại
- **Logout**: Click "Đăng xuất" để thoát khỏi phiên admin

## Bảo Mật

### Tính Năng Bảo Mật
- **OTP 6 số**: Mã ngẫu nhiên 6 chữ số
- **Thời gian hết hạn**: 10 phút
- **Sử dụng 1 lần**: OTP chỉ được dùng 1 lần
- **Session timeout**: 24 giờ
- **IP tracking**: Lưu IP address
- **User agent tracking**: Lưu thông tin thiết bị

### Lưu Ý Bảo Mật
- Không chia sẻ OTP với người khác
- Đăng xuất khi không sử dụng
- Sử dụng email bảo mật
- Báo cáo ngay nếu phát hiện hoạt động bất thường

## Troubleshooting

### Lỗi Thường Gặp
1. **"Email không được gửi"**: Kiểm tra cấu hình SMTP
2. **"OTP không chính xác"**: Kiểm tra mã OTP và thời gian hết hạn
3. **"Không thể truy cập admin"**: Kiểm tra role user có phải admin không
4. **"Session hết hạn"**: Đăng nhập lại và xác thực OTP

### Debug
- Kiểm tra log Laravel: `storage/logs/laravel.log`
- Kiểm tra email queue: `php artisan queue:work`
- Kiểm tra database: `admin_otps` table

## Mở Rộng

### Tính Năng Có Thể Thêm
- **SMS OTP**: Gửi OTP qua SMS
- **Push notifications**: Thông báo đẩy
- **Backup codes**: Mã dự phòng
- **Remember device**: Ghi nhớ thiết bị
- **Activity logs**: Nhật ký hoạt động
- **Admin notifications**: Thông báo cho admin khác

### Performance
- **Queue**: Sử dụng queue cho email
- **Caching**: Cache OTP để tăng tốc
- **Rate limiting**: Giới hạn số lần gửi OTP
- **Monitoring**: Theo dõi hoạt động OTP 