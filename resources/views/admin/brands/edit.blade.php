<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý thương hiệu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h1 class="font-semibold text-gray-800 leading-tight"
            style="text-align: center; margin: 0 0 2rem 0; font-size: 2rem;">
            {{ __('Cập nhật thương hiệu') }}
        </h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <form method="POST" action="{{ route('brands.update', $brand->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- ID (readonly) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">ID</label>
                        <input type="text" value="{{ $brand->id }}" readonly
                            class="w-full border border-gray-300 rounded px-4 py-2 bg-gray-100">
                    </div>

                    <!-- Tên thương hiệu -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-1">Tên thương hiệu <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $brand->name) }}" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('name') border-red-500 @enderror"
                            placeholder="Nhập tên thương hiệu">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="mb-4">
                        <label for="slug" class="block text-gray-700 font-medium mb-1">Slug <span class="text-red-500">*</span></label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $brand->slug) }}" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('slug') border-red-500 @enderror"
                            placeholder="ten-san-pham">
                        @error('slug')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Hình ảnh thumbnail hiện tại -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Hình ảnh hiện tại</label>
                        @if ($brand->logo)
                            <div class="border rounded-lg p-4 bg-gray-50">
                                <img src="{{ asset('storage/' . $brand->logo) }}"
                                     alt="{{ $brand->name }}"
                                     class="w-32 h-32 object-cover rounded" width="200px">
                                <p class="text-sm text-gray-600 mt-2">{{ $brand->logo }}</p>
                            </div>
                        @else
                            <p class="text-gray-400 italic">Không có hình ảnh</p>
                        @endif
                    </div>

                    <!-- Hình ảnh thumbnail mới -->
                    <div class="mb-4">
                        <label for="logo" class="block text-gray-700 font-medium mb-1">Cập nhật hình ảnh</label>
                        <input type="file" id="logo" name="logo" accept="image/*"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('logo') border-red-500 @enderror">
                        <p class="text-sm text-gray-500 mt-1">Để trống nếu không muốn thay đổi hình ảnh</p>
                        @error('logo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mô tả -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-medium mb-1">Mô tả</label>
                        <textarea id="description" name="description" rows="4"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('description') border-red-500 @enderror"
                            placeholder="Nhập mô tả thương hiệu">{{ old('description', $brand->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- <!-- Giá gốc -->
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 font-medium mb-1">Giá gốc <span class="text-red-500">*</span></label>
                        <input type="number" id="price" name="price" value="{{ old('price', $brand->price) }}" step="0.01" min="0" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('price') border-red-500 @enderror"
                            placeholder="0.00">
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Giá khuyến mãi -->
                    <div class="mb-4">
                        <label for="price_sale" class="block text-gray-700 font-medium mb-1">Giá khuyến mãi</label>
                        <input type="number" id="price_sale" name="price_sale" value="{{ old('price_sale', $brand->price_sale) }}" step="0.01" min="0"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('price_sale') border-red-500 @enderror"
                            placeholder="0.00">
                        @error('price_sale')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Danh mục -->
                    <div class="mb-4">
                        <label for="category_id" class="block text-gray-700 font-medium mb-1">Danh mục <span class="text-red-500">*</span></label>
                        <select id="category_id" name="category_id" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('category_id') border-red-500 @enderror">
                            <option value="">Chọn danh mục</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $brand->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Thương hiệu -->
                    <div class="mb-4">
                        <label for="brand_id" class="block text-gray-700 font-medium mb-1">Thương hiệu <span class="text-red-500">*</span></label>
                        <select id="brand_id" name="brand_id" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('brand_id') border-red-500 @enderror">
                            <option value="">Chọn thương hiệu</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id', $brand->brand_id) == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div> --}}

                    <!-- Trạng thái hoạt động -->
                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $brand->is_active) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-gray-700 font-medium">Kích hoạt thương hiệu</span>
                        </label>
                        @error('is_active')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nút điều hướng -->
                    <div class="flex justify-between">
                        <a href="{{ route('brands.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white font-medium px-6 py-2 rounded transition duration-200">
                            Quay lại
                        </a>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded transition duration-200">
                            Cập nhật thương hiệu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Tự động tạo slug từ tên thương hiệu
        document.getElementById('name').addEventListener('input', function() {
            const name = this.value;
            const slug = name
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/[đĐ]/g, 'd')
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
            document.getElementById('slug').value = slug;
        });
    </script>
</x-app-layout>
