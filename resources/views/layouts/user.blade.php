<?php
    $logos = \App\Models\Logo::all();
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!-- Custom Scripts -->
    <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
</head>

<body>

    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <defs>
            <symbol xmlns="http://www.w3.org/2000/svg" id="link" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M12 19a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm0-4a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm-5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm7-12h-1V2a1 1 0 0 0-2 0v1H8V2a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3Zm1 17a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-9h16Zm0-11H4V6a1 1 0 0 1 1-1h1v1a1 1 0 0 0 2 0V5h8v1a1 1 0 0 0 2 0V5h1a1 1 0 0 1 1 1ZM7 15a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm0 4a1 1 0 1 0-1-1a1 1 0 0 0 1 1Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="arrow-right" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M17.92 11.62a1 1 0 0 0-.21-.33l-5-5a1 1 0 0 0-1.42 1.42l3.3 3.29H7a1 1 0 0 0 0 2h7.59l-3.3 3.29a1 1 0 0 0 0 1.42a1 1 0 0 0 1.42 0l5-5a1 1 0 0 0 .21-.33a1 1 0 0 0 0-.76Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="category" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M19 5.5h-6.28l-.32-1a3 3 0 0 0-2.84-2H5a3 3 0 0 0-3 3v13a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-10a3 3 0 0 0-3-3Zm1 13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-13a1 1 0 0 1 1-1h4.56a1 1 0 0 1 .95.68l.54 1.64a1 1 0 0 0 .95.68h7a1 1 0 0 1 1 1Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="calendar" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3Zm1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="heart" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M20.16 4.61A6.27 6.27 0 0 0 12 4a6.27 6.27 0 0 0-8.16 9.48l7.45 7.45a1 1 0 0 0 1.42 0l7.45-7.45a6.27 6.27 0 0 0 0-8.87Zm-1.41 7.46L12 18.81l-6.75-6.74a4.28 4.28 0 0 1 3-7.3a4.25 4.25 0 0 1 3 1.25a1 1 0 0 0 1.42 0a4.27 4.27 0 0 1 6 6.05Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="plus" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M19 11h-6V5a1 1 0 0 0-2 0v6H5a1 1 0 0 0 0 2h6v6a1 1 0 0 0 2 0v-6h6a1 1 0 0 0 0-2Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="minus" viewBox="0 0 24 24">
                <path fill="currentColor" d="M19 11H5a1 1 0 0 0 0 2h14a1 1 0 0 0 0-2Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="cart" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M8.5 19a1.5 1.5 0 1 0 1.5 1.5A1.5 1.5 0 0 0 8.5 19ZM19 16H7a1 1 0 0 1 0-2h8.491a3.013 3.013 0 0 0 2.885-2.176l1.585-5.55A1 1 0 0 0 19 5H6.74a3.007 3.007 0 0 0-2.82-2H3a1 1 0 0 0 0 2h.921a1.005 1.005 0 0 1 .962.725l.155.545v.005l1.641 5.742A3 3 0 0 0 7 18h12a1 1 0 0 0 0-2Zm-1.326-9l-1.22 4.274a1.005 1.005 0 0 1-.963.726H8.754l-.255-.892L7.326 7ZM16.5 19a1.5 1.5 0 1 0 1.5 1.5a1.5 1.5 0 0 0-1.5-1.5Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="check" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M18.71 7.21a1 1 0 0 0-1.42 0l-7.45 7.46l-3.13-3.14A1 1 0 1 0 5.29 13l3.84 3.84a1 1 0 0 0 1.42 0l8.16-8.16a1 1 0 0 0 0-1.47Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="trash" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M10 18a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1ZM20 6h-4V5a3 3 0 0 0-3-3h-2a3 3 0 0 0-3 3v1H4a1 1 0 0 0 0 2h1v11a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8h1a1 1 0 0 0 0-2ZM10 5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v1h-4Zm7 14a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8h10Zm-3-1a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="star-outline" viewBox="0 0 12 12">
                <path fill="currentColor"
                    d="M5.283 1.546a.8.8 0 0 1 1.435 0L7.83 3.798l2.486.361a.8.8 0 0 1 .443 1.365L8.96 7.277l.425 2.476a.8.8 0 0 1-1.16.844L6 9.427l-2.224 1.17a.8.8 0 0 1-1.16-.844l.424-2.476l-1.799-1.753a.8.8 0 0 1 .444-1.365l2.486-.36zm.718.806l-.98 1.983a.8.8 0 0 1-.601.438l-2.19.318l1.585 1.544a.8.8 0 0 1 .23.708l-.374 2.18l1.958-1.03a.8.8 0 0 1 .744 0l1.958 1.03l-.374-2.18a.8.8 0 0 1 .23-.708L9.771 5.09l-2.189-.318a.8.8 0 0 1-.602-.438z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="star-solid" viewBox="0 0 12 12">
                <path fill="currentColor"
                    d="M5.283 1.546a.8.8 0 0 1 1.435 0L7.83 3.798l2.486.361a.8.8 0 0 1 .443 1.365L8.96 7.277l.425 2.476a.8.8 0 0 1-1.16.844L6 9.427l-2.224 1.17a.8.8 0 0 1-1.16-.844l.424-2.476l-1.799-1.753a.8.8 0 0 1 .444-1.365l2.486-.36z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="search" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="user" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M15.71 12.71a6 6 0 1 0-7.42 0a10 10 0 0 0-6.22 8.18a1 1 0 0 0 2 .22a8 8 0 0 1 15.9 0a1 1 0 0 0 1 .89h.11a1 1 0 0 0 .88-1.1a10 10 0 0 0-6.25-8.19ZM12 12a4 4 0 1 1 4-4a4 4 0 0 1-4 4Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="close" viewBox="0 0 15 15">
                <path fill="currentColor"
                    d="M7.953 3.788a.5.5 0 0 0-.906 0L6.08 5.85l-2.154.33a.5.5 0 0 0-.283.843l1.574 1.613l-.373 2.284a.5.5 0 0 0 .736.518l1.92-1.063l1.921 1.063a.5.5 0 0 0 .736-.519l-.373-2.283l1.574-1.613a.5.5 0 0 0-.283-.844L8.921 5.85l-.968-2.062Z" />
            </symbol>
        </defs>
    </svg>

    <div class="preloader-wrapper">
        <div class="preloader">
        </div>
    </div>

    <!-- Cart Sidebar -->
    <div id="cartSidebar" class="fixed inset-y-0 right-0 w-96 bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out z-50">
        <div class="flex flex-col h-full">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Giỏ hàng</h3>
                <button id="closeCart" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Cart Items -->
            <div class="flex-1 overflow-y-auto p-4">
                @php $total = 0; @endphp

                @if ($cart && $cart->items->count())
                    <div class="space-y-4">
                        @foreach ($cart->items as $item)
                            @php
                                $variant = $item->productVariant;
                                $product = $variant?->product ?? $item->product;
                                $name = $product?->name ?? 'Sản phẩm không tên';
                                $price = $variant?->price ?? ($product?->price ?? 0);
                                $subtotal = $price * $item->quantity;
                                $total += $subtotal;
                            @endphp

                            <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg">
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900">{{ $name }}</h4>
                                    @if ($variant)
                                        <p class="text-xs text-gray-500">Size: {{ $variant->size }} | Màu: {{ $variant->color_name }}</p>
                                    @endif
                                    <p class="text-xs text-gray-500">Số lượng: {{ $item->quantity }}</p>
                                </div>
                                <div class="text-sm font-medium text-gray-900">
                                    {{ number_format($subtotal, 0, ',', '.') }} VNĐ
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <p class="mt-2 text-sm text-gray-500">Giỏ hàng trống</p>
                    </div>
                @endif
            </div>

            <!-- Footer -->
            @if ($cart && $cart->items->count())
                <div class="border-t border-gray-200 p-4">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-lg font-medium text-gray-900">Tổng</span>
                        <span class="text-lg font-bold text-gray-900">{{ number_format($total, 0, ',', '.') }} VNĐ</span>
                    </div>
                    <a href="{{ route('cart.index') }}" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors text-center block font-medium">
                        Tiếp tục thanh toán
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Cart Overlay -->
    <div id="cartOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>
    <!-- Search Modal -->
    <div id="searchModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
                <div class="flex items-center justify-between p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Tìm kiếm</h3>
                    <button id="closeSearch" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-6">
                    <form action="{{ route('home.search') }}" method="get" class="space-y-4">
                        <div class="flex space-x-2">
                            <input type="text" name="search"
                                   class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Bạn đang tìm kiếm gì?" value="{{ request('search') }}">
                            <button type="submit" class="bg-gray-900 text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition-colors">
                                Tìm kiếm
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between py-4 border-b border-gray-200">

                <!-- Logo -->
                <div class="flex justify-center lg:justify-start mb-4 lg:mb-0">
                    <div class="main-logo">
                        <a href="{{ route('home.index') }}" class="block">
                            @foreach ($logos as $logo)
                                @if ($logo->is_active == 1)
                                    <img src="{{ asset('storage/' . $logo->image) }}" alt="logo" class="h-12">
                                @else
                                    <img src="" alt="logo" class="h-12">
                                @endif
                            @break
                        @endforeach
                        </a>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="hidden lg:block flex-1 max-w-2xl mx-8">
                    <div class="bg-gray-100 rounded-full p-2 flex items-center">
                        <form id="search-form" class="flex w-full" action="{{ route('home.search') }}" method="GET">
                            <!-- Category Dropdown -->
                            <div class="flex-shrink-0">
                                <select name="category" class="bg-transparent border-0 text-gray-600 px-3 py-2 focus:outline-none">
                                    <option value="">Tất cả danh mục</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Search Input -->
                            <div class="flex-1 flex">
                                <input type="text" name="search"
                                       class="flex-1 bg-transparent border-0 px-3 py-2 focus:outline-none placeholder-gray-500"
                                       placeholder="Tìm kiếm sản phẩm" value="{{ request('search') }}">
                                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition-colors">
                                    Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            {{-- <div class="col-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
                            </svg>
                        </div>
                    </div>
                </div> --}}
                <!-- User Actions -->
                <div class="flex justify-center lg:justify-end items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <!-- User Icon -->
                        <div class="relative">
                            @auth
                                <button id="userDropdown" class="bg-gray-100 hover:bg-gray-200 p-2 rounded-full transition-colors">
                                    <svg width="24" height="24" viewBox="0 0 24 24" class="text-gray-700">
                                        <use xlink:href="#user"></use>
                                    </svg>
                                </button>
                                <div id="userDropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                                    @if (auth()->user()->role == 'admin')
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Quản trị viên</a>
                                        <div class="border-t border-gray-200"></div>
                                    @endif
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Xem hồ sơ</a>
                                    <div class="border-t border-gray-200"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Đăng xuất</button>
                                    </form>
                                </div>
                            @else
                                <a href="{{ route('login') }}" class="bg-gray-100 hover:bg-gray-200 p-2 rounded-full transition-colors">
                                    <svg width="24" height="24" viewBox="0 0 24 24" class="text-gray-700">
                                        <use xlink:href="#user"></use>
                                    </svg>
                                </a>
                            @endauth
                        </div>

                        <!-- Heart Icon -->
                        <a href="#" class="bg-gray-100 hover:bg-gray-200 p-2 rounded-full transition-colors">
                            <svg width="24" height="24" viewBox="0 0 24 24" class="text-gray-700">
                                <use xlink:href="#heart"></use>
                            </svg>
                        </a>

                        <!-- Cart Icon -->
                        <button id="cartToggle" class="bg-gray-100 hover:bg-gray-200 p-2 rounded-full transition-colors relative">
                            <svg width="24" height="24" viewBox="0 0 24 24" class="text-gray-700">
                                <use xlink:href="#cart"></use>
                            </svg>
                            @if($cart && $cart->items->count() > 0)
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ $cart->items->count() }}
                                </span>
                            @endif
                        </button>

                        <!-- Mobile Search Icon -->
                        <button id="mobileSearchToggle" class="lg:hidden bg-gray-100 hover:bg-gray-200 p-2 rounded-full transition-colors">
                            <svg width="24" height="24" viewBox="0 0 24 24" class="text-gray-700">
                                <use xlink:href="#search"></use>
                            </svg>
                        </button>
                    </div>
                </div>
        </div>
    </div>
        <!-- Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-center py-4">
                <nav class="w-full">
                    <!-- Mobile Menu Button -->
                    <div class="lg:hidden flex justify-center mb-4">
                        <button id="mobileMenuToggle" class="bg-gray-100 hover:bg-gray-200 p-2 rounded-lg transition-colors">
                            <svg width="24" height="24" viewBox="0 0 24 24" class="text-gray-700">
                                <path fill="currentColor" d="M3 6h18v2H3V6zm0 5h18v2H3v-2zm0 5h18v2H3v-2z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Desktop Menu -->
                    <div class="hidden lg:flex justify-center">
                        <ul class="flex items-center space-x-8 text-sm font-semibold uppercase tracking-wide">
                            <li>
                                <a href="#women" class="text-gray-700 hover:text-blue-600 transition-colors">Phụ nữ</a>
                            </li>
                            <li>
                                <a href="#men" class="text-gray-700 hover:text-blue-600 transition-colors">Nam giới</a>
                            </li>
                            <li>
                                <a href="#kids" class="text-gray-700 hover:text-blue-600 transition-colors">Trẻ em</a>
                            </li>
                            <li>
                                <a href="#accessories" class="text-gray-700 hover:text-blue-600 transition-colors">Phụ kiện</a>
                            </li>
                            <li class="relative group">
                                <button class="text-gray-700 hover:text-blue-600 transition-colors flex items-center">
                                    Trang
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="absolute top-full left-0 mt-2 w-64 bg-black text-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                    <div class="py-2">
                                        <a href="about.html" class="block px-4 py-2 text-sm hover:bg-gray-800">Giới thiệu <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded ml-2">PRO</span></a>
                                        <a href="shop.html" class="block px-4 py-2 text-sm hover:bg-gray-800">Cửa hàng <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded ml-2">PRO</span></a>
                                        <a href="single-product.html" class="block px-4 py-2 text-sm hover:bg-gray-800">Sản phẩm đơn lẻ <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded ml-2">PRO</span></a>
                                        <a href="cart.html" class="block px-4 py-2 text-sm hover:bg-gray-800">Giỏ hàng <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded ml-2">PRO</span></a>
                                        <a href="checkout.html" class="block px-4 py-2 text-sm hover:bg-gray-800">Thanh toán <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded ml-2">PRO</span></a>
                                        <a href="blog.html" class="block px-4 py-2 text-sm hover:bg-gray-800">Bài viết <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded ml-2">PRO</span></a>
                                        <a href="single-post.html" class="block px-4 py-2 text-sm hover:bg-gray-800">Bài viết đơn lẻ <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded ml-2">PRO</span></a>
                                        <a href="styles.html" class="block px-4 py-2 text-sm hover:bg-gray-800">Phong cách <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded ml-2">PRO</span></a>
                                        <a href="contact.html" class="block px-4 py-2 text-sm hover:bg-gray-800">Liên hệ <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded ml-2">PRO</span></a>
                                        <a href="thank-you.html" class="block px-4 py-2 text-sm hover:bg-gray-800">Cảm ơn <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded ml-2">PRO</span></a>
                                        <a href="account.html" class="block px-4 py-2 text-sm hover:bg-gray-800">Tài khoản <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded ml-2">PRO</span></a>
                                        <a href="404.html" class="block px-4 py-2 text-sm hover:bg-gray-800">Lỗi 404 <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded ml-2">PRO</span></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#brand" class="text-gray-700 hover:text-blue-600 transition-colors">Thương Hiệu</a>
                            </li>
                            <li>
                                <a href="#sale" class="text-gray-700 hover:text-blue-600 transition-colors">Khuyến Mãi</a>
                            </li>
                            <li>
                                <a href="#blog" class="text-gray-700 hover:text-blue-600 transition-colors">Blog</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Mobile Menu -->
                    <div id="mobileMenu" class="lg:hidden hidden">
                        <div class="bg-white border-t border-gray-200 py-4">
                            <ul class="space-y-2 text-center">
                                <li><a href="#women" class="block py-2 text-gray-700 hover:text-blue-600">Phụ nữ</a></li>
                                <li><a href="#men" class="block py-2 text-gray-700 hover:text-blue-600">Nam giới</a></li>
                                <li><a href="#kids" class="block py-2 text-gray-700 hover:text-blue-600">Trẻ em</a></li>
                                <li><a href="#accessories" class="block py-2 text-gray-700 hover:text-blue-600">Phụ kiện</a></li>
                                <li><a href="#brand" class="block py-2 text-gray-700 hover:text-blue-600">Thương Hiệu</a></li>
                                <li><a href="#sale" class="block py-2 text-gray-700 hover:text-blue-600">Khuyến Mãi</a></li>
                                <li><a href="#blog" class="block py-2 text-gray-700 hover:text-blue-600">Blog</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

