@extends('layouts.user')

@section('content')
    <!-- Notification Messages -->
    {{-- @php
        dd(session('selected_items'));
        dd(session('buy_now'));
    @endphp --}}
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
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mã giảm giá</label>
                            <div class="flex gap-2">
                               <select name="voucher_code" id="voucher_code" class="form-select">
    <option value="">-- Chọn mã giảm giá --</option>
    @foreach ($vouchers as $voucher)
        <option value="{{ $voucher->code }}">{{ $voucher->code }}</option>
    @endforeach
</select>

                                <button type="button" id="apply-voucher"
                                    class="px-6 py-3 bg-purple-600 text-white font-semibold rounded-xl hover:bg-purple-700 transition-colors">
                                    Áp dụng
                                </button>
                            </div>
                            @if(session('voucher_error'))
                                <div class="mt-2 text-red-600 text-sm">{{ session('voucher_error') }}</div>
                            @endif
                            <div id="voucher-info" class="mt-2 text-green-600 text-sm hidden"></div>
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
                        <li class="flex justify-between items-center py-4 border-t border-gray-200">
                            <span class="font-bold text-lg">Tổng cộng</span>
                            <span class="font-bold text-lg text-purple-700"
                                id="total-amount">{{ number_format($total, 0, ',', '.') }} VNĐ</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize notifications
            initializeNotifications();

            // Initialize voucher functionality
            initializeVoucher();
        });

        // Voucher functionality
        function initializeVoucher() {
            const applyBtn = document.getElementById('apply-voucher');
            const voucherInput = document.getElementById('voucher_code');
            const voucherInfo = document.getElementById('voucher-info');

            if (applyBtn && voucherInput) {
                applyBtn.addEventListener('click', function() {
                    const code = voucherInput.value.trim();
                    if (!code) {
                        showVoucherInfo('Vui lòng nhập mã giảm giá', 'error');
                        return;
                    }

                    // Validate voucher via AJAX
                    validateVoucher(code);
                });

                // Allow Enter key to apply voucher
                voucherInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        applyBtn.click();
                    }
                });
            }
        }

        function validateVoucher(code) {
            const applyBtn = document.getElementById('apply-voucher');
            const originalText = applyBtn.textContent;

            // Show loading state
            applyBtn.textContent = 'Đang kiểm tra...';
            applyBtn.disabled = true;

            // Get current total amount
            const totalElement = document.getElementById('total-amount');
            const totalText = totalElement.textContent;
            const total = parseFloat(totalText.replace(/[^\d]/g, ''));

            // Send AJAX request to validate voucher
            fetch('/validate-voucher', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    code: code,
                    total_amount: total
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showVoucherInfo(data.message, 'success');
                    updateTotalWithDiscount(data.discount_amount, total);
                } else {
                    showVoucherInfo(data.message, 'error');
                }
            })
            .catch(error => {
                showVoucherInfo('Có lỗi xảy ra, vui lòng thử lại', 'error');
            })
            .finally(() => {
                applyBtn.textContent = originalText;
                applyBtn.disabled = false;
            });
        }

        function showVoucherInfo(message, type) {
            const voucherInfo = document.getElementById('voucher-info');
            voucherInfo.textContent = message;
            voucherInfo.className = `mt-2 text-sm ${type === 'success' ? 'text-green-600' : 'text-red-600'}`;
            voucherInfo.classList.remove('hidden');

            // Auto hide after 5 seconds
            setTimeout(() => {
                voucherInfo.classList.add('hidden');
            }, 5000);
        }

        function updateTotalWithDiscount(discountAmount, originalTotal) {
            const totalElement = document.getElementById('total-amount');
            const newTotal = originalTotal - discountAmount;
            totalElement.textContent = new Intl.NumberFormat('vi-VN').format(newTotal) + ' VNĐ';

            // Add discount info
            const discountInfo = document.createElement('div');
            discountInfo.id = 'discount-info';
            discountInfo.className = 'flex justify-between items-center py-2 text-green-600';
            discountInfo.innerHTML = `
                <span>Giảm giá:</span>
                <span>-${new Intl.NumberFormat('vi-VN').format(discountAmount)} VNĐ</span>
            `;

            // Insert before total
            const totalLi = totalElement.closest('li');
            const existingDiscount = document.getElementById('discount-info');
            if (existingDiscount) {
                existingDiscount.remove();
            }
            totalLi.parentNode.insertBefore(discountInfo, totalLi);
        }

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
    </script>
@endsection
