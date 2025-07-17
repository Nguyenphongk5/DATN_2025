<x-app-layout>
    <x-slot name="header">
        <div
            class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-plus-circle text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Thêm ảnh con sản phẩm</h2>
        </div>
    </x-slot>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Thêm ảnh sản phẩm</h1>
                    <p class="text-gray-600 mt-2">{{ $product->name }}</p>
                </div>
                <a href="{{ route('admin.products.galleries.index', $product->id) }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Quay lại
                </a>
            </div>

            <div class="bg-white rounded-lg shadow-md">
                <div class="p-6">
                    <form action="{{ route('admin.products.galleries.store', $product->id) }}" method="POST"
                        enctype="multipart/form-data" id="galleryForm">
                        @csrf

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Chọn ảnh <span class="text-red-500">*</span>
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center"
                                id="dropZone">
                                <div id="uploadArea">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                    <p class="text-gray-600 mb-2">Kéo thả ảnh vào đây hoặc click để chọn</p>
                                    <p class="text-sm text-gray-500">Hỗ trợ: JPG, PNG, GIF, WEBP (Tối đa 2MB mỗi ảnh)
                                    </p>
                                    <input type="file" name="images[]" id="imageInput" multiple accept="image/*"
                                        class="hidden">
                                </div>
                            </div>
                        </div>

                        <!-- Preview Area -->
                        <div id="previewArea" class="mb-6 hidden">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Ảnh đã chọn:</h3>
                            <div id="imagePreview" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <!-- Preview images will be inserted here -->
                            </div>
                        </div>

                        <div class="flex justify-end gap-3">
                            <a href="{{ route('admin.products.galleries.index', $product->id) }}"
                                class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition-colors">
                                Hủy
                            </a>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                                <i class="fas fa-save mr-2"></i>Lưu ảnh
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
                const dropZone = document.getElementById('dropZone');
                const imageInput = document.getElementById('imageInput');
                const previewArea = document.getElementById('previewArea');
                const imagePreview = document.getElementById('imagePreview');
                const uploadArea = document.getElementById('uploadArea');
                const form = document.getElementById('galleryForm');

                let selectedFiles = [];

                // Click to select files
                dropZone.addEventListener('click', () => {
                    imageInput.click();
                });

                // File input change
                imageInput.addEventListener('change', handleFiles);

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
                    handleFiles({
                        target: {
                            files: files
                        }
                    });
                });

                function handleFiles(e) {
                    const files = Array.from(e.target.files);

                    // Validate files
                    const validFiles = files.filter(file => {
                        if (!file.type.startsWith('image/')) {
                            alert(`File "${file.name}" không phải là ảnh`);
                            return false;
                        }

                        if (file.size > 2 * 1024 * 1024) {
                            alert(`File "${file.name}" quá lớn (tối đa 2MB)`);
                            return false;
                        }

                        return true;
                    });

                    if (validFiles.length === 0) return;

                    // Add to selected files
                    selectedFiles = [...selectedFiles, ...validFiles];

                    // Update preview
                    updatePreview();

                    // Clear input
                    imageInput.value = '';
                }

                function updatePreview() {
                    if (selectedFiles.length === 0) {
                        previewArea.classList.add('hidden');
                        return;
                    }

                    previewArea.classList.remove('hidden');
                    imagePreview.innerHTML = '';

                    selectedFiles.forEach((file, index) => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const previewDiv = document.createElement('div');
                            previewDiv.className = 'relative bg-gray-100 rounded-lg p-4';
                            previewDiv.innerHTML = `
                    <img src="${e.target.result}"
                         alt="${file.name}"
                         class="w-full h-32 object-cover rounded mb-3">
                    <div class="space-y-2">
                        <input type="text"
                               name="alt_text[]"
                               placeholder="Mô tả ảnh (tùy chọn)"
                               class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500">${file.name}</span>
                            <button type="button"
                                    onclick="removeFile(${index})"
                                    class="text-red-500 hover:text-red-700 text-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
                            imagePreview.appendChild(previewDiv);
                        };
                        reader.readAsDataURL(file);
                    });
                }

                // Remove file function
                window.removeFile = function(index) {
                    selectedFiles.splice(index, 1);
                    updatePreview();
                };

                // Form validation
                form.addEventListener('submit', function(e) {
                    if (selectedFiles.length === 0) {
                        e.preventDefault();
                        alert('Vui lòng chọn ít nhất một ảnh');
                        return;
                    }

                    // Create FormData and append files
                    const formData = new FormData();
                    formData.append('_token', document.querySelector('input[name="_token"]').value);

                    selectedFiles.forEach((file, index) => {
                        formData.append(`images[]`, file);
                        const altText = document.querySelector(
                            `input[name="alt_text[]"]:nth-of-type(${index + 1})`);
                        if (altText) {
                            formData.append(`alt_text[]`, altText.value);
                        } else {
                            formData.append(`alt_text[]`, '');
                        }
                    });

                    // Submit form
                    fetch(form.action, {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.text())
                        .then(html => {
                            // Handle response
                            if (html.includes('success')) {
                                window.location.href =
                                    '{{ route('admin.products.galleries.index', $product->id) }}';
                            } else {
                                // Show errors
                                document.body.innerHTML = html;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Có lỗi xảy ra khi upload ảnh');
                        });

                    e.preventDefault();
                });
            });
        </script>
    @endpush
</x-app-layout>
