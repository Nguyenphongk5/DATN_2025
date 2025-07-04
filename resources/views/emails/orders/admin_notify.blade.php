@component('mail::message')
# Đơn hàng mới từ {{ $name }}

**Chi tiết đơn hàng:**
- Họ tên: {{ $name }}
- SĐT: {{ $phone }}
- Địa chỉ: {{ $address }}
- Ghi chú: {{ $note ?? 'Không có' }}
- Tổng tiền: {{ number_format($total, 0, ',', '.') }} VNĐ
- Thanh toán: {{ $payment_method == 'cod' ? 'COD' : 'Online' }}

@component('mail::button', ['url' => route('admin.orders.index')])
Xem đơn hàng
@endcomponent

**Thông báo tự động từ hệ thống**
@endcomponent
