@extends('layouts.app')
@section('content')
<div class="container mx-auto p-4 max-w-xl">
    <h1 class="text-3xl font-bold mb-6 text-blue-700 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
        Thêm mới Voucher
    </h1>
    <form action="{{ route('admin.vouchers.store') }}" method="POST" class="bg-white rounded shadow p-6 space-y-4">
        @csrf
        <div>
            <label class="block font-semibold mb-1">Mã voucher</label>
            <input type="text" name="code" class="border rounded w-full px-3 py-2 focus:ring focus:border-blue-400" required value="{{ old('code') }}">
        </div>
        <div>
            <label class="block font-semibold mb-1">Loại giảm giá</label>
            <select name="discount_type" class="border rounded w-full px-3 py-2 focus:ring focus:border-blue-400" required>
                <option value="percent">Phần trăm</option>
                <option value="fixed">Số tiền</option>
            </select>
        </div>
        <div>
            <label class="block font-semibold mb-1">Giá trị giảm</label>
            <input type="number" name="discount_value" class="border rounded w-full px-3 py-2 focus:ring focus:border-blue-400" required value="{{ old('discount_value') }}">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Ngày bắt đầu</label>
                <input type="date" name="start_date" class="border rounded w-full px-3 py-2 focus:ring focus:border-blue-400" required value="{{ old('start_date') }}">
            </div>
            <div>
                <label class="block font-semibold mb-1">Ngày kết thúc</label>
                <input type="date" name="end_date" class="border rounded w-full px-3 py-2 focus:ring focus:border-blue-400" required value="{{ old('end_date') }}">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Số lượng</label>
                <input type="number" name="quantity" class="border rounded w-full px-3 py-2 focus:ring focus:border-blue-400" required value="{{ old('quantity') }}">
            </div>
            <div>
                <label class="block font-semibold mb-1">Giới hạn mỗi user</label>
                <input type="number" name="user_limit" class="border rounded w-full px-3 py-2 focus:ring focus:border-blue-400" required value="{{ old('user_limit', 1) }}">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Đơn tối thiểu</label>
                <input type="number" name="min_money" class="border rounded w-full px-3 py-2 focus:ring focus:border-blue-400" required value="{{ old('min_money') }}">
            </div>
            <div>
                <label class="block font-semibold mb-1">Đơn tối đa</label>
                <input type="number" name="max_money" class="border rounded w-full px-3 py-2 focus:ring focus:border-blue-400" required value="{{ old('max_money') }}">
            </div>
        </div>
        <div>
            <label class="block font-semibold mb-1">Trạng thái</label>
            <select name="is_active" class="border rounded w-full px-3 py-2 focus:ring focus:border-blue-400">
                <option value="1">Kích hoạt</option>
                <option value="0">Ẩn</option>
            </select>
        </div>
        <div class="flex items-center gap-3 mt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 transition text-white px-6 py-2 rounded font-semibold shadow">Lưu</button>
            <a href="{{ route('admin.vouchers.index') }}" class="ml-2 text-gray-600 hover:underline">Quay lại</a>
        </div>
    </form>
</div>
@endsection 