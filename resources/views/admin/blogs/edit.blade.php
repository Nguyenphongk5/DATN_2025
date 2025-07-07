<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-blog text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Cập nhật bài viết</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-8">
                <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 drop-shadow-lg flex items-center gap-2 mb-8">
                    <i class="fas fa-edit animate-bounce text-indigo-400"></i>
                    Cập nhật bài viết
                </h1>
                <form method="POST" action="{{ route('admin.blogs.update', $blog->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- ID (readonly) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">ID</label>
                        <input type="text" value="{{ $blog->id }}" readonly
                            class="w-full border border-gray-300 rounded px-4 py-2 bg-gray-100">
                    </div>

                    <!-- Tên bài viết -->
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-medium mb-1">Tên sản phẩm <span class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title', $blog->title) }}" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('title') border-red-500 @enderror"
                            placeholder="Nhập tên sản phẩm">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="mb-4">
                        <label for="slug" class="block text-gray-700 font-medium mb-1">Slug <span class="text-red-500">*</span></label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $blog->slug) }}" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('slug') border-red-500 @enderror"
                            placeholder="ten-san-pham">
                        @error('slug')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Hình ảnh thumbnail hiện tại -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Hình ảnh hiện tại</label>
                        @if ($blog->img_avt)
                            <div class="border rounded-lg p-4 bg-gray-50">
                                <img src="{{ asset('storage/' . $blog->img_avt) }}"
                                     alt="{{ $blog->title }}"
                                     class="w-32 h-32 object-cover rounded" width="200px">
                                <p class="text-sm text-gray-600 mt-2">{{ $blog->img_avt }}</p>
                            </div>
                        @else
                            <p class="text-gray-400 italic">Không có hình ảnh</p>
                        @endif
                    </div>

                    <!-- Hình ảnh thumbnail mới -->
                    <div class="mb-4">
                        <label for="img_avt" class="block text-gray-700 font-medium mb-1">Cập nhật hình ảnh</label>
                        <input type="file" id="img_avt" name="img_avt" accept="image/*"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('img_avt') border-red-500 @enderror">
                        <p class="text-sm text-gray-500 mt-1">Để trống nếu không muốn thay đổi hình ảnh</p>
                        @error('img_avt')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mô tả -->
                    <div class="mb-4">
                        <label for="short_description" class="block text-gray-700 font-medium mb-1">Mô tả</label>
                        <textarea id="short_description" name="short_description" rows="4"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('short_description') border-red-500 @enderror"
                            placeholder="Nhập mô tả sản phẩm">{{ old('short_description', $blog->short_description) }}</textarea>
                        @error('short_description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Nội dung bài viết -->
                    <div class="mb-4">
                        <label for="content" class="block text-gray-700 font-medium mb-1">Nội dung bài viết</label>
                        <textarea id="content" name="content" rows="4"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('content') border-red-500 @enderror  "
                            placeholder="Nhập nội dung bài viết">{{ old('content', $blog->content) }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- <!-- Giá gốc -->
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 font-medium mb-1">Giá gốc <span class="text-red-500">*</span></label>
                        <input type="number" id="price" name="price" value="{{ old('price', $blog->price) }}" step="0.01" min="0" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('price') border-red-500 @enderror"
                            placeholder="0.00">
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Giá khuyến mãi -->
                    <div class="mb-4">
                        <label for="price_sale" class="block text-gray-700 font-medium mb-1">Giá khuyến mãi</label>
                        <input type="number" id="price_sale" name="price_sale" value="{{ old('price_sale', $blog->price_sale) }}" step="0.01" min="0"
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
                                <option value="{{ $category->id }}" {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- bài viết -->
                    <div class="mb-4">
                        <label for="brand_id" class="block text-gray-700 font-medium mb-1">bài viết <span class="text-red-500">*</span></label>
                        <select id="brand_id" name="brand_id" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('brand_id') border-red-500 @enderror">
                            <option value="">Chọn bài viết</option>
                            @foreach($blogs as $blog)
                                <option value="{{ $blog->id }}" {{ old('brand_id', $blog->brand_id) == $blog->id ? 'selected' : '' }}>
                                    {{ $blog->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div> --}}

                    <!-- Trạng thái hoạt động -->
                    <div class="mb-3">
                        <label for="is_active" class="block text-gray-700 font-medium mb-1">Trạng Thái <span class="text-red-500">*</span></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_active" id="active1"
                                value="1" {{ old('is_active', $blog->is_active) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="active1">Kích hoạt</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_active" id="active0"
                                value="0" {{ old('is_active', $blog->is_active) == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="active0">Ngưng hoạt động</label>
                        </div>
                        @error('is_active')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nút điều hướng -->
                    <div class="flex justify-between">
                        <a href="{{ route('admin.blogs.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white font-medium px-6 py-2 rounded transition duration-200">
                            Quay lại
                        </a>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded transition duration-200">
                            Cập nhật bài viết
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Tự động tạo slug từ tên bài viết
        function generateSlug(str) {
            return str
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/[đĐ]/g, 'd')
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^[-]+|[-]+$/g, '');
        }
        document.getElementById('title').addEventListener('input', function() {
            const title = this.value;
            document.getElementById('slug').value = generateSlug(title);
        });
    </script>
</x-app-layout>
