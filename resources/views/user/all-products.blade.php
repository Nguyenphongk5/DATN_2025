@extends('layouts.user')
@section('content')
    <!-- Header Section -->
    <section class="py-12 bg-gradient-to-r from-purple-50 via-pink-50 to-blue-50 mb-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1
                        class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 bg-clip-text text-transparent mb-2">
                        Tất cả sản phẩm
                    </h1>
                    <p class="text-gray-600 text-lg">Khám phá bộ sưu tập đầy đủ của chúng tôi</p>
                </div>
                <nav
                    class="text-sm text-gray-500 flex items-center gap-2 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full shadow-lg">
                    <a class="hover:text-purple-600 transition-colors font-medium" href="/">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        Home
                    </a>
                    <span class="mx-2 text-gray-400">/</span>
                    <span class="text-purple-600 font-semibold">Tất cả sản phẩm</span>
                </nav>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-8 bg-white mb-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-white p-6 rounded-2xl text-center shadow-lg">
                    <div class="text-3xl font-bold mb-2">{{ $totalProducts }}</div>
                    <div class="text-purple-100">Sản phẩm</div>
                </div>
                <div class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white p-6 rounded-2xl text-center shadow-lg">
                    <div class="text-3xl font-bold mb-2">{{ $totalCategories }}</div>
                    <div class="text-blue-100">Danh mục</div>
                </div>
                <div
                    class="bg-gradient-to-r from-green-500 to-emerald-500 text-white p-6 rounded-2xl text-center shadow-lg">
                    <div class="text-3xl font-bold mb-2">{{ $totalBrands }}</div>
                    <div class="text-green-100">Thương hiệu</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filters and Products Section -->
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Filters Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-xl p-6 sticky top-4">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <i class="fas fa-filter text-purple-500"></i>
                            Bộ lọc
                        </h3>

                        <!-- Search -->
                        <div class="mb-6">
                            <form action="{{ route('home.products') }}" method="GET" class="space-y-4">
                                <!-- Category Filter -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Danh mục</label>
                                    <select name="category"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                        <option value="">Tất cả danh mục</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Brand Filter -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Thương hiệu</label>
                                    <select name="brand"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                        <option value="">Tất cả thương hiệu</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ request('brand') == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Price Range -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Khoảng giá</label>
                                    <div class="space-y-2">
                                        <select name="price_range"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                            <option value="">Chọn khoảng giá</option>
                                            <option value="0-500000"
                                                {{ request('price_range') == '0-500000' ? 'selected' : '' }}>Dưới 500k
                                            </option>
                                            <option value="500000-1000000"
                                                {{ request('price_range') == '500000-1000000' ? 'selected' : '' }}>500k - 1
                                                triệu</option>
                                            <option value="1000000-2000000"
                                                {{ request('price_range') == '1000000-2000000' ? 'selected' : '' }}>1 triệu
                                                - 2 triệu</option>
                                            <option value="2000000"
                                                {{ request('price_range') == '2000000' ? 'selected' : '' }}>Trên 2 triệu
                                            </option>
                                        </select>
                                    </div>
                                </div>


                                <!-- Sort -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Sắp xếp</label>
                                    <select name="sort"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Mới nhất
                                        </option>
                                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                                            Giá tăng dần</option>
                                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                                            Giá giảm dần</option>
                                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Tên A-Z
                                        </option>
                                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Phổ
                                            biến</option>
                                    </select>
                                </div>

                                <!-- Apply Filters Button -->
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold py-3 px-4 rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-200">
                                    <i class="fas fa-search mr-2"></i>
                                    Áp dụng bộ lọc
                                </button>

                                <!-- Clear Filters -->
                                <a href="{{ route('home.products') }}"
                                    class="block w-full bg-gray-200 text-gray-700 font-bold py-3 px-4 rounded-lg hover:bg-gray-300 transition-all duration-200 text-center">
                                    <i class="fas fa-times mr-2"></i>
                                    Xóa bộ lọc
                                </a>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="lg:col-span-3">
                    <!-- Results Header -->
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                        <div class="mb-4 md:mb-0">
                            <h2 class="text-2xl font-bold text-gray-900">
                                Kết quả tìm kiếm
                            </h2>
                            <p class="text-gray-600">
                                Hiển thị {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} trong tổng số
                                {{ $products->total() }} sản phẩm
                            </p>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    @if ($products->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($products as $product)
                                <div
                                    class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
                                    <!-- Product Image -->
                                    <div class="relative overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                                        <img src="{{ asset('storage/' . $product->img_thumb) }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-500">

                                        <!-- Badges -->
                                        <div class="absolute top-4 left-4 flex flex-col gap-2">
                                            @if ($product->created_at >= now()->subDays(7))
                                                <span
                                                    class="bg-gradient-to-r from-green-500 to-emerald-600 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">
                                                    NEW
                                                </span>
                                            @endif
                                            @if ($product->price_sale)
                                                <span
                                                    class="bg-gradient-to-r from-red-500 to-pink-600 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">
                                                    -{{ round((($product->price - $product->price_sale) / $product->price) * 100) }}%
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Quick Actions -->
                                        <div
                                            class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                            <button
                                                class="bg-white/90 backdrop-blur-sm rounded-full p-2 shadow-lg hover:bg-white transition-all duration-200">
                                                <i class="fas fa-heart text-gray-600 hover:text-red-500"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Product Info -->
                                    <div class="p-6">
                                        <!-- Category & Brand -->
                                        <div class="flex items-center gap-2 mb-2">
                                            <span
                                                class="text-xs bg-purple-100 text-purple-700 px-2 py-1 rounded-full">{{ $product->category->name }}</span>
                                            <span
                                                class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full">{{ $product->brand->name }}</span>
                                        </div>

                                        <!-- Product Name -->
                                        <h3
                                            class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-purple-600 transition-colors duration-200">
                                            <a href="{{ route('home.show', $product->id) }}"
                                                class="hover:underline">{{ $product->name }}</a>
                                        </h3>

                                        <!-- Rating -->
                                        <div class="flex items-center gap-2 mb-3">
                                            <x-star-rating :rating="$product->average_rating" size="w-4 h-4" :showNumber="false" />
                                            <span class="text-sm text-gray-500">({{ $product->rating_count }})</span>
                                        </div>

                                        <!-- Price -->
                                        <div class="flex items-center gap-2 mb-4">
                                            <span
                                                class="text-xl font-bold text-purple-600">{{ number_format($product->price, 0, '', '.') }}
                                                VNĐ</span>
                                            @if ($product->price_sale)
                                                <del class="text-sm text-gray-400">{{ number_format($product->price_sale, 0, '', '.') }}
                                                    VNĐ</del>
                                            @endif
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="flex gap-2">
                                            <a href="{{ route('home.show', $product->id) }}"
                                                class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold py-2 px-4 rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-200 text-center text-sm">
                                                <i class="fas fa-eye mr-1"></i>
                                                Xem chi tiết
                                            </a>
                                            <button
                                                class="bg-gray-100 text-gray-700 p-2 rounded-lg hover:bg-gray-200 transition-all duration-200">
                                                <i class="fas fa-shopping-cart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $products->appends(request()->query())->links() }}
                        </div>
                    @else
                        <!-- No Products Found -->
                        <div class="text-center py-12">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-search text-3xl text-gray-400"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Không tìm thấy sản phẩm</h3>
                            <p class="text-gray-600 mb-6">Thử thay đổi bộ lọc hoặc tìm kiếm với từ khóa khác</p>
                            <a href="{{ route('home.products') }}"
                                class="bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold py-3 px-6 rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-200">
                                <i class="fas fa-refresh mr-2"></i>
                                Xem tất cả sản phẩm
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .sticky {
            position: sticky;
            top: 1rem;
        }

        /* Custom pagination styles */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
        }

        .pagination .page-item .page-link {
            padding: 0.5rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            color: #6b7280;
            text-decoration: none;
            transition: all 0.2s;
        }

        .pagination .page-item .page-link:hover {
            background-color: #f3f4f6;
            border-color: #d1d5db;
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #8b5cf6, #ec4899);
            border-color: #8b5cf6;
            color: white;
        }

        .pagination .page-item.disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
@endsection
