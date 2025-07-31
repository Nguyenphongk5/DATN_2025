<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mã xác thực OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .otp-code {
            background: #fff;
            border: 2px dashed #667eea;
            padding: 20px;
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 8px;
            color: #667eea;
            margin: 20px 0;
            border-radius: 10px;
        }
        .info-box {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 15px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 12px;
        }
        .btn {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 25px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🔐 Mã xác thực OTP</h1>
        <p>Trang quản trị hệ thống</p>
    </div>

    <div class="content">
        <h2>Xin chào {{ $user->name }}!</h2>
        
        <p>Bạn đã yêu cầu truy cập vào trang quản trị. Vui lòng sử dụng mã OTP dưới đây để xác thực:</p>

        <div class="otp-code">
            {{ $otp }}
        </div>

        <div class="info-box">
            <h4>📋 Thông tin bảo mật:</h4>
            <ul>
                <li><strong>Thời gian hết hạn:</strong> {{ $expiresAt->format('d/m/Y H:i:s') }}</li>
                <li><strong>IP Address:</strong> {{ $ipAddress ?? 'Không xác định' }}</li>
                <li><strong>Thiết bị:</strong> {{ $userAgent ?? 'Không xác định' }}</li>
            </ul>
        </div>

        <div style="margin: 30px 0;">
            <h4>⚠️ Lưu ý quan trọng:</h4>
            <ul>
                <li>Mã OTP chỉ có hiệu lực trong <strong>10 phút</strong></li>
                <li>Mã OTP chỉ được sử dụng <strong>1 lần</strong></li>
                <li>Không chia sẻ mã này với bất kỳ ai</li>
                <li>Nếu bạn không yêu cầu mã này, vui lòng bỏ qua email này</li>
            </ul>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('admin.otp.form') }}" class="btn">
                🔗 Truy cập trang xác thực
            </a>
        </div>

        <div style="background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 5px;">
            <h4>🛡️ Bảo mật tài khoản:</h4>
            <p>Để bảo vệ tài khoản của bạn, chúng tôi khuyến nghị:</p>
            <ul>
                <li>Không chia sẻ thông tin đăng nhập</li>
                <li>Sử dụng mật khẩu mạnh</li>
                <li>Đăng xuất khi không sử dụng</li>
                <li>Báo cáo ngay nếu phát hiện hoạt động bất thường</li>
            </ul>
        </div>
    </div>

    <div class="footer">
        <p>Email này được gửi tự động từ hệ thống quản trị.</p>
        <p>Nếu bạn có thắc mắc, vui lòng liên hệ với quản trị viên.</p>
        <p>© {{ date('Y') }} - Hệ thống quản trị</p>
    </div>
</body>
</html> 