@extends('layouts.user')
@section('content')
    <!-- Notification Messages -->
    @if (session('add_to_cart'))
        <div id="success-notification"
            class="fixed top-6 right-6 z-50 transform transition-all duration-500 ease-out opacity-0 translate-x-full">
            <div
                class="bg-gradient-to-r from-emerald-500 to-green-600 text-white px-6 py-4 rounded-2xl shadow-2xl border border-emerald-400/30 backdrop-blur-sm animate-pulse">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <div
                            class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center shadow-lg ring-2 ring-white/30">
                            <svg class="w-5 h-5 text-white drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-sm">{{ session('add_to_cart') }}</p>
                        <p class="text-xs text-emerald-100">Sản phẩm đã được thêm thành công!</p>
                    </div>
                    <button onclick="closeNotification('success-notification')"
                        class="flex-shrink-0 text-white/80 hover:text-white transition-all duration-200 hover:scale-110 hover:bg-white/20 rounded-full p-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
                <!-- Progress bar -->
                <div class="mt-3 w-full bg-white/20 rounded-full h-1">
                    <div id="progress-bar" class="bg-white h-1 rounded-full transition-all duration-5000 ease-linear"
                        style="width: 100%"></div>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div id="error-notification"
            class="fixed top-6 right-6 z-50 transform transition-all duration-500 ease-out opacity-0 translate-x-full">
            <div
                class="bg-gradient-to-r from-red-500 to-pink-600 text-white px-6 py-4 rounded-2xl shadow-2xl border border-red-400/30 backdrop-blur-sm">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <div
                            class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center shadow-lg ring-2 ring-white/30">
                            <svg class="w-5 h-5 text-white drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-sm">{{ session('error') }}</p>
                        <p class="text-xs text-red-100">Đã xảy ra lỗi, vui lòng thử lại!</p>
                    </div>
                    <button onclick="closeNotification('error-notification')"
                        class="flex-shrink-0 text-white/80 hover:text-white transition-all duration-200 hover:scale-110 hover:bg-white/20 rounded-full p-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
                <!-- Progress bar -->
                <div class="mt-3 w-full bg-white/20 rounded-full h-1">
                    <div id="error-progress-bar" class="bg-white h-1 rounded-full transition-all duration-5000 ease-linear"
                        style="width: 100%"></div>
                </div>
            </div>
        </div>
    @endif

    <!-- Header Section -->
    <section class="py-12 bg-gradient-to-r from-purple-50 via-pink-50 to-blue-50 mb-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1
                        class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 bg-clip-text text-transparent mb-2">
                        Chi tiết sản phẩm
                    </h1>
                    <p class="text-gray-600 text-lg">Khám phá và mua sắm sản phẩm</p>
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
                    <a class="hover:text-purple-600 transition-colors font-medium" href="{{ route('home.search') }}">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                        Sản phẩm
                    </a>
                    <span class="mx-2 text-gray-400">/</span>
                    <span class="text-purple-600 font-semibold">{{ $product->name }}</span>
                </nav>
            </div>
        </div>
    </section>

    <!-- Hero Section for Product -->
    <section class="relative min-h-[60vh] bg-gradient-to-br from-gray-50 via-white to-blue-50 py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Product Images -->
                <div class="mb-6">
                    <!-- Ảnh chính -->
                    <div
                        class="relative bg-white rounded-3xl shadow-xl overflow-hidden flex items-center justify-center mb-4">
                        <img id="main-product-image" src="{{ asset('storage/' . $product->img_thumb) }}"
                            alt="{{ $product->name }}"
                            class="w-full h-[420px] object-cover transition-all duration-300 hover:scale-105">
                        <!-- Badge -->
                        <div class="absolute top-4 left-4 flex flex-col gap-2 z-10">
                            @if ($product->created_at >= now()->subDays(7))
                                <span
                                    class="bg-gradient-to-r from-green-500 to-emerald-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg transform -rotate-12">NEW</span>
                            @endif
                            <span
                                class="bg-gradient-to-r from-red-500 to-pink-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">-30%</span>
                        </div>
                    </div>

                    <!-- Ảnh gallery (tối đa 6 ảnh) -->
                    @if ($galleryImages->count() > 0)
                        <div class="bg-white rounded-2xl shadow-lg p-4">
                            <h4 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                                <i class="fas fa-palette text-indigo-500"></i>
                                Ảnh sản phẩm cùng loại khác màu
                            </h4>
                            <div class="grid grid-cols-3 md:grid-cols-6 gap-3">
                                <!-- Ảnh chính (đầu tiên) -->
                                <div
                                    class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105 cursor-pointer gallery-image border-2 border-purple-500">
                                    <img src="{{ asset('storage/' . $product->img_thumb) }}" alt="{{ $product->name }}"
                                        class="w-full h-20 object-cover">

                                    <!-- Overlay với click icon -->
                                    <div
                                        class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                        <div class="opacity-0 group-hover:opacity-100 transition-all duration-300">
                                            <div class="bg-white/90 backdrop-blur-sm rounded-full p-2 shadow-lg">
                                                <svg class="w-4 h-4 text-gray-800" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Badge cho ảnh chính -->
                                    <div class="absolute top-1 left-1">
                                        <span
                                            class="bg-gradient-to-r from-purple-500 to-pink-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full shadow-lg">
                                            Chính
                                        </span>
                                    </div>
                                </div>

                                <!-- Ảnh gallery -->
                                @foreach ($galleryImages->take(5) as $gallery)
                                    <div
                                        class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105 cursor-pointer gallery-image border-2 border-transparent">
                                        <img src="{{ asset('storage/product_galleries/' . $gallery->image) }}"
                                            alt="{{ $gallery->alt_text ?? $product->name }}"
                                            class="w-full h-20 object-cover">

                                        <!-- Overlay với click icon -->
                                        <div
                                            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                            <div class="opacity-0 group-hover:opacity-100 transition-all duration-300">
                                                <div class="bg-white/90 backdrop-blur-sm rounded-full p-2 shadow-lg">
                                                    <svg class="w-4 h-4 text-gray-800" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Thông báo nếu có nhiều hơn 5 ảnh gallery -->
                            @if ($galleryImages->count() > 5)
                                <div class="mt-3 text-center">
                                    <p class="text-sm text-gray-500">
                                        <i class="fas fa-info-circle text-indigo-400"></i>
                                        Hiển thị
                                        {{ 1 + min(5, $galleryImages->count()) }}/{{ 1 + $galleryImages->count() }} màu
                                        sắc
                                    </p>
                                </div>
                            @endif

                            <!-- Test button -->
                            <div class="mt-3 text-center">
                                <button onclick="testGallery()"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm">
                                    Test Gallery
                                </button>
                            </div>
                        </div>
                    @else
                        <!-- Empty state khi không có ảnh gallery -->
                        <div class="bg-white rounded-2xl shadow-lg p-4">
                            <h4 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                                <i class="fas fa-palette text-indigo-500"></i>
                                Ảnh sản phẩm cùng loại khác màu
                            </h4>
                            <div class="text-center py-8">
                                <div
                                    class="w-16 h-16 bg-gradient-to-r from-gray-200 to-gray-300 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-palette text-2xl text-gray-400"></i>
                                </div>
                                <p class="text-gray-500 text-sm">
                                    Chưa có ảnh màu sắc khác cho sản phẩm này
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- Product Info Card -->
                <div>
                    <div class="bg-white rounded-3xl shadow-2xl p-8">
                        <h1 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">{{ $product->name }}</h1>
                        <div class="flex items-center gap-2 mb-4">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-6 h-6 {{ $i <= 4 ? 'text-yellow-400' : 'text-gray-300' }}"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            @endfor
                            <span class="ml-2 text-sm text-gray-500">(4.5)</span>
                        </div>
                        <div class="flex items-center gap-4 mb-6">
                            <span
                                class="text-3xl font-bold text-gray-900">{{ number_format($product->price, 0, '', '.') }}
                                <span class="text-base">VNĐ</span></span>
                            <del class="text-lg text-gray-400">{{ number_format($product->price_sale, 0, '', '.') }}
                                VNĐ</del>
                        </div>
                        <p class="text-gray-700 mb-6">{{ $product->description }}</p>

                        <!-- Stock Information -->
                        <div class="mb-6 p-4 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl border border-blue-200">
                            <h6 class="font-semibold text-gray-800 flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                Kho: <span id="stock-quantity" class="text-green-600 font-semibold">...</span> sản phẩm
                            </h6>
                            <p class="text-xs text-gray-600" id="stock-description">
                                Đang tải thông tin kho...
                            </p>
                        </div>

                        <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <!-- Color -->
                            <div>
                                <h6 class="uppercase text-gray-800 font-semibold mb-2">Color:</h6>
                                <div class="flex flex-wrap gap-2">
                                    @php $colors = $productVariants->pluck('color_name')->unique(); @endphp
                                    @foreach ($colors as $index => $color)
                                        @php
                                            $variantsWithColor = $productVariants->where('color_name', $color);
                                            $totalQuantity = $variantsWithColor->sum('quantity');
                                            $isAvailable = $totalQuantity > 0;
                                        @endphp
                                        <div>
                                            <input type="radio" class="hidden peer" name="color_name"
                                                id="color-{{ $index }}" value="{{ $color }}"
                                                {{ $loop->first ? 'checked' : '' }}
                                                {{ !$isAvailable ? 'disabled' : '' }}>
                                            <label
                                                class="inline-flex items-center cursor-pointer px-3 py-1 border-2 border-gray-300 rounded-full transition
                                                                                                                                                                        peer-checked:border-blue-600 peer-checked:bg-blue-100 peer-checked:text-blue-700 peer-checked:shadow-md
                                                                                                                                                                        bg-white text-gray-700 {{ !$isAvailable ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                for="color-{{ $index }}">
                                                <span class="rounded-full inline-block mr-2 border"
                                                    style="width: 16px; height: 16px; background-color: {{ optional($productVariants->firstWhere('color_name', $color))->hex_code ?? '#ccc' }};"></span>
                                                {{ $color }}
                                                @if($isAvailable)
                                                    <span class="ml-1 text-xs text-green-600 font-medium">({{ $totalQuantity }})</span>
                                                @else
                                                    <span class="ml-1 text-xs text-red-600 font-medium">(Hết hàng)</span>
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Size -->
                            <div>
                                <h6 class="uppercase text-gray-800 font-semibold mb-2">Size:</h6>
                                <div class="flex flex-wrap gap-2">
                                    @php $sizes = $productVariants->pluck('size')->unique(); @endphp
                                    @foreach ($sizes as $index => $size)
                                        @php
                                            $variantsWithSize = $productVariants->where('size', $size);
                                            $totalQuantity = $variantsWithSize->sum('quantity');
                                            $isAvailable = $totalQuantity > 0;
                                        @endphp
                                        <div>
                                            <input type="radio" class="hidden peer size-radio" name="size"
                                                id="size-{{ $index }}" value="{{ $size }}"
                                                {{ $loop->first ? 'checked' : '' }}
                                                {{ !$isAvailable ? 'disabled' : '' }}>
                                            <label
                                                class="inline-flex items-center cursor-pointer px-4 py-2 border-2 border-gray-300 rounded-full transition
                                                                                                                                                                        peer-checked:border-blue-600 peer-checked:bg-blue-100 peer-checked:text-blue-700 peer-checked:shadow-md
                                                                                                                                                                        bg-white text-gray-700 font-semibold {{ !$isAvailable ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                for="size-{{ $index }}">
                                                {{ $size }}
                                                @if($isAvailable)
                                                    <span class="ml-1 text-xs text-green-600 font-medium">({{ $totalQuantity }})</span>
                                                @else
                                                    <span class="ml-1 text-xs text-red-600 font-medium">(Hết hàng)</span>
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="no-size-message" class="hidden mt-2 text-sm text-red-600">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                    Không có size nào khả dụng cho màu này
                                </div>
                            </div>
                            <!-- Quantity -->
                            <div>
                                <h6 class="uppercase text-gray-800 font-semibold mb-2">Quantity:</h6>
                                <input type="number" name="quantity" value="1" min="1" max="100"
                                    class="border rounded-lg px-4 py-2 text-center w-32"
                                    oninput="this.value = Math.max(1, Math.min(100, this.value))" />
                            </div>
                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-4 mt-4">
                                <button type="submit" name="action" value="buy_now"
                                    class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-full px-8 py-3 hover:from-purple-600 hover:to-blue-600 transition-all">Mua
                                    ngay</button>
                                <button type="submit" name="action" value="add_to_cart"
                                    class="w-full sm:w-auto bg-gradient-to-r from-gray-800 to-gray-600 text-white font-bold rounded-full px-8 py-3 hover:from-gray-900 hover:to-gray-700 transition-all">Thêm
                                    vào giỏ</button>
                            </div>
                        </form>
                        <div class="mt-6 flex flex-wrap gap-6 text-sm text-gray-600">
                            <div><span class="font-semibold">SKU:</span> {{ $product->slug }}</div>
                            <div><span class="font-semibold">Category:</span> {{ $product->category_name }}</div>
                            <div><span class="font-semibold">Tags:</span> Classic, Modern</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tabs Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <div x-data="{ tab: window.location.hash ? window.location.hash.substring(1) : 'desc' }"
                     x-init="$watch('tab', value => { sessionStorage.setItem('currentTab', value); })"
                     class="flex flex-col md:flex-row gap-8">
                    <div class="flex flex-row md:flex-col gap-2 md:w-1/4 mb-4 md:mb-0">
                        <button @click="tab = 'desc'; window.location.hash = 'desc'"
                            :class="tab === 'desc' ? 'bg-blue-200 text-blue-800 font-bold' :
                                'bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800'"
                            class="tab-btn px-6 py-3 rounded-xl font-semibold text-left focus:outline-none focus:ring-2 focus:ring-blue-400 mb-2 transition">Mô
                            tả</button>
                        <button @click="tab = 'add'; window.location.hash = 'add'"
                            :class="tab === 'add' ? 'bg-blue-200 text-blue-800 font-bold' :
                                'bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800'"
                            class="tab-btn px-6 py-3 rounded-xl font-semibold text-left focus:outline-none focus:ring-2 focus:ring-blue-400 mb-2 transition">Thông
                            tin thêm</button>
                        <button @click="tab = 'review'; window.location.hash = 'review'"
                            :class="tab === 'review' ? 'bg-blue-200 text-blue-800 font-bold' :
                                'bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800'"
                            class="tab-btn px-6 py-3 rounded-xl font-semibold text-left focus:outline-none focus:ring-2 focus:ring-blue-400 transition">Đánh
                            giá</button>
                    </div>
                    <div class="flex-1">
                        <div x-show="tab === 'desc'" class="tab-content" x-transition>
                            <h5 class="font-bold mb-2">Mô tả sản phẩm</h5>
                            <p class="mb-2">{{ $product->description }}</p>
                            <ul class="list-disc pl-6 mb-2 text-gray-700">
                                <li>Chất liệu cao cấp, bền đẹp</li>
                                <li>Thiết kế hiện đại, hợp xu hướng</li>
                                <li>Bảo hành chính hãng</li>
                            </ul>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis
                                eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit,
                                posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris
                                sit amet orci. Aenean dignissim pellentesque felis. Phasellus ultrices nulla quis nibh.
                                Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus. </p>
                        </div>
                        <div x-show="tab === 'add'" class="tab-content" x-transition>
                            <h5 class="font-bold mb-2">Thông tin thêm</h5>
                            <p>Thông tin bổ sung về sản phẩm...</p>
                        </div>
                        <!-- Reviews Tab -->
                        <div x-show="tab === 'review'" class="tab-content" x-transition>
                            @if (session('success'))
                                <div
                                    class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 border border-green-300 shadow">
                                    {{ session('success') }}</div>
                            @endif
                            <div class="comments-list max-h-80 md:max-h-[500px] overflow-y-auto pr-2 custom-scrollbar space-y-8">
                                @forelse ($comments as $comment)
                                    <div class="comment-item bg-white rounded-2xl shadow-lg p-6 flex flex-col md:flex-row gap-5 border border-gray-100"
                                        x-data="{ showReply: false }" data-comment-id="{{ $comment->id }}">
                                        <div class="flex-shrink-0 flex flex-col items-center">
                                            <img src="{{ asset('storage/' . $comment->user->avatar) }}" alt="user"
                                                class="w-14 h-14 rounded-full object-cover border-2 border-purple-200">
                                        </div>
                                        <div class="flex-1">
                                            <div
                                                class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 mb-1">
                                                <span class="font-bold text-gray-900">{{ $comment->user->name }}</span>
                                                <span
                                                    class="text-xs text-gray-400">{{ $comment->created_at->format('d/m/Y') }}</span>
                                            </div>
                                            <div class="flex items-center gap-1 mb-2">
                                                @php $rating = (int) $comment->rating; @endphp
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <svg class="w-5 h-5 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @endfor
                                            </div>
                                            @if ($comment->content)
                                                <p class="text-gray-700 mb-2 whitespace-pre-line">{{ $comment->content }}
                                                </p>
                                            @endif
                                            @if ($comment->image)
                                                <img src="{{ asset('storage/' . $comment->image) }}" alt="Ảnh bình luận"
                                                    class="rounded-lg mt-2 max-w-[150px] border border-gray-200">
                                            @endif
                                            @if ($comment->replies && $comment->replies->count())
                                                <div class="mt-4 pl-4 border-l-4 border-purple-100 space-y-4">
                                                    @foreach ($comment->replies as $reply)
                                                        <div class="flex gap-3 items-start">
                                                            <img src="{{ asset('images/default-avatar.png') }}"
                                                                alt="user"
                                                                class="w-10 h-10 rounded-full object-cover border border-purple-100">
                                                            <div class="flex-1">
                                                                <div class="flex items-center gap-2 mb-1">
                                                                    <span
                                                                        class="font-semibold text-gray-800">{{ $reply->user->name }}</span>
                                                                    <span
                                                                        class="text-xs text-gray-400">{{ $reply->created_at->format('d/m/Y H:i') }}</span>
                                                                    @if ($reply->user->role === 'admin')
                                                                        <span
                                                                            class="ml-2 px-2 py-0.5 rounded bg-red-500 text-white text-xs font-bold">Admin</span>
                                                                    @endif
                                                                </div>
                                                                <p class="text-gray-700 mb-1 whitespace-pre-line">
                                                                    {{ $reply->content }}</p>
                                                                @if ($reply->image)
                                                                    <img src="{{ asset('storage/' . $reply->image) }}"
                                                                        alt="Ảnh phản hồi"
                                                                        class="rounded mt-1 max-w-[120px] border border-gray-200">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                            <div class="flex gap-2 mt-3 flex-wrap">
                                                @if (auth()->check() && auth()->user()->role == 'admin' && $comment->replies->count() == 0)
                                                    <button @click="showReply = !showReply" type="button"
                                                        class="px-3 py-1 rounded bg-blue-100 text-blue-700 hover:bg-blue-200 text-xs font-semibold transition">Trả
                                                        lời</button>
                                                @endif
                                            </div>
                                            @if (auth()->check() && auth()->user()->role == 'admin')
                                                <div x-show="showReply" class="mt-3" x-transition>
                                                    <form class="reply-form" action="{{ route('comments.store') }}#v-pills-reviews"
                                                        method="POST" class="space-y-3" onsubmit="return handleReplySubmit(event, {{ $comment->id }});">
                                                        @csrf
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}">
                                                        <input type="hidden" name="parent_id"
                                                            value="{{ $comment->id }}">
                                                        <input type="hidden" name="ajax_request" value="1">
                                                        <div>
                                                            <label class="block mb-1 text-sm font-medium">Trả lời:</label>
                                                            <textarea name="content" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400" rows="2"
                                                                placeholder="Trả lời bình luận..." required></textarea>
                                                        </div>
                                                        <button type="submit" class="reply-submit-btn px-4 py-2 rounded bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                                                            <span class="submit-text">Gửi phản hồi</span>
                                                            <span class="loading-text hidden">Đang gửi...</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center text-gray-400 py-8">Chưa có bình luận nào cho sản phẩm này.
                                    </div>
                                @endforelse
                            </div>
                            <div class="add-review mt-10 bg-white rounded-2xl shadow-lg p-8">
                                <h5 class="mb-4 text-xl font-bold text-gray-900">Gửi bình luận của bạn</h5>
                                @if ($canComment)
                                    <form id="review" action="{{ route('comments.store') }}#v-pills-reviews" method="POST"
                                        enctype="multipart/form-data" class="space-y-6" x-data="{ rating: 0, hover: 0 }" onsubmit="return handleCommentSubmit(event);">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="ajax_request" value="1">
                                        <div>
                                            <label class="block mb-1 text-sm font-medium">Đánh giá *</label>
                                            <div class="flex items-center gap-1">
                                                <template x-for="i in [1,2,3,4,5]" :key="i">
                                                    <label :for="'rating' + i" class="cursor-pointer">
                                                        <input type="radio" :id="'rating' + i" name="rating"
                                                            :value="i" class="hidden" x-model="rating">
                                                        <svg @mouseenter="hover = i" @mouseleave="hover = 0"
                                                            @click="rating = i"
                                                            :class="(hover ? hover : rating) >= i ? 'text-yellow-400' :
                                                                'text-gray-300'"
                                                            class="w-7 h-7 transition-colors duration-200 fill-current hover:text-yellow-300"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    </label>
                                                </template>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block mb-1 text-sm font-medium">Ảnh (nếu có)</label>
                                            <input type="file" name="image"
                                                class="w-full border rounded-lg px-3 py-2">
                                        </div>
                                        <div>
                                            <label class="block mb-1 text-sm font-medium">Nội dung bình luận</label>
                                            <textarea name="content" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400" rows="5"
                                                placeholder="Nhập bình luận của bạn..."></textarea>
                                        </div>
                                        <button type="submit" id="submit-comment-btn"
                                            class="px-8 py-2 rounded bg-purple-600 text-white font-bold hover:bg-purple-700 transition">
                                            <span class="submit-text">Gửi bình luận</span>
                                            <span class="loading-text hidden">Đang gửi...</span>
                                        </button>
                                    </form>
                                @elseif ($hasCommented)
                                    <div class="p-6 rounded-lg bg-green-50 border border-green-200 text-center">
                                        <div class="flex items-center justify-center mb-3">
                                            <svg class="w-8 h-8 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <h6 class="text-lg font-semibold text-green-800">Đã đánh giá sản phẩm</h6>
                                        </div>
                                        <p class="text-green-700">Bạn đã đánh giá sản phẩm này. Cảm ơn bạn đã chia sẻ trải nghiệm!</p>
                                    </div>
                                @else
                                    <div class="p-6 rounded-lg bg-yellow-50 border border-yellow-200 text-center">
                                        <div class="flex items-center justify-center mb-3">
                                            <svg class="w-8 h-8 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                            </svg>
                                            <h6 class="text-lg font-semibold text-yellow-800">Chưa thể đánh giá</h6>
                                        </div>
                                        <p class="text-yellow-700">Bạn cần mua sản phẩm này trước khi có thể đánh giá.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products Section -->
    <section class="py-20 bg-gradient-to-br from-gray-50 via-white to-blue-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2
                    class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-gray-900 via-purple-800 to-pink-600 bg-clip-text text-transparent mb-4">
                    Sản phẩm liên quan</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-purple-600 to-pink-600 mx-auto mt-6 rounded-full"></div>
            </div>
            <div class="relative">
                <div class="swiper related-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($products as $product)
                            <div class="swiper-slide">
                                <div class="group relative animate-fade-in-up">
                                    <div
                                        class="bg-white rounded-3xl shadow-2xl border-2 border-transparent group-hover:border-purple-400 transition-all duration-300 overflow-hidden">
                                        <div class="relative overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                                            <img src="{{ asset('storage/' . $product->img_thumb) }}"
                                                alt="{{ $product->name }}"
                                                class="w-full h-60 object-cover rounded-t-3xl group-hover:scale-105 transition-transform duration-500">
                                            <span
                                                class="absolute top-4 left-4 flex items-center gap-1 bg-gradient-to-r from-pink-500 to-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3"></path>
                                                </svg>
                                                -30%
                                            </span>
                                        </div>
                                        <div class="p-6 flex flex-col h-full">
                                            <h3
                                                class="text-lg font-extrabold text-gray-900 mb-2 line-clamp-2 group-hover:text-purple-600 transition-colors duration-200">
                                                <a href="{{ route('home.show', $product->id) }}"
                                                    class="hover:underline">{{ $product->name }}</a>
                                            </h3>
                                            <div class="flex items-center gap-2 mb-2">
                                                <span
                                                    class="text-2xl font-bold text-pink-600">{{ number_format($product->price, 0, '', '.') }}
                                                    VNĐ</span>
                                                <del class="text-base text-gray-400">{{ number_format($product->price_sale, 0, '', '.') }}
                                                    VNĐ</del>
                                            </div>
                                            <div class="flex items-center gap-1 mb-4">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <svg width="18" height="18"
                                                        class="{{ $i <= 4 ? 'text-yellow-400' : 'text-gray-300' }}"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                        </path>
                                                    </svg>
                                                @endfor
                                                <span class="ml-2 text-sm text-gray-500">(4.5)</span>
                                            </div>
                                            <a href="{{ route('home.show', $product->id) }}"
                                                class="mt-auto w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold py-3 px-4 rounded-xl hover:from-purple-700 hover:to-pink-700 transition-all duration-200 flex items-center justify-center gap-2 shadow-lg">
                                                <span>Xem chi tiết</span>
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-prev related-prev"></div>
                    <div class="swiper-button-next related-next"></div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing gallery...'); // Debug log

            // Check if we need to scroll to new comment
            if (sessionStorage.getItem('scrollToNewComment') === 'true') {
                sessionStorage.removeItem('scrollToNewComment');

                // Switch to review tab first
                const reviewsTab = document.querySelector('[x-data]');
                if (reviewsTab && reviewsTab.__x) {
                    reviewsTab.__x.$data.tab = 'review';
                    window.location.hash = 'review';
                }

                // Scroll to the first comment (newest) after a short delay
                setTimeout(() => {
                    const newComment = document.querySelector('.comment-item:first-child');
                    if (newComment) {
                        newComment.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });

                        // Add highlight effect
                        newComment.style.backgroundColor = '#fef3c7';
                        newComment.style.borderColor = '#f59e0b';
                        newComment.style.transform = 'scale(1.02)';
                        newComment.style.transition = 'all 0.3s ease';

                        // Remove highlight after 3 seconds
                        setTimeout(() => {
                            newComment.style.backgroundColor = '';
                            newComment.style.borderColor = '';
                            newComment.style.transform = '';
                        }, 3000);
                    }
                }, 800);
            }

            new Swiper('.related-swiper', {
                slidesPerView: 4,
                spaceBetween: 32,
                navigation: {
                    nextEl: '.related-next',
                    prevEl: '.related-prev',
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 4
                    },
                    768: {
                        slidesPerView: 3
                    },
                    640: {
                        slidesPerView: 2
                    },
                    0: {
                        slidesPerView: 1
                    }
                }
            });

            // Initialize notifications with beautiful animations
            initializeNotifications();

            // Add click event listeners to gallery images
            const galleryImages = document.querySelectorAll('.gallery-image');
            console.log('Found gallery images:', galleryImages.length); // Debug log

            galleryImages.forEach((img, index) => {
                img.addEventListener('click', function(e) {
                    console.log('Gallery image clicked:', index); // Debug log
                    const imgElement = this.querySelector('img');
                    if (imgElement) {
                        changeMainImage(imgElement.src, imgElement.alt, this);
                    }
                });
            });
        });

        function initializeNotifications() {
            const successNotification = document.getElementById('success-notification');
            const errorNotification = document.getElementById('error-notification');

            if (successNotification) {
                showNotification(successNotification, 'progress-bar');
            }

            if (errorNotification) {
                showNotification(errorNotification, 'error-progress-bar');
            }
        }

        function showNotification(notification, progressBarId) {
            // Show notification with slide-in animation
            setTimeout(() => {
                notification.classList.remove('opacity-0', 'translate-x-full');
                notification.classList.add('opacity-100', 'translate-x-0', 'notification-bounce');

                // Add glow effect based on notification type
                const notificationDiv = notification.querySelector('div');
                if (progressBarId === 'progress-bar') {
                    notificationDiv.classList.add('notification-glow');
                } else {
                    notificationDiv.classList.add('notification-glow-error');
                }
            }, 100);

            // Animate progress bar
            const progressBar = document.getElementById(progressBarId);
            if (progressBar) {
                setTimeout(() => {
                    progressBar.style.width = '0%';
                }, 100);
            }

            // Auto hide after 5 seconds
            setTimeout(() => {
                hideNotification(notification);
            }, 5000);
        }

        function hideNotification(notification) {
            notification.classList.remove('opacity-100', 'translate-x-0');
            notification.classList.add('opacity-0', 'translate-x-full');

            setTimeout(() => {
                notification.remove();
            }, 500);
        }

        function closeNotification(notificationId) {
            const notification = document.getElementById(notificationId);
            if (notification) {
                hideNotification(notification);
            }
        }

        // Add confetti effect for success notification
        function createConfetti() {
            const colors = ['#10B981', '#059669', '#34D399', '#6EE7B7', '#A7F3D0'];
            const confettiCount = 50;

            for (let i = 0; i < confettiCount; i++) {
                const confetti = document.createElement('div');
                confetti.style.position = 'fixed';
                confetti.style.top = '0';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.width = Math.random() * 10 + 5 + 'px';
                confetti.style.height = Math.random() * 10 + 5 + 'px';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.borderRadius = '50%';
                confetti.style.pointerEvents = 'none';
                confetti.style.zIndex = '9999';
                confetti.style.animation = `fall ${Math.random() * 3 + 2}s linear forwards`;

                document.body.appendChild(confetti);

                setTimeout(() => {
                    confetti.remove();
                }, 5000);
            }
        }

        // Add CSS for confetti animation
        const style = document.createElement('style');
        style.textContent = `
                                            @keyframes fall {
                                                to {
                                                    transform: translateY(100vh) rotate(360deg);
                                                    opacity: 0;
                                                }
                                            }

                                            @keyframes bounce {
                                                0%, 20%, 50%, 80%, 100% {
                                                    transform: translateY(0);
                                                }
                                                40% {
                                                    transform: translateY(-10px);
                                                }
                                                60% {
                                                    transform: translateY(-5px);
                                                }
                                            }

                                            @keyframes glow {
                                                0%, 100% {
                                                    box-shadow: 0 0 5px rgba(16, 185, 129, 0.5);
                                                }
                                                50% {
                                                    box-shadow: 0 0 20px rgba(16, 185, 129, 0.8), 0 0 30px rgba(16, 185, 129, 0.6);
                                                }
                                            }

                                            @keyframes glow-error {
                                                0%, 100% {
                                                    box-shadow: 0 0 5px rgba(239, 68, 68, 0.5);
                                                }
                                                50% {
                                                    box-shadow: 0 0 20px rgba(239, 68, 68, 0.8), 0 0 30px rgba(239, 68, 68, 0.6);
                                                }
                                            }

                                            .notification-bounce {
                                                animation: bounce 0.6s ease-in-out;
                                            }

                                            .notification-glow {
                                                animation: glow 2s ease-in-out infinite;
                                            }

                                            .notification-glow-error {
                                                animation: glow-error 2s ease-in-out infinite;
                                            }
                                        `;
        document.head.appendChild(style);

        // Trigger confetti for success notification
        const successNotification = document.getElementById('success-notification');
        if (successNotification) {
            setTimeout(() => {
                createConfetti();
            }, 200);
        }

        // Function to change main product image
        function changeMainImage(imageSrc, imageAlt, clickedElement) {
            console.log('changeMainImage called with:', imageSrc, imageAlt); // Debug log

            const mainImage = document.getElementById('main-product-image');
            if (!mainImage) {
                console.error('Main image element not found');
                return;
            }

            const currentMainSrc = mainImage.src;
            const currentMainAlt = mainImage.alt;

            console.log('Current main image:', currentMainSrc); // Debug log

            // Simple image swap without complex animations for now
            mainImage.src = imageSrc;
            mainImage.alt = imageAlt;

            // Update the clicked gallery image with the old main image
            const clickedImage = clickedElement.querySelector('img');
            if (clickedImage) {
                clickedImage.src = currentMainSrc;
                clickedImage.alt = currentMainAlt;
            }

            // Handle badge "Chính" - remove from all and add to clicked
            const allBadges = document.querySelectorAll('.gallery-image .absolute.top-1.left-1 span');
            allBadges.forEach(badge => {
                if (badge.textContent === 'Chính') {
                    badge.remove();
                }
            });

            // Add badge to clicked element if it doesn't have one
            const clickedBadge = clickedElement.querySelector('.absolute.top-1.left-1 span');
            if (!clickedBadge) {
                const badgeContainer = clickedElement.querySelector('.absolute.top-1.left-1');
                if (badgeContainer) {
                    const newBadge = document.createElement('span');
                    newBadge.className =
                        'bg-gradient-to-r from-purple-500 to-pink-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full shadow-lg';
                    newBadge.textContent = 'Chính';
                    badgeContainer.appendChild(newBadge);
                }
            }

            // Add visual feedback to clicked gallery image
            const galleryImages = document.querySelectorAll('.gallery-image');
            galleryImages.forEach(img => {
                img.style.border = '2px solid transparent';
                img.style.transform = 'scale(1)';
            });

            // Highlight the clicked image
            clickedElement.style.border = '2px solid #8b5cf6';
            clickedElement.style.transform = 'scale(1.05)';

            console.log('Image change completed'); // Debug log
        }

        // Test function
        function testGallery() {
            console.log('Test button clicked');
            const mainImage = document.getElementById('main-product-image');
            const galleryImages = document.querySelectorAll('.gallery-image');

            console.log('Main image:', mainImage);
            console.log('Gallery images found:', galleryImages.length);

            if (galleryImages.length > 0) {
                const firstGalleryImage = galleryImages[0].querySelector('img');
                if (firstGalleryImage) {
                    console.log('First gallery image src:', firstGalleryImage.src);
                    changeMainImage(firstGalleryImage.src, firstGalleryImage.alt, galleryImages[0]);
                }
            }
        }

        // Function to show notification when image changes
        function showImageChangeNotification() {
            // Create notification element
            const notification = document.createElement('div');
            notification.className =
                'fixed top-6 right-6 z-50 transform transition-all duration-500 ease-out opacity-0 translate-x-full';
            notification.innerHTML = `
                        <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-3 rounded-xl shadow-lg border border-blue-400/30 backdrop-blur-sm">
                            <div class="flex items-center space-x-2">
                                <div class="flex-shrink-0">
                                    <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-sm">Đã thay đổi ảnh chính</p>
                                </div>
                            </div>
                        </div>
                    `;

            document.body.appendChild(notification);

            // Show notification
            setTimeout(() => {
                notification.classList.remove('opacity-0', 'translate-x-full');
                notification.classList.add('opacity-100', 'translate-x-0');
            }, 100);

            // Hide notification after 2 seconds
            setTimeout(() => {
                notification.classList.remove('opacity-100', 'translate-x-0');
                notification.classList.add('opacity-0', 'translate-x-full');
                setTimeout(() => {
                    notification.remove();
                }, 500);
            }, 2000);
        }

        // Product variants data for stock calculation
        const productVariants = @json($productVariants);

        // Function to update size options based on selected color
        function updateSizeOptions() {
            const selectedColor = document.querySelector('input[name="color_name"]:checked')?.value;
            const sizeInputs = document.querySelectorAll('input[name="size"]');
            let firstEnabled = null;
            let foundChecked = false;
            let enabledCount = 0;

            console.log('Updating size options for color:', selectedColor);

            sizeInputs.forEach(input => {
                const sizeValue = input.value;
                const sizeLabel = input.parentElement;

                if (selectedColor) {
                    // Kiểm tra có biến thể với color và size này không
                    const exists = productVariants.some(variant =>
                        variant.color_name === selectedColor && variant.size.toString() === sizeValue.toString()
                    );

                    console.log('Size', sizeValue, 'exists for color', selectedColor, ':', exists);

                    if (exists) {
                        input.disabled = false;
                        sizeLabel.style.display = '';
                        sizeLabel.classList.remove('opacity-50', 'cursor-not-allowed');
                        if (!firstEnabled) firstEnabled = input;
                        if (input.checked) foundChecked = true;
                        enabledCount++;
                    } else {
                        input.disabled = true;
                        sizeLabel.style.display = 'none';
                        input.checked = false;
                    }
                } else {
                    // Nếu chưa chọn màu, hiển thị tất cả size
                    input.disabled = false;
                    sizeLabel.style.display = '';
                    sizeLabel.classList.remove('opacity-50', 'cursor-not-allowed');
                    if (!firstEnabled) firstEnabled = input;
                    if (input.checked) foundChecked = true;
                    enabledCount++;
                }
            });

            // Nếu size đang chọn không hợp lệ, tự động chọn size đầu tiên hợp lệ
            if (!foundChecked && firstEnabled) {
                firstEnabled.checked = true;
                console.log('Auto-selected first available size:', firstEnabled.value);
            }

            // Thông báo nếu không có size nào khả dụng
            if (selectedColor && enabledCount === 0) {
                console.log('No sizes available for color:', selectedColor);
                const noSizeMessage = document.getElementById('no-size-message');
                if (noSizeMessage) {
                    noSizeMessage.classList.remove('hidden');
                }
            } else {
                const noSizeMessage = document.getElementById('no-size-message');
                if (noSizeMessage) {
                    noSizeMessage.classList.add('hidden');
                }
            }
        }

        // Function to update stock quantity based on selected variant
        function updateStockQuantity() {
            const selectedColor = document.querySelector('input[name="color_name"]:checked')?.value;
            const selectedSize = document.querySelector('input[name="size"]:checked')?.value;
            const stockElement = document.getElementById('stock-quantity');
            const stockDescription = document.getElementById('stock-description');

            console.log('Selected color:', selectedColor);
            console.log('Selected size:', selectedSize);
            console.log('Product variants:', productVariants);

            if (!stockElement || !stockDescription) {
                console.log('Stock elements not found');
                return;
            }

            // If both color and size are selected, show specific variant quantity
            if (selectedColor && selectedSize) {
                // Convert size to string for comparison if it's a number
                const sizeToCompare = selectedSize.toString();

                console.log('Looking for variant with color:', selectedColor, 'and size:', sizeToCompare);

                // Find the variant that matches both color and size
                const selectedVariant = productVariants.find(variant => {
                    const variantColor = variant.color_name;
                    const variantSize = variant.size.toString();
                    const matches = variantColor === selectedColor && variantSize === sizeToCompare;
                    console.log('Checking variant:', variantColor, variantSize, 'matches:', matches);
                    return matches;
                });

                console.log('Found variant:', selectedVariant);

                if (selectedVariant) {
                    stockElement.textContent = selectedVariant.quantity;

                    // Update color based on availability
                    if (selectedVariant.quantity > 0) {
                        stockElement.className = 'text-green-600 font-semibold';
                        stockDescription.textContent = `Số lượng còn lại cho ${selectedColor} - Size ${selectedSize}`;
                    } else {
                        stockElement.className = 'text-red-600 font-semibold';
                        stockDescription.textContent = `Biến thể ${selectedColor} - Size ${selectedSize} đã hết hàng`;
                    }
                } else {
                    stockElement.textContent = '0';
                    stockElement.className = 'text-red-600 font-semibold';
                    stockDescription.textContent = `Biến thể ${selectedColor} - Size ${selectedSize} không tồn tại`;
                }
            } else {
                // If not both color and size are selected, show total quantity
                const totalQuantity = productVariants.reduce((sum, variant) => sum + parseInt(variant.quantity), 0);
                stockElement.textContent = totalQuantity;

                if (totalQuantity > 0) {
                    stockElement.className = 'text-green-600 font-semibold';
                    stockDescription.textContent = 'Tổng số lượng tất cả biến thể trong kho - Chọn màu và size để xem số lượng cụ thể';
                } else {
                    stockElement.className = 'text-red-600 font-semibold';
                    stockDescription.textContent = 'Kho hiện tại đang trống';
                }
            }
        }

        // Add event listeners for color and size selection
        document.addEventListener('DOMContentLoaded', function() {
            const colorInputs = document.querySelectorAll('input[name="color_name"]');
            const sizeInputs = document.querySelectorAll('input[name="size"]');

            console.log('Color inputs found:', colorInputs.length);
            console.log('Size inputs found:', sizeInputs.length);

            // Log the first selected color and size
            const firstColor = document.querySelector('input[name="color_name"]:checked');
            const firstSize = document.querySelector('input[name="size"]:checked');
            console.log('First selected color:', firstColor?.value);
            console.log('First selected size:', firstSize?.value);

            colorInputs.forEach(input => {
                input.addEventListener('change', function() {
                    console.log('Color changed to:', this.value);
                    updateSizeOptions(); // Cập nhật size options trước
                    updateStockQuantity(); // Sau đó cập nhật stock
                });
            });

            sizeInputs.forEach(input => {
                input.addEventListener('change', function() {
                    console.log('Size changed to:', this.value);
                    updateStockQuantity();
                });
            });

            // Initialize stock quantity on page load with a small delay to ensure DOM is ready
            setTimeout(() => {
                console.log('Initializing stock quantity...');
                // Cập nhật size options trước
                updateSizeOptions();

                // If both color and size are selected, show specific variant quantity
                if (firstColor && firstSize) {
                    const selectedColor = firstColor.value;
                    const selectedSize = firstSize.value;
                    const sizeToCompare = selectedSize.toString();

                    console.log('Looking for initial variant with color:', selectedColor, 'and size:', sizeToCompare);

                    const selectedVariant = productVariants.find(variant => {
                        const variantColor = variant.color_name;
                        const variantSize = variant.size.toString();
                        const matches = variantColor === selectedColor && variantSize === sizeToCompare;
                        console.log('Checking initial variant:', variantColor, variantSize, 'matches:', matches);
                        return matches;
                    });

                    console.log('Found initial variant:', selectedVariant);

                    if (selectedVariant) {
                        const stockElement = document.getElementById('stock-quantity');
                        const stockDescription = document.getElementById('stock-description');

                        if (stockElement && stockDescription) {
                            stockElement.textContent = selectedVariant.quantity;

                            if (selectedVariant.quantity > 0) {
                                stockElement.className = 'text-green-600 font-semibold';
                                stockDescription.textContent = `Số lượng còn lại cho ${selectedColor} - Size ${selectedSize}`;
                            } else {
                                stockElement.className = 'text-red-600 font-semibold';
                                stockDescription.textContent = `Biến thể ${selectedColor} - Size ${selectedSize} đã hết hàng`;
                            }
                        }
                    } else {
                        updateStockQuantity();
                    }
                } else {
                    updateStockQuantity();
                }
            }, 100);
        });

        // Function to show notification
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed top-6 right-6 z-50 transform transition-all duration-500 ease-out opacity-0 translate-x-full`;
            notification.innerHTML = `
                <div class="bg-gradient-to-r ${type === 'success' ? 'from-emerald-500 to-green-600' : 'from-red-500 to-pink-600'} text-white px-6 py-4 rounded-2xl shadow-2xl border ${type === 'success' ? 'border-emerald-400/30' : 'border-red-400/30'} backdrop-blur-sm">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center shadow-lg ring-2 ring-white/30">
                                <svg class="w-5 h-5 text-white drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="${type === 'success' ? 'M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z' : 'M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z'}" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-sm">${message}</p>
                            <p class="text-xs ${type === 'success' ? 'text-emerald-100' : 'text-red-100'}">${type === 'success' ? 'Thao tác thành công!' : 'Đã xảy ra lỗi!'}</p>
                        </div>
                    </div>
                </div>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.classList.remove('opacity-0', 'translate-x-full');
                notification.classList.add('opacity-100', 'translate-x-0');
            }, 100);

            setTimeout(() => {
                notification.classList.remove('opacity-100', 'translate-x-0');
                notification.classList.add('opacity-0', 'translate-x-full');
                setTimeout(() => {
                    notification.remove();
                }, 500);
            }, 3000);
        }

        // Function to handle comment submission (AJAX)
        function handleCommentSubmit(event) {
            event.preventDefault();

            // Show beautiful confirmation modal
            showConfirmationModal();

            return false;
        }

        // Function to show confirmation modal
        function showConfirmationModal() {
            // Create modal HTML
            const modalHTML = `
                <div id="confirmation-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0">
                        <div class="p-6">
                            <div class="flex items-center justify-center mb-4">
                                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 text-center mb-2">Xác nhận gửi bình luận</h3>
                            <p class="text-gray-600 text-center mb-6">
                                Bạn có chắc chắn muốn gửi bình luận này?<br>
                                <span class="font-semibold text-yellow-600">Lưu ý:</span> Sau khi gửi, bạn sẽ <span class="font-bold text-red-600">KHÔNG THỂ</span> chỉnh sửa hoặc xóa bình luận này.
                            </p>
                            <div class="flex gap-3">
                                <button id="cancel-comment" class="flex-1 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                                    Hủy bỏ
                                </button>
                                <button id="confirm-comment" class="flex-1 px-4 py-2 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-700 transition-colors">
                                    Gửi bình luận
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Add modal to body
            document.body.insertAdjacentHTML('beforeend', modalHTML);

            // Animate modal in
            setTimeout(() => {
                const modal = document.getElementById('confirmation-modal');
                const modalContent = modal.querySelector('.bg-white');
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);

            // Handle cancel button
            document.getElementById('cancel-comment').addEventListener('click', () => {
                hideConfirmationModal();
            });

            // Handle confirm button
            document.getElementById('confirm-comment').addEventListener('click', () => {
                hideConfirmationModal();
                submitCommentForm();
            });

            // Handle clicking outside modal
            document.getElementById('confirmation-modal').addEventListener('click', (e) => {
                if (e.target.id === 'confirmation-modal') {
                    hideConfirmationModal();
                }
            });
        }

        // Function to hide confirmation modal
        function hideConfirmationModal() {
            const modal = document.getElementById('confirmation-modal');
            const modalContent = modal.querySelector('.bg-white');
            modalContent.classList.add('scale-95', 'opacity-0');
            modalContent.classList.remove('scale-100', 'opacity-100');

            setTimeout(() => {
                modal.remove();
            }, 300);
        }

        // Function to submit comment form
        function submitCommentForm() {
            const form = document.getElementById('comment-form');
            const formData = new FormData(form);
            const submitBtn = form.querySelector('#submit-comment-btn');
            const loadingText = submitBtn.querySelector('.loading-text');
            const submitText = submitBtn.querySelector('.submit-text');

            // Show loading state
            submitText.classList.add('hidden');
            loadingText.classList.remove('hidden');
            submitBtn.disabled = true;



            fetch(form.action, {
                method: form.method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');

                    // Reset form
                    form.reset();

                    // Reset rating stars
                    const ratingInputs = form.querySelectorAll('input[name="rating"]');
                    ratingInputs.forEach(input => input.checked = false);

                    // Reset Alpine.js rating
                    const alpineComponent = form.__x;
                    if (alpineComponent) {
                        alpineComponent.$data.rating = 0;
                        alpineComponent.$data.hover = 0;
                    }

                    // Hide form and show success message
                    form.style.display = 'none';
                    const successMessage = document.createElement('div');
                    successMessage.className = 'p-6 rounded-lg bg-green-50 border border-green-200 text-center';
                    successMessage.innerHTML = `
                        <div class="flex items-center justify-center mb-3">
                            <svg class="w-8 h-8 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h6 class="text-lg font-semibold text-green-800">Đã đánh giá sản phẩm</h6>
                        </div>
                        <p class="text-green-700">Bạn đã đánh giá sản phẩm này. Cảm ơn bạn đã chia sẻ trải nghiệm!</p>
                    `;
                    form.parentNode.appendChild(successMessage);

                    // Switch to review tab and scroll to comments
                    setTimeout(() => {
                        const reviewsTab = document.querySelector('[x-data]');
                        if (reviewsTab && reviewsTab.__x) {
                            reviewsTab.__x.$data.tab = 'review';
                            window.location.hash = 'review';
                        }

                                            // Reload page to show new comment and scroll to it
                    setTimeout(() => {
                        // Store flag in sessionStorage to indicate new comment
                        sessionStorage.setItem('scrollToNewComment', 'true');
                        location.reload();
                    }, 1000);
                    }, 500);
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error submitting comment:', error);
                showNotification('Đã xảy ra lỗi khi gửi bình luận.', 'error');
            })
            .finally(() => {
                // Reset button state
                submitText.classList.remove('hidden');
                loadingText.classList.add('hidden');
                submitBtn.disabled = false;
            });
            return false;
        }



        // Function to handle reply submission (AJAX)
        function handleReplySubmit(event, commentId) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const submitBtn = form.querySelector('.reply-submit-btn');
            const loadingText = submitBtn.querySelector('.loading-text');
            const submitText = submitBtn.querySelector('.submit-text');

            // Show loading state
            submitText.classList.add('hidden');
            loadingText.classList.remove('hidden');
            submitBtn.disabled = true;

            fetch(form.action, {
                method: form.method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');

                    // Reset form
                    form.reset();

                    // Hide reply form
                    const replyContainer = form.closest('[x-data]');
                    if (replyContainer && replyContainer.__x) {
                        replyContainer.__x.$data.showReply = false;
                    }

                    // Hide reply button after successful reply
                    const replyButton = document.querySelector(`[data-comment-id="${commentId}"] button[onclick*="showReply"]`);
                    if (replyButton) {
                        replyButton.style.display = 'none';
                    }

                    // Reload page to show new reply
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error submitting reply:', error);
                showNotification('Đã xảy ra lỗi khi gửi phản hồi.', 'error');
            })
            .finally(() => {
                // Reset button state
                submitText.classList.remove('hidden');
                loadingText.classList.add('hidden');
                submitBtn.disabled = false;
            });
            return false;
        }
    </script>
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
            background: #f3f4f6;
            border-radius: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #c4b5fd;
            border-radius: 8px;
        }

        .custom-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: #c4b5fd #f3f4f6;
        }

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.5s ease-out;
        }

        /* Modal animations */
        @keyframes modal-fade-in {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes modal-fade-out {
            from {
                opacity: 1;
                transform: scale(1);
            }
            to {
                opacity: 0;
                transform: scale(0.9);
            }
        }

        .modal-enter {
            animation: modal-fade-in 0.3s ease-out;
        }

        .modal-exit {
            animation: modal-fade-out 0.3s ease-in;
        }
    </style>
@endsection
