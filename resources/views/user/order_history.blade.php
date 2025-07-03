@extends('layouts.user')

@section('content')
<section class="py-5 mb-5 bg-light">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <h1 class="page-title pb-2">Lịch sử đơn hàng</h1>
            <nav class="breadcrumb fs-6">
                <a class="breadcrumb-item nav-link" href="{{ route('home') }}">Trang chủ</a>
                <span class="breadcrumb-item active" aria-current="page">Lịch sử đơn hàng</span>
            </nav>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table table-bordered align-middle bg-white">
                <thead class="bg-light">
                    <tr class="text-uppercase text-muted">
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Trạng thái</th>
                        <th>Thanh toán</th>
                        <th>Tổng tiền</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td><strong>{{ $order->order_code }}</strong></td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @php
                                    $badgeClass = match($order->status) {
                                        'pending' => 'warning',
                                        'confirmed' => 'primary',
                                        'shipping' => 'info',
                                        'completed' => 'success',
                                        'cancelled' => 'danger',
                                        default => 'secondary',
                                    };
                                @endphp
                                <span class="badge bg-{{ $badgeClass }}">{{ ucfirst($order->status) }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $order->payment_status === 'Paid' ? 'success' : 'secondary' }}">
                                    {{ $order->payment_status }}
                                </span>
                            </td>
                            <td>{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-primary btn-sm">
                                    Xem chi tiết
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Bạn chưa có đơn hàng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
