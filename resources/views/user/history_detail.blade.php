@extends('layouts.user')

@section('content')
<section class="py-5 mb-4 bg-light">
    <div class="container-fluid">
        <h1 class="page-title">Chi tiết đơn hàng</h1>
        <p>Mã đơn hàng: <strong>{{ $order->order_code }}</strong></p>
    </div>
</section>

<section class="py-3">
    <div class="container-fluid">

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card p-4">
                    <h5 class="mb-3">Danh sách sản phẩm</h5>
                   <table class="table">
    <thead>
        <tr class="text-uppercase text-muted">
            <th>Ảnh</th>
            <th>Sản phẩm</th>
            <th>Size</th>
            <th>Màu</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->orderDetails as $item)
            @php
                $variant = $item->productVariant;
                $product = $variant?->product;
                $image = $variant?->image ?? $product?->img_thumb ?? 'images/no-image.png';
            @endphp
            <tr>
                <td>
                    <img src="{{ asset('storage/' . $image) }}" alt="ảnh sản phẩm" width="70">
                </td>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->size_name }}</td>
                <td>{{ $item->color_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} VNĐ</td>
            </tr>
        @endforeach
    </tbody>
</table>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="card p-4">
                    <h5 class="mb-3">Thông tin đơn hàng</h5>
                    <p><strong>Người nhận:</strong> {{ $order->user_name }}</p>
                    <p><strong>SĐT:</strong> {{ $order->user_phone }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $order->user_address }}</p>
                    <p><strong>Trạng thái:</strong> {{ ucfirst($order->status) }}</p>
                    <p><strong>Thanh toán:</strong> {{ $order->payment_status }}</p>
                    <p><strong>Ghi chú:</strong> {{ $order->note ?? 'Không có' }}</p>
                    <hr>
                    <p><strong>Tổng tiền:</strong> {{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</p>

                    @if (in_array($order->status, ['pending', 'confirmed']))
                        <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="mt-3">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-danger w-100" onclick="return confirm('Bạn chắc chắn muốn hủy đơn này?')">
                                Hủy đơn hàng
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