</header>

@yield('content')

<footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Logo and Social Links -->
            <div class="lg:col-span-1">
                <div class="mb-6">
                    @foreach ($logos as $logo)
                        @if ($logo->is_active == 1)
                            <a href="{{ route('home.index') }}" class="block">
                                <img src="{{ asset('storage/' . $logo->image) }}" alt="logo" class="h-12 brightness-0 invert filter hover:brightness-100 hover:invert-0 transition-all duration-300 cursor-pointer">
                            </a>
                        @else
                            <a href="{{ route('home.index') }}" class="block">
                                <img src="" alt="logo" class="h-12 brightness-0 invert filter hover:brightness-100 hover:invert-0 transition-all duration-300 cursor-pointer">
                            </a>
                        @endif
                    @break
                @endforeach
                </div>
                <div class="flex space-x-3">
                    <a href="#" class="bg-gray-800 hover:bg-gray-700 p-2 rounded-full transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M15.12 5.32H17V2.14A26.11 26.11 0 0 0 14.26 2c-2.72 0-4.58 1.66-4.58 4.7v2.62H6.61v3.56h3.07V22h3.68v-9.12h3.06l.46-3.56h-3.52V7.05c0-1.05.28-1.73 1.76-1.73Z" />
                        </svg>
                    </a>
                    <a href="#" class="bg-gray-800 hover:bg-gray-700 p-2 rounded-full transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M22.991 3.95a1 1 0 0 0-1.51-.86a7.48 7.48 0 0 1-1.874.794a5.152 5.152 0 0 0-3.374-1.242a5.232 5.232 0 0 0-5.223 5.063a11.032 11.032 0 0 1-6.814-3.924a1.012 1.012 0 0 0-.857-.365a.999.999 0 0 0-.785.5a5.276 5.276 0 0 0-.242 4.769l-.002.001a1.041 1.041 0 0 0-.496.89a3.042 3.042 0 0 0 .027.439a5.185 5.185 0 0 0 1.568 3.312a.998.998 0 0 0-.066.77a5.204 5.204 0 0 0 2.362 2.922a7.465 7.465 0 0 1-3.59.448A1 1 0 0 0 1.45 19.3a12.942 12.942 0 0 0 7.01 2.061a12.788 12.788 0 0 0 12.465-9.363a12.822 12.822 0 0 0 .535-3.646l-.001-.2a5.77 5.77 0 0 0 1.532-4.202Zm-3.306 3.212a.995.995 0 0 0-.234.702c.01.165.009.331.009.488a10.824 10.824 0 0 1-.454 3.08a10.685 10.685 0 0 1-10.546 7.93a10.938 10.938 0 0 1-2.55-.301a9.48 9.48 0 0 0 2.942-1.564a1 1 0 0 0-.602-1.786a3.208 3.208 0 0 1-2.214-.935q.224-.042.445-.105a1 1 0 0 0-.08-1.943a3.198 3.198 0 0 1-2.25-1.726a5.3 5.3 0 0 0 .545.046a1.02 1.02 0 0 0 .984-.696a1 1 0 0 0-.4-1.137a3.196 3.196 0 0 1-1.425-2.673c0-.066.002-.133.006-.198a13.014 13.014 0 0 0 8.21 3.48a1.02 1.02 0 0 0 .817-.36a1 1 0 0 0 .206-.867a3.157 3.157 0 0 1-.087-.729a3.23 3.23 0 0 1 3.226-3.226a3.184 3.184 0 0 1 2.345 1.02a.993.993 0 0 0 .921.298a9.27 9.27 0 0 0 1.212-.322a6.681 6.681 0 0 1-1.026 1.524Z" />
                        </svg>
                    </a>
                    <a href="#" class="bg-gray-800 hover:bg-gray-700 p-2 rounded-full transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M23 9.71a8.5 8.5 0 0 0-.91-4.13a2.92 2.92 0 0 0-1.72-1A78.36 78.36 0 0 0 12 4.27a78.45 78.45 0 0 0-8.34.3a2.87 2.87 0 0 0-1.46.74c-.9.83-1 2.25-1.1 3.45a48.29 48.29 0 0 0 0 6.48a9.55 9.55 0 0 0 .3 2a3.14 3.14 0 0 0 .71 1.36a2.86 2.86 0 0 0 1.49.78a45.18 45.18 0 0 0 6.5.33c3.5.05 6.57 0 10.2-.28a2.88 2.88 0 0 0 1.53-.78a2.49 2.49 0 0 0 .61-1a10.58 10.58 0 0 0 .52-3.4c.04-.56.04-3.94.04-4.54ZM9.74 14.85V8.66l5.92 3.11c-1.66.92-3.85 1.96-5.92 3.08Z" />
                        </svg>
                    </a>
                    <a href="#" class="bg-gray-800 hover:bg-gray-700 p-2 rounded-full transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.34 5.46a1.2 1.2 0 1 0 1.2 1.2a1.2 1.2 0 0 0-1.2-1.2Zm4.6 2.42a7.59 7.59 0 0 0-.46-2.43a4.94 4.94 0 0 0-1.16-1.77a4.7 4.7 0 0 0-1.77-1.15a7.3 7.3 0 0 0-2.43-.47C15.06 2 14.72 2 12 2s-3.06 0-4.12.06a7.3 7.3 0 0 0-2.43.47a4.78 4.78 0 0 0-1.77 1.15a4.7 4.7 0 0 0-1.15 1.77a7.3 7.3 0 0 0-.47 2.43C2 8.94 2 9.28 2 12s0 3.06.06 4.12a7.3 7.3 0 0 0 .47 2.43a4.7 4.7 0 0 0 1.15 1.77a4.78 4.78 0 0 0 1.77 1.15a7.3 7.3 0 0 0 2.43.47C8.94 22 9.28 22 12 22s3.06 0 4.12-.06a7.3 7.3 0 0 0 2.43-.47a4.7 4.7 0 0 0 1.77-1.15a4.85 4.85 0 0 0 1.16-1.77a7.59 7.59 0 0 0 .46-2.43c0-1.06.06-1.4.06-4.12s0-3.06-.06-4.12ZM20.14 16a5.61 5.61 0 0 1-.34 1.86a3.06 3.06 0 0 1-.75 1.15a3.19 3.19 0 0 1-1.15.75a5.61 5.61 0 0 1-1.86.34c-1 .05-1.37.06-4 .06s-3 0-4-.06a5.73 5.73 0 0 1-1.94-.3a3.27 3.27 0 0 1-1.1-.75a3 3 0 0 1-.74-1.15a5.54 5.54 0 0 1-.4-1.9c0-1-.06-1.37-.06-4s0-3 .06-4a5.54 5.54 0 0 1 .35-1.9A3 3 0 0 1 5 5a3.14 3.14 0 0 1 1.1-.8A5.73 5.73 0 0 1 8 3.86c1 0 1.37-.06 4-.06s3 0 4 .06a5.61 5.61 0 0 1 1.86.34a3.06 3.06 0 0 1 1.19.8a3.06 3.06 0 0 1 .75 1.1a5.61 5.61 0 0 1 .34 1.9c.05 1 .06 1.37.06 4s-.01 3-.06 4ZM12 6.87A5.13 5.13 0 1 0 17.14 12A5.12 5.12 0 0 0 12 6.87Zm0 8.46A3.33 3.33 0 1 1 15.33 12A3.33 3.33 0 0 1 12 15.33Z" />
                        </svg>
                    </a>
                </div>
            </div>
            <!-- About Us -->
            <div>
                <h5 class="text-lg font-semibold mb-4">Về chúng tôi</h5>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Giới thiệu</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Điều khoản</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Tạp chí của chúng tôi</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Cơ hội nghề nghiệp</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Chương trình liên kết</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Báo chí</a></li>
                </ul>
            </div>
            <!-- Customer Service -->
            <div>
                <h5 class="text-lg font-semibold mb-4">Dịch vụ khách hàng</h5>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Câu hỏi thường gặp</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Liên hệ</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Chính sách bảo mật</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Chính sách hoàn trả và hoàn tiền</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Hướng dẫn cookie</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Thông tin giao hàng</a></li>
                </ul>
            </div>
            <!-- Newsletter -->
            <div>
                <h5 class="text-lg font-semibold mb-4">Đăng ký nhận bản tin</h5>
                <p class="text-gray-300 mb-4">Đăng ký nhận bản tin để nhận thông tin về các chương trình khuyến mãi của chúng tôi.</p>
                <form action="{{ route('home.index') }}" class="flex">
                    <input type="email" placeholder="Email Address"
                           class="flex-1 px-4 py-2 bg-gray-800 border border-gray-700 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white placeholder-gray-400">
                    <button type="submit" class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded-r-lg transition-colors">
                        Đăng ký
                    </button>
                </form>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Bottom -->
