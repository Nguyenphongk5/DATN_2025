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