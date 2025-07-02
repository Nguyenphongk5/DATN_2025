<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý đơn hàng') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h1 class="font-semibold text-gray-800 leading-tight text-center mb-8 text-2xl">
            {{ __('Danh sách đơn hàng') }}
        </h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                     @if (session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
                    <div class="overflow-x-auto">
                        <!-- Bộ lọc -->
                        <form action="{{ route('orders.index') }}" method="GET" class="mb-6">
                            <div class="flex flex-wrap gap-4 items-center">
                                <input type="text" name="keyword" placeholder="Tìm mã đơn / tên / email / sđt"
                                    value="{{ request('keyword') }}"
                                    class="border border-gray-300 rounded px-3 py-2 w-64" />

                                <select name="status" class="border border-gray-300 rounded px-3 py-2">
                                    <option value="">Tất cả trạng thái</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xác nhận</option>
                                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                                    <option value="shipping" {{ request('status') == 'shipping' ? 'selected' : '' }}>Đang giao</option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Đã giao</option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã huỷ</option>
                                </select>

                                <select name="payment_status" class="border border-gray-300 rounded px-3 py-2">
                                    <option value="">Tất cả thanh toán</option>
                                    <option value="Unpaid" {{ request('payment_status') == 'Unpaid' ? 'selected' : '' }}>Chưa thanh toán</option>
                                    <option value="Paid" {{ request('payment_status') == 'Paid' ? 'selected' : '' }}>Đã thanh toán</option>
                                    <option value="Refunded" {{ request('payment_status') == 'Refunded' ? 'selected' : '' }}>Hoàn tiền</option>
                                </select>

                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                                    Lọc
                                </button>
                            </div>
                        </form>

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
                                                    <select name="status" onchange="this.form.submit()" class="text-sm rounded border-gray-300 px-2 py-1">
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

                        <!-- Phân trang -->
                        @if(isset($orders) && $orders->hasPages())
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