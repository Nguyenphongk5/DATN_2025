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
                <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- ID (readonly) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">ID</label>
                        <input type="text" value="{{ $product->id }}" readonly
                            class="w-full border border-gray-300 rounded px-4 py-2 bg-gray-100">
                    </div>

                    <!-- Tên sản phẩm -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-1">Tên sản phẩm <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('name') border-red-500 @enderror"
                            placeholder="Nhập tên sản phẩm">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="mb-4">
                        <label for="slug" class="block text-gray-700 font-medium mb-1">Slug <span class="text-red-500">*</span></label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $product->slug) }}" required
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
                                     alt="{{ $product->name }}"
                                     class="w-32 h-32 object-cover rounded" width="200px">
                                <p class="text-sm text-gray-600 mt-2">{{ $product->img_thumb }}</p>
                            </div>
                        @else
                            <p class="text-gray-400 italic">Không có hình ảnh</p>
                        @endif
                    </div>

                    <!-- Hình ảnh thumbnail mới -->
                    <div class="mb-4">
                        <label for="img_thumb" class="block text-gray-700 font-medium mb-1">Cập nhật hình ảnh</label>
                        <input type="file" id="img_thumb" name="img_thumb" accept="image/*"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('img_thumb') border-red-500 @enderror">
                        <p class="text-sm text-gray-500 mt-1">Để trống nếu không muốn thay đổi hình ảnh</p>
                        @error('img_thumb')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Hình ảnh gallery hiện tại -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Hình ảnh gallery hiện tại</label>
                        @if($product->galleries && $product->galleries->count() > 0)
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                @foreach($product->galleries as $gallery)
                                    <div class="relative border rounded-lg p-2 bg-gray-50">
                                        <img src="{{ asset('storage/' . $gallery->image) }}"
                                             alt="Gallery image"
                                             class="w-full h-24 object-cover rounded">
                                        <button type="button" 
                                                onclick="deleteGalleryImage({{ $gallery->id }})"
                                                class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                                            ×
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-400 italic">Không có hình ảnh gallery</p>
                        @endif
                    </div>

                    <!-- Thêm ảnh gallery mới -->
                    <div class="mb-4">
                        <label for="gallery_images" class="block text-gray-700 font-medium mb-1">Thêm ảnh gallery mới</label>
                        <input type="file" id="gallery_images" name="gallery_images[]" accept="image/*" multiple
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('gallery_images.*') border-red-500 @enderror"
                            onchange="validateGalleryImages(this)">
                        <p class="text-sm text-gray-500 mt-1">Có thể chọn nhiều ảnh cùng lúc. Hỗ trợ: JPG, PNG, GIF, SVG (tối đa 2MB mỗi ảnh)</p>
                        <p class="text-sm text-red-500 mt-1">⚠️ <strong>Giới hạn:</strong> Tối đa 6 ảnh gallery cho mỗi sản phẩm (hiện tại có {{ $product->galleries->count() }} ảnh)</p>
                        @error('gallery_images.*')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <div id="gallery-preview" class="mt-3 grid grid-cols-3 gap-2"></div>
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
                        <label for="price" class="block text-gray-700 font-medium mb-1">Giá gốc <span class="text-red-500">*</span></label>
                        <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('price') border-red-500 @enderror"
                            placeholder="0.00">
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Giá khuyến mãi -->
                    <div class="mb-4">
                        <label for="price_sale" class="block text-gray-700 font-medium mb-1">Giá khuyến mãi</label>
                        <input type="number" id="price_sale" name="price_sale" value="{{ old('price_sale', $product->price_sale) }}" step="0.01" min="0"
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
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                                <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
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
                        <label for="is_active" class="block text-gray-700 font-medium mb-1">Trạng Thái <span class="text-red-500">*</span></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_active" id="active1"
                                value="1" {{ old('is_active', $product->is_active) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="active1">Kích hoạt</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_active" id="active0"
                                value="0" {{ old('is_active', $product->is_active) == 0 ? 'checked' : '' }}>
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
                </form>
            </div>
        </div>
    </div>

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

        // Xóa ảnh gallery
        function deleteGalleryImage(galleryId) {
            if (confirm('Bạn có chắc chắn muốn xóa ảnh này?')) {
                fetch(`/admin/gallery/${galleryId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Xóa phần tử khỏi DOM
                        const element = document.querySelector(`[onclick="deleteGalleryImage(${galleryId})"]`).parentElement.parentElement;
                        element.remove();
                        
                        // Cập nhật thông báo số lượng ảnh
                        updateGalleryCount();
                        
                        // Kiểm tra nếu không còn ảnh nào thì hiển thị thông báo
                        const galleryContainer = document.querySelector('.grid');
                        if (galleryContainer && galleryContainer.children.length === 0) {
                            galleryContainer.parentElement.innerHTML = '<p class="text-gray-400 italic">Không có hình ảnh gallery</p>';
                        }
                    } else {
                        alert('Có lỗi xảy ra khi xóa ảnh');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi xóa ảnh');
                });
            }
        }

        // Validate gallery images for edit form
        function validateGalleryImages(input) {
            const files = input.files;
            const maxFiles = 6;
            const currentGalleryCount = {{ $product->galleries->count() }};
            const remainingSlots = maxFiles - currentGalleryCount;
            const previewContainer = document.getElementById('gallery-preview');
            
            // Clear previous preview
            previewContainer.innerHTML = '';
            
            if (files.length > remainingSlots) {
                alert(`Chỉ có thể thêm tối đa ${remainingSlots} ảnh nữa. Hiện tại có ${currentGalleryCount} ảnh, tổng cộng không được vượt quá ${maxFiles} ảnh.`);
                input.value = '';
                return;
            }
            
            // Preview selected images
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const previewDiv = document.createElement('div');
                    previewDiv.className = 'relative border rounded p-2 bg-gray-50';
                    
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-full h-20 object-cover rounded';
                    img.alt = 'Preview';
                    
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-600';
                    removeBtn.innerHTML = '×';
                    removeBtn.onclick = function() {
                        previewDiv.remove();
                        // Remove file from input
                        const dt = new DataTransfer();
                        const input = document.getElementById('gallery_images');
                        const { files } = input;
                        
                        for (let i = 0; i < files.length; i++) {
                            if (i !== Array.from(previewContainer.children).indexOf(previewDiv)) {
                                dt.items.add(files[i]);
                            }
                        }
                        input.files = dt.files;
                    };
                    
                    previewDiv.appendChild(img);
                    previewDiv.appendChild(removeBtn);
                    previewContainer.appendChild(previewDiv);
                };
                
                reader.readAsDataURL(file);
            }
        }

        // Update gallery count display
        function updateGalleryCount() {
            const currentCount = document.querySelectorAll('.thumbnail-item').length;
            const maxCount = 6;
            const remainingSlots = maxCount - currentCount;
            
            // Cập nhật thông báo
            const limitText = document.querySelector('.text-red-500.mt-1');
            if (limitText) {
                limitText.innerHTML = `⚠️ <strong>Giới hạn:</strong> Tối đa 6 ảnh gallery cho mỗi sản phẩm (hiện tại có ${currentCount} ảnh)`;
            }
            
            // Disable input nếu đã đạt giới hạn
            const galleryInput = document.getElementById('gallery_images');
            if (remainingSlots <= 0) {
                galleryInput.disabled = true;
                galleryInput.placeholder = 'Đã đạt giới hạn tối đa 6 ảnh';
            } else {
                galleryInput.disabled = false;
                galleryInput.placeholder = '';
            }
        }

        // Initialize gallery count on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateGalleryCount();
        });
    </script>
</x-app-layout>
