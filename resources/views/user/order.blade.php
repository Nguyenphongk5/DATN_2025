@extends('layouts.user')

@section('content')
    <!-- Notification Messages -->
    @php
        // dd(session('selected_items'));
        // dd(session('buy_now'));
    @endphp
    @if (session('success'))
        <div id="success-notification"
            class="fixed top-6 right-6 z-50 transform transition-all duration-500 ease-out opacity-0 translate-x-full">
            <div
                class="bg-gradient-to-r from-emerald-500 to-green-600 text-white px-6 py-4 rounded-2xl shadow-2xl border border-emerald-400/30 backdrop-blur-sm animate-pulse">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <div
                            class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center shadow-lg ring-2 ring-white/30">
                            <svg class="w-5 h-5 text-white drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-sm">{{ session('success') }}</p>
                        <p class="text-xs text-emerald-100">Đơn hàng đã được xử lý thành công!</p>
                    </div>
                    <button onclick="closeNotification('success-notification')"
                        class="flex-shrink-0 text-white/80 hover:text-white transition-all duration-200 hover:scale-110 hover:bg-white/20 rounded-full p-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
                <!-- Progress bar -->
                <div class="mt-3 w-full bg-white/20 rounded-full h-1">
                    <div id="success-progress-bar"
                        class="bg-white h-1 rounded-full transition-all duration-5000 ease-linear" style="width: 100%">
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div id="error-notification"
            class="fixed top-6 right-6 z-50 transform transition-all duration-500 ease-out opacity-0 translate-x-full">
            <div
                class="bg-gradient-to-r from-red-500 to-pink-600 text-white px-6 py-4 rounded-2xl shadow-2xl border border-red-400/30 backdrop-blur-sm">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <div
                            class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center shadow-lg ring-2 ring-white/30">
                            <svg class="w-5 h-5 text-white drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-sm">{{ session('error') }}</p>
                        <p class="text-xs text-red-100">Đã xảy ra lỗi, vui lòng thử lại!</p>
                    </div>
                    <button onclick="closeNotification('error-notification')"
                        class="flex-shrink-0 text-white/80 hover:text-white transition-all duration-200 hover:scale-110 hover:bg-white/20 rounded-full p-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
                <!-- Progress bar -->
                <div class="mt-3 w-full bg-white/20 rounded-full h-1">
                    <div id="error-progress-bar" class="bg-white h-1 rounded-full transition-all duration-5000 ease-linear"
                        style="width: 100%"></div>
                </div>
            </div>
        </div>
    @endif
    <!-- Header Section -->
    <section class="py-12 bg-gradient-to-r from-purple-50 via-pink-50 to-blue-50 mb-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1
                        class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 bg-clip-text text-transparent mb-2">
                        Thanh toán
                    </h1>
                    <p class="text-gray-600 text-lg">Hoàn tất đơn hàng của bạn</p>
                </div>
                <nav
                    class="text-sm text-gray-500 flex items-center gap-2 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full shadow-lg">
                    <a class="hover:text-purple-600 transition-colors font-medium" href="/">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        Home
                    </a>
                    <span class="mx-2 text-gray-400">/</span>
                    <a class="hover:text-purple-600 transition-colors font-medium" href="{{ route('cart.index') }}">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01">
                            </path>
                        </svg>
                        Giỏ hàng
                    </a>
                    <span class="mx-2 text-gray-400">/</span>
                    <span class="text-purple-600 font-semibold flex items-center">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Thanh toán
                    </span>
                </nav>
            </div>
        </div>
    </section>

    <section class="py-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="w-full lg:w-7/12 bg-white rounded-2xl shadow-lg p-8">
                    <h4 class="text-xl font-semibold mb-6">Thông tin nhận hàng</h4>

                    @if ($errors->any())
                        <div
                            class="mb-6 bg-gradient-to-r from-red-500 to-pink-600 text-white px-6 py-4 rounded-2xl shadow-xl border border-red-400/30">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-sm">Có lỗi xảy ra:</p>
                                    <ul class="text-xs text-red-100 mt-1 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>• {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form id="checkout-form" action="{{ route('checkout.placeOrder') }}" method="POST"
                        class="space-y-5">
                        @csrf
                        <input type="hidden" name="paid_confirmed" id="paid_confirmed" value="0">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Họ tên</label>
                            <input type="text" name="name"
                                class="block w-full rounded-xl border 2 -gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base"
                                value="{{ old('name', auth()->user()->name ?? '') }}" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                            <input type="text" name="phone"
                                class="block w-full rounded-xl border 2 -gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base"
                                value="{{ old('phone') }}" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ</label>
                            <input type="text" name="address"
                                class="block w-full rounded-xl border 2 -gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base"
                                value="{{ old('address') }}" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ghi chú</label>
                            <textarea name="note"
                                class="block w-full rounded-xl border 2 -gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base"
                                rows="3">{{ old('note') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phương thức giao hàng</label>
                            <select name="shipping_method"
                                class="block w-full rounded-xl border 2 -gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base"
                                required>
                                <option value="standard">Giao hàng tiêu chuẩn</option>
                                <option value="express">Giao hàng nhanh</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phương thức thanh toán</label>
                            <select name="payment_method"
                                class="block w-full rounded-xl border 2 -gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base"
                                required id="payment_method">
                                <option value="cod">Thanh toán khi nhận hàng</option>
                                <option value="online">Thanh toán VNPay</option>
                            </select>
                        </div>
                        <button type="submit" id="btn-submit"
                            class="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-xl shadow-md hover:from-purple-700 hover:to-pink-700 transition-all duration-200">Đặt
                            hàng</button>
                    </form>
                </div>

                <div class="w-full lg:w-5/12 bg-white rounded-2xl shadow-lg p-8">
                    <h4 class="text-xl font-semibold mb-6">Đơn hàng của bạn</h4>
                    <!-- MÃ GIẢM GIÁ chuyển sang đây -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mã giảm giá</label>
                        <div class="flex items-center gap-2">
                            <input type="text" name="voucher_code"
                                class="flex-1 rounded-xl border-2 border-purple-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-200 focus:ring-opacity-50 py-3 px-4 text-base bg-gradient-to-r from-purple-50 to-pink-50 shadow-inner transition-all duration-200"
                                placeholder="Nhập mã giảm giá cực xịn..." value="{{ old('voucher_code') }}">
                            <button type="button" id="btn-apply-voucher"
                                class="px-5 py-3 bg-gradient-to-r from-purple-600 via-pink-500 to-blue-500 text-white font-bold rounded-xl shadow-lg hover:from-pink-600 hover:to-purple-700 hover:scale-105 transition-all duration-200 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
                                </svg>
                                Áp dụng
                            </button>
                        </div>
                        @if (isset($vouchers) && $vouchers->count())
                            <div class="mt-3">
                                <div class="font-semibold text-sm text-purple-700 mb-2 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
                                    </svg>
                                    Mã giảm giá có sẵn:
                                </div>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($vouchers as $voucher)
                                        <button type="button"
                                            class="px-3 py-2 rounded-lg bg-gradient-to-r from-pink-400 via-purple-400 to-blue-400 text-white font-bold shadow hover:scale-105 transition-all duration-200"
                                            onclick="document.querySelector('input[name=\'voucher_code\']').value='{{ $voucher->code }}'">
                                            {{ $voucher->code }}
                                            <span class="ml-1 text-xs font-normal">
                                                @if ($voucher->discount_type === 'percent')
                                                    -{{ $voucher->discount_value }}%
                                                @else
                                                    -{{ number_format($voucher->discount_value, 0, ',', '.') }}đ
                                                @endif
                                            </span>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- END MÃ GIẢM GIÁ -->
                    <ul class="divide-y divide-gray-200 mb-6">
                        @php $total = 0; @endphp
                        @if (session('buy_now'))
                            @php
                                $data = session('buy_now');
                                $var = \App\Models\ProductVariant::with('product')
                                    ->where('product_id', $data['product_id'])
                                    ->where('color_name', $data['color_name'])
                                    ->where('size', $data['size'])
                                    ->first();
                                $quantity = $data['quantity'] ?? 1;
                                $product = $var->product;
                                $price = $var->price;
                                $subtotal = $price * $quantity;
                                $total += $subtotal;
                            @endphp
                            <li class="flex justify-between items-start py-4">
                                <div>
                                    <h6 class="font-semibold text-gray-800">{{ $product->name }}</h6>
                                    <div class="text-sm text-gray-500">Size: {{ $var->size }}, Màu:
                                        {{ $var->color_name }}</div>
                                    <div class="text-sm text-gray-500">Số lượng: {{ $quantity }}</div>
                                </div>
                                <span class="text-gray-700 font-semibold">{{ number_format($subtotal, 0, ',', '.') }}
                                    VNĐ</span>
                            </li>
                        @else
                            @if (isset($variant))
                                @php
                                    $product = $variant->product;
                                    $price = $variant->price;
                                    $subtotal = $price * $quantity;
                                    $total += $subtotal;
                                @endphp
                                <li class="flex justify-between items-start py-4">
                                    <div>
                                        <h6 class="font-semibold text-gray-800">{{ $product->name }}</h6>
                                        <div class="text-sm text-gray-500">Size: {{ $variant->size }}, Màu:
                                            {{ $variant->color_name }}</div>
                                        <div class="text-sm text-gray-500">Số lượng: {{ $quantity }}</div>
                                    </div>
                                    <span class="text-gray-700 font-semibold">{{ number_format($subtotal, 0, ',', '.') }}
                                        VNĐ</span>
                                </li>
                            @elseif (!empty($cart?->items))
                                @php $selectedIds = session('selected_items', []); @endphp
                                @foreach ($cart->items as $item)
                                    @if (empty($selectedIds) || in_array($item->id, $selectedIds))
                                        @php
                                            $variant = $item->productVariant;
                                            $product = $variant?->product ?? $item->product;
                                            $price = $variant?->price ?? ($product?->price ?? 0);
                                            $subtotal = $price * $item->quantity;
                                            $total += $subtotal;
                                        @endphp
                                        <li class="flex justify-between items-start py-4">
                                            <div>
                                                <h6 class="font-semibold text-gray-800">
                                                    {{ $product->name ?? 'Sản phẩm' }}</h6>
                                                @if ($variant)
                                                    <div class="text-sm text-gray-500">Size: {{ $variant->size }},
                                                        Màu:
                                                        {{ $variant->color_name }}</div>
                                                @endif
                                                <div class="text-sm text-gray-500">Số lượng: {{ $item->quantity }}
                                                </div>
                                            </div>
                                            <span
                                                class="text-gray-700 font-semibold">{{ number_format($subtotal, 0, ',', '.') }}
                                                VNĐ</span>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endif
                        <li class="flex justify-between items-center py-4 border-t border-gray-200" id="order-total-row">
                            <span class="font-bold text-lg">Tổng cộng</span>
                            <span class="font-bold text-lg text-purple-700" id="total-amount-original"
                                data-total-original="{{ $total }}">{{ number_format($total, 0, ',', '.') }}
                                VNĐ</span>
                        </li>
                        <!-- Dòng giảm giá và tổng sau giảm sẽ được JS chèn vào đây -->
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <script>
        window.TOTAL_ORIGINAL = {{ $total }};
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize notifications
            initializeNotifications();
        });

        // Notification functions
        function initializeNotifications() {
            const successNotification = document.getElementById('success-notification');
            const errorNotification = document.getElementById('error-notification');

            if (successNotification) {
                showNotification(successNotification, 'success-progress-bar');
            }

            if (errorNotification) {
                showNotification(errorNotification, 'error-progress-bar');
            }
        }

        function showNotification(notification, progressBarId) {
            // Show notification with slide-in animation
            setTimeout(() => {
                notification.classList.remove('opacity-0', 'translate-x-full');
                notification.classList.add('opacity-100', 'translate-x-0', 'notification-bounce');

                // Add glow effect based on notification type
                const notificationDiv = notification.querySelector('div');
                if (progressBarId === 'success-progress-bar') {
                    notificationDiv.classList.add('notification-glow');
                } else {
                    notificationDiv.classList.add('notification-glow-error');
                }
            }, 100);

            // Animate progress bar
            const progressBar = document.getElementById(progressBarId);
            if (progressBar) {
                setTimeout(() => {
                    progressBar.style.width = '0%';
                }, 100);
            }

            // Auto hide after 5 seconds
            setTimeout(() => {
                hideNotification(notification);
            }, 5000);
        }

        function hideNotification(notification) {
            notification.classList.remove('opacity-100', 'translate-x-0');
            notification.classList.add('opacity-0', 'translate-x-full');

            setTimeout(() => {
                notification.remove();
            }, 500);
        }

        function closeNotification(notificationId) {
            const notification = document.getElementById(notificationId);
            if (notification) {
                hideNotification(notification);
            }
        }

        // Add CSS for animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes bounce {
                0%, 20%, 50%, 80%, 100% {
                    transform: translateY(0);
                }
                40% {
                    transform: translateY(-10px);
                }
                60% {
                    transform: translateY(-5px);
                }
            }

            @keyframes glow {
                0%, 100% {
                    box-shadow: 0 0 5px rgba(16, 185, 129, 0.5);
                }
                50% {
                    box-shadow: 0 0 20px rgba(16, 185, 129, 0.8), 0 0 30px rgba(16, 185, 129, 0.6);
                }
            }

            @keyframes glow-error {
                0%, 100% {
                    box-shadow: 0 0 5px rgba(239, 68, 68, 0.5);
                }
                50% {
                    box-shadow: 0 0 20px rgba(239, 68, 68, 0.8), 0 0 30px rgba(239, 68, 68, 0.6);
                }
            }

            .notification-bounce {
                animation: bounce 0.6s ease-in-out;
            }

            .notification-glow {
                animation: glow 2s ease-in-out infinite;
            }

            .notification-glow-error {
                animation: glow-error 2s ease-in-out infinite;
            }
        `;
        document.head.appendChild(style);

        // Hiệu ứng fade-in cho các dòng giảm giá
        const style2 = document.createElement('style');
        style2.textContent = `
            @keyframes fade-in-down {
                0% { opacity: 0; transform: translateY(-20px); }
                100% { opacity: 1; transform: translateY(0); }
            }
            @keyframes fade-in-up {
                0% { opacity: 0; transform: translateY(20px); }
                100% { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in-down { animation: fade-in-down 0.7s cubic-bezier(.4,0,.2,1) both; }
            .animate-fade-in-up { animation: fade-in-up 0.7s cubic-bezier(.4,0,.2,1) both; }
        `;
        document.head.appendChild(style2);

        document.getElementById('btn-apply-voucher').onclick = function() {
            const code = document.querySelector('input[name="voucher_code"]').value;
            let total = window.TOTAL_ORIGINAL;
            const totalEl = document.getElementById('total-amount-original');
            const orderTotalRow = document.getElementById('order-total-row');

            // Luôn hiện lại dòng tổng cộng gốc trước khi áp dụng mã mới
            if (orderTotalRow) orderTotalRow.style.display = '';

            // Xóa các dòng giảm giá/tổng sau giảm cũ nếu có
            let discountLi = document.getElementById('voucher-discount-li');
            let totalAfterLi = document.getElementById('voucher-totalafter-li');
            if (discountLi) discountLi.remove();
            if (totalAfterLi) totalAfterLi.remove();

            // Xóa thông báo cũ
            document.querySelectorAll('.voucher-message').forEach(e => e.remove());

            fetch("{{ route('ajax.applyVoucher') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        voucher_code: code,
                        total_amount: total
                    })
                })
                .then(res => res.json())
                .then(data => {
                    // Hiển thị thông báo ở dưới (notification chung)
                    let notification = document.getElementById('voucher-notification');
                    if (!notification) {
                        notification = document.createElement('div');
                        notification.id = 'voucher-notification';
                        notification.style.position = 'fixed';
                        notification.style.bottom = '30px';
                        notification.style.left = '50%';
                        notification.style.transform = 'translateX(-50%)';
                        notification.style.zIndex = '9999';
                        document.body.appendChild(notification);
                    }
                    notification.innerHTML = '';
                    if (data.success) {
                        // Chèn dòng giảm giá và tổng sau giảm vào box Đơn hàng của bạn
                        discountLi = document.createElement('li');
                        discountLi.id = 'voucher-discount-li';
                        discountLi.className = 'flex justify-between items-center py-2 animate-fade-in-down';
                        discountLi.innerHTML =
                            `<span class="font-medium text-base text-gray-600 flex items-center gap-1"><svg class=\"w-5 h-5 text-emerald-500\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M5 13l4 4L19 7\" /></svg>Giảm giá</span><span class=\"inline-flex items-center gap-1 bg-cyan-50 rounded-lg px-2 py-1 font-bold text-cyan-600\">-${data.discount.toLocaleString('vi-VN')} <span class=\"text-xs text-cyan-400 font-normal\">VNĐ</span></span>`;
                        orderTotalRow.parentElement.insertBefore(discountLi, orderTotalRow.nextSibling);

                        totalAfterLi = document.createElement('li');
                        totalAfterLi.id = 'voucher-totalafter-li';
                        totalAfterLi.className = 'flex justify-between items-center py-2 animate-fade-in-up';
                        const totalAfter = total - data.discount;
                        totalAfterLi.innerHTML =
                            `<span class=\"font-bold text-lg flex items-center gap-1\"><svg class=\"w-5 h-5 text-purple-500\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M12 8v4l3 3\" /></svg>Tổng sau giảm</span><span class=\"font-bold text-lg text-purple-700\" id=\"total-amount-discounted\">${totalAfter.toLocaleString('vi-VN')} VNĐ</span>`;
                        discountLi.parentElement.insertBefore(totalAfterLi, discountLi.nextSibling);
                        // Ẩn dòng tổng cộng gốc
                        orderTotalRow.style.display = 'none';

                        notification.innerHTML =
                            `<div class='voucher-message flex items-center gap-2 bg-gradient-to-r from-emerald-400 to-green-500 text-white px-6 py-3 rounded-2xl shadow-xl animate-pulse text-base font-semibold'><svg class='w-6 h-6 text-white' fill='none' stroke='currentColor' stroke-width='2' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' d='M5 13l4 4L19 7' /></svg> ${data.message}</div>`;
                    } else {
                        notification.innerHTML =
                            `<div class='voucher-message flex items-center gap-2 bg-gradient-to-r from-red-400 to-pink-500 text-white px-6 py-3 rounded-2xl shadow-xl animate-pulse text-base font-semibold'><svg class='w-6 h-6 text-white' fill='none' stroke='currentColor' stroke-width='2' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' d='M6 18L18 6M6 6l12 12' /></svg> ${data.message}</div>`;
                    }
                    setTimeout(() => {
                        if (notification) notification.innerHTML = '';
                    }, 3000);
                });
        };
    </script>
@endsection
