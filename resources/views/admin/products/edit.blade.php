<x-app-layout>
    <x-slot name="header">
        <div
            class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-edit text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Cập nhật sản phẩm</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-8">
                <form method="POST" action="{{ route('admin.products.update', $product->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col items-center mb-8">
                        @if ($product->img_thumb)
                            <div class="rounded-2xl overflow-hidden ring-4 ring-sky-300 shadow-xl mb-4">
                                <img src="{{ asset('storage/' . $product->img_thumb) }}" alt="{{ $product->name }}"
                                    class="w-40 h-40 object-cover">
                            </div>
                        @else
                            <div
                                class="w-40 h-40 rounded-2xl bg-gradient-to-br from-gray-200 to-sky-100 flex items-center justify-center text-5xl text-gray-400 mb-4">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                        <h1
                            class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 drop-shadow-lg flex items-center gap-2">
                            <i class="fas fa-cube animate-bounce text-indigo-400"></i>
                            {{ $product->name }}
                        </h1>
                    </div>

                    <!-- ID (readonly) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-1">ID</label>
                        <input type="text" value="{{ $product->id }}" readonly
                            class="w-full border-2 border-indigo-200 rounded-xl px-4 py-2 bg-gray-100 font-semibold shadow-inner">
                    </div>

                    <!-- Tên sản phẩm -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold mb-1">Tên sản phẩm <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required
                            class="w-full border-2 border-indigo-200 rounded-xl px-4 py-2 font-semibold shadow-inner focus:ring-2 focus:ring-sky-400 @error('name') border-red-500 @enderror"
                            placeholder="Nhập tên sản phẩm">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="mb-4">
                        <label for="slug" class="block text-gray-700 font-bold mb-1">Slug <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $product->slug) }}" required
                            class="w-full border-2 border-indigo-200 rounded-xl px-4 py-2 font-semibold shadow-inner focus:ring-2 focus:ring-sky-400 @error('slug') border-red-500 @enderror"
                            placeholder="ten-san-pham">
                        @error('slug')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Hình ảnh thumbnail hiện tại -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-1">Hình ảnh hiện tại</label>
                        @if ($product->img_thumb)
                            <div class="rounded-2xl overflow-hidden ring-2 ring-sky-200 shadow mb-2">
                                <img src="{{ asset('storage/' . $product->img_thumb) }}" alt="{{ $product->name }}"
                                    class="w-24 h-24 object-cover">
                            </div>
                        @else
                            <div
                                class="w-24 h-24 rounded-2xl bg-gradient-to-br from-gray-200 to-sky-100 flex items-center justify-center text-3xl text-gray-400 mb-2">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Hình ảnh thumbnail mới -->
                    <div class="mb-4">
                        <label for="img_thumb" class="block text-gray-700 font-bold mb-1">Cập nhật hình ảnh</label>
                        <input type="file" id="img_thumb" name="img_thumb" accept="image/*"
                            class="w-full border-2 border-indigo-200 rounded-xl px-4 py-2 font-semibold shadow-inner focus:ring-2 focus:ring-sky-400 @error('img_thumb') border-red-500 @enderror">
                        <p class="text-sm text-gray-500 mt-1">Để trống nếu không muốn thay đổi hình ảnh</p>
                        @error('img_thumb')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mô tả -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-bold mb-1">Mô tả</label>
                        <textarea id="description" name="description" rows="4"
                            class="w-full border-2 border-indigo-200 rounded-xl px-4 py-2 font-semibold shadow-inner focus:ring-2 focus:ring-sky-400 @error('description') border-red-500 @enderror"
                            placeholder="Nhập mô tả sản phẩm">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Giá gốc -->
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 font-bold mb-1">Giá gốc <span
                                class="text-red-500">*</span></label>
                        <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}"
                            step="0.01" min="0" required
                            class="w-full border-2 border-indigo-200 rounded-xl px-4 py-2 font-semibold shadow-inner focus:ring-2 focus:ring-sky-400 @error('price') border-red-500 @enderror"
                            placeholder="0.00">
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Giá khuyến mãi -->
                    <div class="mb-4">
                        <label for="price_sale" class="block text-gray-700 font-bold mb-1">Giá khuyến mãi</label>
                        <input type="number" id="price_sale" name="price_sale"
                            value="{{ old('price_sale', $product->price_sale) }}" step="0.01" min="0"
                            class="w-full border-2 border-indigo-200 rounded-xl px-4 py-2 font-semibold shadow-inner focus:ring-2 focus:ring-sky-400 @error('price_sale') border-red-500 @enderror"
                            placeholder="0.00">
                        @error('price_sale')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Danh mục -->
                    <div class="mb-4">
                        <label for="category_id" class="block text-gray-700 font-bold mb-1">Danh mục <span
                                class="text-red-500">*</span></label>
                        <select id="category_id" name="category_id" required
                            class="w-full border-2 border-indigo-200 rounded-xl px-4 py-2 font-semibold shadow-inner bg-gradient-to-r from-indigo-50 to-cyan-50 focus:ring-2 focus:ring-sky-400 @error('category_id') border-red-500 @enderror">
                            <option value="">Chọn danh mục</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Thương hiệu -->
                    <div class="mb-4">
                        <label for="brand_id" class="block text-gray-700 font-bold mb-1">Thương hiệu <span
                                class="text-red-500">*</span></label>
                        <select id="brand_id" name="brand_id" required
                            class="w-full border-2 border-indigo-200 rounded-xl px-4 py-2 font-semibold shadow-inner bg-gradient-to-r from-indigo-50 to-cyan-50 focus:ring-2 focus:ring-sky-400 @error('brand_id') border-red-500 @enderror">
                            <option value="">Chọn thương hiệu</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Trạng thái hoạt động -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-1">Trạng thái <span
                                class="text-red-500">*</span></label>
                        <div class="flex gap-6 mt-2">
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input class="form-check-input accent-green-500" type="radio" name="is_active" value="1"
                                    {{ old('is_active', $product->is_active) == 1 ? 'checked' : '' }}>
                                <span
                                    class="px-3 py-1 text-xs font-bold rounded-full bg-gradient-to-r from-green-300 via-emerald-400 to-cyan-300 text-green-900 shadow ring-2 ring-green-200/60">Đang
                                    hoạt động</span>
                            </label>
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input class="form-check-input accent-pink-500" type="radio" name="is_active" value="0"
                                    {{ old('is_active', $product->is_active) == 0 ? 'checked' : '' }}>
                                <span
                                    class="px-3 py-1 text-xs font-bold rounded-full bg-gradient-to-r from-red-300 via-pink-400 to-fuchsia-300 text-red-900 shadow ring-2 ring-pink-200/60">Đã
                                    ẩn</span>
                            </label>
                        </div>
                        @error('is_active')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex justify-between mt-8">
                        <a href="{{ route('admin.products.index') }}"
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
        // Tự động tạo slug từ tên sản phẩm
        document.getElementById('name').addEventListener('input', function () {
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
