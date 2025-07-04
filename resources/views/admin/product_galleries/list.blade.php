<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Thư viện ảnh') }}
        </h2>
    </x-slot>
    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    <div class="py-12">
        <h1 class="font-semibold text-gray-800 leading-tight"
            style="text-align: center; margin: 0 0 2rem 0; font-size: 2rem;">
            {{ __('Quản lý thư viện ảnh') }}
        </h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <section>
                            <div class="flex justify-between gap-6 flex-col xl:flex-row">
                                <div class="flex flex-col gap-[10px] lg:gap-[27px] xl:w-[25%] md:flex-row xl:flex-col">
                                    <form action="{{ route('admin.products-galleries.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div
                                            class="border bg-neutral-bg border-neutral dark:bg-dark-neutral-bg dark:border-dark-neutral-border rounded-2xl pb-5 flex-1 px-[28px] pt-[35px]">
                                            <div class="mb-4 text-center">
                                                {{-- <p>Sẽ thêm ảnh cho sản phẩm:</p>
                                                <strong id="selected_product_name" class="text-blue-600">Chưa chọn sản
                                                    phẩm</strong>
                                                <label for="countries"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sẽ
                                                    thêm ảnh cho sản phẩm:</label>
                                                <input type="hidden" name="product_id" id="product_id_input"> --}}
                                                <select id="countries" name="product_id"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option selected>Chọn sản phẩm</option>
                                                    @foreach ($products as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
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
                                                <input type="file" id="fileUpload" class="d-none" name="image[]"
                                                    multiple>

                                                {{-- Lỗi cho cả mảng (ví dụ: bắt buộc phải chọn file) --}}
                                                @error('image')
                                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                @enderror
                                                {{-- Lỗi cho từng file bên trong mảng (ví dụ: sai định dạng, quá dung
                                                lượng) --}}
                                                @error('image.*')
                                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                @enderror
                                            </label>
                                            <button type="submit" class="btn btn-outline-success mb-3 text-center">Thêm
                                                ảnh</button>
                                            <div class="flex flex-col mb-12 gap-y-[10px]">
                                                <div id="image-preview-container" class="flex flex-col gap-y-3">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div
                                    class="rounded-2xl border border-neutral bg-neutral-bg dark:border-dark-neutral-border dark:bg-dark-neutral-bg overflow-x-scroll scrollbar-hide flex-1 px-[28px] pt-[33px] pb-[23px]">
                                    <div class="w-full bg-neutral h-[1px] mb-[10px] dark:bg-dark-neutral-border"></div>
                                    <table class="w-full min-w-[800px] lg:min-w-fit">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @dd($product['name']) --}}
                                            @foreach ($galleries as $value)
                                                <tr>
                                                    <td>
                                                        <input class="checkbox checkbox-primary product-select-checkbox"
                                                            {{-- Thêm class này --}} type="checkbox"
                                                            data-product-id="{{ $value->product->id }}" {{-- Thêm
                                                            data-product-id --}}
                                                            data-product-name="{{ $value->product->name }}">
                                                        {{-- Thêm data-product-name --}}
                                                    </td>
                                                    <td class="py-[10px]">
                                                        <div class="flex items-center gap-[13px]"><img class="mr-2"
                                                                src="{{ asset('storage/' . $value->image) }}" width="50"
                                                                alt="pdf icon">
                                                            <div class="flex flex-col gap-y-[5px]">
                                                                <h4
                                                                    class="font-semibold leading-4 text-gray-1100 text-[14px] dark:text-gray-dark-1100">
                                                                    {{ $value->product->name }}
                                                                </h4>
                                                                <time
                                                                    class="text-xs text-gray-400 dark:text-gray-dark-400">{{ $value->created_at->format('d/m/Y H:i') }}</time>
                                                                <time
                                                                    class="text-xs text-gray-400 dark:text-gray-dark-400">{{ $value->updated_at->format('d/m/Y H:i') }}</time>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="flex items-center gap-[10px]">
                                                            <button type="button"
                                                                class="edit-modal-btn btn btn-outline-warning"
                                                                data-gallery-id="{{ $value->id }}"
                                                                data-update-url="{{ route('admin.products-galleries.update', $value->id) }}"
                                                                data-product-id="{{ $value->product->id }}"
                                                                data-image-url="{{ asset('storage/' . $value->image) }}">
                                                                Sửa
                                                            </button>

                                                            <form
                                                                action="{{ route('admin.products-galleries.destroy', $value->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa ảnh này không?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-outline-danger">
                                                                    Xóa
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        </section>
                    </div>
                    <div class="mt-6">
                        {{ $galleries->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
<div id="editModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-lg p-6 m-4">
        <div class="flex justify-between items-center border-b pb-3">
            <h3 class="text-xl font-semibold">Chỉnh sửa ảnh</h3>
            <button id="closeModalBtn" class="text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
        </div>

        <div class="mt-4">
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Bắt buộc cho việc update --}}

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Ảnh hiện tại:</label>
                    <img id="editImagePreview" src="" alt="Ảnh hiện tại" class="mt-2 h-32 w-auto rounded-md border">
                </div>

                <div class="mb-4">
                    <label for="editImageInput" class="block text-sm font-medium text-gray-700">Thay đổi ảnh (để trống
                        nếu không muốn đổi)</label>
                    <input type="file" name="image" id="editImageInput"
                        class="block w-full text-sm mt-1 border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="editProductId" class="block text-sm font-medium text-gray-700">Sản phẩm liên kết</label>
                    <select id="editProductId" name="product_id" class="block w-full mt-1 border-gray-300 rounded-md">
                        {{-- Options sẽ được thêm bằng JavaScript --}}
                    </select>
                </div>

                <div class="flex justify-end gap-4 mt-6">
                    <button type="button" id="cancelModalBtn"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Hủy</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Cập
                        nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Lấy các phần tử cần thiết từ DOM
        const checkboxes = document.querySelectorAll('.product-select-checkbox');
        const hiddenInput = document.getElementById('product_id_input');
        const displayName = document.getElementById('selected_product_name');

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                // Nếu checkbox này được tick
                if (this.checked) {
                    // Bỏ tick tất cả các checkbox khác
                    checkboxes.forEach(function (otherCheckbox) {
                        if (otherCheckbox !== this) {
                            otherCheckbox.checked = false;
                        }
                    }, this);

                    // Lấy ID và tên sản phẩm từ data attributes
                    const productId = this.dataset.productId;
                    const productName = this.dataset.productName;

                    // Cập nhật giá trị cho form upload
                    hiddenInput.value = productId;
                    displayName.textContent = productName;

                } else {
                    // Nếu người dùng bỏ tick, xóa giá trị
                    hiddenInput.value = '';
                    displayName.textContent = 'Chưa chọn sản phẩm';
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.getElementById('fileUpload');
        const previewContainer = document.getElementById('image-preview-container');

        // DataTransfer sẽ giúp chúng ta quản lý danh sách file (thêm/xóa)
        let fileListContainer = new DataTransfer();

        // Lắng nghe sự kiện khi người dùng chọn file
        fileInput.addEventListener('change', function (event) {
            const files = event.target.files;

            // Thêm các file mới chọn vào danh sách quản lý
            for (let i = 0; i < files.length; i++) {
                fileListContainer.items.add(files[i]);
            }

            // Cập nhật lại danh sách file trong input và hiển thị preview
            updateFileInputAndPreviews();
        });

        // Dùng event delegation để xử lý sự kiện click nút xóa
        previewContainer.addEventListener('click', function (event) {
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

                reader.onload = function (e) {
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
    
    // Lấy tất cả sản phẩm từ PHP và chuyển thành JSON cho JS sử dụng
    const allProducts = @json(
        $products->map(function ($product) {
            return ['id' => $product->id, 'name' => $product->name];
        })
    );

    document.addEventListener('DOMContentLoaded', function () {
        // === Các yếu tố của Modal ===
        const editModal = document.getElementById('editModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const cancelModalBtn = document.getElementById('cancelModalBtn');
        const editForm = document.getElementById('editForm');
        const editImagePreview = document.getElementById('editImagePreview');
        const editProductIdSelect = document.getElementById('editProductId');
        const editImageInput = document.getElementById('editImageInput'); // << Thêm dòng này

        // === Các nút Sửa trong bảng ===
        const editButtons = document.querySelectorAll('.edit-modal-btn');

        // ... (code mở và đóng modal giữ nguyên) ...

        function openModal() {
            editModal.classList.remove('hidden');
        }

        function closeModal() {
            editModal.classList.add('hidden');
        }

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                // ... (code điền dữ liệu vào modal giữ nguyên) ...
                const updateUrl = this.dataset.updateUrl;
                const imageUrl = this.dataset.imageUrl;
                const currentProductId = this.dataset.productId;
                editForm.action = updateUrl;
                editImagePreview.src = imageUrl;
                editProductIdSelect.innerHTML = '';
                allProducts.forEach(product => {
                    const option = document.createElement('option');
                    option.value = product.id;
                    option.textContent = product.name;
                    if (product.id == currentProductId) {
                        option.selected = true;
                    }
                    editProductIdSelect.appendChild(option);
                });

                openModal();
            });
        });

        // === BẮT ĐẦU PHẦN CODE MỚI ===
        // Lắng nghe sự kiện khi người dùng chọn file mới trong modal
        editImageInput.addEventListener('change', function (event) {
            // Kiểm tra xem người dùng có thực sự chọn file không
            if (event.target.files && event.target.files[0]) {
                const file = event.target.files[0];

                // Tạo một URL tạm thời cho file vừa chọn
                const newImageUrl = URL.createObjectURL(file);

                // Cập nhật ảnh preview bằng URL tạm thời đó
                editImagePreview.src = newImageUrl;
            }
        });
        // === KẾT THÚC PHẦN CODE MỚI ===

        closeModalBtn.addEventListener('click', closeModal);
        cancelModalBtn.addEventListener('click', closeModal);
        editModal.addEventListener('click', function (event) {
            if (event.target === editModal) {
                closeModal();
            }
        });
    });


</script>