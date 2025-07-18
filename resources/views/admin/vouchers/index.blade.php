<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-ticket-alt text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Danh sách voucher</h2>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-10">
                @if(session('success'))
                    <div class="alert alert-success mb-4">{{ session('success') }}</div>
                @endif
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-indigo-700">Danh sách voucher</h2>
                    <a href="{{ route('admin.vouchers.create') }}"
                       class="bg-gradient-to-r from-green-400 to-cyan-400 hover:from-cyan-400 hover:to-green-400 text-white font-bold px-6 py-2 rounded-xl shadow-lg flex items-center gap-2 transition">
                        <i class="fas fa-plus-circle"></i> Tạo voucher mới
                    </a>
                </div>
                <div class="overflow-x-auto custom-scrollbar rounded-2xl">
                    <table class="w-full table-auto border-collapse shadow-xl rounded-2xl overflow-hidden">
                        <thead class="bg-gradient-to-r from-indigo-100 via-sky-100 to-cyan-100 text-indigo-700">
                            <tr>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">ID</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Mã voucher</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Loại</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Giá trị</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Ngày bắt đầu</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Ngày kết thúc</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Số lượng</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Đã dùng</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Giới hạn/người</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Đơn tối thiểu</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Đơn tối đa</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Trạng thái</th>
                                <th class="px-6 py-3 text-center text-base font-bold uppercase">Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-indigo-100 text-center text-lg">
                            @foreach($vouchers as $voucher)
                                <tr class="hover:bg-gradient-to-r hover:from-indigo-50 hover:to-cyan-50 transition">
                                    <td class="px-6 py-4 font-bold">{{ $voucher->id }}</td>
                                    <td class="px-6 py-4 font-semibold text-indigo-700">{{ $voucher->code }}</td>
                                    <td class="px-6 py-4">
                                        @if($voucher->discount_type == 'percent')
                                            <span class="inline-block px-3 py-1 rounded-full bg-gradient-to-r from-blue-400 to-cyan-400 text-white font-bold text-sm">Phần trăm</span>
                                        @else
                                            <span class="inline-block px-3 py-1 rounded-full bg-gradient-to-r from-green-400 to-emerald-400 text-white font-bold text-sm">Cố định</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-bold text-indigo-600">{{ $voucher->discount_value }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $voucher->start_date }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $voucher->end_date }}</td>
                                    <td class="px-6 py-4 font-bold text-indigo-600">{{ $voucher->quantity }}</td>
                                    <td class="px-6 py-4 font-bold text-orange-600">{{ $voucher->used_count }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $voucher->user_limit }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ number_format($voucher->min_money) }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $voucher->max_money == null ? 'Không giới hạn' : number_format($voucher->max_money) }}</td>
                                    <td class="px-6 py-4">
                                        @if($voucher->is_active)
                                            <span class="inline-block px-3 py-1 rounded-full bg-gradient-to-r from-green-400 to-cyan-400 text-white font-bold text-sm">Kích hoạt</span>
                                        @else
                                            <span class="inline-block px-3 py-1 rounded-full bg-gradient-to-r from-gray-400 to-gray-600 text-white font-bold text-sm">Tạm dừng</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2 justify-center">
                                            <a href="{{ route('admin.vouchers.edit', $voucher) }}"
                                               class="bg-gradient-to-r from-yellow-400 to-pink-400 hover:from-pink-400 hover:to-yellow-400 text-white font-bold py-2 px-4 rounded-xl shadow-lg flex items-center gap-1 transition">
                                                <i class="fas fa-edit"></i> Sửa
                                            </a>
                                            <form action="{{ route('admin.vouchers.destroy', $voucher) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="bg-gradient-to-r from-red-400 to-pink-400 hover:from-pink-400 hover:to-red-400 text-white font-bold py-2 px-4 rounded-xl shadow-lg flex items-center gap-1 transition"
                                                        onclick="return confirm('Bạn có chắc muốn xóa voucher này?')">
                                                    <i class="fas fa-trash"></i> Xóa
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
