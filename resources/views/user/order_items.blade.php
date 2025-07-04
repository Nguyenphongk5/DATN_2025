@forelse ($orders as $order)
<div class="card mb-3">
    <div class="card-header d-flex justify-content-between">
        <span><strong>Mã đơn:</strong> {{ $order->order_code }}</span>
        <span class="text-muted">{{ ucfirst($order->status) }}</span>
    </div>
    <div class="card-body">
        @foreach ($order->orderDetails as $item)
        @php
        $variant = $item->productVariant;
        $product = $variant?->product;
        $image = $variant?->image ?? $product?->img_thumb ?? 'images/no-image.png';
        @endphp
        <div class="d-flex mb-2">
            <img src="{{ asset('storage/' . $image) }}" alt="ảnh" width="70" class="me-3">
            <div>
                {{ $item->product_name }}<br>
                <small class="text-muted">{{ $item->color_name }}, {{ $item->size_name }} x{{ $item->quantity }}</small>
            </div>
            <div class="ms-auto fw-bold">
                ₫{{ number_format($item->price * $item->quantity, 0, ',', '.') }}
            </div>
        </div>
        @endforeach

        <div class="text-end mt-2">
            <span class="fw-bold">Tổng tiền: ₫{{ number_format($order->total_amount, 0, ',', '.') }}</span><br>
            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-secondary mt-2">Xem chi
                tiết</a>
            <a href="{{ route('orders.reorder', $item->id) }}" class="btn btn-sm btn-primary mt-2">
                Mua lại
            </a>

        </div>
    </div>
</div>
@empty
<div class="alert alert-info">Không có đơn hàng nào.</div>
@endforelse