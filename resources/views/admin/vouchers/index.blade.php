@extends('layouts.app')
@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6 text-blue-700 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l2-2m0 0l2-2m-2 2V7m0 5v5m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
        Danh sách Voucher
    </h1>
    <a href="{{ route('admin.vouchers.create') }}" class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 transition text-white px-6 py-2 rounded-full shadow-lg mb-6 inline-flex items-center gap-2 font-semibold focus:ring focus:ring-blue-300 transform hover:scale-105 duration-150">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
        Thêm mới
    </a>
    @if($vouchers->isEmpty())
        <div class="p-4 bg-yellow-100 text-yellow-800 rounded mb-4 shadow">Chưa có voucher nào. Hãy bấm "Thêm mới" để tạo voucher đầu tiên!</div>
    @else
    <div class="overflow-x-auto rounded shadow">
    <table class="min-w-full bg-white border border-gray-200">
        <thead class="bg-gradient-to-r from-blue-50 to-blue-100 sticky top-0 z-10">
            <tr>
                <th class="border px-3 py-2 text-center">#</th>
                <th class="border px-3 py-2 text-left">Mã</th>
                <th class="border px-3 py-2 text-left">Loại</th>
                <th class="border px-3 py-2 text-left">Giá trị</th>
                <th class="border px-3 py-2 text-left">Ngày bắt đầu</th>
                <th class="border px-3 py-2 text-left">Ngày kết thúc</th>
                <th class="border px-3 py-2 text-center">Số lượng</th>
                <th class="border px-3 py-2 text-center">Đã dùng</th>
                <th class="border px-3 py-2 text-center">Trạng thái</th>
                <th class="border px-3 py-2 text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vouchers as $voucher)
            <tr class="hover:bg-blue-50 transition">
                <td class="border px-3 py-2 text-center font-bold">{{ $loop->iteration }}</td>
                <td class="border px-3 py-2">
                    <span class="inline-flex items-center gap-2">
                        <span class="inline-block bg-blue-100 text-blue-700 rounded-full px-3 py-1 font-mono font-semibold shadow-sm text-sm">{{ $voucher->code }}</span>
                    </span>
                </td>
                <td class="border px-3 py-2">{{ $voucher->discount_type == 'percent' ? 'Phần trăm' : 'Số tiền' }}</td>
                <td class="border px-3 py-2">{{ $voucher->discount_type == 'percent' ? $voucher->discount_value.'%' : number_format($voucher->discount_value).'₫' }}</td>
                <td class="border px-3 py-2">{{ $voucher->start_date }}</td>
                <td class="border px-3 py-2">{{ $voucher->end_date }}</td>
                <td class="border px-3 py-2 text-center">{{ $voucher->quantity }}</td>
                <td class="border px-3 py-2 text-center">{{ $voucher->used_count }}</td>
                <td class="border px-3 py-2 text-center">
                    @if($voucher->is_active)
                        <span class="inline-flex items-center gap-1 px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full font-semibold">
                            <svg xmlns='http://www.w3.org/2000/svg' class='h-4 w-4 text-green-500' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7' /></svg>
                            Kích hoạt
                        </span>
                        @php
                            $remaining = $voucher->quantity - $voucher->used_count;
                            $daysLeft = \Carbon\Carbon::parse($voucher->end_date)->diffInDays(now(), false);
                        @endphp
                        @if($remaining <= 5)
                            <span class="ml-1 inline-block px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full font-semibold animate-pulse">Sắp hết lượt (còn {{ $remaining }})</span>
                        @endif
                        @if($daysLeft >= 0 && $daysLeft <= 3)
                            <span class="ml-1 inline-block px-2 py-1 text-xs bg-orange-100 text-orange-800 rounded-full font-semibold animate-pulse">Sắp hết hạn ({{ $daysLeft }} ngày)</span>
                        @endif
                    @else
                        <span class="inline-flex items-center gap-1 px-2 py-1 text-xs bg-gray-200 text-gray-600 rounded-full font-semibold">
                            <svg xmlns='http://www.w3.org/2000/svg' class='h-4 w-4 text-gray-500' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12' /></svg>
                            Ẩn
                        </span>
                    @endif
                </td>
                <td class="border px-3 py-2 text-center whitespace-nowrap">
                    <a href="{{ route('admin.vouchers.edit', $voucher) }}" class="inline-flex items-center gap-1 text-blue-600 bg-blue-50 hover:bg-blue-200 hover:text-blue-800 transition font-medium px-4 py-1 rounded-full shadow focus:ring focus:ring-blue-200 transform hover:scale-105 duration-150">
                        <svg xmlns='http://www.w3.org/2000/svg' class='h-4 w-4' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15.232 5.232l3.536 3.536M9 11l2 2m0 0l2-2m-2 2V7m0 6v5' /></svg>
                        Sửa
                    </a>
                    <form action="{{ route('admin.vouchers.destroy', $voucher) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Xác nhận xóa voucher này?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-1 text-red-500 bg-red-50 hover:bg-red-200 hover:text-red-700 transition font-medium px-4 py-1 rounded-full shadow focus:ring focus:ring-red-200 transform hover:scale-105 duration-150">
                            <svg xmlns='http://www.w3.org/2000/svg' class='h-4 w-4' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12' /></svg>
                            Xóa
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    @endif
</div>
@endsection 