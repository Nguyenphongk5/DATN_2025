<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Xác nhận đơn hàng</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f2f4f8;
      font-family: 'Segoe UI', sans-serif;
    }
    .email-wrapper {
      max-width: 700px;
      margin: 30px auto;
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      overflow: hidden;
    }
    .email-header {
      background: linear-gradient(135deg, #0d6efd, #6610f2);
      color: white;
      text-align: center;
      padding: 40px 20px;
    }
    .email-header h1 {
      margin: 0;
      font-size: 28px;
    }
    .email-body {
      padding: 40px 30px;
      color: #333;
    }
    .order-info p {
      font-size: 16px;
      margin-bottom: 10px;
    }
    .order-info strong {
      width: 160px;
      display: inline-block;
      color: #555;
    }
    .btn-order {
      background-color: #198754;
      color: #fff;
      padding: 14px 28px;
      font-size: 16px;
      border-radius: 8px;
      text-decoration: none;
      display: inline-block;
      margin-top: 30px;
    }
    .btn-order:hover {
      background-color: #157347;
    }
    .email-footer {
      text-align: center;
      padding: 20px;
      font-size: 13px;
      color: #888;
    }
  </style>
</head>
<body>

<div class="email-wrapper">
  <div class="email-header">
    <h1>🎉 Cảm ơn bạn đã đặt hàng!</h1>
    <p>Chúng tôi đã nhận được đơn hàng của bạn.</p>
  </div>

  <div class="email-body">
    <h4 class="mb-4">🧾 Chi tiết đơn hàng</h4>
    <div class="order-info">
      <p><strong>👤 Họ tên:</strong> {{ $name }}</p>
      <p><strong>📞 Số điện thoại:</strong> {{ $phone }}</p>
      <p><strong>📍 Địa chỉ:</strong> {{ $address }}</p>
      <p><strong>📝 Ghi chú:</strong> {{ $note ?? 'Không có' }}</p>
      <p><strong>💰 Tổng tiền:</strong> <span style="color:#dc3545; font-weight:bold">{{ number_format($total, 0, ',', '.') }} VNĐ</span></p>
      <p><strong>💳 Thanh toán:</strong> {{ $payment_method == 'cod' ? 'Thanh toán khi nhận hàng (COD)' : 'Online' }}</p>
    </div>

    <div class="text-center">
      <a href="{{ url('/') }}" class="btn-order">🛒 Tiếp tục mua sắm</a>
    </div>
  </div>

  <div class="email-footer">
    &copy; {{ date('Y') }} {{ config('app.name') }}. Cảm ơn bạn đã ủng hộ!
  </div>
</div>

</body>
</html>
