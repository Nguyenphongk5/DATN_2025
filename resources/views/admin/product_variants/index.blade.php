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
                            @foreach ($productVariants as $key => $variant)
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
                            @endforeach
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
