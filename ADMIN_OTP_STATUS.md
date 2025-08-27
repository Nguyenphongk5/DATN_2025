# Kiểm tra Trạng thái OTP Admin

## ✅ **Các thành phần đã có:**

### 1. **Controller (AdminOtpController.php)**
- ✅ `showOtpForm()` - Hiển thị form OTP
- ✅ `sendOtp()` - Gửi OTP qua email (AJAX)
- ✅ `verifyOtp()` - Xác thực OTP
- ✅ `resendOtp()` - Gửi lại OTP
- ✅ `logout()` - Đăng xuất admin

### 2. **Model (AdminOtp.php)**
- ✅ `generateOtp()` - Tạo OTP mới
- ✅ `verifyOtp()` - Kiểm tra OTP
- ✅ `isValid()` - Kiểm tra OTP còn hiệu lực
- ✅ `markAsUsed()` - Đánh dấu OTP đã dùng

### 3. **Middleware (AdminOtpMiddleware.php)**
- ✅ Kiểm tra user đã đăng nhập
- ✅ Kiểm tra user là admin
- ✅ Kiểm tra đã xác thực OTP
- ✅ Kiểm tra OTP chưa hết hạn (24h)

### 4. **View (otp.blade.php)**
- ✅ Form nhập OTP
- ✅ Auto-submit khi nhập đủ 6 số
- ✅ Timer gửi lại OTP (60s)
- ✅ Thông tin user
- ✅ Thông báo lỗi/thành công

### 5. **Routes**
- ✅ `admin.otp.form` - Form OTP
- ✅ `admin.otp.send` - Gửi OTP
- ✅ `admin.otp.verify` - Xác thực OTP
- ✅ `admin.otp.resend` - Gửi lại OTP
- ✅ `admin.logout` - Đăng xuất

### 6. **Mail (AdminOtpMail.php)**
- ✅ Template email OTP
- ✅ Thông tin OTP và thời gian hết hạn

## ⚠️ **Vấn đề có thể gặp:**

### 1. **Mail Configuration**
- Mail đang được cấu hình để log thay vì gửi thực
- Cần cấu hình SMTP hoặc mail service thực

### 2. **Database**
- Cần migration cho bảng `admin_otps`
- Cần seeder để test

### 3. **Environment**
- Cần cấu hình mail trong .env
- Cần cấu hình APP_URL

## 🔧 **Cách test:**

### **Test 1: Kiểm tra route**
```bash
php artisan route:list | findstr "otp"
```

### **Test 2: Kiểm tra mail log**
```bash
tail -f storage/logs/laravel.log
```

### **Test 3: Kiểm tra database**
```bash
php artisan tinker
>>> App\Models\AdminOtp::count()
```

### **Test 4: Test OTP flow**
1. Đăng nhập admin
2. Truy cập `/admin/otp`
3. Kiểm tra email/log
4. Nhập OTP
5. Kiểm tra redirect

## 📝 **Cần kiểm tra:**

1. **Mail configuration** trong .env
2. **Database migration** đã chạy chưa
3. **User có role admin** không
4. **Session configuration** có đúng không
5. **Log files** có lỗi gì không

## 🚀 **Nếu có vấn đề:**

1. Kiểm tra Laravel logs: `storage/logs/laravel.log`
2. Kiểm tra mail logs: `storage/logs/laravel.log`
3. Kiểm tra database connection
4. Kiểm tra session configuration
