<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý sản phẩm') }}
        </h2>
    </x-slot>

    <div class="py-12" >
        <h1 class="font-semibold text-gray-800 leading-tight" style="text-align: center; margin: 0 0 2rem 0; font-size: 2rem;">
            {{ __('Danh sách sản phẩm') }}
        </h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto" >
                        <!-- Bộ lọc -->
                        <form action="{{ route('products.index') }}" method="GET" class="mb-6">
                            <div class="flex flex-wrap gap-4 items-center">
                                <select name="category" id="categoryFilter" class="border border-gray-300 rounded px-3 py-2">
                                    <option value="">Tất cả danh mục</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <select name="brand" id="brandFilter" class="border border-gray-300 rounded px-3 py-2">
                                    <option value="">Tất cả thương hiệu</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <select name="status" id="statusFilter" class="border border-gray-300 rounded px-3 py-2">
                                    <option value="">Tất cả trạng thái</option>
                                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Đang hoạt động</option>
                                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Đã ẩn</option>
                                </select>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                                    Lọc
                                </button>
                                <a href="{{ route('products.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded btn btn-primary">
                                    Thêm sản phẩm mới
                                </a>
                            </div>
                        </form>

                        <table class="w-full table-auto border-collapse">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">STT</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Hình ảnh</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Tên sản phẩm</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Danh mục</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Thương hiệu</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Giá gốc</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Giá khuyến mãi</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Lượt xem</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Trạng thái</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-center">
                                @foreach ($products as $key => $product)
                                    <tr>
                                        <td class="px-6 py-4">{{ $key + 1 }}</td>
                                        <td class="px-6 py-4">
                                            @if ($product->img_thumb)
                                                <img src="{{ asset('storage/' . $product->img_thumb) }}"
                                                     alt="{{ $product->name }}"
                                                     class="w-16 h-16 object-cover rounded mx-auto">
                                            @else
                                                <div class="w-16 h-16 bg-gray-200 rounded mx-auto flex items-center justify-center">
                                                    <span class="text-gray-400 text-xs">No Image</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="max-w-xs">
                                                <p class="font-medium text-gray-900">{{ $product->name }}</p>
                                                <p class="text-sm text-gray-500">{{ $product->slug }}</p>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-blue-600">{{ $product->category_name ?? 'N/A' }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-green-600">{{ $product->brand_name ?? 'N/A' }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="font-semibold">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($product->price_sale)
                                                <span class="text-red-600 font-semibold">{{ number_format($product->price_sale, 0, ',', '.') }} VNĐ</span>
                                            @else
                                                <span class="text-gray-400 italic">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-gray-600">{{ number_format($product->view) }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($product->is_active)
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    Đang hoạt động
                                                </span>
                                            @else
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                    Đã ẩn
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-2 justify-center">
                                                <a href="{{ route('products.show', $product->id) }}"
                                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                                    Chi tiết
                                                </a>
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                    class="bg-yellow-500 btn btn-primary hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                                    Sửa
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Phân trang -->
                        @if(isset($products) && $products->hasPages())
                            <div class="mt-6">
                                {{ $products->links('pagination::tailwind') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
