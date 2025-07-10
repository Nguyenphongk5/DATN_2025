<x-app-layout>
    <x-slot name="header">
        <div
            class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-receipt text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Quản lý đơn hàng</h2>
        </div>
    </x-slot>
    <div class="py-8">
        <h1
            class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 text-center mb-8 drop-shadow-lg flex items-center justify-center gap-3">
            <i class="fas fa-clipboard-list animate-bounce text-indigo-400"></i>
            Danh sách đơn hàng
        </h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-8">
                {{-- Bộ lọc --}}
                <form action="{{ route('admin.orders.index') }}" method="GET" class="mb-8">
                    <div
                        class="flex flex-wrap gap-4 items-end bg-gradient-to-r from-indigo-50 via-sky-50 to-cyan-50 border border-indigo-100 rounded-2xl p-4 shadow">
                        <div class="flex flex-col">
                            <label for="keyword" class="text-sm text-indigo-700 mb-1 font-semibold">Tìm kiếm</label>
                            <input type="text" name="keyword" id="keyword" placeholder="Mã đơn / tên / email / SĐT"
                                value="{{ request('keyword') }}"
                                class="border border-indigo-200 rounded-xl px-4 py-2 w-64 focus:outline-none focus:ring-2 focus:ring-sky-400 shadow" />
                        </div>
                        <div class="flex flex-col">
                            <label for="status" class="text-sm text-indigo-700 mb-1 font-semibold">Trạng thái
                                đơn</label>
                            <select name="status" id="status"
                                class="border border-indigo-200 rounded-xl px-4 py-2 w-48 focus:outline-none focus:ring-2 focus:ring-sky-400 shadow">
                                <option value="">Tất cả</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xác
                                    nhận</option>
                                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Đã
                                    xác
                                    nhận</option>
                                <option value="shipping" {{ request('status') == 'shipping' ? 'selected' : '' }}>Đang
                                    giao
                                </option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Đã
                                    giao
                                </option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã
                                    huỷ
                                </option>
                            </select>
                        </div>
                        <div class="flex flex-col">
                            <label for="payment_status" class="text-sm text-indigo-700 mb-1 font-semibold">Thanh
                                toán</label>
                            <select name="payment_status" id="payment_status"
                                class="border border-indigo-200 rounded-xl px-4 py-2 w-48 focus:outline-none focus:ring-2 focus:ring-sky-400 shadow">
                                <option value="">Tất cả</option>
                                <option value="Unpaid" {{ request('payment_status') == 'Unpaid' ? 'selected' : '' }}>
                                    Chưa
                                    thanh toán</option>
                                <option value="Paid" {{ request('payment_status') == 'Paid' ? 'selected' : '' }}>Đã
                                    thanh
                                    toán</option>
                                <option value="Refunded"
                                    {{ request('payment_status') == 'Refunded' ? 'selected' : '' }}>
                                    Hoàn tiền</option>
                            </select>
                        </div>
                        <div class="flex flex-col">
                            <label class="invisible mb-1">Lọc</label>
                            <button type="submit"
                                class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white font-bold px-6 py-2 rounded-xl shadow-lg flex items-center gap-2 transition">
                                <i class="fas fa-filter"></i> Lọc kết quả
                            </button>
                        </div>
                    </div>
                </form>

                {{-- Bảng đơn hàng --}}
                <div class="overflow-x-auto custom-scrollbar rounded-2xl">
                    <table class="w-full table-auto border-collapse shadow-xl rounded-2xl overflow-hidden">
                        <thead class="bg-gradient-to-r from-indigo-100 via-sky-100 to-cyan-100 text-indigo-700">
                            <tr>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">STT</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Mã đơn</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Tên khách</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">SĐT</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Tổng tiền</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Trạng thái</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Thanh toán</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-indigo-100 text-center text-lg">
                            @foreach ($orders as $key => $order)
                                <tr class="hover:bg-gradient-to-r hover:from-indigo-50 hover:to-cyan-50 transition">
                                    <td class="px-6 py-4 font-bold">{{ $key + 1 }}</td>
                                    <td class="px-6 py-4 font-mono text-indigo-600">{{ $order->order_code }}</td>
                                    <td class="px-6 py-4 font-semibold">{{ $order->user_name }}</td>
                                    <td class="px-6 py-4">{{ $order->user_phone }}</td>
                                    <td class="px-6 py-4 text-right font-bold text-cyan-600">
                                        {{ number_format($order->total_amount, 0, ',', '.') }} VNĐ
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusMap = [
                                                'pending' => ['Chờ xác nhận', 'from-yellow-400 to-yellow-600'],
                                                'confirmed' => ['Đã xác nhận', 'from-blue-400 to-blue-600'],
                                                'shipping' => ['Đang giao', 'from-sky-400 to-cyan-500'],
                                                'completed' => ['Đã giao', 'from-green-400 to-green-600'],
                                                'cancelled' => ['Đã huỷ', 'from-gray-400 to-gray-600'],
                                            ];
                                            $status = $order->status;
                                        @endphp
                                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <span
                                                class="inline-block px-4 py-1 rounded-xl font-bold text-base shadow-sm border
                                                    {{ $status === 'pending' ? 'bg-yellow-50 border-yellow-400 text-yellow-700' : '' }}
                                                    {{ $status === 'confirmed' ? 'bg-blue-50 border-blue-400 text-blue-700' : '' }}
                                                    {{ $status === 'shipping' ? 'bg-cyan-50 border-cyan-400 text-cyan-700' : '' }}
                                                    {{ $status === 'completed' ? 'bg-green-50 border-green-400 text-green-700' : '' }}
                                                    {{ $status === 'cancelled' ? 'bg-gray-100 border-gray-400 text-gray-600' : '' }}"
                                                style="min-width: 120px; text-align: center;">
                                                {{ $statusMap[$status][0] ?? 'Không xác định' }}
                                            </span>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($order->payment_status === 'Paid')
                                            <span
                                                class="inline-block px-4 py-1 rounded-full bg-gradient-to-r from-green-400 to-cyan-400 text-white font-bold shadow text-sm">Đã
                                                thanh toán</span>
                                        @elseif ($order->payment_status === 'Unpaid')
                                            <span
                                                class="inline-block px-4 py-1 rounded-full bg-gradient-to-r from-red-400 to-pink-400 text-white font-bold shadow text-sm">Chưa
                                                thanh toán</span>
                                        @else
                                            <span
                                                class="inline-block px-4 py-1 rounded-full bg-gradient-to-r from-yellow-400 to-yellow-600 text-white font-bold shadow text-sm">Hoàn
                                                tiền</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2 justify-center">
                                            <a href="{{ route('admin.orders.show', $order->id) }}"
                                                class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white font-bold py-2 px-6 rounded-xl shadow-lg flex items-center gap-2 transition">
                                                <i class="fas fa-eye"></i> Xem
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Phân trang --}}
                    @if (isset($orders) && $orders->hasPages())
                        <div class="mt-8 flex justify-center">
                            {{ $orders->links('pagination::tailwind') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
