@extends('layouts.user')

@section('content')
<section class="py-5 bg-light border-bottom mb-3">
    <div class="container-fluid">
        <h3 class="mb-0">Đơn hàng của tôi</h3>
    </div>
</section>

<div class="container-fluid">
    {{-- Tabs --}}
    <ul class="nav nav-tabs mb-4" id="orderTabs">
        @php
            $tabs = [
                '' => 'Tất cả',
                'pending' => 'Chờ xác nhận',
                'confirmed' => 'Chờ lấy hàng',
                'shipping' => 'Đang giao',
                'delivered' => 'Đã giao',
                'cancelled' => 'Đã hủy',
            ];
        @endphp

        @foreach ($tabs as $key => $label)
            <li class="nav-item">
                <a class="nav-link filter-tab {{ request('status') == $key ? 'active' : ($key == '' && !request('status') ? 'active' : '') }}"
                   href="#"
                   data-status="{{ $key }}">{{ $label }}</a>
            </li>
        @endforeach
    </ul>

    {{-- Danh sách đơn hàng --}}
    <div id="orders-list">
        @include('user.order_items', ['orders' => $orders])
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.addEventListener('click', function (e) {
                e.preventDefault();
                const status = this.dataset.status;

                fetch("{{ url('/order-history/filter') }}?status=" + status)

                    .then(res => {
                        if (!res.ok) throw new Error('Network response was not ok');
                        return res.text();
                    })
                    .then(html => {
                        document.getElementById('orders-list').innerHTML = html;

                        // Cập nhật trạng thái tab active
                        document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                        this.classList.add('active');
                    })
                    .catch(err => {
                        console.error("Lỗi:", err);
                        alert("Không thể tải đơn hàng. Vui lòng thử lại.");
                    });
            });
        });
    });
</script>
@endsection
