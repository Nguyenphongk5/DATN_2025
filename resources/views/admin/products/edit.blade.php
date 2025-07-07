<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý sản phẩm') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h1 class="font-semibold text-gray-800 leading-tight"
            style="text-align: center; margin: 0 0 2rem 0; font-size: 2rem;">
            {{ __('Cập nhật sản phẩm') }}
        </h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <section>
                    <form method="POST" action="{{ route('admin.products.update', $product->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="flex justify-between gap-6 flex-col xl:flex-row">
                            <div class="flex flex-col gap-[10px] lg:gap-[27px] xl:w-[25%] md:flex-row xl:flex-col">
                                <div
                                    class="border bg-neutral-bg border-neutral dark:bg-dark-neutral-bg dark:border-dark-neutral-border rounded-2xl pb-5 flex-1 px-[28px] pt-[35px]">

                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-medium mb-2">Thư viện ảnh hiện
                                            tại</label>
                                        <div
                                            class="grid grid-cols-2 sm:grid-cols-3 gap-4 p-2 border rounded-lg bg-gray-50 min-h-[8rem]">
                                            @if ($product->galleries->isNotEmpty())
                                                @foreach ($product->galleries as $gallery)
                                                    <div class="relative group">
                                                        <img src="{{ asset('storage/' . $gallery->image) }}"
                                                            alt="Gallery Image"
                                                            class="w-full h-24 object-cover rounded-lg">
                                                        <div
                                                            class="absolute top-1 right-1 bg-white rounded-full p-1 flex items-center shadow">
                                                            <input type="checkbox" name="delete_galleries[]"
                                                                value="{{ $gallery->id }}"
                                                                id="delete_gallery_{{ $gallery->id }}"
                                                                class="h-4 w-4 rounded cursor-pointer">
                                                            <label for="delete_gallery_{{ $gallery->id }}"
                                                                class="ml-1 text-xs text-red-600 cursor-pointer"
                                                                title="Đánh dấu để xóa">Xóa</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p class="col-span-full text-center self-center text-gray-400 italic">
                                                    Thư viện ảnh trống</p>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-500 mt-1">Đánh dấu vào ô "Xóa" để loại bỏ ảnh khi
                                            cập nhật.</p>
                                    </div>


                                    <label for="fileUpload"
                                        class="block border-dashed border-2 text-center mb-4 border-neutral py-4 dark:border-dark-neutral-border cursor-pointer">
                                        Thêm ảnh mới <br>
                                        <i class="fa-solid fa-image text-gray-400"></i>
                                        <p class="text-sm leading-6 text-gray-500 font-normal">Kéo thả hoặc nhấn để chọn
                                            ảnh</p>
                                        <input type="file" id="fileUpload" class="d-none" name="image[]" multiple>
                                    </label>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-medium mb-2">Ảnh mới xem trước</label>
                                        <div id="image-preview-container"
                                            class="grid grid-cols-2 sm:grid-cols-3 gap-4 p-2 border rounded-lg bg-gray-50 min-h-[8rem]">
                                            <p class="col-span-full text-center self-center text-gray-400 italic">Chưa
                                                có ảnh nào được chọn</p>
                                        </div>
                                    </div>

                                    {{-- Hiển thị lỗi validation --}}
                                    @error('image.*')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    @error('delete_galleries.*')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror

                                </div>
                            </div>

                            <div
                                class="rounded-2xl border border-neutral bg-neutral-bg dark:border-dark-neutral-border dark:bg-dark-neutral-bg scrollbar-hide flex-1 px-[28px] pt-[33px] pb-[23px]">
                                <div class="w-full bg-neutral h-[1px] mb-[10px] dark:bg-dark-neutral-border"></div>
                                <!-- ID (readonly) -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-1">ID</label>
                                    <input type="text" value="{{ $product->id }}" readonly
                                        class="w-full border border-gray-300 rounded px-4 py-2 bg-gray-100">
                                </div>

                                <!-- Tên sản phẩm -->
                                <div class="mb-4">
                                    <label for="name" class="block text-gray-700 font-medium mb-1">Tên sản phẩm
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="name" name="name"
                                        value="{{ old('name', $product->name) }}" required
                                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('name') border-red-500 @enderror"
                                        placeholder="Nhập tên sản phẩm">
                                    @error('name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Slug -->
                                <div class="mb-4">
                                    <label for="slug" class="block text-gray-700 font-medium mb-1">Slug <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" id="slug" name="slug"
                                        value="{{ old('slug', $product->slug) }}" required
                                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('slug') border-red-500 @enderror"
                                        placeholder="ten-san-pham">
                                    @error('slug')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Hình ảnh thumbnail hiện tại -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-1">Hình ảnh hiện tại</label>
                                    @if ($product->img_thumb)
                                        <div class="border rounded-lg p-4 bg-gray-50">
                                            <img src="{{ asset('storage/' . $product->img_thumb) }}"
                                                alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded"
                                                width="200px">
                                            <p class="text-sm text-gray-600 mt-2">{{ $product->img_thumb }}</p>
                                        </div>
                                    @else
                                        <p class="text-gray-400 italic">Không có hình ảnh</p>
                                    @endif
                                </div>

                                <!-- Hình ảnh thumbnail mới -->
                                <div class="mb-4">
                                    <label for="img_thumb" class="block text-gray-700 font-medium mb-1">Cập nhật hình
                                        ảnh</label>
                                    <input type="file" id="img_thumb" name="img_thumb" accept="image/*"
                                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('img_thumb') border-red-500 @enderror">
                                    <p class="text-sm text-gray-500 mt-1">Để trống nếu không muốn thay đổi hình ảnh</p>
                                    @error('img_thumb')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Mô tả -->
                                <div class="mb-4">
                                    <label for="description" class="block text-gray-700 font-medium mb-1">Mô tả</label>
                                    <textarea id="description" name="description" rows="4"
                                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('description') border-red-500 @enderror"
                                        placeholder="Nhập mô tả sản phẩm">{{ old('description', $product->description) }}</textarea>
                                    @error('description')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Giá gốc -->
                                <div class="mb-4">
                                    <label for="price" class="block text-gray-700 font-medium mb-1">Giá gốc <span
                                            class="text-red-500">*</span></label>
                                    <input type="number" id="price" name="price"
                                        value="{{ old('price', $product->price) }}" step="0.01" min="0"
                                        required
                                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('price') border-red-500 @enderror"
                                        placeholder="0.00">
                                    @error('price')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Giá khuyến mãi -->
                                <div class="mb-4">
                                    <label for="price_sale" class="block text-gray-700 font-medium mb-1">Giá khuyến
                                        mãi</label>
                                    <input type="number" id="price_sale" name="price_sale"
                                        value="{{ old('price_sale', $product->price_sale) }}" step="0.01"
                                        min="0"
                                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('price_sale') border-red-500 @enderror"
                                        placeholder="0.00">
                                    @error('price_sale')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Danh mục -->
                                <div class="mb-4">
                                    <label for="category_id" class="block text-gray-700 font-medium mb-1">Danh mục
                                        <span class="text-red-500">*</span></label>
                                    <select id="category_id" name="category_id" required
                                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('category_id') border-red-500 @enderror">
                                        <option value="">Chọn danh mục</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                                    <label for="brand_id" class="block text-gray-700 font-medium mb-1">Thương hiệu
                                        <span class="text-red-500">*</span></label>
                                    <select id="brand_id" name="brand_id" required
                                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('brand_id') border-red-500 @enderror">
                                        <option value="">Chọn thương hiệu</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Trạng thái hoạt động -->
                                {{-- <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-gray-700 font-medium">Kích hoạt sản phẩm</span>
                        </label>
                        @error('is_active')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div> --}}

                                <div class="mb-3">
                                    <label for="is_active" class="block text-gray-700 font-medium mb-1">Trạng Thái
                                        <span class="text-red-500">*</span></label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_active"
                                            id="active1" value="1"
                                            {{ old('is_active', $product->is_active) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="active1">Kích hoạt</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_active"
                                            id="active0" value="0"
                                            {{ old('is_active', $product->is_active) == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="active0">Ngưng hoạt động</label>
                                    </div>
                                    @error('is_active')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Nút điều hướng -->
                                <div class="flex justify-between">
                                    <a href="{{ route('admin.products.index') }}"
                                        class="bg-gray-500 hover:bg-gray-600 text-white font-medium px-6 py-2 rounded transition duration-200">
                                        Quay lại
                                    </a>
                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded transition duration-200">
                                        Cập nhật sản phẩm
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>


</x-app-layout>

<script>
    // Tự động tạo slug từ tên sản phẩm
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

    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('fileUpload');
        const previewContainer = document.getElementById('image-preview-container');

        if (fileInput && previewContainer) {
            fileInput.addEventListener('change', function(event) {
                previewContainer.innerHTML = ''; // Xóa nội dung mặc định
                const files = event.target.files;

                if (files.length === 0) {
                    previewContainer.innerHTML =
                        '<p class="col-span-full text-center self-center text-gray-400 italic">Chưa có ảnh nào được chọn</p>';
                    return;
                }

                for (const file of files) {
                    if (!file.type.startsWith('image/')) continue;
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('w-full', 'h-24', 'object-cover', 'rounded-lg', 'border');
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
