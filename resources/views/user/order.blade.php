@extends('layouts.user')

@section('content')
    <?php

    ?>
    <section class="py-5 mb-5 bg-light">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <h1 class="page-title pb-2">Checkout</h1>
                <nav class="breadcrumb fs-6">
                    <a class="breadcrumb-item nav-link" href="/">Home</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container-fluid">
            <div class="row g-5">
                <div class="col-md-7">
                    <h4 class="mb-4">Thông tin nhận hàng</h4>

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="checkout-form" action="{{ route('checkout.placeOrder') }}" method="POST">
                        @csrf

                        {{-- ✅ Thêm hidden để nhận xác nhận đã thanh toán --}}
                        <input type="hidden" name="paid_confirmed" id="paid_confirmed" value="0">

                        <div class="mb-3">
                            <label class="form-label">Họ tên</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', auth()->user()->name ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ghi chú</label>
                            <textarea name="note" class="form-control" rows="3">{{ old('note') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phương thức giao hàng</label>
                            <select name="shipping_method" class="form-select" required>
                                <option value="standard">Giao hàng tiêu chuẩn</option>
                                <option value="express">Giao hàng nhanh</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Phương thức thanh toán</label>
                            <select name="payment_method" class="form-select" required id="payment_method">
                                <option value="cod">Thanh toán khi nhận hàng</option>
                                <option value="online">Thanh toán VNPay</option>
                            </select>

                            <div id="vnpay-qr-box" class="mt-3 d-none">
                                <p><strong>Quét mã QR để thanh toán VNPay:</strong></p>
                                <img id="vnpay-qr-img" src="" alt="QR VNPay" style="max-width: 300px;"
                                    class="mb-2">

                                <button type="button" id="confirm-paid" class="btn btn-success">Tôi đã thanh toán</button>

                                <div id="paid-message" class="mt-2 text-success fw-bold d-none">
                                    ✅ Đã thanh toán thành công!
                                </div>
                            </div>
                        </div>

                        <button type="submit" id="btn-submit" class="btn btn-primary w-100">Đặt hàng</button>
                    </form>
                </div>

                <div class="col-md-5">
                    <h4 class="mb-4">Đơn hàng của bạn</h4>
                    <ul class="list-group mb-3">
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
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0">{{ $product->name }}</h6>
                                    <small class="text-muted">Size: {{ $var->size }}, Màu:
                                        {{ $var->color_name }}</small>
                                    <div><small class="text-muted">Số lượng: {{ $quantity }}</small></div>
                                </div>
                                <span class="text-muted">{{ number_format($subtotal, 0, ',', '.') }} VNĐ</span>
                            </li>
                        @else
                            @if (isset($variant))
                                @php
                                    $product = $variant->product;
                                    $price = $variant->price;
                                    $subtotal = $price * $quantity;
                                    $total += $subtotal;
                                @endphp
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <div>
                                        <h6 class="my-0">{{ $product->name }}</h6>
                                        <small class="text-muted">Size: {{ $variant->size }}, Màu:
                                            {{ $variant->color_name }}</small>
                                        <div><small class="text-muted">Số lượng: {{ $quantity }}</small></div>
                                    </div>
                                    <span class="text-muted">{{ number_format($subtotal, 0, ',', '.') }} VNĐ</span>
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
                                        <li class="list-group-item d-flex justify-content-between lh-sm">
                                            <div>
                                                <h6 class="my-0">{{ $product->name ?? 'Sản phẩm' }}</h6>
                                                @if ($variant)
                                                    <small class="text-muted">Size: {{ $variant->size }}, Màu:
                                                        {{ $variant->color_name }}</small>
                                                @endif
                                                <div><small class="text-muted">
                                                        Số lượng: {{ $item->quantity }}</small>
                                                </div>
                                            </div>
                                            <span class="text-muted">{{ number_format($subtotal, 0, ',', '.') }} VNĐ</span>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endif



                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>Tổng cộng</strong></span>
                            <strong id="total-amount">{{ number_format($total, 0, ',', '.') }} VNĐ</strong>
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

            // Xử lý thay đổi phương thức thanh toán
            select.addEventListener('change', function() {
                if (this.value === 'online') {
                    qrBox.classList.remove('d-none');

                    const amount = {{ $total ?? 100000 }};
                    const orderInfo = encodeURIComponent("THANHTOAN");

                    const qrUrl =
                        `https://img.vietqr.io/image/970422-000000000001-qr_only.png?amount=${amount}&addInfo=${orderInfo}`;
                    qrImg.src = qrUrl;

                    // Reset trạng thái
                    qrImg.classList.remove('d-none');
                    confirmBtn.classList.remove('d-none');
                    paidMessage.classList.add('d-none');

                    // Ẩn nút "Đặt hàng" để tránh người dùng bấm 2 nút
                    if (submitBtn) submitBtn.classList.add('d-none');
                } else {
                    qrBox.classList.add('d-none');
                    if (submitBtn) submitBtn.classList.remove('d-none');
                }
            });

            // Bấm "Tôi đã thanh toán" → tự động submit
            confirmBtn.addEventListener('click', function() {
                if (isSubmitted) return;
                isSubmitted = true;

                paidInput.value = 1;

                qrImg.classList.add('d-none');
                confirmBtn.classList.add('d-none');
                paidMessage.classList.remove('d-none');

                setTimeout(function() {
                    form.submit();
                }, 2000);
            });

            // Bấm "Đặt hàng" thủ công
            if (submitBtn) {
                submitBtn.addEventListener('click', function(event) {
                    if (isSubmitted) {
                        event.preventDefault();
                        return;
                    }
                    isSubmitted = true;
                    // submitBtn.disabled = true;
                });
            }

            // Nếu người dùng F5 hoặc quay lại chọn lại "online" → hiển thị lại QR
            if (select.value === 'online') {
                select.dispatchEvent(new Event('change'));
            }
        });
    </script>
@endsection
