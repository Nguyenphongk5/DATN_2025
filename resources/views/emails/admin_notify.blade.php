<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Người đăng ký mới</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, sans-serif;
      background-color: #f6f6f6;
      margin: 0;
      padding: 30px 0;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      background: #ffffff;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.07);
    }

    h2 {
      margin-top: 0;
      font-size: 24px;
      color: #111;
      text-align: center;
    }

    .info {
      font-size: 16px;
      color: #333;
      line-height: 1.6;
    }

    .label {
      font-weight: bold;
      color: #555;
    }

    .highlight {
      color: #e63946;
    }

    .footer {
      text-align: center;
      font-size: 13px;
      color: #aaa;
      margin-top: 40px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>📥 Người đăng ký mới</h2>
    <div class="info">
      <p><span class="label">👤 Họ tên:</span> <span class="highlight">{{ $name }}</span></p>
      <p><span class="label">📧 Email:</span> <span class="highlight">{{ $email }}</span></p>
    </div>
    <div class="footer">
      Email hệ thống từ ShoeStyle<br>
      {{ date('d/m/Y H:i') }}
    </div>
  </div>
</body>
</html>
