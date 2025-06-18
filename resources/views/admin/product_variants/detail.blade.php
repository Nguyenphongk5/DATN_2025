<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý biến thể sản phẩm') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h1 class="font-semibold text-gray-800 leading-tight" style="text-align: center; margin: 0 0 2rem 0; font-size: 2rem;">
            {{ __('Chi tiết biến thể sản phẩm') }}
        </h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Màu sắc -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Màu sắc</h3>
                            <div class="border rounded-lg p-6 bg-gray-50">
                                <div class="flex items-center space-x-4">
                                    <div class="w-20 h-20 rounded-full border-4 border-gray-300"
                                         style="background-color: {{ $productVariant->hex_code }}"></div>
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-800">{{ $productVariant->color_name }}</h4>
                                        <p class="text-gray-600">Mã màu: {{ $productVariant->hex_code }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin biến thể -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Thông tin biến thể</h3>

                            <div class="space-y-4">
                                <!-- ID -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">ID:</span>
                                    <span class="text-gray-900">{{ $productVariant->id }}</span>
                                </div>

                                <!-- Sản phẩm -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Sản phẩm:</span>
                                    <span class="text-gray-900">{{ $productVariant->product_name ?? 'N/A' }}</span>
                                </div>

                                <!-- Kích thước -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Kích thước:</span>
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded text-sm font-medium">
                                        {{ $productVariant->size }}
                                    </span>
                                </div>

                                <!-- Tên màu -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Tên màu:</span>
                                    <span class="text-gray-900">{{ $productVariant->color_name }}</span>
                                </div>

                                <!-- Mã màu hex -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Mã màu:</span>
                                    <span class="text-gray-900">{{ $productVariant->hex_code }}</span>
                                </div>

                                <!-- Số lượng -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Số lượng:</span>
                                    @if ($productVariant->quantity > 0)
                                        <span class="text-green-600 font-semibold">{{ number_format($productVariant->quantity) }}</span>
                                    @else
                                        <span class="text-red-600 font-semibold">Hết hàng</span>
                                    @endif
                                </div>

                                <!-- Giá gốc -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Giá gốc:</span>
                                    <span class="text-gray-900 font-semibold">{{ number_format($productVariant->price, 0, ',', '.') }} VNĐ</span>
                                </div>

                                <!-- Giá khuyến mãi -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Giá khuyến mãi:</span>
                                    @if ($productVariant->price_sale)
                                        <span class="text-red-600 font-semibold">{{ number_format($productVariant->price_sale, 0, ',', '.') }} VNĐ</span>
                                    @else
                                        <span class="text-gray-400 italic">Không có</span>
                                    @endif
                                </div>

                                <!-- Ngày tạo -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Ngày tạo:</span>
                                    <span class="text-gray-900">{{ $productVariant->created_at ? $productVariant->created_at->format('d/m/Y H:i') : 'N/A' }}</span>
                                </div>

                                <!-- Ngày cập nhật -->
                                <div class="flex border-b pb-2">
                                    <span class="font-medium text-gray-700 w-32">Cập nhật lần cuối:</span>
                                    <span class="text-gray-900">{{ $productVariant->updated_at ? $productVariant->updated_at->format('d/m/Y H:i') : 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Thông tin sản phẩm gốc -->
                    @if (isset($productVariant->product))
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Thông tin sản phẩm gốc</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <span class="font-medium text-gray-700">Tên sản phẩm:</span>
                                        <p class="text-gray-900">{{ $productVariant->product->name }}</p>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-700">Danh mục:</span>
                                        <p class="text-gray-900">{{ $productVariant->product->category_name ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-700">Thương hiệu:</span>
                                        <p class="text-gray-900">{{ $productVariant->product->brand_name ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Nút điều hướng -->
                    <div class="mt-8 flex gap-4">
                        <a href="{{ route('product_variants.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white font-medium px-6 py-2 rounded transition duration-200">
                            Quay lại danh sách
                        </a>
                        <a href="{{ route('product_variants.edit', $productVariant->id) }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded transition duration-200">
                            Chỉnh sửa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
