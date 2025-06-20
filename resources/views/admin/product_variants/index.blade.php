<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý biến thể sản phẩm') }}
        </h2>
    </x-slot>

    <div class="py-12" >
        <h1 class="font-semibold text-gray-800 leading-tight" style="text-align: center; margin: 0 0 2rem 0; font-size: 2rem;">
            {{ __('Danh sách biến thể sản phẩm') }}
        </h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto" >
                        <!-- Bộ lọc -->
                        <form action="{{ route('product_variants.index') }}" method="GET" class="mb-6">
                            <div class="flex flex-wrap gap-4 items-center">
                                <select name="product" id="productFilter" class="border border-gray-300 rounded px-3 py-2">
                                    <option value="">Tất cả sản phẩm</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ request('product') == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <select name="size" id="sizeFilter" class="border border-gray-300 rounded px-3 py-2">
                                    <option value="">Tất cả kích thước</option>
                                    @foreach($sizes ?? [] as $size)
                                        <option value="{{ $size }}" {{ request('size') == $size ? 'selected' : '' }}>
                                            {{ $size }}
                                        </option>
                                    @endforeach
                                </select>
                                <select name="color" id="colorFilter" class="border border-gray-300 rounded px-3 py-2">
                                    <option value="">Tất cả màu sắc</option>
                                    @foreach($colors ?? [] as $color)
                                        <option value="{{ $color }}" {{ request('color') == $color ? 'selected' : '' }}>
                                            {{ $color }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                                    Lọc
                                </button>
                                <a href="{{ route('product_variants.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded btn btn-primary">
                                    Thêm biến thể mới
                                </a>
                            </div>
                        </form>

                        <table class="w-full table-auto border-collapse">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">STT</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Sản phẩm</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Kích thước</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Màu sắc</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Số lượng</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Giá gốc</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Giá khuyến mãi</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-center">
                                @foreach ($productVariants as $key => $variant)
                                    <tr>
                                        <td class="px-6 py-4">{{ $key + 1 }}</td>
                                        <td class="px-6 py-4">
                                            <div class="max-w-xs">
                                                <p class="font-medium text-gray-900">{{ $variant->product_name ?? 'N/A' }}</p>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-sm font-medium">
                                                {{ $variant->size }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center space-x-2">
                                                <div class="w-6 h-6 rounded-full border border-gray-300"
                                                     style="background-color: {{ $variant->hex_code }}"></div>
                                                <span class="text-gray-700">{{ $variant->color_name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($variant->quantity > 0)
                                                <span class="text-green-600 font-semibold">{{ number_format($variant->quantity) }}</span>
                                            @else
                                                <span class="text-red-600 font-semibold">Hết hàng</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="font-semibold">{{ number_format($variant->price, 0, ',', '.') }} VNĐ</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($variant->price_sale)
                                                <span class="text-red-600 font-semibold">{{ number_format($variant->price_sale, 0, ',', '.') }} VNĐ</span>
                                            @else
                                                <span class="text-gray-400 italic">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-2 justify-center">
                                                <a href="{{ route('product_variants.show', $variant->id) }}"
                                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                                    Chi tiết
                                                </a>
                                                <a href="{{ route('product_variants.edit', $variant->id) }}"
                                                    class="bg-yellow-500 btn btn-primary hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                                    Sửa
                                                </a>
                                                <form action="{{ route('product_variants.destroy', $variant->id) }}" method="POST"
                                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa biến thể này?')"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                                        Xóa
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Phân trang -->
                        @if(isset($productVariants) && $productVariants->hasPages())
                            <div class="mt-6">
                                {{ $productVariants->links('pagination::tailwind') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
