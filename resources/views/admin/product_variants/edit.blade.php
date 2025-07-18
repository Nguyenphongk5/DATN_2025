<x-app-layout>
    <x-slot name="header">
        <div
            class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-edit text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Cập nhật biến thể sản phẩm</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-8">
                <form method="POST" action="{{ route('admin.product_variants.update', $productVariant->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- ID (readonly) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">ID</label>
                        <input type="text" value="{{ $productVariant->id }}" readonly
                            class="w-full border border-gray-300 rounded px-4 py-2 bg-gray-100">
                    </div>

                    <!-- Sản phẩm -->
                    <div class="mb-4">
                        <label for="product_id" class="block text-gray-700 font-medium mb-1">Sản phẩm <span
                                class="text-red-500">*</span></label>
                        <input type="hidden" name="product_id" value="{{ $productVariant->product_id }}">
                        <input type="text" id="product_id" value="{{ $product->name }}"
                            readonly
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('product_id') border-red-500 @enderror">
                        @error('product_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kích thước -->
                    <div class="mb-4">
                        <label for="size" class="block text-gray-700 font-medium mb-1">Kích thước <span
                                class="text-red-500">*</span></label>
                        <input type="number" id="size" name="size"
                            value="{{ old('size', $productVariant->size) }}" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('size') border-red-500 @enderror"
                            placeholder="Ví dụ: 39">
                        @error('size')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tên màu -->
                    <div class="mb-4">
                        <label for="color_name" class="block text-gray-700 font-medium mb-1">Tên màu <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="color_name" name="color_name"
                            value="{{ old('color_name', $productVariant->color_name) }}" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('color_name') border-red-500 @enderror"
                            placeholder="Ví dụ: Đỏ, Xanh dương, Đen...">
                        @error('color_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mã màu hex -->
                    <div class="mb-4">
                        <label for="hex_code" class="block text-gray-700 font-medium mb-1">Mã màu hex <span
                                class="text-red-500">*</span></label>
                        <div class="flex items-center space-x-2">
                            <input type="color" id="hex_code" name="hex_code"
                                value="{{ old('hex_code', $productVariant->hex_code) }}" required
                                class="w-16 h-10 border border-gray-300 rounded cursor-pointer @error('hex_code') border-red-500 @enderror">
                            <input type="text" id="hex_code_text"
                                value="{{ old('hex_code', $productVariant->hex_code) }}"
                                class="flex-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500"
                                placeholder="#000000" readonly>
                        </div>
                        @error('hex_code')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Số lượng -->
                    <div class="mb-4">
                        <label for="quantity" class="block text-gray-700 font-medium mb-1">Số lượng <span
                                class="text-red-500">*</span></label>
                        <input type="number" id="quantity" name="quantity"
                            value="{{ old('quantity', $productVariant->quantity) }}" min="0" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('quantity') border-red-500 @enderror"
                            placeholder="0">
                        @error('quantity')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Giá gốc -->
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 font-medium mb-1">Giá gốc <span
                                class="text-red-500">*</span></label>
                        <input type="number" id="price" name="price"
                            value="{{ old('price', $productVariant->price) }}" step="0.01" min="0" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('price') border-red-500 @enderror"
                            placeholder="0.00">
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Giá khuyến mãi -->
                    <div class="mb-6">
                        <label for="price_sale" class="block text-gray-700 font-medium mb-1">Giá khuyến mãi</label>
                        <input type="number" id="price_sale" name="price_sale"
                            value="{{ old('price_sale', $productVariant->price_sale) }}" step="0.01" min="0"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('price_sale') border-red-500 @enderror"
                            placeholder="0.00">
                        @error('price_sale')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nút điều hướng -->
                    <div class="flex justify-between mt-8">
                        <a href="{{ route('admin.product_variants.index') }}"
                            class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white font-bold py-3 px-8 rounded-xl shadow-lg flex items-center gap-2 transition">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                        <button type="submit"
                            class="bg-gradient-to-r from-green-400 to-emerald-500 hover:from-emerald-500 hover:to-green-400 text-white font-bold py-3 px-8 rounded-xl shadow-lg flex items-center gap-2 transition">
                            <i class="fas fa-save"></i> Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Đồng bộ giá trị màu hex
        document.getElementById('hex_code').addEventListener('input', function() {
            document.getElementById('hex_code_text').value = this.value;
        });

        document.getElementById('hex_code_text').addEventListener('input', function() {
            const value = this.value;
            if (value.match(/^#[0-9A-F]{6}$/i)) {
                document.getElementById('hex_code').value = value;
            }
        });
    </script>
</x-app-layout>
