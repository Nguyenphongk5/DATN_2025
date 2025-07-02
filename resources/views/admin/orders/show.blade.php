<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Chi tiết đơn hàng: {{ $order->order_code }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold mb-4">Thông tin khách hàng</h3>
            <p><strong>Tên:</strong> {{ $order->user_name }}</p>
            <p><strong>Email:</strong> {{ $order->user_email }}</p>
            <p><strong>SĐT:</strong> {{ $order->user_phone }}</p>
            <p><strong>Địa chỉ:</strong> {{ $order->user_address }}</p>
            <p><strong>Ghi chú:</strong> {{ $order->note ?? 'Không có' }}</p>

            <h3 class="text-lg font-semibold mt-6 mb-4">Sản phẩm đã đặt</h3>
            <table class="w-full border-collapse table-auto text-center">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2">Sản phẩm</th>
                        <th class="border px-4 py-2">Size</th>
                        <th class="border px-4 py-2">Màu</th>
                        <th class="border px-4 py-2">Số lượng</th>
                        <th class="border px-4 py-2">Giá</th>
                        <th class="border px-4 py-2">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderDetails as $detail)
                        <tr>
                            <td class="border px-4 py-2">{{ $detail->product_name }}</td>
                            <td class="border px-4 py-2">{{ $detail->size_name }}</td>
                            <td class="border px-4 py-2">{{ $detail->color_name }}</td>
                            <td class="border px-4 py-2">{{ $detail->quantity }}</td>
                            <td class="border px-4 py-2">{{ number_format($detail->price, 0, ',', '.') }} VNĐ</td>
                            <td class="border px-4 py-2">{{ number_format($detail->quantity * $detail->price, 0, ',', '.') }} VNĐ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3 class="text-lg font-semibold mt-6">Tổng đơn hàng</h3>
            <p><strong>Phí vận chuyển:</strong> {{ number_format($order->shipping_fee, 0, ',', '.') }} VNĐ</p>
            <p><strong>Giảm giá:</strong> {{ number_format($order->discount_amount, 0, ',', '.') }} VNĐ</p>
            <p><strong>Tổng cộng:</strong> <span class="text-red-500 font-bold text-lg">{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</span></p>

            <h3 class="text-lg font-semibold mt-6">Trạng thái</h3>
            <p><strong>Trạng thái đơn:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Thanh toán:</strong> {{ $order->payment_status }}</p>
        </div>
    </div>
</x-app-layout>
