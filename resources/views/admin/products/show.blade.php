<x-app-layout>
    <x-slot name="header">
        <div
            class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-cube text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Chi tiết sản phẩm</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Hình ảnh sản phẩm -->
                    <div class="space-y-4 flex flex-col items-center">
                        <h3 class="text-lg font-bold text-indigo-700 mb-4 flex items-center gap-2"><i
                                class="fas fa-image text-sky-400"></i> Hình ảnh sản phẩm</h3>
                        @if ($product->img_thumb)
                            <div class="rounded-2xl overflow-hidden ring-4 ring-sky-300 shadow-xl">
                                <img src="{{ asset('storage/' . $product->img_thumb) }}" alt="{{ $product->name }}"
                                    class="w-80 h-80 object-cover">
                            </div>
                        @else
                            <div
                                class="rounded-2xl h-80 w-80 bg-gradient-to-br from-gray-200 to-sky-100 flex items-center justify-center">
                                <span class="text-gray-400 italic text-lg">Không có hình ảnh</span>
                            </div>
                        @endif
                    </div>

                    <!-- Thông tin sản phẩm -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-bold text-indigo-700 mb-4 flex items-center gap-2"><i
                                class="fas fa-info-circle text-sky-400"></i> Thông tin sản phẩm</h3>
                        <div class="space-y-4">
                            <div class="flex border-b pb-2">
                                <span class="font-bold text-indigo-700 w-40 flex items-center gap-2"><i
                                        class="fas fa-hashtag"></i> ID:</span>
                                <span class="text-gray-900">{{ $product->id }}</span>
                            </div>
                            <div class="flex border-b pb-2">
                                <span class="font-bold text-indigo-700 w-40 flex items-center gap-2"><i
                                        class="fas fa-cube"></i> Tên sản phẩm:</span>
                                <span class="text-gray-900">{{ $product->name }}</span>
                            </div>
                            <div class="flex border-b pb-2">
                                <span class="font-bold text-indigo-700 w-40 flex items-center gap-2"><i
                                        class="fas fa-link"></i> Slug:</span>
                                <span class="text-gray-900">{{ $product->slug }}</span>
                            </div>
                            <div class="flex border-b pb-2">
                                <span class="font-bold text-indigo-700 w-40 flex items-center gap-2"><i
                                        class="fas fa-tags"></i> Danh mục:</span>
                                <span class="text-blue-700 font-bold">{{ $product->category_name ?? 'N/A' }}</span>
                            </div>
                            <div class="flex border-b pb-2">
                                <span class="font-bold text-indigo-700 w-40 flex items-center gap-2"><i
                                        class="fas fa-copyright"></i> Thương hiệu:</span>
                                <span class="text-green-700 font-bold">{{ $product->brand_name ?? 'N/A' }}</span>
                            </div>
                            <div class="flex border-b pb-2">
                                <span class="font-bold text-indigo-700 w-40 flex items-center gap-2"><i
                                        class="fas fa-money-bill-wave"></i> Giá gốc:</span>
                                <span
                                    class="text-gray-900 font-semibold">{{ number_format($product->price, 0, ',', '.') }}
                                    VNĐ</span>
                            </div>
                            <div class="flex border-b pb-2">
                                <span class="font-bold text-indigo-700 w-40 flex items-center gap-2"><i
                                        class="fas fa-bolt"></i> Giá khuyến mãi:</span>
                                @if ($product->price_sale)
                                    <span
                                        class="text-red-600 font-semibold">{{ number_format($product->price_sale, 0, ',', '.') }}
                                        VNĐ</span>
                                @else
                                    <span class="text-gray-400 italic">Không có</span>
                                @endif
                            </div>
                            <div class="flex border-b pb-2">
                                <span class="font-bold text-indigo-700 w-40 flex items-center gap-2"><i
                                        class="fas fa-eye"></i> Lượt xem:</span>
                                <span class="text-gray-900">{{ number_format($product->view) }}</span>
                            </div>
                            <div class="flex border-b pb-2">
                                <span class="font-bold text-indigo-700 w-40 flex items-center gap-2"><i
                                        class="fas fa-toggle-on"></i> Trạng thái:</span>
                                @if ($product->is_active)
                                    <span
                                        class="px-3 py-1 text-xs font-bold rounded-full bg-gradient-to-r from-green-300 via-emerald-400 to-cyan-300 text-green-900 shadow ring-2 ring-green-200/60 animate-pulse">Đang
                                        hoạt động</span>
                                @else
                                    <span
                                        class="px-3 py-1 text-xs font-bold rounded-full bg-gradient-to-r from-red-300 via-pink-400 to-fuchsia-300 text-red-900 shadow ring-2 ring-pink-200/60">Đã
                                        ẩn</span>
                                @endif
                            </div>
                            <div class="flex border-b pb-2">
                                <span class="font-bold text-indigo-700 w-40 flex items-center gap-2"><i
                                        class="fas fa-calendar-plus"></i> Ngày tạo:</span>
                                <span
                                    class="text-gray-900">{{ $product->created_at ? \Carbon\Carbon::parse($product->created_at)->format('d/m/Y H:i:s') : 'N/A' }}</span>
                            </div>
                            <div class="flex border-b pb-2">
                                <span class="font-bold text-indigo-700 w-40 flex items-center gap-2"><i
                                        class="fas fa-calendar-check"></i> Cập nhật lần cuối:</span>
                                <span
                                    class="text-gray-900">{{ $product->updated_at ? \Carbon\Carbon::parse($product->updated_at)->format('d/m/Y H:i:s') : 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($product->description)
                    <div class="mt-8">
                        <h3 class="text-lg font-bold text-indigo-700 mb-4 flex items-center gap-2"><i
                                class="fas fa-align-left text-sky-400"></i> Mô tả sản phẩm</h3>
                        <div class="bg-gradient-to-br from-blue-50 via-cyan-50 to-white p-4 rounded-2xl shadow-inner">
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $product->description }}</p>
                        </div>
                    </div>
                @endif

                <!-- Gallery Images -->
                
                @if($galleryImages->count() > 0)
                    <div class="mt-8">
                        <h3 class="text-lg font-bold text-indigo-700 mb-4 flex items-center gap-2"><i
                                class="fas fa-images text-sky-400"></i> Ảnh gallery ({{ $galleryImages->count() }})</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                            @foreach($galleryImages as $gallery)
                                <div class="relative group">
                                    <img src="{{ asset('storage/product_galleries/' . $gallery->image) }}" 
                                         alt="{{ $gallery->alt_text ?? $product->name }}" 
                                         class="w-full h-24 object-cover rounded-lg shadow-md group-hover:shadow-xl transition-all duration-300">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 rounded-lg flex items-center justify-center">
                                        <div class="opacity-0 group-hover:opacity-100 transition-all duration-300 text-white text-xs text-center">
                                            <div class="font-bold">{{ $gallery->alt_text ?? 'No alt text' }}</div>
                                            <div class="text-xs">Order: {{ $gallery->sort_order }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 text-center">
                            <a href="{{ route('admin.products.galleries.index', $product->id) }}" 
                               class="bg-gradient-to-r from-purple-400 to-pink-500 hover:from-pink-500 hover:to-purple-400 text-white px-4 py-2 rounded-lg font-bold shadow-md flex items-center gap-2 transition inline-flex">
                                <i class="fas fa-images"></i> Quản lý gallery
                            </a>
                        </div>
                    </div>
                @else
                    <div class="mt-8">
                        <h3 class="text-lg font-bold text-indigo-700 mb-4 flex items-center gap-2"><i
                                class="fas fa-images text-sky-400"></i> Ảnh gallery</h3>
                        <div class="bg-gradient-to-br from-gray-50 via-slate-50 to-white p-6 rounded-2xl shadow-inner text-center">
                            <i class="fas fa-images text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 mb-4">Chưa có ảnh gallery nào</p>
                            <a href="{{ route('admin.products.galleries.index', $product->id) }}" 
                               class="bg-gradient-to-r from-purple-400 to-pink-500 hover:from-pink-500 hover:to-purple-400 text-white px-4 py-2 rounded-lg font-bold shadow-md flex items-center gap-2 transition inline-flex">
                                <i class="fas fa-plus"></i> Thêm ảnh gallery
                            </a>
                        </div>
                    </div>
                @endif

                <div class="mt-8 flex gap-4 justify-center">
                    <a href="{{ route('admin.products.index') }}"
                        class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white font-bold py-3 px-8 rounded-xl shadow-lg flex items-center gap-2 transition">
                        <i class="fas fa-arrow-left"></i> Quay lại danh sách
                    </a>
                    <a href="{{ route('admin.products.edit', $product->id) }}"
                        class="bg-gradient-to-r from-yellow-400 to-pink-500 hover:from-pink-500 hover:to-yellow-400 text-white font-bold py-3 px-8 rounded-xl shadow-lg flex items-center gap-2 transition">
                        <i class="fas fa-edit"></i> Chỉnh sửa
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
