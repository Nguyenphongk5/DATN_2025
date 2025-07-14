@extends('layouts.app')
@section('content')
<div class="container mx-auto p-4 max-w-xl">
    <h1 class="text-3xl font-bold mb-6 text-blue-700 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l2 2m0 0l2-2m-2 2V7m0 6v5m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
        Chỉnh sửa Voucher
    </h1>
    <form action="{{ route('admin.vouchers.update', $voucher) }}" method="POST" class="bg-white rounded shadow p-6 space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-semibold mb-1">Mã voucher</label>
            <input type="text" name="code" class="border rounded w-full px-3 py-2 focus:ring focus:border-blue-400" required value="{{ old('code', $voucher->code) }}">
        </div>
        <div>
            <label class="block font-semibold mb-1">Loại giảm giá</label>
            <select name="discount_type" class="border rounded w-full px-3 py-2 focus:ring focus:border-blue-400" required>
                <option value="percent" {{ $voucher->discount_type == 'percent' ? 'selected' : '' }}>Phần trăm</option>
                <option value="fixed" {{ $voucher->discount_type == 'fixed' ? 'selected' : '' }}>Số tiền</option>
            </select>
        </div>
        <div>
            <label class="block font-semibold mb-1">Giá trị giảm</label>
            <input type="number" name="discount_value" class="border rounded w-full px-3 py-2 focus:ring focus:border-blue-400" required value="{{ old('discount_value', $voucher->discount_value) }}">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Ngày bắt đầu</label>
                <input type="date" name="start_date" class="border rounded w-full px-3 py-2 focus:ring focus:border-blue-400" required value="{{ old('start_date', $voucher->start_date) }}">
            </div>
            <div>
                <label class="block font-semibold mb-1">Ngày kết thúc</label>
                <input type="date" name="end_date" class="border rounded w-full px-3 py-2 focus:ring focus:border-blue-400" required value="{{ old('end_date', $voucher->end_date) }}">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Số lượng</label>
                <input type="number" name="quantity" class="border rounded w-full px-3 py-2 focus:ring focus:border-blue-400" required value="{{ old('quantity', $voucher->quantity) }}">
            </div>
            <div>
                <label class="block font-semibold mb-1">Giới hạn mỗi user</label>
                <input type="number" name="user_limit" class="border rounded w-full px-3 py-2 focus:ring focus:border-blue-400" required value="{{ old('user_limit', $voucher->user_limit) }}">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Đơn tối thiểu</label>
                <input type="number" name="min_money" class="border rounded w-full px-3 py-2 focus:ring focus:border-blue-400" required value="{{ old('min_money', $voucher->min_money) }}">
            </div>
            <div>
                <label class="block font-semibold mb-1">Đơn tối đa</label>
                <input type="number" name="max_money" class="border rounded w-full px-3 py-2 focus:ring focus:border-blue-400" required value="{{ old('max_money', $voucher->max_money) }}">
            </div>
        </div>
        <div>
            <label class="block font-semibold mb-1">Trạng thái</label>
            <select name="is_active" class="border rounded w-full px-3 py-2 focus:ring focus:border-blue-400">
                <option value="1" {{ $voucher->is_active ? 'selected' : '' }}>Kích hoạt</option>
                <option value="0" {{ !$voucher->is_active ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>
        <div class="flex items-center gap-3 mt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 transition text-white px-6 py-2 rounded font-semibold shadow">Cập nhật</button>
            <a href="{{ route('admin.vouchers.index') }}" class="ml-2 text-gray-600 hover:underline">Quay lại</a>
        </div>
    </form>
</div>
@endsection 