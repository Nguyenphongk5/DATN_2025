<x-app-layout>
    <x-slot name="header">
        <div
            class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-cube text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Chi tiết biến thể sản phẩm</h2>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-8">
                <h1
                    class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 drop-shadow-lg flex items-center gap-2 mb-8">
                    <i class="fas fa-cube animate-bounce text-indigo-400"></i>
                    {{ $productVariant->product_name ?? 'Chi tiết biến thể' }}
                </h1>
                <div class="overflow-x-auto custom-scrollbar rounded-2xl">
                    <table class="w-full table-auto border-collapse shadow-xl rounded-2xl overflow-hidden text-base">
                        <thead class="bg-gradient-to-r from-indigo-100 via-sky-100 to-cyan-100 text-indigo-700">
                            <tr>
                                <th class="px-6 py-4 text-left font-bold">Thuộc tính</th>
                                <th class="px-6 py-4 text-left font-bold">Giá trị</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-indigo-100">
                            <tr class="hover:bg-indigo-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-indigo-700">ID</td>
                                <td class="px-6 py-4">{{ $productVariant->id }}</td>
                            </tr>
                            <tr class="hover:bg-indigo-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-indigo-700">Tên biến thể</td>
                                <td class="px-6 py-4">{{ $productVariant->product_name }}</td>
                            </tr>
                            <tr class="hover:bg-indigo-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-indigo-700">Size</td>
                                <td class="px-6 py-4">{{ $productVariant->size }}</td>
                            </tr>
                            <tr class="hover:bg-indigo-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-indigo-700">Color</td>
                                <td class="px-6 py-4">{{ $productVariant->color_name }}</td>
                            </tr>
                            <tr class="hover:bg-indigo-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-indigo-700">Giá</td>
                                <td class="px-6 py-4">{{ number_format($productVariant->price, 0, ',', '.') }} VNĐ</td>
                            </tr>
                            <tr class="hover:bg-indigo-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-indigo-700">Số lượng</td>
                                <td class="px-6 py-4">{{ $productVariant->quantity ?? 0 }}</td>
                            </tr>
                            <tr class="hover:bg-indigo-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-indigo-700">Trạng thái</td>
                                <td class="px-6 py-4">
                                    @if($productVariant->is_active)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-2"></i>Hoạt động
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle mr-2"></i>Ngưng hoạt động
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr class="hover:bg-indigo-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-indigo-700">Ngày tạo</td>
                                <td class="px-6 py-4">
                                    @if($productVariant->created_at)
                                        @if(is_string($productVariant->created_at))
                                            {{ \Carbon\Carbon::parse($productVariant->created_at)->format('d/m/Y H:i:s') }}
                                        @else
                                            {{ $productVariant->created_at->format('d/m/Y H:i:s') }}
                                        @endif
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr class="hover:bg-indigo-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-indigo-700">Ngày cập nhật</td>
                                <td class="px-6 py-4">
                                    @if($productVariant->updated_at)
                                        @if(is_string($productVariant->updated_at))
                                            {{ \Carbon\Carbon::parse($productVariant->updated_at)->format('d/m/Y H:i:s') }}
                                        @else
                                            {{ $productVariant->updated_at->format('d/m/Y H:i:s') }}
                                        @endif
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-8 flex gap-4 justify-center">
                    <a href="{{ route('admin.product_variants.index') }}"
                        class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white font-bold py-3 px-8 rounded-xl shadow-lg flex items-center gap-2 transition">
                        <i class="fas fa-arrow-left"></i> Quay lại danh sách
                    </a>
                    <a href="{{ route('admin.product_variants.edit', $productVariant->id) }}"
                        class="bg-gradient-to-r from-yellow-400 to-pink-500 hover:from-pink-500 hover:to-yellow-400 text-white font-bold py-3 px-8 rounded-xl shadow-lg flex items-center gap-2 transition">
                        <i class="fas fa-edit"></i> Chỉnh sửa
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