<div class="bg-gray-800 py-4">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center">
            <p class="text-gray-300">© 2025 Spark. All rights reserved.</p>
        </div>
    </div>
</div>

</body>

<style>

</style>

<!-- Floating Chat Icon -->
<div id="chat-toggle-btn" onclick="toggleChat()" class="fixed bottom-6 right-6 w-14 h-14 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg flex items-center justify-center cursor-pointer transition-all duration-300 z-40 hover:scale-110">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
    </svg>
</div>

<!-- Chat Box -->
<div id="chat-box-wrapper" class="fixed bottom-24 right-6 w-80 h-96 bg-white rounded-lg shadow-2xl border border-gray-200 hidden z-50">
    <!-- Header -->
    <div id="chat-header" class="bg-blue-600 text-white px-4 py-3 rounded-t-lg flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
            <span class="font-medium">Hỗ trợ trực tuyến</span>
        </div>
        <button onclick="toggleChat()" class="text-white hover:text-gray-200 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Chat Messages -->
    <div id="chat-box" class="flex-1 overflow-y-auto p-4 space-y-3 bg-gray-50"></div>

    <!-- Footer -->
    <div id="chat-footer" class="p-4 border-t border-gray-200 bg-white rounded-b-lg">
        @auth
            <input type="hidden" id="chat_name" value="{{ auth()->user()->name }}">
        @else
            <input type="text" id="chat_name" placeholder="Tên của bạn..."
                   class="w-full px-3 py-2 mb-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
        @endauth
        <div class="flex items-center space-x-2">
            <input type="text" id="chat_message" placeholder="Nhập tin nhắn..."
                   class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
            <button id="send-btn" onclick="sendMessage()"
                    class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function toggleChat() {
  const chatBox = document.getElementById('chat-box-wrapper');
  chatBox.classList.toggle('hidden');
}

