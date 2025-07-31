<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mã OTP đăng nhập</title>
    <style>
        body {
            background: #f4f6fb;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .card {
            max-width: 400px;
            margin: 40px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 28px 20px 24px 20px;
        }
        .otp-label {
            color: #222;
            font-size: 16px;
            margin: 0 0 10px 0;
        }
        .otp-code {
            font-size: 38px;
            font-weight: bold;
            color: #1a237e;
            letter-spacing: 8px;
            margin: 10px 0 18px 0;
        }
        .warning {
            color: #d32f2f;
            font-size: 15px;
            font-weight: 500;
            margin-bottom: 8px;
        }
        .note {
            color: #333;
            font-size: 15px;
        }
        @media (max-width: 600px) {
            .card { margin: 0; border-radius: 0; }
            .otp-code { font-size: 28px; letter-spacing: 4px; }
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="otp-label">Mã OTP của bạn là</div>
        <div class="otp-code">{{ $otp->otp }}</div>
        <div class="warning">
            Tuyệt đối KHÔNG chia sẻ mã xác thực (OTP) cho bất kỳ ai dưới bất kỳ hình thức nào.
        </div>
        <div class="note">
            Mã xác thực có hiệu lực đến: <b>{{ \Carbon\Carbon::parse($otp->expires_at)->format('H:i d/m/Y') }}</b>
        </div>
    </div>
</body>
</html> 