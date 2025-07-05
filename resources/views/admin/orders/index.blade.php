<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý đơn hàng') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h1 class="text-2xl font-semibold text-gray-800 text-center mb-8">
            {{ __('Danh sách đơn hàng') }}
        </h1>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Flash message --}}
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 text-sm font-medium">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4 text-sm font-medium">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Bộ lọc --}}
                    <form action="{{ route('orders.index') }}" method="GET" class="mb-6">
                        <div class="flex flex-wrap gap-4 items-end bg-gray-50 border border-gray-200 rounded p-4 shadow-sm">
                            <div class="flex flex-col">
                                <label for="keyword" class="text-sm text-gray-600 mb-1">Tìm kiếm</label>
                                <input type="text" name="keyword" id="keyword"
                                    placeholder="Mã đơn / tên / email / SĐT"
                                    value="{{ request('keyword') }}"
                                    class="border border-gray-300 rounded px-3 py-2 w-64 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            </div>

                            <div class="flex flex-col">
                                <label for="status" class="text-sm text-gray-600 mb-1">Trạng thái đơn</label>
                                <select name="status" id="status"
                                    class="border border-gray-300 rounded px-3 py-2 w-48 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Tất cả</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xác nhận</option>
                                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                                    <option value="shipping" {{ request('status') == 'shipping' ? 'selected' : '' }}>Đang giao</option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Đã giao</option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã huỷ</option>
                                </select>
                            </div>

                            <div class="flex flex-col">
                                <label for="payment_status" class="text-sm text-gray-600 mb-1">Thanh toán</label>
                                <select name="payment_status" id="payment_status"
                                    class="border border-gray-300 rounded px-3 py-2 w-48 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Tất cả</option>
                                    <option value="Unpaid" {{ request('payment_status') == 'Unpaid' ? 'selected' : '' }}>Chưa thanh toán</option>
                                    <option value="Paid" {{ request('payment_status') == 'Paid' ? 'selected' : '' }}>Đã thanh toán</option>
                                    <option value="Refunded" {{ request('payment_status') == 'Refunded' ? 'selected' : '' }}>Hoàn tiền</option>
                                </select>
                            </div>

                            <div class="flex flex-col">
                                <label class="invisible mb-1">Lọc</label>
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded shadow text-sm font-semibold transition">
                                    Lọc kết quả
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- Bảng đơn hàng --}}
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">STT</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Mã đơn</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Tên khách</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Email</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">SĐT</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Tổng tiền</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Trạng thái</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Thanh toán</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-center">
                                @foreach ($orders as $key => $order)
                                    <tr>
                                        <td class="px-6 py-4">{{ $key + 1 }}</td>
                                        <td class="px-6 py-4">{{ $order->order_code }}</td>
                                        <td class="px-6 py-4">{{ $order->user_name }}</td>
                                        <td class="px-6 py-4">{{ $order->user_email }}</td>
                                        <td class="px-6 py-4">{{ $order->user_phone }}</td>
                                        <td class="px-6 py-4">{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</td>
                                        <td class="px-6 py-4">
                                            @if ($order->status === 'cancelled')
                                                <span class="text-red-600 font-semibold">Đã huỷ</span>
                                            @else
                                                <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" onchange="this.form.submit()"
                                                        class="text-sm rounded border-gray-300 px-2 py-1">
                                                        @foreach (['pending' => 'Chờ xác nhận', 'confirmed' => 'Đã xác nhận', 'shipping' => 'Đang giao', 'completed' => 'Đã giao', 'cancelled' => 'Đã huỷ'] as $key => $label)
                                                            <option value="{{ $key }}" {{ $order->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($order->payment_status === 'Paid')
                                                <span class="text-green-600 font-semibold">Đã thanh toán</span>
                                            @elseif ($order->payment_status === 'Unpaid')
                                                <span class="text-red-500 font-semibold">Chưa thanh toán</span>
                                            @else
                                                <span class="text-yellow-500 font-semibold">Hoàn tiền</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-2 justify-center">
                                                <a href="{{ route('orders.show', $order->id) }}"
                                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                                    Chi tiết
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Phân trang --}}
                        @if($orders->hasPages())
                            <div class="mt-6">
                                {{ $orders->links('pagination::tailwind') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
