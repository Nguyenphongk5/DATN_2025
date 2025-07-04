@forelse ($orders as $order)
<div class="card shadow-sm mb-4 border-0">
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
        <div>
            <strong class="text-dark">Mã đơn:</strong> {{ $order->order_code }}
        </div>
        <span class="badge 
                @if($order->status === 'pending') bg-warning text-dark
                @elseif($order->status === 'processing') bg-info
                @elseif($order->status === 'completed') bg-success
                @elseif($order->status === 'cancelled') bg-danger
                @else bg-secondary
                @endif
            ">
            {{ ucfirst($order->status) }}
        </span>
    </div>

    <div class="card-body">
        @foreach ($order->orderDetails as $item)
        @php
        $variant = $item->productVariant;
        $product = $variant?->product;
        $image = $variant?->image ?? $product?->img_thumb ?? 'images/no-image.png';
        @endphp

        <div class="d-flex align-items-start mb-3 border-bottom pb-2">
            <img src="{{ asset('storage/' . $image) }}" alt="ảnh" width="70" height="70" class="me-3 rounded border"
                style="object-fit: cover;">
            <div class="flex-grow-1">
                <div class="fw-semibold">{{ $item->product_name }}</div>
                <small class="text-muted">
                    {{ $item->color_name ?? 'Không màu' }}, {{ $item->size_name ?? 'Không size' }}
                    x{{ $item->quantity }}
                </small>
            </div>
            <div class="ms-auto text-end fw-bold text-primary">
                ₫{{ number_format($item->price * $item->quantity, 0, ',', '.') }}
            </div>
        </div>
        @endforeach

        <div class="text-end mt-3">
            <div class="mb-2 fw-bold fs-6">Tổng tiền: <span
                    class="text-danger">₫{{ number_format($order->total_amount, 0, ',', '.') }}</span></div>
            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-dark me-2">
                <i class="bi bi-receipt-cutoff"></i> Xem chi tiết
            </a>
            <a href="{{ route('orders.reorder', $order->id) }}" class="btn btn-sm btn-primary">
                <i class="bi bi-arrow-repeat"></i> Mua lại
            </a>

        </div>
    </div>
</div>
@empty
<div class="alert alert-info text-center py-5 shadow-sm rounded bg-white">
    <i class="bi bi-bag-x-fill fs-2 text-muted"></i><br>
    Không có đơn hàng nào.
</div>
@endforelse