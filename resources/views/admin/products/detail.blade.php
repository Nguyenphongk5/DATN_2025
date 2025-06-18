<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý sản phẩm') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h1 class="font-semibold text-gray-800 leading-tight" style="text-align: center; margin: 0 0 2rem 0; font-size: 2rem;">
            {{ __('Chi tiết sản phẩm') }}
        </h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Hình ảnh sản phẩm -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Hình ảnh sản phẩm</h3>
                            @if ($product->img_thumb)
                                <div class="border rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/' . $product->img_thumb) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-64 object-cover">
                                </div>
                            @else
                                <div class="border rounded-lg h-64 bg-gray-100 flex items-center justify-center">
                                    <span class="text-gray-400 italic">Không có hình ảnh</span>
                                </div>
                            @endif
                        </div>

                        <!-- Thông tin sản phẩm -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Thông tin sản phẩm</h3>
                            
                            <div class="space-y-4">
                                <!-- ID -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">ID:</span>
                                    <span class="text-gray-900">{{ $product->id }}</span>
                                </div>

                                <!-- Tên sản phẩm -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Tên sản phẩm:</span>
                                    <span class="text-gray-900">{{ $product->name }}</span>
                                </div>

                                <!-- Slug -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Slug:</span>
                                    <span class="text-gray-900">{{ $product->slug }}</span>
                                </div>

                                <!-- Danh mục -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Danh mục:</span>
                                    <span class="text-gray-900">{{ $product->category_name ?? 'N/A' }}</span>
                                </div>

                                <!-- Thương hiệu -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Thương hiệu:</span>
                                    <span class="text-gray-900">{{ $product->brand_name ?? 'N/A' }}</span>
                                </div>

                                <!-- Giá gốc -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Giá gốc:</span>
                                    <span class="text-gray-900 font-semibold">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                </div>

                                <!-- Giá khuyến mãi -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Giá khuyến mãi:</span>
                                    @if ($product->price_sale)
                                        <span class="text-red-600 font-semibold">{{ number_format($product->price_sale, 0, ',', '.') }} VNĐ</span>
                                    @else
                                        <span class="text-gray-400 italic">Không có</span>
                                    @endif
                                </div>

                                <!-- Lượt xem -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Lượt xem:</span>
                                    <span class="text-gray-900">{{ number_format($product->view) }}</span>
                                </div>

                                <!-- Trạng thái -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Trạng thái:</span>
                                    @if ($product->is_active)
                                        <span class="text-green-600 font-semibold">Đang hoạt động</span>
                                    @else
                                        <span class="text-red-600 font-semibold">Đã ẩn</span>
                                    @endif
                                </div>

                                <!-- Ngày tạo -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Ngày tạo:</span>
                                    <span class="text-gray-900">{{ $product->created_at ? $product->created_at->format('d/m/Y H:i') : 'N/A' }}</span>
                                </div>

                                <!-- Ngày cập nhật -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Cập nhật lần cuối:</span>
                                    <span class="text-gray-900">{{ $product->updated_at ? $product->updated_at->format('d/m/Y H:i') : 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mô tả sản phẩm -->
                    @if ($product->description)
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Mô tả sản phẩm</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-gray-700 whitespace-pre-wrap">{{ $product->description }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Nút điều hướng -->
                    <div class="mt-8 flex gap-4">
                        <a href="{{ route('products.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white font-medium px-6 py-2 rounded transition duration-200">
                            Quay lại danh sách
                        </a>
                        <a href="{{ route('products.edit', $product->id) }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded transition duration-200">
                            Chỉnh sửa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
