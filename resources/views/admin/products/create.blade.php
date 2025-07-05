<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý sản phẩm') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h1 class="font-semibold text-gray-800 leading-tight"
            style="text-align: center; margin: 0 0 2rem 0; font-size: 2rem;">
            {{ __('Thêm sản phẩm mới') }}
        </h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <section>
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="flex justify-between gap-6 flex-col xl:flex-row">
                            <div class="flex flex-col gap-[10px] lg:gap-[27px] xl:w-[25%] md:flex-row xl:flex-col">

                                <div
                                    class="border bg-neutral-bg border-neutral dark:bg-dark-neutral-bg dark:border-dark-neutral-border rounded-2xl pb-5 flex-1 px-[28px] pt-[35px]">
                                    <div class="mb-4 text-center">
                                        @error('product_id')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <label for="fileUpload"
                                        class="border-dashed border-2 text-center mb-12 border-neutral py-[26px] dark:border-dark-neutral-border">
                                        Thêm ảnh <br>
                                        <i class="fa-solid fa-image"></i>
                                        <p class="text-sm leading-6 text-gray-500 font-normal mb-[5px]">Drop
                                            your
                                            image here, or browse</p>
                                        <p class="leading-6 text-gray-400 text-[13px]">JPG,PNG and GIF files are
                                            allowed</p>
                                        <input type="file" id="fileUpload" class="d-none" name="image[]" multiple>

                                        {{-- Lỗi cho cả mảng (ví dụ: bắt buộc phải chọn file) --}}
                                        @error('image')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                        {{-- Lỗi cho từng file bên trong mảng (ví dụ: sai định dạng, quá dung lượng) --}}
                                        @error('image.*')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </label>
                                    <div class="flex flex-col mb-12 gap-y-[10px]">
                                        <div id="image-preview-container" class="flex flex-col gap-y-3">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div
                                class="rounded-2xl border border-neutral bg-neutral-bg dark:border-dark-neutral-border dark:bg-dark-neutral-bg scrollbar-hide flex-1 px-[28px] pt-[33px] pb-[23px]">
                                <div class="w-full bg-neutral h-[1px] mb-[10px] dark:bg-dark-neutral-border"></div>


                                <!-- Tên sản phẩm -->
                                <div class="mb-4">
                                    <label for="name" class="block text-gray-700 font-medium mb-1">Tên sản phẩm
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                                        required
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
                                    <input type="text" id="slug" name="slug" value="{{ old('slug') }}"
                                        required
                                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('slug') border-red-500 @enderror"
                                        placeholder="ten-san-pham">
                                    @error('slug')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Hình ảnh thumbnail -->
                                <div class="mb-4">
                                    <label for="img_thumb" class="block text-gray-700 font-medium mb-1">Hình ảnh
                                        thumbnail <span class="text-red-500">*</span></label>
                                    <input type="file" id="img_thumb" name="img_thumb" accept="image/*" required
                                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('img_thumb') border-red-500 @enderror">
                                    @error('img_thumb')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Mô tả -->
                                <div class="mb-4">
                                    <label for="description" class="block text-gray-700 font-medium mb-1">Mô tả</label>
                                    <textarea id="description" name="description" rows="4"
                                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500 @error('description') border-red-500 @enderror"
                                        placeholder="Nhập mô tả sản phẩm">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Giá gốc -->
                                <div class="mb-4">
                                    <label for="price" class="block text-gray-700 font-medium mb-1">Giá gốc <span
                                            class="text-red-500">*</span></label>
                                    <input type="number" id="price" name="price" value="{{ old('price') }}"
                                        step="0.01" min="0" required
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
                                        value="{{ old('price_sale') }}" step="0.01" min="0"
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
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                                {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
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
                                        Thêm sản phẩm
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

        // DataTransfer sẽ giúp chúng ta quản lý danh sách file (thêm/xóa)
        let fileListContainer = new DataTransfer();

        // Lắng nghe sự kiện khi người dùng chọn file
        fileInput.addEventListener('change', function(event) {
            const files = event.target.files;

            // Thêm các file mới chọn vào danh sách quản lý
            for (let i = 0; i < files.length; i++) {
                fileListContainer.items.add(files[i]);
            }

            // Cập nhật lại danh sách file trong input và hiển thị preview
            updateFileInputAndPreviews();
        });

        // Dùng event delegation để xử lý sự kiện click nút xóa
        previewContainer.addEventListener('click', function(event) {
            // Chỉ hoạt động khi click vào phần tử có class 'remove-btn'
            if (event.target && event.target.classList.contains('remove-btn')) {
                const indexToRemove = parseInt(event.target.dataset.index, 10);

                // Xóa file khỏi danh sách quản lý
                fileListContainer.items.remove(indexToRemove);

                // Cập nhật lại input và preview sau khi xóa
                updateFileInputAndPreviews();
            }
        });

        function updateFileInputAndPreviews() {
            // Xóa các preview cũ
            previewContainer.innerHTML = '';

            // Lấy danh sách file hiện tại từ DataTransfer
            const currentFiles = fileListContainer.files;

            // Gán lại danh sách file đã được cập nhật vào input
            fileInput.files = currentFiles;

            // Tạo và hiển thị preview cho từng file trong danh sách
            for (let i = 0; i < currentFiles.length; i++) {
                const file = currentFiles[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Tạo HTML cho mỗi item preview
                    const previewItemHTML = `
                        <div class="flex items-center justify-between py-2 border pl-3 pr-3 transition-all duration-300 border-[#E8EDF2] dark:border-[#313442] rounded-[5px] gap-x-[10px] hover:shadow-sm">
                            <img class="h-12 w-12 object-cover rounded" src="${e.target.result}" alt="${file.name}">
                            <div class="flex-1 flex flex-col min-w-0">
                                <span class="text-sm text-gray-800 dark:text-gray-200 truncate font-medium">${file.name}</span>
                                <span class="text-xs text-gray-500">${(file.size / 1024).toFixed(2)} KB</span>
                            </div>
                            <button type="button" class="remove-btn text-red-500 hover:text-red-700 font-bold text-2xl p-1" data-index="${i}">&times;</button>
                        </div>
                    `;
                    previewContainer.innerHTML += previewItemHTML;
                }

                reader.readAsDataURL(file);
            }
        }
    });
</script>
