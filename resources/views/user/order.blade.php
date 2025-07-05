@extends('layouts.user')

@section('content')
    <section class="py-8 bg-gray-100 mb-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                <h1 class="text-3xl font-bold text-gray-800 pb-2">Checkout</h1>
                <nav class="text-sm text-gray-500 flex items-center gap-2">
                    <a class="hover:text-purple-600 transition-colors" href="/">Home</a>
                    <span class="mx-1">/</span>
                    <span class="text-purple-600 font-semibold">Checkout</span>
                </nav>
            </div>
        </div>
    </section>

    <section class="py-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="w-full lg:w-7/12 bg-white rounded-2xl shadow-lg p-8">
                    <h4 class="text-xl font-semibold mb-6">Thông tin nhận hàng</h4>

                    @if (session('error'))
                        <div class="mb-4 text-red-700 bg-red-100 border border-red-200 rounded-lg px-4 py-2 text-center">{{ session('error') }}</div>
                    @endif
                    @if (session('success'))
                        <div class="mb-4 text-green-700 bg-green-100 border border-green-200 rounded-lg px-4 py-2 text-center">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="mb-4 text-red-700 bg-red-100 border border-red-200 rounded-lg px-4 py-2">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="checkout-form" action="{{ route('checkout.placeOrder') }}" method="POST" class="space-y-5">
                        @csrf
                        <input type="hidden" name="paid_confirmed" id="paid_confirmed" value="0">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Họ tên</label>
                            <input type="text" name="name" class="block w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base" value="{{ old('name', auth()->user()->name ?? '') }}" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                            <input type="text" name="phone" class="block w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base" value="{{ old('phone') }}" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ</label>
                            <input type="text" name="address" class="block w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base" value="{{ old('address') }}" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ghi chú</label>
                            <textarea name="note" class="block w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base" rows="3">{{ old('note') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phương thức giao hàng</label>
                            <select name="shipping_method" class="block w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base" required>
                                <option value="standard">Giao hàng tiêu chuẩn</option>
                                <option value="express">Giao hàng nhanh</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phương thức thanh toán</label>
                            <select name="payment_method" class="block w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base" required id="payment_method">
                                <option value="cod">Thanh toán khi nhận hàng</option>
                                <option value="online">Thanh toán VNPay</option>
                            </select>
                            <div id="vnpay-qr-box" class="mt-3 hidden">
                                <p class="font-semibold mb-2">Quét mã QR để thanh toán VNPay:</p>
                                <img id="vnpay-qr-img" src="" alt="QR VNPay" class="mb-2 max-w-xs rounded-xl border border-gray-200">
                                <button type="button" id="confirm-paid" class="mt-2 w-full py-2 px-4 bg-green-500 text-white font-semibold rounded-xl shadow hover:bg-green-600 transition-all">Tôi đã thanh toán</button>
                                <div id="paid-message" class="mt-2 text-green-600 font-bold hidden">
                                    ✅ Đã thanh toán thành công!
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="btn-submit" class="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-xl shadow-md hover:from-purple-700 hover:to-pink-700 transition-all duration-200">Đặt hàng</button>
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
                                    <div class="text-sm text-gray-500">Size: {{ $var->size }}, Màu: {{ $var->color_name }}</div>
                                    <div class="text-sm text-gray-500">Số lượng: {{ $quantity }}</div>
                                </div>
                                <span class="text-gray-700 font-semibold">{{ number_format($subtotal, 0, ',', '.') }} VNĐ</span>
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
                                        <div class="text-sm text-gray-500">Size: {{ $variant->size }}, Màu: {{ $variant->color_name }}</div>
                                        <div class="text-sm text-gray-500">Số lượng: {{ $quantity }}</div>
                                    </div>
                                    <span class="text-gray-700 font-semibold">{{ number_format($subtotal, 0, ',', '.') }} VNĐ</span>
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
                                                <h6 class="font-semibold text-gray-800">{{ $product->name ?? 'Sản phẩm' }}</h6>
                                                @if ($variant)
                                                    <div class="text-sm text-gray-500">Size: {{ $variant->size }}, Màu: {{ $variant->color_name }}</div>
                                                @endif
                                                <div class="text-sm text-gray-500">Số lượng: {{ $item->quantity }}</div>
                                            </div>
                                            <span class="text-gray-700 font-semibold">{{ number_format($subtotal, 0, ',', '.') }} VNĐ</span>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endif
                        <li class="flex justify-between items-center py-4 border-t border-gray-200">
                            <span class="font-bold text-lg">Tổng cộng</span>
                            <span class="font-bold text-lg text-purple-700" id="total-amount">{{ number_format($total, 0, ',', '.') }} VNĐ</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const select = document.getElementById('payment_method');
            const qrBox = document.getElementById('vnpay-qr-box');
            const qrImg = document.getElementById('vnpay-qr-img');
            const confirmBtn = document.getElementById('confirm-paid');
            const paidMessage = document.getElementById('paid-message');
            const paidInput = document.getElementById('paid_confirmed');
            const submitBtn = document.getElementById('btn-submit');
            const form = document.getElementById('checkout-form');

            let isSubmitted = false;

            select.addEventListener('change', function() {
                if (this.value === 'online') {
                    qrBox.classList.remove('hidden');
                    const amount = {{ $total ?? 100000 }};
                    const orderInfo = encodeURIComponent("THANHTOAN");
                    const qrUrl = `https://img.vietqr.io/image/970422-000000000001-qr_only.png?amount=${amount}&addInfo=${orderInfo}`;
                    qrImg.src = qrUrl;
                    qrImg.classList.remove('hidden');
                    confirmBtn.classList.remove('hidden');
                    paidMessage.classList.add('hidden');
                    if (submitBtn) submitBtn.classList.add('hidden');
                } else {
                    qrBox.classList.add('hidden');
                    if (submitBtn) submitBtn.classList.remove('hidden');
                }
            });

            confirmBtn.addEventListener('click', function() {
                if (isSubmitted) return;
                isSubmitted = true;
                paidInput.value = 1;
                qrImg.classList.add('hidden');
                confirmBtn.classList.add('hidden');
                paidMessage.classList.remove('hidden');
                setTimeout(function() {
                    form.submit();
                }, 2000);
            });

            if (submitBtn) {
                submitBtn.addEventListener('click', function(event) {
                    if (isSubmitted) {
                        event.preventDefault();
                        return;
                    }
                    isSubmitted = true;
                });
            }

            if (select.value === 'online') {
                select.dispatchEvent(new Event('change'));
            }
        });
    </script>
@endsection
