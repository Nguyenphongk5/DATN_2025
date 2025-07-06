@extends('layouts.app')

@section('title', 'Chỉnh sửa ảnh sản phẩm - ' . $product->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Chỉnh sửa ảnh sản phẩm</h1>
                <p class="text-gray-600 mt-2">{{ $product->name }}</p>
            </div>
            <a href="{{ route('admin.products.galleries.index', $product->id) }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Quay lại
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md">
            <div class="p-6">
                <form action="{{ route('admin.products.galleries.update', [$product->id, $gallery->id]) }}" 
                      method="POST" 
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Current Image Preview -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Ảnh hiện tại
                        </label>
                        <div class="border rounded-lg p-4">
                            <img src="{{ asset('storage/product_galleries/' . $gallery->image) }}" 
                                 alt="{{ $gallery->alt_text ?? $product->name }}"
                                 class="w-full h-64 object-cover rounded">
                        </div>
                    </div>

                    <!-- Upload New Image -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Thay đổi ảnh (tùy chọn)
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center" 
                             id="dropZone">
                            <div id="uploadArea">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-600 mb-2">Kéo thả ảnh vào đây hoặc click để chọn</p>
                                <p class="text-sm text-gray-500">Hỗ trợ: JPG, PNG, GIF, WEBP (Tối đa 2MB)</p>
                                <input type="file" 
                                       name="image" 
                                       id="imageInput" 
                                       accept="image/*" 
                                       class="hidden">
                            </div>
                        </div>
                        <div id="newImagePreview" class="mt-4 hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Ảnh mới:
                            </label>
                            <img id="previewImg" class="w-full h-64 object-cover rounded border">
                        </div>
                    </div>

                    <!-- Alt Text -->
                    <div class="mb-6">
                        <label for="alt_text" class="block text-sm font-medium text-gray-700 mb-2">
                            Mô tả ảnh (Alt text)
                        </label>
                        <input type="text" 
                               name="alt_text" 
                               id="alt_text" 
                               value="{{ old('alt_text', $gallery->alt_text) }}"
                               placeholder="Mô tả ảnh để tối ưu SEO"
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('alt_text')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sort Order -->
                    <div class="mb-6">
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                            Thứ tự hiển thị
                        </label>
                        <input type="number" 
                               name="sort_order" 
                               id="sort_order" 
                               value="{{ old('sort_order', $gallery->sort_order) }}"
                               min="0"
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <p class="text-sm text-gray-500 mt-1">Số càng nhỏ hiển thị càng trước</p>
                        @error('sort_order')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Active Status -->
                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" 
                                   name="is_active" 
                                   value="1"
                                   {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Kích hoạt ảnh này</span>
                        </label>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.products.galleries.index', $product->id) }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition-colors">
                            Hủy
                        </a>
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                            <i class="fas fa-save mr-2"></i>Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropZone = document.getElementById('dropZone');
    const imageInput = document.getElementById('imageInput');
    const newImagePreview = document.getElementById('newImagePreview');
    const previewImg = document.getElementById('previewImg');

    // Click to select file
    dropZone.addEventListener('click', () => {
        imageInput.click();
    });

    // File input change
    imageInput.addEventListener('change', handleFile);

    // Drag and drop events
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('border-blue-500', 'bg-blue-50');
    });

    dropZone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        dropZone.classList.remove('border-blue-500', 'bg-blue-50');
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('border-blue-500', 'bg-blue-50');
        
        const files = Array.from(e.dataTransfer.files);
        if (files.length > 0) {
            handleFile({ target: { files: files } });
        }
    });

    function handleFile(e) {
        const file = e.target.files[0];
        
        if (!file) return;
        
        // Validate file
        if (!file.type.startsWith('image/')) {
            alert('File phải là ảnh');
            return;
        }
        
        if (file.size > 2 * 1024 * 1024) {
            alert('File quá lớn (tối đa 2MB)');
            return;
        }

        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            newImagePreview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush 