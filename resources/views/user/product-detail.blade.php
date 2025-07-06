@extends('layouts.user')
@section('content')
    <!-- Notification Messages -->
    @if(session('add_to_cart'))
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

    @if(session('error'))
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
                    <div class="relative bg-white rounded-3xl shadow-xl overflow-hidden flex items-center justify-center mb-4">
                        <img id="main-product-image" src="{{ asset('storage/' . $product->img_thumb) }}" alt="{{ $product->name }}"
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
                    @if($galleryImages->count() > 0)
                        <div class="bg-white rounded-2xl shadow-lg p-4">
                            <h4 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                                <i class="fas fa-palette text-indigo-500"></i>
                                Ảnh sản phẩm cùng loại khác màu
                            </h4>
                            <div class="grid grid-cols-3 md:grid-cols-6 gap-3">
                                <!-- Ảnh chính (đầu tiên) -->
                                <div class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105 cursor-pointer gallery-image border-2 border-purple-500">
                                    <img src="{{ asset('storage/' . $product->img_thumb) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-20 object-cover">
                                    
                                    <!-- Overlay với click icon -->
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                        <div class="opacity-0 group-hover:opacity-100 transition-all duration-300">
                                            <div class="bg-white/90 backdrop-blur-sm rounded-full p-2 shadow-lg">
                                                <svg class="w-4 h-4 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Badge cho ảnh chính -->
                                    <div class="absolute top-1 left-1">
                                        <span class="bg-gradient-to-r from-purple-500 to-pink-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full shadow-lg">
                                            Chính
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Ảnh gallery -->
                                @foreach($galleryImages->take(5) as $gallery)
                                    <div class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105 cursor-pointer gallery-image border-2 border-transparent">
                                        <img src="{{ asset('storage/product_galleries/' . $gallery->image) }}" 
                                             alt="{{ $gallery->alt_text ?? $product->name }}" 
                                             class="w-full h-20 object-cover">
                                        
                                        <!-- Overlay với click icon -->
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                            <div class="opacity-0 group-hover:opacity-100 transition-all duration-300">
                                                <div class="bg-white/90 backdrop-blur-sm rounded-full p-2 shadow-lg">
                                                    <svg class="w-4 h-4 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Thông báo nếu có nhiều hơn 5 ảnh gallery -->
                            @if($galleryImages->count() > 5)
                                <div class="mt-3 text-center">
                                    <p class="text-sm text-gray-500">
                                        <i class="fas fa-info-circle text-indigo-400"></i>
                                        Hiển thị {{ 1 + min(5, $galleryImages->count()) }}/{{ 1 + $galleryImages->count() }} màu sắc
                                    </p>
                                </div>
                            @endif
                            
                            <!-- Test button -->
                            <div class="mt-3 text-center">
                                <button onclick="testGallery()" class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm">
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
                                <div class="w-16 h-16 bg-gradient-to-r from-gray-200 to-gray-300 rounded-full flex items-center justify-center mx-auto mb-4">
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
                                <svg class="w-6 h-6 {{ $i <= 4 ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            @endfor
                            <span class="ml-2 text-sm text-gray-500">(4.5)</span>
                        </div>
                        <div class="flex items-center gap-4 mb-6">
                            <span class="text-3xl font-bold text-gray-900">{{ number_format($product->price, 0, '', '.') }}
                                <span class="text-base">VNĐ</span></span>
                            <del class="text-lg text-gray-400">{{ number_format($product->price_sale, 0, '', '.') }}
                                VNĐ</del>
                        </div>
                        <p class="text-gray-700 mb-6">{{ $product->description }}</p>
                        <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <!-- Color -->
                            <div>
                                <h6 class="uppercase text-gray-800 font-semibold mb-2">Color:</h6>
                                <div class="flex flex-wrap gap-2">
                                    @php $colors = $productVariants->pluck('color_name')->unique(); @endphp
                                    @foreach ($colors as $index => $color)
                                        <div>
                                            <input type="radio" class="hidden peer" name="color_name" id="color-{{ $index }}"
                                                value="{{ $color }}" {{ $loop->first ? 'checked' : '' }}>
                                            <label
                                                class="inline-flex items-center cursor-pointer px-3 py-1 border-2 border-gray-300 rounded-full transition
                                                                                                                                                        peer-checked:border-blue-600 peer-checked:bg-blue-100 peer-checked:text-blue-700 peer-checked:shadow-md
                                                                                                                                                        bg-white text-gray-700"
                                                for="color-{{ $index }}">
                                                <span class="rounded-full inline-block mr-2 border"
                                                    style="width: 16px; height: 16px; background-color: {{ optional($productVariants->firstWhere('color_name', $color))->hex_code ?? '#ccc' }};"></span>
                                                {{ $color }}
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
                                        <div>
                                            <input type="radio" class="hidden peer" name="size" id="size-{{ $index }}"
                                                value="{{ $size }}" {{ $loop->first ? 'checked' : '' }}>
                                            <label
                                                class="inline-flex items-center cursor-pointer px-4 py-2 border-2 border-gray-300 rounded-full transition
                                                                                                                                                        peer-checked:border-blue-600 peer-checked:bg-blue-100 peer-checked:text-blue-700 peer-checked:shadow-md
                                                                                                                                                        bg-white text-gray-700 font-semibold"
                                                for="size-{{ $index }}">
                                                {{ $size }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Quantity -->
                            <div>
                                <h6 class="uppercase text-gray-800 font-semibold mb-2">Quantity:</h6>
                                <input type="number" name="quantity" value="1" min="1" max="100"
                                    class="border rounded-lg px-4 py-2 text-center w-32">
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
                <div x-data="{ tab: 'desc' }" class="flex flex-col md:flex-row gap-8">
                    <div class="flex flex-row md:flex-col gap-2 md:w-1/4 mb-4 md:mb-0">
                        <button @click="tab = 'desc'"
                            :class="tab === 'desc' ? 'bg-blue-200 text-blue-800 font-bold' : 'bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800'"
                            class="tab-btn px-6 py-3 rounded-xl font-semibold text-left focus:outline-none focus:ring-2 focus:ring-blue-400 mb-2 transition">Mô
                            tả</button>
                        <button @click="tab = 'add'"
                            :class="tab === 'add' ? 'bg-blue-200 text-blue-800 font-bold' : 'bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800'"
                            class="tab-btn px-6 py-3 rounded-xl font-semibold text-left focus:outline-none focus:ring-2 focus:ring-blue-400 mb-2 transition">Thông
                            tin thêm</button>
                        <button @click="tab = 'review'"
                            :class="tab === 'review' ? 'bg-blue-200 text-blue-800 font-bold' : 'bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800'"
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
                        </div>
                        <div x-show="tab === 'add'" class="tab-content" x-transition>
                            <h5 class="font-bold mb-2">Thông tin thêm</h5>
                            <p>Thông tin bổ sung về sản phẩm...</p>
                        </div>
                        <div x-show="tab === 'review'" class="tab-content" x-transition>
                            <h5 class="font-bold mb-2">Đánh giá khách hàng</h5>
                            <div class="space-y-6">
                                <div class="flex items-center gap-4">
                                    <img src="/images/reviewer-1.jpg" alt="review"
                                        class="w-12 h-12 rounded-full object-cover">
                                    <div>
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                            <span class="text-sm text-gray-500">4.5</span>
                                        </div>
                                        <div class="font-semibold">Tina Johnson <span class="text-xs text-gray-400">–
                                                03/07/2023</span></div>
                                        <p class="text-gray-700">Sản phẩm rất đẹp, chất lượng tốt, giao hàng nhanh!</p>
                                    </div>
                                </div>
                                <!-- Add more reviews as needed -->
                            </div>
                            <div class="mt-8">
                                <h6 class="font-bold mb-2">Thêm đánh giá</h6>
                                <form class="space-y-4">
                                    <div>
                                        <label class="block mb-1">Đánh giá *</label>
                                        <div class="flex items-center gap-1">
                                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                            <!-- ... -->
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block mb-1">Nội dung *</label>
                                        <textarea class="border rounded-lg px-3 py-2 w-full"
                                            placeholder="Viết đánh giá của bạn..."></textarea>
                                    </div>
                                    <div>
                                        <label class="block mb-1">Tên *</label>
                                        <input type="text" class="border rounded-lg px-3 py-2 w-full"
                                            placeholder="Tên của bạn">
                                    </div>
                                    <div>
                                        <label class="block mb-1">Email *</label>
                                        <input type="email" class="border rounded-lg px-3 py-2 w-full"
                                            placeholder="Email của bạn">
                                    </div>
                                    <button type="submit"
                                        class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-lg px-6 py-3 hover:from-purple-600 hover:to-blue-600 transition-all">Gửi
                                        đánh giá</button>
                                </form>
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
                                            <img src="{{ asset('storage/' . $product->img_thumb) }}" alt="{{ $product->name }}"
                                                class="w-full h-60 object-cover rounded-t-3xl group-hover:scale-105 transition-transform duration-500">
                                            <span
                                                class="absolute top-4 left-4 flex items-center gap-1 bg-gradient-to-r from-pink-500 to-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        document.addEventListener('DOMContentLoaded', function () {
            console.log('DOM loaded, initializing gallery...'); // Debug log
            
            new Swiper('.related-swiper', {
                slidesPerView: 4,
                spaceBetween: 32,
                navigation: {
                    nextEl: '.related-next',
                    prevEl: '.related-prev',
                },
                breakpoints: {
                    1024: { slidesPerView: 4 },
                    768: { slidesPerView: 3 },
                    640: { slidesPerView: 2 },
                    0: { slidesPerView: 1 }
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
                    newBadge.className = 'bg-gradient-to-r from-purple-500 to-pink-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full shadow-lg';
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
            notification.className = 'fixed top-6 right-6 z-50 transform transition-all duration-500 ease-out opacity-0 translate-x-full';
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
    </script>
@endsection
