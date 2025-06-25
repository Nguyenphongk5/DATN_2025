@extends('layouts.user')

@section('content')
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

                <form action="{{ route('checkout.placeOrder') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Họ tên</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name ?? '') }}" required>
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
                        <select name="payment_method" class="form-select" required>
                            <option value="cod">Thanh toán khi nhận hàng</option>
                            <option value="online">Thanh toán online</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Đặt hàng</button>
                </form>
            </div>

            <div class="col-md-5">
                <h4 class="mb-4">Đơn hàng của bạn</h4>
                <ul class="list-group mb-3">
                    @php $total = 0; @endphp
                    @foreach ($cart?->items ?? [] as $item)
                        @php
                            $variant = $item->productVariant;
                            $product = $variant?->product ?? $item->product;
                            $name = $product?->name ?? 'Sản phẩm';
                            $price = $variant?->price ?? $product?->price ?? 0;
                            $subtotal = $price * $item->quantity;
                            $total += $subtotal;
                        @endphp
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">{{ $name }}</h6>
                                @if ($variant)
                                    <small class="text-muted">Size: {{ $variant->size }}, Màu: {{ $variant->color_name }}</small>
                                @endif
                                <div><small class="text-muted">Số lượng: {{ $item->quantity }}</small></div>
                            </div>
                            <span class="text-muted">${{ number_format($subtotal, 0, ',', '.') }}</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <span><strong>Tổng cộng</strong></span>
                        <strong>${{ number_format($total, 0, ',', '.') }}</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
