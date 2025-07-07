<x-app-layout>
    <x-slot name="header">
        <div
            class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-cubes text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Quản lý biến thể sản phẩm</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <h1
            class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 text-center mb-8 drop-shadow-lg flex items-center justify-center gap-3">
            <i class="fas fa-cube animate-bounce text-indigo-400"></i>
            Danh sách biến thể sản phẩm
        </h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-6">
                <!-- Header với nút tạo mới và bộ lọc -->
                <div class="flex flex-col lg:flex-row justify-between items-center gap-4 mb-6">
                    <!-- Bộ lọc và tìm kiếm (bên trái) -->
                    <div class="flex flex-col sm:flex-row gap-4 items-center order-2 lg:order-1 w-full lg:w-auto">
                        <!-- Tìm kiếm -->
                        <form method="GET" action="{{ route('admin.product_variants.index') }}" class="flex gap-2">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Tìm kiếm theo tên sản phẩm..."
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <button type="submit"
                                class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg transition">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>

                        <!-- Lọc theo trạng thái -->
                        <form method="GET" action="{{ route('admin.product_variants.index') }}" class="flex gap-2">
                            <select name="is_active"
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <option value="">Tất cả trạng thái</option>
                                <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>Đang hoạt động</option>
                                <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>Đã ẩn</option>
                            </select>
                            <button type="submit"
                                class="bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg transition">
                                <i class="fas fa-filter"></i>
                            </button>
                        </form>

                        <!-- Reset bộ lọc -->
                        @if(request('search') || request('is_active'))
                            <a href="{{ route('admin.product_variants.index') }}"
                                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition flex items-center gap-2">
                                <i class="fas fa-times"></i>
                                Reset
                            </a>
                        @endif
                    </div>

                    <!-- Nút tạo mới (bên phải) -->
                    <div class="flex items-center gap-3 order-1 lg:order-2 w-full lg:w-auto justify-end">
                        <a href="{{ route('admin.product_variants.create') }}"
                            class="bg-gradient-to-r from-green-400 to-emerald-500 hover:from-emerald-500 hover:to-green-400 text-white font-bold py-3 px-6 rounded-xl shadow-lg flex items-center gap-2 transition transform hover:scale-105">
                            <i class="fas fa-plus"></i>
                            Tạo biến thể mới
                        </a>
                        <span class="text-gray-600 font-medium">
                            Tổng: <span class="text-indigo-600 font-bold">{{ $productVariants->total() }}</span> biến thể
                        </span>
                    </div>
                </div>

                <div class="overflow-x-auto custom-scrollbar rounded-2xl">
                    <table class="w-full table-auto border-collapse shadow-xl rounded-2xl overflow-hidden">
                        <thead class="bg-gradient-to-r from-indigo-100 via-sky-100 to-cyan-100 text-indigo-700">
                            <tr>
                                <th class="px-6 py-3 text-center text-sm font-medium uppercase">STT</th>
                                <th class="px-6 py-3 text-center text-sm font-medium uppercase">Sản phẩm</th>
                                <th class="px-6 py-3 text-center text-sm font-medium uppercase">Kích thước</th>
                                <th class="px-6 py-3 text-center text-sm font-medium uppercase">Màu sắc</th>
                                <th class="px-6 py-3 text-center text-sm font-medium uppercase">Số lượng</th>
                                <th class="px-6 py-3 text-center text-sm font-medium uppercase">Giá gốc</th>
                                <th class="px-6 py-3 text-center text-sm font-medium uppercase">Giá khuyến mãi</th>
                                <th class="px-6 py-3 text-center text-sm font-medium uppercase">Trạng thái</th>
                                <th class="px-6 py-3 text-center text-sm font-medium uppercase">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-indigo-100 text-center text-base">
                            @forelse ($productVariants as $key => $variant)
                                <tr class="hover:bg-gradient-to-r hover:from-indigo-50 hover:to-cyan-50 transition">
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
                                            <span
                                                class="text-green-600 font-semibold">{{ number_format($variant->quantity) }}</span>
                                        @else
                                            <span class="text-red-600 font-semibold">Hết hàng</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-semibold">{{ number_format($variant->price, 0, ',', '.') }}
                                            VNĐ</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($variant->price_sale)
                                            <span
                                                class="text-red-600 font-semibold">{{ number_format($variant->price_sale, 0, ',', '.') }}
                                                VNĐ</span>
                                        @else
                                            <span class="text-gray-400 italic">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($variant->is_active)
                                            <span
                                                class="px-3 py-1 text-xs font-bold rounded-full bg-gradient-to-r from-green-300 via-emerald-400 to-cyan-300 text-green-900 shadow ring-2 ring-green-200/60 animate-pulse">Đang
                                                hoạt động</span>
                                        @else
                                            <span
                                                class="px-3 py-1 text-xs font-bold rounded-full bg-gradient-to-r from-red-300 via-pink-400 to-fuchsia-300 text-red-900 shadow ring-2 ring-pink-200/60">Đã
                                                ẩn</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2 justify-center">
                                            <a href="{{ route('admin.product_variants.show', $variant->id) }}"
                                                class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white px-4 py-2 rounded-xl font-bold shadow-md flex items-center gap-2 transition">
                                                <i class="fas fa-eye"></i> Chi tiết
                                            </a>
                                            <a href="{{ route('admin.product_variants.edit', $variant->id) }}"
                                                class="bg-gradient-to-r from-yellow-400 to-pink-500 hover:from-pink-500 hover:to-yellow-400 text-white px-4 py-2 rounded-xl font-bold shadow-md flex items-center gap-2 transition">
                                                <i class="fas fa-edit"></i> Sửa
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-8 text-center text-gray-500">
                                        <div class="flex flex-col items-center gap-3">
                                            <i class="fas fa-inbox text-4xl text-gray-300"></i>
                                            <p class="text-lg font-medium">Không có biến thể sản phẩm nào</p>
                                            <a href="{{ route('admin.product_variants.create') }}"
                                                class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg transition">
                                                Tạo biến thể đầu tiên
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @if (isset($productVariants) && $productVariants->hasPages())
                        <div class="mt-8 flex justify-center">
                            {{ $productVariants->links('pagination::tailwind') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
