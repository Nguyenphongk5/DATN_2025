<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-ticket-alt text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Tạo voucher mới</h2>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-10">
                <form action="{{ route('admin.vouchers.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="code" class="block font-bold text-indigo-700 mb-1">Mã voucher</label>
                            <input type="text" class="form-input w-full rounded-xl border-indigo-200 focus:ring-2 focus:ring-sky-400 @error('code') border-red-400 @enderror" id="code" name="code" value="{{ old('code') }}" placeholder="Nhập mã voucher">
                            @error('code')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label for="discount_type" class="block font-bold text-indigo-700 mb-1">Loại giảm giá</label>
                            <select class="form-input w-full rounded-xl border-indigo-200 focus:ring-2 focus:ring-sky-400 @error('discount_type') border-red-400 @enderror" id="discount_type" name="discount_type">
                                <option value="percent" {{ old('discount_type') == 'percent' ? 'selected' : '' }}>Phần trăm</option>
                                <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Cố định</option>
                            </select>
                            @error('discount_type')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label for="discount_value" class="block font-bold text-indigo-700 mb-1">Giá trị giảm</label>
                            <input type="number" step="0.01" class="form-input w-full rounded-xl border-indigo-200 focus:ring-2 focus:ring-sky-400 @error('discount_value') border-red-400 @enderror" id="discount_value" name="discount_value" value="{{ old('discount_value') }}" placeholder="Nhập giá trị">
                            @error('discount_value')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label for="quantity" class="block font-bold text-indigo-700 mb-1">Số lượng</label>
                            <input type="number" class="form-input w-full rounded-xl border-indigo-200 focus:ring-2 focus:ring-sky-400 @error('quantity') border-red-400 @enderror" id="quantity" name="quantity" value="{{ old('quantity') }}" placeholder="Số lượng">
                            @error('quantity')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label for="user_limit" class="block font-bold text-indigo-700 mb-1">Giới hạn/người</label>
                            <input type="number" class="form-input w-full rounded-xl border-indigo-200 focus:ring-2 focus:ring-sky-400 @error('user_limit') border-red-400 @enderror" id="user_limit" name="user_limit" value="{{ old('user_limit', 1) }}" placeholder="Mỗi người dùng tối đa">
                            @error('user_limit')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label for="min_money" class="block font-bold text-indigo-700 mb-1">Đơn tối thiểu</label>
                            <input type="number" step="0.01" class="form-input w-full rounded-xl border-indigo-200 focus:ring-2 focus:ring-sky-400 @error('min_money') border-red-400 @enderror" id="min_money" name="min_money" value="{{ old('min_money') }}" placeholder="Giá trị tối thiểu">
                            @error('min_money')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label for="max_money" class="block font-bold text-indigo-700 mb-1">Đơn tối đa</label>
                            <input type="number" step="0.01" class="form-input w-full rounded-xl border-indigo-200 focus:ring-2 focus:ring-sky-400 @error('max_money') border-red-400 @enderror" id="max_money" name="max_money" value="{{ old('max_money') }}" placeholder="Giá trị tối đa">
                            @error('max_money')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label for="start_date" class="block font-bold text-indigo-700 mb-1">Ngày bắt đầu</label>
                            <input type="date" class="form-input w-full rounded-xl border-indigo-200 focus:ring-2 focus:ring-sky-400 @error('start_date') border-red-400 @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}">
                            @error('start_date')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label for="end_date" class="block font-bold text-indigo-700 mb-1">Ngày kết thúc</label>
                            <input type="date" class="form-input w-full rounded-xl border-indigo-200 focus:ring-2 focus:ring-sky-400 @error('end_date') border-red-400 @enderror" id="end_date" name="end_date" value="{{ old('end_date') }}">
                            @error('end_date')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label for="is_active" class="block font-bold text-indigo-700 mb-1">Trạng thái</label>
                            <select class="form-input w-full rounded-xl border-indigo-200 focus:ring-2 focus:ring-sky-400 @error('is_active') border-red-400 @enderror" id="is_active" name="is_active">
                                <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Kích hoạt</option>
                                <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Tạm dừng</option>
                            </select>
                            @error('is_active')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="flex justify-between mt-10">
                        <a href="{{ route('admin.vouchers.index') }}" class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white font-bold py-3 px-8 rounded-xl shadow-lg flex items-center gap-2 transition">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                        <button type="submit" class="bg-gradient-to-r from-green-400 to-emerald-500 hover:from-emerald-500 hover:to-green-400 text-white font-bold py-3 px-8 rounded-xl shadow-lg flex items-center gap-2 transition">
                            <i class="fas fa-save"></i> Lưu voucher
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
