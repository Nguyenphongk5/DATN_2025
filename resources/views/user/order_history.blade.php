@extends('layouts.user')

@section('content')
    <section class="py-10 bg-gradient-to-r from-blue-100 via-purple-100 to-pink-100 border-b mb-10 shadow-inner">
        <div class="container mx-auto px-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h3
                class="text-3xl md:text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 mb-0 drop-shadow-lg">
                Đơn hàng của tôi
            </h3>
        </div>
    </section>

    <div class="container mx-auto px-4">
        {{-- Tabs --}}
        <div class="flex flex-wrap gap-3 mb-12 justify-center" id="orderTabs">
            @php
                $tabs = [
                    '' => 'Tất cả',
                    'pending' => 'Chờ xác nhận',
                    'confirmed' => 'Chờ lấy hàng',
                    'shipping' => 'Đang giao',
                    'completed' => 'Đã giao',
                    'cancelled' => 'Đã hủy',
                ];
            @endphp
            @foreach ($tabs as $key => $label)
                <button type="button"
                    class="filter-tab px-6 py-2 rounded-full font-semibold text-base shadow-lg transition-all duration-200 focus:outline-none border-2 border-transparent
                        {{ request('status') == $key || ($key == '' && !request('status')) ? 'bg-gradient-to-r from-pink-500 to-indigo-500 text-white scale-105 border-pink-400 shadow-xl' : 'bg-white text-indigo-700 hover:bg-gradient-to-r hover:from-indigo-100 hover:to-pink-100' }}"
                    data-status="{{ $key }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        {{-- Danh sách đơn hàng --}}
        <div id="orders-list">
            @include('user.order_items', ['orders' => $orders])
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('orderTabs').addEventListener('click', function(e) {
                    const tab = e.target.closest('.filter-tab');
                    if (!tab) return;
                    e.preventDefault();
                    const status = tab.dataset.status;
                    fetch("{{ url('/order-history/filter') }}?status=" + status)
                        .then(res => {
                            if (!res.ok) throw new Error('Network response was not ok');
                            return res.text();
                        })
                        .then(html => {
                            document.getElementById('orders-list').innerHTML = html;
                            // Cập nhật trạng thái tab active
                            document.querySelectorAll('.filter-tab').forEach(t => {
                                t.classList.remove('bg-gradient-to-r', 'from-pink-500',
                                    'to-indigo-500', 'text-white', 'scale-105',
                                    'border-pink-400', 'shadow-xl');
                                t.classList.add('bg-white', 'text-indigo-700');
                            });
                            tab.classList.remove('bg-white', 'text-indigo-700');
                            tab.classList.add('bg-gradient-to-r', 'from-pink-500', 'to-indigo-500',
                                'text-white', 'scale-105', 'border-pink-400', 'shadow-xl');
                        })
                        .catch(err => {
                            console.error("Lỗi:", err);
                            alert("Không thể tải đơn hàng. Vui lòng thử lại.");
                        });
                });
            });
        </script>
    </div>
    <div class="flex justify-center mt-8">
        <div class="inline-block bg-white rounded-xl shadow px-4 py-2">
            {{ $orders->links('pagination::tailwind') }}
        </div>
    </div>
@endsection
