@extends('layouts.user')

@section('content')
<section class="py-8 mb-8 bg-gradient-to-r from-blue-100 via-purple-100 to-pink-100 shadow-inner">
    <div class="container mx-auto px-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1
                class="text-3xl md:text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 mb-2 drop-shadow-lg">
                Chi tiết đơn hàng</h1>
            <p class="text-lg text-gray-700">Mã đơn hàng: <strong
                    class="text-indigo-600">{{ $order->order_code }}</strong></p>
        </div>
        <a href="{{ route('orders.history') }}"
            class="inline-flex items-center px-5 py-2 rounded-xl bg-gradient-to-r from-pink-500 to-indigo-500 text-white font-semibold text-base shadow-md hover:from-pink-400 hover:to-indigo-400 transition group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:-translate-x-1 transition-transform"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Quay lại
        </a>
    </div>
</section>

    <section class="py-6">
        <div class="container mx-auto px-4 flex flex-col gap-8">
            <!-- Sản phẩm -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 border border-gray-100">
                <h5 class="mb-6 text-2xl font-bold text-indigo-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-pink-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                    </svg>
                    Danh sách sản phẩm
                </h5>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-base text-gray-700">
                        <thead>
                            <tr
                                class="bg-gradient-to-r from-indigo-100 to-pink-100 text-xs uppercase tracking-wider text-gray-600">
                                <th class="py-3 px-2 text-center">Ảnh</th>
                                <th class="py-3 px-2 text-left">Sản phẩm</th>
                                <th class="py-3 px-2 text-center">Size</th>
                                <th class="py-3 px-2 text-center">Màu</th>
                                <th class="py-3 px-2 text-center">Số lượng</th>
                                <th class="py-3 px-2 text-right">Đơn giá</th>
                                <th class="py-3 px-2 text-right">Giảm giá</th>
                                <th class="py-3 px-2 text-right">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderDetails as $item)
                                @php
                                    $variant = $item->productVariant;
                                    $product = $variant?->product;
                                    $image = $variant?->image ?? ($product?->img_thumb ?? 'images/no-image.png');
                                @endphp
                                <tr class="hover:bg-pink-50 transition">
                                    <td class="py-3 px-2 text-center">
                                        <img src="{{ asset('storage/' . $image) }}" alt="ảnh sản phẩm"
                                            class="w-20 h-20 object-cover rounded-2xl border-2 border-pink-100 shadow-md mx-auto">
                                    </td>
                                    <td class="py-3 px-2">
                                        <div class="font-bold text-gray-900 text-lg md:text-xl leading-snug max-w-xs break-words line-clamp-2 transition-colors duration-200 hover:text-pink-600 hover:bg-pink-50 px-2 py-1 rounded cursor-pointer shadow-sm border border-transparent hover:border-pink-200"
                                            title="{{ $item->product_name }}">
                                            {{ $item->product_name }}
                                        </div>
                                    </td>
                                    <td class="py-3 px-2 text-center">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded bg-pink-100 text-pink-700 font-medium">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="3" />
                                                <path
                                                    d="M12 2v2m0 16v2m10-10h-2M4 12H2m15.364-7.364l-1.414 1.414M6.05 17.95l-1.414 1.414m12.728 0l-1.414-1.414M6.05 6.05L4.636 4.636" />
                                            </svg>
                                            {{ $item->size_name }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-2 text-center">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded bg-indigo-100 text-indigo-700 font-medium">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path d="M12 20l9-5-9-5-9 5 9 5z" />
                                                <path d="M12 12V4" />
                                            </svg>
                                            {{ $item->color_name }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-2 text-center">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded bg-gray-100 text-gray-700 font-medium">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M17 9V7a5 5 0 00-10 0v2a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2v-7a2 2 0 00-2-2z" />
                                            </svg>
                                            x{{ $item->quantity }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-2 text-right text-indigo-600 font-semibold">
                                        {{ number_format($item->price, 0, ',', '.') }} <span
                                            class="text-xs text-gray-400">VNĐ</span>
                                    </td>
                                    <td class="py-3 px-2 text-right text-indigo-600 font-semibold">
                                        {{ number_format($order->discount_amount, 0, ',', '.') }} <span
                                            class="text-xs text-gray-400">VNĐ</span>
                                    </td>
                                    <td
                                        class="py-3 px-2 text-right font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-indigo-500">
                                        {{ number_format($order->total_amount, 0, ',', '.') }} <span
                                            class="text-xs text-gray-400">VNĐ</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Thông tin đơn hàng -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 border border-gray-100 flex flex-col gap-4">
                <h5 class="mb-4 text-2xl font-bold text-pink-600 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Thông tin đơn hàng
                </h5>
                <div class="space-y-3 text-gray-700 text-base">
                    <p class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804" />
                            <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="font-semibold text-gray-900">Người nhận:</span> {{ $order->user_name }}
                    </p>
                    <p class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-pink-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M3 5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" />
                            <path d="M16 3v4a1 1 0 001 1h4" />
                        </svg>
                        <span class="font-semibold text-gray-900">SĐT:</span> {{ $order->user_phone }}
                    </p>
                    <p class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M17.657 16.657L13.414 12.414a2 2 0 00-2.828 0l-4.243 4.243" />
                            <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="font-semibold text-gray-900">Địa chỉ:</span>
                        <span class="text-gray-700">
                            @php
                                $addressParts = [];
                                if ($order->user_address) {
                                    $addressParts[] = $order->user_address;
                                }
                                if ($order->ward) {
                                    $addressParts[] = $order->ward;
                                }
                                if ($order->district) {
                                    $addressParts[] = $order->district;
                                }
                                if ($order->province) {
                                    $addressParts[] = $order->province;
                                }
                            @endphp
                            {{ implode(', ', $addressParts) ?: 'Chưa có địa chỉ' }}
                        </span>
                    </p>
                    <p class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-pink-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M9 17v-2a4 4 0 014-4h4" />
                        </svg>
@php
function getStatusLabel($status) {
    return match ($status) {
        'pending' => 'Chờ xác nhận',
        'confirmed'=> 'Đã xác nhận',
        'shipping' => 'Đang vận chuyển',
        'completed' => 'Đã giao',
        'cancelled' => 'Đã hủy',
        default => ucfirst($status)
    };
}
@endphp
<span class="font-semibold text-gray-900">Trạng thái:</span>
<span id="order-status" class="capitalize px-2 py-1 rounded font-semibold text-indigo-700">
    {{ getStatusLabel($order->status) }}
</span>



                    </p>


                        @php
                            $paymentStatus = strtolower(trim($order->payment_status));
                        @endphp

                     <p class="flex items-center gap-2">
    <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2"
        viewBox="0 0 24 24">
        <path d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 0V4m0 16v-4m8-4h-4m-8 0H4" />
    </svg>
    <span class="font-semibold text-gray-900">Thanh toán:</span>
    <span id="payment-status">
        {{ strtolower(trim($order->payment_status)) === 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
    </span>
</p>


                    </p>
                    <p class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-pink-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M12 20l9-5-9-5-9 5 9 5z" />
                            <path d="M12 12V4" />
                        </svg>
                        <span class="font-semibold text-gray-900">Ghi chú:</span> {{ $order->note ?? 'Không có' }}
                    </p>
                    <p class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-pink-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 6.75h12v10.5h-12V6.75zM14.25 10.5H17.5l2.25 3.75v3H14.25v-6.75z" />
                            <circle cx="6" cy="18" r="1.5" />
                            <circle cx="18" cy="18" r="1.5" />
                        </svg>
                        <span class="font-semibold text-gray-900">Phí vẫn chuyển:</span> <span
                            class="text-cyan-600 font-bold">{{ number_format($order->shipping_fee, 0, ',', '.') }}
                            VNĐ</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5 text-cyan-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
                        </svg>
                        <span class="font-semibold text-gray-700 text-base">Giảm giá:</span>
                        <span
                            class="text-base font-bold text-cyan-600 ml-1">{{ number_format($order->discount_amount, 0, ',', '.') }}
                            VNĐ</span>
                    </p>
                </div>

            {{-- QR Code chứa toàn bộ thông tin --}}
            <div class="flex justify-center mb-8">
                <div class="bg-white rounded-2xl p-6 shadow-xl border border-indigo-100">
                    <div class="text-center mb-2 font-semibold text-indigo-600">Quét mã để xem nhanh thông tin đơn
                        hàng</div>

                        <div style=" margin-left: 20%;">@php
                            $qrText = "Mã đơn: {$order->order_code}\n";
                            $qrText .= "Tên KH: {$order->user_name}\n";
                            $qrText .= "SĐT: {$order->user_phone}\n";
                            $qrText .= "Email: {$order->user_email}\n";
                            $qrText .= "Địa chỉ: {$order->user_address}\n";
                            $qrText .=
                                'Trạng thái: ' .
                                match ($order->status) {
                                    'pending' => 'Chờ xác nhận',
                                    'processing' => 'Đang xử lý',
                                    'shipping' => 'Đang vận chuyển',
                                    'completed' => 'Đã giao',
                                    'cancelled' => 'Đã hủy',
                                    default => ucfirst($order->status),
                                } .
                                "\n";
                            $qrText .= "Thanh toán: {$order->payment_status}\n";
                            $qrText .= 'Tổng tiền: ' . number_format($order->total_amount, 0, ',', '.') . " VNĐ\n";
                            $qrText .= "Sản phẩm:\n";
                            foreach ($order->orderDetails as $item) {
                                $qrText .=
                                    "- {$item->product_name} ({$item->quantity} x " .
                                    number_format($item->price, 0, ',', '.') .
                                    ")\n";
                            }
                        @endphp
                        {!! QrCode::encoding('UTF-8')->size(180)->generate($qrText) !!}
                    </div>
                    <div class="mt-2 text-sm text-</div>gray-500 text-center">Mã: <span
                            class="font-mono">{{ $order->order_code }}</span></div>
                </div>
            </div>
            <hr class="my-4 border-t-2 border-pink-100">
            <div
                class="bg-gradient-to-r from-indigo-100 to-pink-100 rounded-2xl px-6 py-4 shadow-inner text-lg font-bold text-indigo-700 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-pink-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 0V4m0 16v-4m8-4h-4m-8 0H4" />
                </svg>
                Tổng tiền: <span class="ml-2 text-pink-600">{{ number_format($order->total_amount, 0, ',', '.') }}
                    VNĐ</span>
            </div>
            @if (in_array($order->status, ['pending']))
            <form id="cancel-form" action="{{ route('orders.cancel', $order->id) }}" method="POST" class="mt-6">
                @csrf
                @method('PUT')
                <button
                    class="w-full py-3 rounded-xl bg-gradient-to-r from-pink-500 to-indigo-500 text-white font-bold shadow-lg hover:scale-105 hover:from-pink-400 hover:to-indigo-400 transition transform duration-200 flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline h-5 w-5 -mt-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Hủy đơn hàng
                </button>
            </form>
            @endif
            @if ($order->status === 'completed' || $order->status === 'confirmed')
            @if (!$order->returnRequest || $order->returnRequest->status === 'pending')
            <a href="{{ route('returns.create', $order->id) }}"
              id="return-btn"    class="w-full mt-3 py-3 rounded-xl bg-gradient-to-r from-red-500 to-orange-500 text-white font-bold shadow-lg hover:scale-105 hover:from-red-400 hover:to-orange-400 transition transform duration-200 flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline h-5 w-5 -mt-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H3m6 6-6-6 6-6" />
                </svg>
                Hoàn hàng
            </a>
            @else
            <div class="mt-4 px-6 py-4 bg-yellow-50 border-l-4 border-yellow-400 rounded-xl text-gray-800 shadow-md">
                <h3 class="font-bold text-lg mb-1">Thông tin hoàn hàng</h3>
                <p><strong>Trạng thái:</strong>
                    @if ($order->returnRequest->status === 'approved')
                    <span class="text-green-600 font-semibold">Đã chấp nhận</span>
                    @elseif ($order->returnRequest->status === 'rejected')
                    <span class="text-red-600 font-semibold">Không chấp nhận</span>
                    @else
                    <span class="text-yellow-600 font-semibold">Đang chờ xử lý</span>
                    @endif
                </p>
                <p><strong>Phản hồi từ shop:</strong> {{ $order->returnRequest->response_note ?? 'Chưa có phản hồi' }}
                </p>
            </div>
            @endif
            @endif


        </div>
    </div>
</section>
@endsection
<script>
    const orderId = {{ $order->id }};
    let prevStatus = null;

    const statusMap = {
        pending: 'Chờ xác nhận',
        confirmed: 'Đã xác nhận',
        shipping: 'Đang giao',
        completed: 'Đã giao',
        cancelled: 'Đã hủy',
        confirm: 'Đã xác nhận'
    };

    function fetchOrderAndPaymentStatus() {
        fetch(`/api/order-full-status/${orderId}?t=${Date.now()}`) // tránh cache
            .then(res => res.json())
            .then(data => {
                // --- Cập nhật trạng thái đơn hàng ---
                const statusText = statusMap[data.status] || data.status;
                const statusEl = document.getElementById('order-status');
                if (statusEl && data.status !== prevStatus) {
                    prevStatus = data.status;
                    statusEl.innerText = statusText;
                }

                // --- Cập nhật trạng thái thanh toán ---
                const paymentStatusEl = document.getElementById('payment-status');
                const paymentStatus = data.payment_status?.toLowerCase().trim();
                if (data.status === 'completed' || paymentStatus === 'paid') {
                    paymentStatusEl.textContent = 'Đã thanh toán';
                } else {
                    paymentStatusEl.textContent = 'Chưa thanh toán';
                }
            })
            .catch(err => console.error('Lỗi lấy trạng thái đơn hàng & thanh toán:', err));
    }

    // Gọi lần đầu và mỗi giây
    fetchOrderAndPaymentStatus();
    setInterval(fetchOrderAndPaymentStatus, 1000);
    function fetchOrderAndPaymentStatus() {
    fetch(`/api/order-full-status/${orderId}?t=${Date.now()}`) // tránh cache
        .then(res => res.json())
        .then(data => {
            // --- Cập nhật trạng thái đơn hàng ---
            const statusText = statusMap[data.status] || data.status;
            const statusEl = document.getElementById('order-status');
            if (statusEl && data.status !== prevStatus) {
                prevStatus = data.status;
                statusEl.innerText = statusText;
            }

            // --- Cập nhật trạng thái thanh toán ---
            const paymentStatusEl = document.getElementById('payment-status');
            const paymentStatus = data.payment_status?.toLowerCase().trim();
            if (data.status === 'completed' || paymentStatus === 'paid') {
                paymentStatusEl.textContent = 'Đã thanh toán';
            } else {
                paymentStatusEl.textContent = 'Chưa thanh toán';
            }

            // --- Ẩn form hủy nếu trạng thái không còn là pending ---
            const cancelForm = document.getElementById('cancel-form');
            if (cancelForm) {
                if (data.status !== 'pending') {
                    cancelForm.style.display = 'none';
                } else {
                    cancelForm.style.display = 'block';
                }
            }
        })
        .catch(err => console.error('Lỗi lấy trạng thái đơn hàng & thanh toán:', err));
}


</script>
