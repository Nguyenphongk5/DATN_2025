<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý thương hiệu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h1 class="font-semibold text-gray-800 leading-tight" style="text-align: center; margin: 0 0 2rem 0; font-size: 2rem;">
            {{ __('Chi tiết thương hiệu') }}
        </h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Hình ảnh thương hiệu -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Hình ảnh thương hiệu</h3>
                            @if ($brand->logo)
                                <div class="border rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/' . $brand->logo) }}"
                                         alt="{{ $brand->name }}"
                                         class="w-50 h-64 object-cover">
                                </div>
                            @else
                                <div class="border rounded-lg h-64 bg-gray-100 flex items-center justify-center">
                                    <span class="text-gray-400 italic">Không có hình ảnh</span>
                                </div>
                            @endif
                        </div>

                        <!-- Thông tin thương hiệu -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Thông tin thương hiệu</h3>

                            <div class="space-y-4">
                                <!-- ID -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">ID:</span>
                                    <span class="text-gray-900">{{ $brand->id }}</span>
                                </div>

                                <!-- Tên thương hiệu -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Tên thương hiệu:</span>
                                    <span class="text-gray-900">{{ $brand->name }}</span>
                                </div>

                                <!-- Slug -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Slug:</span>
                                    <span class="text-gray-900">{{ $brand->slug }}</span>
                                </div>

                                {{-- <!-- Danh mục -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Danh mục:</span>
                                    <span class="text-gray-900">{{ $brand->category_name ?? 'N/A' }}</span>
                                </div>

                                <!-- Thương hiệu -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Thương hiệu:</span>
                                    <span class="text-gray-900">{{ $brand->brand_name ?? 'N/A' }}</span>
                                </div>

                                <!-- Giá gốc -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Giá gốc:</span>
                                    <span class="text-gray-900 font-semibold">{{ number_format($brand->price, 0, ',', '.') }} VNĐ</span>
                                </div>

                                <!-- Giá khuyến mãi -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Giá khuyến mãi:</span>
                                    @if ($brand->price_sale)
                                        <span class="text-red-600 font-semibold">{{ number_format($brand->price_sale, 0, ',', '.') }} VNĐ</span>
                                    @else
                                        <span class="text-gray-400 italic">Không có</span>
                                    @endif
                                </div>

                                <!-- Lượt xem -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Lượt xem:</span>
                                    <span class="text-gray-900">{{ number_format($brand->view) }}</span>
                                </div> --}}

                                <!-- Trạng thái -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Trạng thái:</span>
                                    @if ($brand->is_active === 1)
                                        <span class="text-green-600 font-semibold">Đang hoạt động</span>
                                    @else
                                        <span class="text-red-600 font-semibold">Đã ẩn</span>
                                    @endif
                                </div>

                                <!-- Ngày tạo -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Ngày tạo:</span>
                                    <span class="text-gray-900">{{ $brand->created_at ? $brand->created_at->format('d/m/Y H:i') : 'N/A' }}</span>
                                </div>

                                <!-- Ngày cập nhật -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Cập nhật lần cuối:</span>
                                    <span class="text-gray-900">{{ $brand->updated_at ? $brand->updated_at->format('d/m/Y H:i') : 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mô tả thương hiệu -->
                    @if ($brand->description)
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Mô tả thương hiệu</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-gray-700 whitespace-pre-wrap">{{ $brand->description }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Nút điều hướng -->
                    <div class="mt-8 flex gap-4">
                        <a href="{{ route('brands.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white font-medium px-6 py-2 rounded transition duration-200">
                            Quay lại danh sách
                        </a>
                        <a href="{{ route('brands.edit', $brand->id) }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded transition duration-200">
                            Chỉnh sửa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