function loadMessages() {
  fetch('/chat/messages')
    .then(res => res.json())
    .then(data => {
      const chatBox = document.getElementById('chat-box');
      chatBox.innerHTML = '';
      data.forEach(msg => {
        const isAdmin = msg.is_admin;
        const messageClass = isAdmin
          ? 'bg-gray-200 text-gray-800 ml-8'
          : 'bg-blue-600 text-white mr-8';
        const containerClass = isAdmin
          ? 'flex justify-start'
          : 'flex justify-end';

        chatBox.innerHTML += `
          <div class="${containerClass}">
            <div class="${messageClass} px-4 py-2 rounded-lg max-w-xs break-words">
              <div class="font-semibold text-xs mb-1">${msg.sender_name}</div>
              <div>${msg.message}</div>
            </div>
          </div>
        `;
      });
      chatBox.scrollTop = chatBox.scrollHeight;
    });
}

function sendMessage() {
  const nameEl = document.getElementById('chat_name');
  const message = document.getElementById('chat_message').value;
  const name = nameEl ? nameEl.value : '';
  if (!name || !message) return;

  fetch('/chat/send', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': token
    },
    body: JSON.stringify({ sender_name: name, message, is_admin: false })
  }).then(() => {
    document.getElementById('chat_message').value = '';
    loadMessages();
  });
}

