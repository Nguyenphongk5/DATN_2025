<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý biến thể sản phẩm') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h1 class="font-semibold text-gray-800 leading-tight"
            style="text-align: center; margin: 0 0 2rem 0; font-size: 2rem;">
            {{ __('Cập nhật biến thể sản phẩm') }}
        </h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <form method="POST" action="{{ route('product_variants.update', $productVariant->id) }}">
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
                        <label for="product_id" class="block text-gray-700 font-medium mb-1">Sản phẩm <span class="text-red-500">*</span></label>
                        <select id="product_id" name="product_id" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('product_id') border-red-500 @enderror">
                            <option value="">Chọn sản phẩm</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id', $productVariant->product_id) == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kích thước -->
                    <div class="mb-4">
                        <label for="size" class="block text-gray-700 font-medium mb-1">Kích thước <span class="text-red-500">*</span></label>
                        <input type="text" id="size" name="size" value="{{ old('size', $productVariant->size) }}" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('size') border-red-500 @enderror"
                            placeholder="Ví dụ: S, M, L, XL, 39, 40, 41...">
                        @error('size')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tên màu -->
                    <div class="mb-4">
                        <label for="color_name" class="block text-gray-700 font-medium mb-1">Tên màu <span class="text-red-500">*</span></label>
                        <input type="text" id="color_name" name="color_name" value="{{ old('color_name', $productVariant->color_name) }}" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('color_name') border-red-500 @enderror"
                            placeholder="Ví dụ: Đỏ, Xanh dương, Đen...">
                        @error('color_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mã màu hex -->
                    <div class="mb-4">
                        <label for="hex_code" class="block text-gray-700 font-medium mb-1">Mã màu hex <span class="text-red-500">*</span></label>
                        <div class="flex items-center space-x-2">
                            <input type="color" id="hex_code" name="hex_code" value="{{ old('hex_code', $productVariant->hex_code) }}" required
                                class="w-16 h-10 border border-gray-300 rounded cursor-pointer @error('hex_code') border-red-500 @enderror">
                            <input type="text" id="hex_code_text" value="{{ old('hex_code', $productVariant->hex_code) }}"
                                class="flex-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500"
                                placeholder="#000000" readonly>
                        </div>
                        @error('hex_code')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Số lượng -->
                    <div class="mb-4">
                        <label for="quantity" class="block text-gray-700 font-medium mb-1">Số lượng <span class="text-red-500">*</span></label>
                        <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $productVariant->quantity) }}" min="0" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('quantity') border-red-500 @enderror"
                            placeholder="0">
                        @error('quantity')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Giá gốc -->
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 font-medium mb-1">Giá gốc <span class="text-red-500">*</span></label>
                        <input type="number" id="price" name="price" value="{{ old('price', $productVariant->price) }}" step="0.01" min="0" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('price') border-red-500 @enderror"
                            placeholder="0.00">
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Giá khuyến mãi -->
                    <div class="mb-6">
                        <label for="price_sale" class="block text-gray-700 font-medium mb-1">Giá khuyến mãi</label>
                        <input type="number" id="price_sale" name="price_sale" value="{{ old('price_sale', $productVariant->price_sale) }}" step="0.01" min="0"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('price_sale') border-red-500 @enderror"
                            placeholder="0.00">
                        @error('price_sale')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nút điều hướng -->
                    <div class="flex justify-between">
                        <a href="{{ route('product_variants.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white font-medium px-6 py-2 rounded transition duration-200">
                            Quay lại
                        </a>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded transition duration-200">
                            Cập nhật biến thể
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
