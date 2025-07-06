<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-receipt text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Chi tiết đơn hàng</h2>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-8">
                <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 drop-shadow-lg flex items-center gap-2 mb-8">
                    <i class="fas fa-clipboard-list animate-bounce text-indigo-400"></i>
                    Chi tiết đơn hàng #{{ $order->order_code }}
                </h1>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <div class="mb-2 text-lg font-bold text-indigo-700">Thông tin khách hàng</div>
                        <div class="mb-1"><span class="font-semibold">Họ tên:</span> {{ $order->user_name }}</div>
                        <div class="mb-1"><span class="font-semibold">Email:</span> {{ $order->user_email }}</div>
                        <div class="mb-1"><span class="font-semibold">SĐT:</span> {{ $order->user_phone }}</div>
                        <div class="mb-1"><span class="font-semibold">Địa chỉ:</span> {{ $order->user_address }}</div>
                        @if ($order->note)
                            <div class="mb-1"><span class="font-semibold">Ghi chú:</span> {{ $order->note }}</div>
                        @endif
                    </div>
                    <div>
                        <div class="mb-2 text-lg font-bold text-indigo-700">Thông tin đơn hàng</div>
                        <div class="mb-1"><span class="font-semibold">Mã đơn:</span> <span class="font-mono text-indigo-600">{{ $order->order_code }}</span></div>
                        <div class="mb-1"><span class="font-semibold">Ngày đặt:</span> {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</div>
                        <div class="mb-1"><span class="font-semibold">Trạng thái:</span>
                            @php
                                $statusMap = [
                                    'pending' => ['Chờ xác nhận', 'from-yellow-400 to-yellow-600'],
                                    'confirmed' => ['Đã xác nhận', 'from-blue-400 to-blue-600'],
                                    'shipping' => ['Đang giao', 'from-sky-400 to-cyan-500'],
                                    'completed' => ['Đã giao', 'from-green-400 to-green-600'],
                                    'cancelled' => ['Đã huỷ', 'from-gray-400 to-gray-600'],
                                ];
                                $status = $order->status;
                            @endphp
                            <span class="inline-block px-4 py-1 rounded-full bg-gradient-to-r {{ $statusMap[$status][1] ?? 'from-gray-400 to-gray-600' }} text-white font-bold shadow text-sm">
                                {{ $statusMap[$status][0] ?? 'Không xác định' }}
                            </span>
                        </div>
                        <div class="mb-1"><span class="font-semibold">Thanh toán:</span>
                            @if ($order->payment_status === 'Paid')
                                <span class="inline-block px-4 py-1 rounded-full bg-gradient-to-r from-green-400 to-cyan-400 text-white font-bold shadow text-sm">Đã thanh toán</span>
                            @elseif ($order->payment_status === 'Unpaid')
                                <span class="inline-block px-4 py-1 rounded-full bg-gradient-to-r from-red-400 to-pink-400 text-white font-bold shadow text-sm">Chưa thanh toán</span>
                            @else
                                <span class="inline-block px-4 py-1 rounded-full bg-gradient-to-r from-yellow-400 to-yellow-600 text-white font-bold shadow text-sm">Hoàn tiền</span>
                            @endif
                        </div>
                        <div class="mb-1"><span class="font-semibold">Phí vận chuyển:</span> <span class="text-cyan-600 font-bold">{{ number_format($order->shipping_fee, 0, ',', '.') }} VNĐ</span></div>
                        <div class="mb-1"><span class="font-semibold">Giảm giá:</span> <span class="text-pink-600 font-bold">{{ number_format($order->discount_amount, 0, ',', '.') }} VNĐ</span></div>
                        <div class="mb-1"><span class="font-semibold">Tổng cộng:</span> <span class="text-2xl text-red-600 font-extrabold">{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</span></div>
                    </div>
                </div>
                <div class="mb-8">
                    <div class="mb-2 text-lg font-bold text-indigo-700">Danh sách sản phẩm</div>
                    <div class="overflow-x-auto custom-scrollbar rounded-2xl">
                        <table class="w-full table-auto border-collapse shadow-xl rounded-2xl overflow-hidden text-base">
                            <thead class="bg-gradient-to-r from-indigo-100 via-sky-100 to-cyan-100 text-indigo-700">
                                <tr>
                                    <th class="px-4 py-2 text-left">Tên SP</th>
                                    <th class="px-4 py-2 text-center">Phân loại</th>
                                    <th class="px-4 py-2 text-center">Số lượng</th>
                                    <th class="px-4 py-2 text-right">Đơn giá</th>
                                    <th class="px-4 py-2 text-right">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-indigo-100 text-center">
                                @foreach ($order->orderDetails as $item)
                                    <tr>
                                        <td class="px-4 py-2 text-left font-semibold">{{ $item->product_name }}</td>
                                        <td class="px-4 py-2">{{ $item->color_name ?? '-' }} | {{ $item->size_name ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $item->quantity }}</td>
                                        <td class="px-4 py-2 text-right">{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                                        <td class="px-4 py-2 text-right font-bold text-cyan-600">{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-8 flex gap-4 justify-center">
                    <a href="{{ route('admin.orders.index') }}" class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white font-bold py-3 px-8 rounded-xl shadow-lg flex items-center gap-2 transition">
                        <i class="fas fa-arrow-left"></i> Quay lại danh sách
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
