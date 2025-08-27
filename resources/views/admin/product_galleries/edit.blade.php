<x-app-layout>
    <x-slot name="header">
        <div
            class="flex items-center gap-3 bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-edit text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Chỉnh sửa ảnh sản phẩm</h2>
        </div>
    </x-slot>
    
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-xl p-6 mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-purple-600 to-pink-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-edit text-white text-xl"></i>
                            </div>
                            <div>
                                <h1
                                    class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                                    Chỉnh sửa ảnh sản phẩm
                                </h1>
                                <p class="text-gray-600">Cập nhật thông tin và ảnh cho sản phẩm</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 text-sm text-gray-500">
                            <span class="flex items-center gap-1">
                                <i class="fas fa-box text-purple-500"></i>
                                {{ $product->name }}
                            </span>
                            <span class="flex items-center gap-1">
                                <i class="fas fa-image text-blue-500"></i>
                                Ảnh #{{ $gallery->sort_order }}
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('admin.products.galleries.index', $product->id) }}"
                            class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl transition-all duration-200 font-medium">
                            <i class="fas fa-arrow-left"></i>
                            Quay lại
                        </a>
                    </div>
                </div>
            </div>

            <!-- Notification Messages -->
            @if (session('success'))
                <div class="mb-6 transform transition-all duration-500 ease-out">
                    <div
                        class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-2xl shadow-lg border border-green-400/30 backdrop-blur-sm">
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 transform transition-all duration-500 ease-out">
                    <div
                        class="bg-gradient-to-r from-red-500 to-pink-600 text-white px-6 py-4 rounded-2xl shadow-lg border border-red-400/30 backdrop-blur-sm">
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Form Section -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="p-6">
                    <form action="{{ route('admin.products.galleries.update', [$product->id, $gallery->id]) }}"
                        method="POST" enctype="multipart/form-data" id="editForm">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Left Column - Image Section -->
                            <div class="space-y-6">
                                <!-- Current Image Preview -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">
                                        <i class="fas fa-image mr-2 text-purple-500"></i>
                                        Ảnh hiện tại
                                    </label>
                                    <div class="relative group">
                                        <div class="border-2 border-gray-200 rounded-xl overflow-hidden shadow-lg">
                                            <img src="{{ asset('storage/product_galleries/' . $gallery->image) }}"
                                                alt="{{ $gallery->alt_text ?? $product->name }}"
                                                class="w-full h-80 object-cover transition-transform duration-300 group-hover:scale-105">
                                        </div>
                                        <div class="absolute top-3 right-3">
                                            <span class="bg-gradient-to-r from-blue-600 to-purple-600 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">
                                                #{{ $gallery->sort_order }}
                                            </span>
                                        </div>
                                        <div class="absolute bottom-3 left-3">
                                            @if ($gallery->is_active)
                                                <span class="bg-gradient-to-r from-green-500 to-emerald-600 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">
                                                    <i class="fas fa-eye mr-1"></i>Active
                                                </span>
                                            @else
                                                <span class="bg-gradient-to-r from-gray-500 to-gray-600 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">
                                                    <i class="fas fa-eye-slash mr-1"></i>Inactive
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Upload New Image -->
                                <div>
                                    <label for="imageInput" class="block text-sm font-medium text-gray-700 mb-3">
                                        <i class="fas fa-image mr-2 text-blue-500"></i>
                                        Thay đổi ảnh (tùy chọn)
                                    </label>
                                    <div class="border-2 border-gray-300 rounded-xl p-4 transition-all duration-300 hover:border-purple-400 hover:bg-purple-50">
                                        <input type="file" name="image" id="imageInput" accept="image/*"
                                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                                        <p class="text-xs text-gray-500 mt-2">Hỗ trợ: JPG, PNG, GIF, WEBP (Tối đa 2MB)</p>
                                    </div>
                                    <div id="newImagePreview" class="mt-4 hidden">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            <i class="fas fa-eye mr-2 text-green-500"></i>
                                            Ảnh mới:
                                        </label>
                                        <div class="relative">
                                            <img id="previewImg" class="w-full h-80 object-cover rounded-xl border-2 border-green-300 shadow-lg">
                                            <button type="button" onclick="removeNewImage()" 
                                                class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white p-2 rounded-full shadow-lg transition-colors">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('image')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Right Column - Form Fields -->
                            <div class="space-y-6">
                                <!-- Alt Text -->
                                <div>
                                    <label for="alt_text" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-tag mr-2 text-green-500"></i>
                                        Mô tả ảnh (Alt text)
                                    </label>
                                    <input type="text" name="alt_text" id="alt_text"
                                        value="{{ old('alt_text', $gallery->alt_text) }}" 
                                        placeholder="Mô tả ảnh để tối ưu SEO"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200">
                                    <p class="text-sm text-gray-500 mt-1">Mô tả ngắn gọn về ảnh để tối ưu SEO</p>
                                    @error('alt_text')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Sort Order -->
                                <div>
                                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-sort-numeric-up mr-2 text-orange-500"></i>
                                        Thứ tự hiển thị
                                    </label>
                                    <input type="number" name="sort_order" id="sort_order"
                                        value="{{ old('sort_order', $gallery->sort_order) }}" min="0"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200">
                                    <p class="text-sm text-gray-500 mt-1">Số càng nhỏ hiển thị càng trước</p>
                                    @error('sort_order')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Active Status -->
                                <div>
                                    <label class="flex items-center p-4 bg-gray-50 rounded-xl border border-gray-200 hover:border-purple-300 transition-all duration-200">
                                        <input type="checkbox" name="is_active" value="1"
                                            {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}
                                            class="w-5 h-5 rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                                        <span class="ml-3 text-sm font-medium text-gray-700">
                                            <i class="fas fa-eye mr-2 text-purple-500"></i>
                                            Kích hoạt ảnh này
                                        </span>
                                    </label>
                                    <p class="text-sm text-gray-500 mt-1">Ảnh sẽ được hiển thị cho khách hàng</p>
                                </div>

                                <!-- File Info -->
                                <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                                    <h4 class="font-medium text-blue-900 mb-2">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Thông tin file
                                    </h4>
                                    <div class="space-y-1 text-sm text-blue-800">
                                        <p><strong>Tên file:</strong> {{ $gallery->image }}</p>
                                        <p><strong>Ngày tạo:</strong> {{ $gallery->created_at->format('d/m/Y H:i') }}</p>
                                        <p><strong>Cập nhật lần cuối:</strong> {{ $gallery->updated_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.products.galleries.index', $product->id) }}"
                                class="inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-xl transition-all duration-200 font-medium">
                                <i class="fas fa-times"></i>
                                Hủy bỏ
                            </a>
                            <button type="submit" id="submitBtn"
                                class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-8 py-3 rounded-xl transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:scale-105">
                                <i class="fas fa-save"></i>
                                Cập nhật ảnh
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const imageInput = document.getElementById('imageInput');
                const newImagePreview = document.getElementById('newImagePreview');
                const previewImg = document.getElementById('previewImg');
                const form = document.getElementById('editForm');
                const submitBtn = document.getElementById('submitBtn');

                // File input change
                imageInput.addEventListener('change', handleFile);

                function handleFile(e) {
                    const file = e.target.files[0];

                    if (!file) {
                        newImagePreview.classList.add('hidden');
                        return;
                    }

                    // Validate file
                    if (!file.type.startsWith('image/')) {
                        alert('File phải là ảnh');
                        imageInput.value = '';
                        return;
                    }

                    if (file.size > 2 * 1024 * 1024) {
                        alert('File quá lớn (tối đa 2MB)');
                        imageInput.value = '';
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

                // Remove new image
                window.removeNewImage = function() {
                    imageInput.value = '';
                    newImagePreview.classList.add('hidden');
                }

                // Form submission
                form.addEventListener('submit', function(e) {
                    // Show loading state
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Đang cập nhật...';
                    submitBtn.disabled = true;
                });
            });
        </script>
    @endpush
</x-app-layout>
