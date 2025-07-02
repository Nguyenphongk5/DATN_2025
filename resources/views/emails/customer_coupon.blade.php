<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>🎁 Ưu đãi độc quyền từ ShoeStyle - Giảm 10% cho bạn!</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f4f4f4;
      margin: 0;
      padding: 0;
      color: #333;
    }
    .email-wrapper {
      max-width: 640px;
      margin: 30px auto;
      background: #ffffff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }
    .header {
      background: linear-gradient(to right, #111, #333);
      color: #fff;
      padding: 40px 30px;
      text-align: center;
    }
    .header h1 {
      margin: 0;
      font-size: 28px;
      letter-spacing: 1px;
    }
    .content {
      padding: 30px;
    }
    .content h2 {
      font-size: 22px;
      margin-top: 0;
      color: #222;
    }
    .coupon-box {
      background: #fff5f5;
      border: 2px dashed #e63946;
      color: #e63946;
      font-size: 22px;
      font-weight: bold;
      padding: 16px 24px;
      text-align: center;
      margin: 25px 0;
      border-radius: 10px;
    }
    .cta {
      display: inline-block;
      margin-top: 20px;
      background-color: #000;
      color: #fff;
      text-decoration: none;
      padding: 12px 28px;
      border-radius: 6px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }
    .cta:hover {
      background-color: #444;
    }
    .footer {
      text-align: center;
      font-size: 13px;
      color: #888;
      padding: 20px;
      background: #fafafa;
    }

    @media screen and (max-width: 640px) {
      .content, .header, .footer {
        padding: 20px;
      }
      .coupon-box {
        font-size: 20px;
      }
    }
  </style>
</head>
<body>
  <div class="email-wrapper">
    <div class="header">
      <h1>👟 ShoeStyle - Ưu Đãi Dành Riêng Cho Bạn</h1>
    </div>
    <div class="content">
      <h2>Xin chào {{ $name }}!</h2>
      <p>Cảm ơn bạn đã tin tưởng và đăng ký nhận thông tin từ <strong>ShoeStyle</strong>.</p>
      <p>Chúng tôi trân trọng gửi tặng bạn <strong>mã giảm giá 10%</strong> áp dụng cho đơn hàng đầu tiên:</p>

      <div class="coupon-box">
        {{ $coupon }}
      </div>

      <p>Sử dụng mã này tại trang thanh toán để tận hưởng ưu đãi ngay hôm nay.</p>

      <a href="{{ url('/') }}" class="cta">🔗 Mua Giày Ngay</a>
    </div>

    <div class="footer">
      © {{ date('Y') }} ShoeStyle. Mọi quyền được bảo lưu.
      <br>
      Bạn nhận được email này vì đã đăng ký tại website của chúng tôi.
    </div>
  </div>
</body>
</html>