// Enter key to send message
document.getElementById('chat_message').addEventListener('keypress', function(e) {
  if (e.key === 'Enter') {
    sendMessage();
  }
});

setInterval(loadMessages, 3000);
loadMessages();

// User dropdown functionality
document.getElementById('userDropdown')?.addEventListener('click', function() {
  document.getElementById('userDropdownMenu').classList.toggle('hidden');
});

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
  if (!e.target.closest('#userDropdown')) {
    document.getElementById('userDropdownMenu')?.classList.add('hidden');
  }
});

// Cart toggle functionality
document.getElementById('cartToggle')?.addEventListener('click', function() {
  document.getElementById('cartSidebar').classList.remove('translate-x-full');
  document.getElementById('cartOverlay').classList.remove('hidden');
});

document.getElementById('closeCart')?.addEventListener('click', function() {
  document.getElementById('cartSidebar').classList.add('translate-x-full');
  document.getElementById('cartOverlay').classList.add('hidden');
});

document.getElementById('cartOverlay')?.addEventListener('click', function() {
  document.getElementById('cartSidebar').classList.add('translate-x-full');
  document.getElementById('cartOverlay').classList.add('hidden');
});

// Search modal functionality
document.getElementById('mobileSearchToggle')?.addEventListener('click', function() {
  document.getElementById('searchModal').classList.remove('hidden');
});

document.getElementById('closeSearch')?.addEventListener('click', function() {
  document.getElementById('searchModal').classList.add('hidden');
});

document.getElementById('searchModal')?.addEventListener('click', function(e) {
  if (e.target === this) {
    this.classList.add('hidden');
  }
});

// Mobile menu toggle
document.getElementById('mobileMenuToggle')?.addEventListener('click', function() {
  document.getElementById('mobileMenu').classList.toggle('hidden');
});
</script>

</html>
