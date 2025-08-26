<?php
$logo = \App\Models\Logo::where('is_active', 1)->first();
if (request()->query('error') === 'admin_cannot_chat') {
    session()->flash('error', 'Tài khoản admin không được sử dụng chat người dùng!');
}
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('app.name', '') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- Custom Scripts -->
    <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>

    @vite('resources/css/app.css')
    <!-- BẮT BUỘC: đặt lên đầu ngay sau <head> hoặc trước script chính -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Winwheel.js/2.7.0/Winwheel.min.js"></script>

</head>

<body>
    @auth
        @if (!session('popup_shown'))
            @include('components.spin-wheel')

            <script>
                // Sau khi hiển thị, gọi route để cập nhật session popup_shown = true
                fetch("{{ route('popup.mark-shown') }}");
            </script>
        @endif
    @endauth



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

    <div id="cartSidebar"
        class="fixed inset-y-0 right-0 w-96 bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out z-50">
        <div class="flex flex-col h-full">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Giỏ hàng</h3>
                <button id="closeCart" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
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
                                $price = $variant?->price_sale ?? $variant?->price ?? $product?->price_sale ?? $product?->price ?? 0;
                                $subtotal = $price * $item->quantity;
                                $total += $subtotal;
                            @endphp

                            <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg">
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900">{{ $name }}</h4>
                                    @if ($variant)
                                        <p class="text-xs text-gray-500">Size: {{ $variant->size }} | Màu:
                                            {{ $variant->color_name }}</p>
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
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
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
                        <span class="text-lg font-bold text-gray-900">{{ number_format($total, 0, ',', '.') }}
                            VNĐ</span>
                    </div>
                    <a href="{{ route('cart.index') }}"
                        class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors text-center block font-medium">
                        Tiếp tục thanh toán
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Cart Overlay -->
    <div id="cartOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

    <!-- Notification System -->
    @if (session('success'))
        <div id="success-notification"
            class="fixed top-6 right-6 z-50 transform transition-all duration-500 ease-out opacity-0 translate-x-full notification-enter">
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
                        <p class="font-semibold text-sm">{{ session('success') }}</p>
                        <p class="text-xs text-emerald-100">Thao tác thành công!</p>
                    </div>
                    <button onclick="closeNotification('success-notification')"
                        class="flex-shrink-0 text-white/80 hover:text-white transition-all duration-200 hover:scale-110 hover:bg-white/20 rounded-full p-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <!-- Progress bar -->
                <div class="mt-3 w-full bg-white/20 rounded-full h-1">
                    <div id="success-progress-bar"
                        class="bg-white h-1 rounded-full transition-all duration-5000 ease-linear"
                        style="width: 100%"></div>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div id="error-notification"
            class="fixed top-6 right-6 z-50 transform transition-all duration-500 ease-out opacity-0 translate-x-full notification-enter">
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <!-- Progress bar -->
                <div class="mt-3 w-full bg-white/20 rounded-full h-1">
                    <div id="error-progress-bar"
                        class="bg-white h-1 rounded-full transition-all duration-5000 ease-linear"
                        style="width: 100%"></div>
                </div>
            </div>
        </div>
    @endif

    @if (session('info'))
        <div id="info-notification"
            class="fixed top-6 right-6 z-50 transform transition-all duration-500 ease-out opacity-0 translate-x-full notification-enter">
            <div
                class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-4 rounded-2xl shadow-2xl border border-blue-400/30 backdrop-blur-sm">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <div
                            class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center shadow-lg ring-2 ring-white/30">
                            <svg class="w-5 h-5 text-white drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-sm">{{ session('info') }}</p>
                        <p class="text-xs text-blue-100">Thông tin quan trọng!</p>
                    </div>
                    <button onclick="closeNotification('info-notification')"
                        class="flex-shrink-0 text-white/80 hover:text-white transition-all duration-200 hover:scale-110 hover:bg-white/20 rounded-full p-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <!-- Progress bar -->
                <div class="mt-3 w-full bg-white/20 rounded-full h-1">
                    <div id="info-progress-bar"
                        class="bg-white h-1 rounded-full transition-all duration-5000 ease-linear"
                        style="width: 100%"></div>
                </div>
            </div>
        </div>
    @endif

    <!-- Search Modal -->
    <div id="searchModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
                <div class="flex items-center justify-between p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Tìm kiếm</h3>
                    <button id="closeSearch" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-6">
                    <form action="{{ route('home.search') }}" method="get" class="space-y-4">
                        <div class="flex space-x-2">
                            <input type="text" name="search"
                                class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Bạn đang tìm kiếm gì?" value="{{ request('search') }}">
                            <button type="submit"
                                class="bg-gray-900 text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition-colors">
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
                            <img src="{{ asset('storage/' . optional($logo)->image) }}" alt="logo"
                                class="h-12">
                        </a>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="hidden lg:block flex-1 max-w-2xl mx-8">
                    <div class="bg-gray-100 rounded-full p-2 flex items-center">
                        <form id="search-form" class="flex w-full" action="{{ route('home.search') }}"
                            method="GET">
                            <!-- Category Dropdown -->
                            <div class="flex-shrink-0">
                                <select name="category"
                                    class="bg-transparent border-0 text-gray-600 px-3 py-2 focus:outline-none">
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
                                <button type="submit"
                                    class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition-colors">
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
                                <button id="userDropdown"
                                    class="bg-gray-100 hover:bg-gray-200 p-2 rounded-full transition-colors">
                                    <svg width="24" height="24" viewBox="0 0 24 24" class="text-gray-700">
                                        <use xlink:href="#user"></use>
                                    </svg>
                                </button>
                                <div id="userDropdownMenu"
                                    class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                                    @if (auth()->user()->role == 'admin')
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Quản trị
                                            viên</a>
                                        <div class="border-t border-gray-200"></div>
                                    @endif
                                    <a href="{{ route('profile.edit') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Xem hồ sơ</a>
                                    <div class="border-t border-gray-200"></div>
                                    <a href="{{ route('orders.history') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Lịch sử đơn
                                        hàng</a>
                                    <div class="border-t border-gray-200"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Đăng
                                            xuất</button>
                                    </form>
                                </div>
                            @else
                                <a href="{{ route('login') }}"
                                    class="bg-gray-100 hover:bg-gray-200 p-2 rounded-full transition-colors">
                                    <svg width="24" height="24" viewBox="0 0 24 24" class="text-gray-700">
                                        <use xlink:href="#user"></use>
                                    </svg>
                                </a>
                            @endauth
                        </div>

                        <!-- Heart Icon -->
                        <a href="{{ route('favorites.index') }}"
                            class="bg-gray-100 hover:bg-gray-200 p-2 rounded-full transition-colors">
                            <svg width="24" height="24" viewBox="0 0 24 24" class="text-gray-700">
                                <use xlink:href="#heart"></use>
                            </svg>
                        </a>

                        <!-- Cart Icon -->
                        <button id="cartToggle"
                            class="bg-gray-100 hover:bg-gray-200 p-2 rounded-full transition-colors relative">
                            <svg width="24" height="24" viewBox="0 0 24 24" class="text-gray-700">
                                <use xlink:href="#cart"></use>
                            </svg>
                            @if ($cart && $cart->items->count() > 0)
                                <span
                                    class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ $cart->items->count() }}
                                </span>
                            @endif
                        </button>

                        <!-- Gift Icon -->
                        @auth
                            <a href="{{ route('checkin.index') }}"
                                class="bg-gradient-to-r from-yellow-300 to-pink-400 hover:from-yellow-400 hover:to-pink-500 p-2 rounded-full transition-colors relative group"
                                title="Điểm danh nhận quà">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="text-white w-6 h-6"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M20 12v7a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-7h16Zm0-2H4V8a2 2 0 0 1 2-2h3.17a3 3 0 1 1 5.66 0H18a2 2 0 0 1 2 2v2Zm-6.5-5a1 1 0 1 0-2 0a1 1 0 0 0 2 0Z" />
                                </svg>
                                <span
                                    class="hidden lg:block absolute -top-2 -right-2 text-xs font-bold bg-red-500 text-white px-1.5 py-0.5 rounded-full animate-ping group-hover:animate-none">
                                    🎁
                                </span>
                            </a>
                        @endauth

                        <!-- Spin Wheel Icon -->
                        <button id="spinWheelBtn"
                            class="bg-gradient-to-r from-pink-400 to-purple-500 hover:from-pink-500 hover:to-purple-600 p-2 rounded-full transition-colors relative group"
                            title="Vòng quay may mắn">
                            <span class="text-white text-lg">🎡</span>
                            <span
                                class="hidden lg:block absolute -top-1 -right-1 text-xs font-bold bg-orange-500 text-white px-1 py-0.5 rounded-full animate-bounce group-hover:animate-none">
                                ✨
                            </span>
                        </button>

                        <!-- Mobile Search Icon -->
                        <button id="mobileSearchToggle"
                            class="lg:hidden bg-gray-100 hover:bg-gray-200 p-2 rounded-full transition-colors">
                            <svg width="24" height="24" viewBox="0 0 24 24" class="text-gray-700">
                                <use xlink:href="#search"></use>
                            </svg>
                        </button>
                    </div>
                </div>

<!-- 🔹 Modal vòng quay -->
<div id="spinWheelModal"
    class="hidden fixed inset-0 bg-gradient-to-br from-purple-900/80 via-pink-900/80 to-red-900/80 backdrop-blur-sm flex justify-center items-center z-50">
    <div class="bg-white p-8 rounded-3xl shadow-2xl w-[420px] text-center relative transform transition-all duration-300 scale-95 hover:scale-100">
        <!-- Close Button -->
        <button id="closeSpinWheel"
            class="absolute top-4 right-4 text-gray-400 hover:text-red-500 hover:rotate-90 transition-all duration-300 text-2xl font-bold z-10">
            ✕
        </button>

        <!-- Header -->
        <div class="mb-4">
            <h2 class="text-3xl font-bold bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 bg-clip-text text-transparent mb-2">
                🎡 Vòng Quay May Mắn
            </h2>
            <p class="text-gray-600 text-sm">Nhấn "Quay ngay" để nhận phần thưởng bất ngờ!</p>
        </div>

        <!-- Wheel Container - Moved to center -->
        <div class="relative mb-4 mx-auto w-fit flex justify-center items-center">
            <!-- Static Outer Ring -->
            <div class="relative rounded-full bg-gradient-to-r from-yellow-400 via-pink-500 to-purple-600 p-1">
                <div class="rounded-full bg-white p-2">
                    <canvas id="wheelCanvas" width="300" height="300" class="rounded-full shadow-lg"></canvas>
                </div>
            </div>

            <!-- Pointer - Centered on wheel -->
            <div class="absolute top-2 left-1/2 transform -translate-x-1/2 z-10">
                <div class="w-0 h-0 border-l-[15px] border-r-[15px] border-b-[25px] border-l-transparent border-r-transparent border-b-red-500 drop-shadow-lg filter"></div>
                <div class="w-4 h-4 bg-red-500 rounded-full mx-auto -mt-1 border-2 border-white shadow-md"></div>
            </div>
        </div>

        <!-- Spin Button -->
        <div class="mb-4">
            <button id="startSpin"
                class="relative overflow-hidden bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:from-green-500 hover:via-green-600 hover:to-green-700 text-white px-8 py-4 rounded-2xl font-bold text-lg shadow-lg transform hover:scale-105 transition-all duration-300 group">
                <span class="relative z-10 flex items-center justify-center space-x-2">
                    <span>🎲</span>
                    <span>Quay Ngay</span>
                    <span>✨</span>
                </span>
                <!-- Shine Effect -->
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
            </button>
        </div>

        <!-- Result -->
        <div id="spinResult" class="min-h-[60px] flex items-center justify-center">
            <p class="text-gray-600 text-lg font-medium bg-gray-50 rounded-2xl px-4 py-3 border-2 border-dashed border-gray-300">
                🎁 Kết quả sẽ hiển thị ở đây
            </p>
        </div>

        <!-- Decorative Elements -->
        <div class="absolute -top-4 -left-4 text-yellow-400 text-2xl animate-bounce">⭐</div>
        <div class="absolute -top-2 -right-8 text-pink-400 text-3xl animate-pulse">🎈</div>
        <div class="absolute -bottom-4 -left-6 text-purple-400 text-2xl animate-bounce delay-300">🎊</div>
        <div class="absolute -bottom-2 -right-4 text-blue-400 text-2xl animate-pulse delay-500">🎭</div>
    </div>
</div>

<style>
/* Result success animation */
.result-success {
    background: linear-gradient(135deg, #10b981, #059669) !important;
    color: white !important;
    border: 2px solid #10b981 !important;
    animation: pulse 2s infinite;
}

/* Wheel spinning effect */
.wheel-spinning {
    filter: blur(2px);
    transition: filter 0.3s ease;
}

/* Modal entrance animation */
#spinWheelModal:not(.hidden) .bg-white {
    animation: modalEnter 0.5s ease-out;
}

@keyframes modalEnter {
    from {
        opacity: 0;
        transform: scale(0.8) translateY(20px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0px);
    }
}

/* Button press effect */
#startSpin:active {
    transform: scale(0.95);
}

/* Sparkling effect */
@keyframes sparkle {
    0%, 100% { opacity: 0; }
    50% { opacity: 1; }
}

.sparkle {
    animation: sparkle 1.5s ease-in-out infinite;
}
</style>

<script>
// JavaScript Code - Thêm vào phần <script> hiện có
// JavaScript Code - Thêm vào phần <script> hiện có
document.addEventListener("DOMContentLoaded", () => {
    const spinBtn = document.getElementById("spinWheelBtn");
    const modal = document.getElementById("spinWheelModal");
    const closeBtn = document.getElementById("closeSpinWheel");
    const startSpinBtn = document.getElementById("startSpin");
    const resultText = document.getElementById("spinResult");
    const canvas = document.getElementById("wheelCanvas");
    const ctx = canvas.getContext("2d");

    let vouchers = [];
    let arc;
    let isSpinning = false;
    let hasSpunToday = false;
    let isLoggedIn = false;

    // 🔹 Kiểm tra trạng thái đăng nhập
    async function checkAuthStatus() {
        try {
            const res = await fetch("{{ route('auth.check') }}");
            const data = await res.json();
            isLoggedIn = data.authenticated;
            return isLoggedIn;
        } catch (error) {
            console.error('Error checking auth status:', error);
            isLoggedIn = false;
            return false;
        }
    }

    // 🔹 Hiển thị form đăng nhập
    function showLoginPrompt() {
        resultText.innerHTML = `
            <div class="bg-blue-100 border-2 border-blue-300 text-blue-800 text-lg font-medium rounded-2xl px-6 py-4">
                🔐 Bạn cần đăng nhập để quay!<br>
                <div class="mt-3 space-x-2">
                    <a href="{{ route('login') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors">
                        Đăng Nhập
                    </a>
                    <a href="{{ route('register') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors">
                        Đăng Ký
                    </a>
                </div>
            </div>
        `;

        // Disable spin button
        updateSpinButton(false, "Cần Đăng Nhập");
    }

    // 🔹 Cập nhật giao diện nút quay
    function updateSpinButton(canSpin, customText = null) {
        if (canSpin) {
            startSpinBtn.disabled = false;
            startSpinBtn.className = "relative overflow-hidden bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:from-green-500 hover:via-green-600 hover:to-green-700 text-white px-8 py-4 rounded-2xl font-bold text-lg shadow-lg transform hover:scale-105 transition-all duration-300 group";
            startSpinBtn.innerHTML = `
                <span class="relative z-10 flex items-center justify-center space-x-2">
                    <span>🎲</span>
                    <span>Quay Ngay</span>
                    <span>✨</span>
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
            `;
        } else {
            startSpinBtn.disabled = true;
            startSpinBtn.className = "relative overflow-hidden bg-gray-400 text-gray-600 px-8 py-4 rounded-2xl font-bold text-lg shadow-lg cursor-not-allowed";

            let buttonText = customText || "Đã Quay Hôm Nay";
            let iconText = customText === "Cần Đăng Nhập" ? "🔐" : "⏰";
            let endIcon = customText === "Cần Đăng Nhập" ? "🔒" : "💤";

            startSpinBtn.innerHTML = `
                <span class="relative z-10 flex items-center justify-center space-x-2">
                    <span>${iconText}</span>
                    <span>${buttonText}</span>
                    <span>${endIcon}</span>
                </span>
            `;
        }
    }

    // 🔹 Hiển thị thông báo đã quay
    function showAlreadySpunMessage() {
        resultText.innerHTML = `
            <div class="bg-orange-100 border-2 border-orange-300 text-orange-800 text-lg font-medium rounded-2xl px-6 py-4">
                ⏰ Bạn đã quay hôm nay rồi!<br>
                <span class="text-sm">Quay lại vào ngày mai nhé! 🌅</span>
            </div>
        `;
    }

    // 🔹 Kiểm tra đã quay hôm nay chưa (chỉ khi đã đăng nhập)
    async function checkDailySpinStatus() {
        if (!isLoggedIn) return;

        try {
            const res = await fetch("{{ route('spin.check-daily') }}");
            const data = await res.json();
            hasSpunToday = data.has_spun_today;

            if (hasSpunToday) {
                updateSpinButton(false);
                showAlreadySpunMessage();
            } else {
                updateSpinButton(true);
            }
        } catch (error) {
            console.error('Error checking spin status:', error);
        }
    }

    // 🔹 Mở modal + kiểm tra authentication
    spinBtn?.addEventListener("click", async () => {
        modal.classList.remove("hidden");

        // Kiểm tra đăng nhập trước
        const authenticated = await checkAuthStatus();

        if (!authenticated) {
            showLoginPrompt();
            return;
        }

        // Nếu đã đăng nhập, kiểm tra trạng thái quay hàng ngày
        await checkDailySpinStatus();

        if (!hasSpunToday) {
            const res = await fetch("{{ route('vouchers.list') }}");
            vouchers = await res.json();
            arc = Math.PI * 2 / vouchers.length;
            drawWheel();

            // Reset result nếu chưa quay
            resultText.innerHTML = `
                <p class="text-gray-600 text-lg font-medium bg-gray-50 rounded-2xl px-4 py-3 border-2 border-dashed border-gray-300">
                    🎁 Kết quả sẽ hiển thị ở đây
                </p>
            `;
        }
    });

    // 🔹 Đóng modal
    closeBtn.addEventListener("click", () => {
        modal.classList.add("hidden");
        isSpinning = false;
    });

    // 🔹 Vẽ vòng quay với gradient và hiệu ứng đẹp
    function drawWheel() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // Vẽ shadow
        ctx.save();
        ctx.shadowColor = 'rgba(0, 0, 0, 0.3)';
        ctx.shadowBlur = 20;
        ctx.shadowOffsetX = 0;
        ctx.shadowOffsetY = 0;

        vouchers.forEach((voucher, i) => {
            const angle = i * arc;

            // Tạo gradient cho từng sector
            const gradient = ctx.createRadialGradient(150, 150, 0, 150, 150, 150);
            if (i % 2 === 0) {
                gradient.addColorStop(0, '#fbbf24'); // Yellow center
                gradient.addColorStop(1, '#f59e0b'); // Darker yellow edge
            } else {
                gradient.addColorStop(0, '#60a5fa'); // Blue center
                gradient.addColorStop(1, '#3b82f6'); // Darker blue edge
            }

            // Vẽ sector
            ctx.beginPath();
            ctx.fillStyle = gradient;
            ctx.moveTo(150, 150);
            ctx.arc(150, 150, 140, angle, angle + arc);
            ctx.fill();

            // Vẽ viền trắng
            ctx.beginPath();
            ctx.strokeStyle = "#ffffff";
            ctx.lineWidth = 3;
            ctx.moveTo(150, 150);
            ctx.arc(150, 150, 140, angle, angle + arc);
            ctx.stroke();

            // Vẽ text với shadow
            ctx.save();
            ctx.translate(150, 150);
            ctx.rotate(angle + arc / 2);
            ctx.fillStyle = "white";
            ctx.strokeStyle = "rgba(0,0,0,0.5)";
            ctx.lineWidth = 1;
            ctx.font = "bold 13px Arial";
            ctx.textAlign = "center";

            // Vẽ code
            ctx.strokeText(voucher.code, 80, -5);
            ctx.fillText(voucher.code, 80, -5);

            // Vẽ discount
            ctx.font = "11px Arial";
            let discountText = voucher.discount_type === "percent"
                ? `-${voucher.discount_value}%`
                : `-${voucher.discount_value.toLocaleString()}đ`;
            ctx.strokeText(discountText, 80, 12);
            ctx.fillText(discountText, 80, 12);
            ctx.restore();
        });

        ctx.restore();

        // Vẽ center circle
        const centerGradient = ctx.createRadialGradient(150, 150, 0, 150, 150, 25);
        centerGradient.addColorStop(0, '#ffffff');
        centerGradient.addColorStop(1, '#e5e7eb');
        ctx.beginPath();
        ctx.fillStyle = centerGradient;
        ctx.arc(150, 150, 20, 0, Math.PI * 2);
        ctx.fill();
        ctx.strokeStyle = '#d1d5db';
        ctx.lineWidth = 2;
        ctx.stroke();
    }

    // 🔹 Quay vòng với hiệu ứng đẹp
    startSpinBtn.addEventListener("click", () => {
        // Kiểm tra đăng nhập trước khi quay
        if (!isLoggedIn) {
            showLoginPrompt();
            return;
        }

        if (isSpinning || hasSpunToday) return;

        // Kiểm tra lại vouchers có tồn tại không
        if (!vouchers || vouchers.length === 0) {
            resultText.innerHTML = `
                <div class="bg-red-100 border-2 border-red-300 text-red-800 text-lg font-medium rounded-2xl px-6 py-4">
                    ❌ Không có voucher để quay!<br>
                    <span class="text-sm">Vui lòng thử lại sau.</span>
                </div>
            `;
            return;
        }

        isSpinning = true;
        startSpinBtn.disabled = true;
        startSpinBtn.innerHTML = `
            <span class="relative z-10 flex items-center justify-center space-x-2">
                <span class="animate-spin">⚡</span>
                <span>Đang Quay...</span>
                <span class="animate-spin">⚡</span>
            </span>
        `;

        // Add spinning effect to canvas
        canvas.classList.add('wheel-spinning');

        let spinAngle = Math.random() * 360 + 1440; // 4 rotations
        let spinTime = 0;
        let spinTimeTotal = 2500; // 2.5 giây
        let easing = (t) => t * t * (3 - 2 * t);

        console.log("Bắt đầu quay với góc:", spinAngle);

        function rotateWheel() {
            spinTime += 20;

            if (spinTime >= spinTimeTotal) {
                console.log("Kết thúc quay");
                stopRotateWheel(spinAngle);
                return;
            }

            const progress = easing(spinTime / spinTimeTotal);
            const angle = spinAngle * progress;

            try {
                ctx.save();
                ctx.clearRect(0, 0, 300, 300);
                ctx.translate(150, 150);
                ctx.rotate((angle * Math.PI) / 180);
                ctx.translate(-150, -150);
                drawWheel();
                ctx.restore();
            } catch (error) {
                console.error("Lỗi khi vẽ:", error);
                // Dừng quay nếu có lỗi
                stopRotateWheel(spinAngle);
                return;
            }

            requestAnimationFrame(rotateWheel);
        }

        function stopRotateWheel(finalAngle) {
            console.log("Dừng quay tại góc:", finalAngle);
            canvas.classList.remove('wheel-spinning');

            // Vẽ lại wheel ở vị trí cuối
            ctx.save();
            ctx.clearRect(0, 0, 300, 300);
            ctx.translate(150, 150);
            ctx.rotate((finalAngle * Math.PI) / 180);
            ctx.translate(-150, -150);
            drawWheel();
            ctx.restore();

            // Tính toán kết quả
            const degrees = finalAngle % 360;
            const index = Math.floor((360 - degrees) / (360 / vouchers.length)) % vouchers.length;
            const prize = vouchers[index];

            console.log("Kết quả:", prize);

            let discountText = prize.discount_type === "percent"
                ? prize.discount_value + "%"
                : prize.discount_value.toLocaleString() + "đ";

            // Show success result with animation
            resultText.innerHTML = `
                <div class="result-success text-white text-lg font-bold rounded-2xl px-6 py-4 shadow-lg">
                    🎉 Chúc mừng! Bạn nhận được:<br>
                    <span class="text-xl">${prize.code}</span><br>
                    <span class="text-yellow-300">(Giảm ${discountText})</span>
                </div>
            `;

            // Cập nhật trạng thái đã quay
            hasSpunToday = true;

            // Reset button sau khi quay xong
            setTimeout(() => {
                isSpinning = false;
                updateSpinButton(false); // Disable button
            }, 2000);

            // Lưu voucher vào DB
            fetch("{{ route('spin.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ voucher_id: prize.id })
            })
            .then(res => res.json())
            .then(data => {
                console.log("Saved voucher:", data);
                if (data.success) {
                    hasSpunToday = true;
                }
            })
            .catch(err => {
                console.error("Lỗi lưu voucher:", err);
                // Vẫn cho phép hiển thị kết quả dù lưu thất bại
            });
        }

        // Bắt đầu quay
        try {
            rotateWheel();
        } catch (error) {
            console.error("Lỗi khởi tạo quay:", error);
            // Reset lại trạng thái nếu có lỗi
            isSpinning = false;
            startSpinBtn.disabled = false;
            startSpinBtn.innerHTML = `
                <span class="relative z-10 flex items-center justify-center space-x-2">
                    <span>🎲</span>
                    <span>Quay Ngay</span>
                    <span>✨</span>
                </span>
            `;
            alert("Có lỗi xảy ra khi quay. Vui lòng thử lại!");
        }
    });
});
</script>
            </div>
        </div>

        <!-- Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-center py-4">
                <nav class="w-full">
                    <!-- Mobile Menu Button -->
                    <div class="lg:hidden flex justify-center mb-4">
                        <button id="mobileMenuToggle"
                            class="bg-gray-100 hover:bg-gray-200 p-2 rounded-lg transition-colors">
                            <svg width="24" height="24" viewBox="0 0 24 24" class="text-gray-700">
                                <path fill="currentColor" d="M3 6h18v2H3V6zm0 5h18v2H3v-2zm0 5h18v2H3v-2z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Desktop Menu -->
                    <div class="hidden lg:flex justify-center">
                        <ul class="flex items-center space-x-8 text-sm font-semibold uppercase tracking-wide">
                            <li>
                                <a href="{{ route('home.index') }}" class="text-gray-700 hover:text-blue-600 transition-colors">Trang
                                    Chủ</a>

                            </li>
                            <li>
                                <a href="{{ route('about') }}">Giới thiệu</a>
                            </li>
                            <li><a href="{{ route('blogs.index') }}" class="hover:text-indigo-600">Blog</a></li>


                            <li>
                                <a href="{{ route('home.products') }}"
                                    class="text-gray-700 hover:text-blue-600 transition-colors">Danh mục</a>
                            </li>

                            <li>
                                <a href="{{ route('products.accessories') }}" class="text-gray-700 hover:text-blue-600 transition-colors">Phụ
                                    kiện</a>
                            </li>
                           

                               <li>
                             <a href="{{ route('contact') }}">Liên hệ</a>
                           </li>


                        </ul>
                    </div>

                    <!-- Mobile Menu -->
                    <div id="mobileMenu" class="lg:hidden hidden">
                        <div class="bg-white border-t border-gray-200 py-4">
                            <ul class="space-y-2 text-center">
                                <li><a href="#women" class="block py-2 text-gray-700 hover:text-blue-600">Trang
                                        Chủ</a>
                                </li>
                                <li><a href="/about" class="block py-2 text-gray-700 hover:text-blue-600">Giới
                                        thiệu</a></li>
                                <li><a href="#kids" class="block py-2 text-gray-700 hover:text-blue-600">Trẻ em</a>
                                </li>
                                <li><a href="#accessories" class="block py-2 text-gray-700 hover:text-blue-600">Phụ
                                        kiện</a></li>
                                <li><a href="#brand" class="block py-2 text-gray-700 hover:text-blue-600">Thương
                                        Hiệu</a></li>
                                <li><a href="#sale" class="block py-2 text-gray-700 hover:text-blue-600">Khuyến
                                        Mãi</a></li>
                                <li><a href="{{ route('vouchers.index') }}"
                                        class="block py-2 text-gray-700 hover:text-blue-600">Mã Giảm Giá</a></li>
                                <li><a href="#blog" class="block py-2 text-gray-700 hover:text-blue-600">Blog</a>
                                </li>
                            </ul>

                        </div>
                    </div>
            </div>
            </nav>
        </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const hash = window.location.hash;

                if (hash) {
                    const tabTrigger = document.querySelector(`[data-bs-target="${hash}"]`);
                    if (tabTrigger) {
                        const tab = new bootstrap.Tab(tabTrigger);
                        tab.show();

                        // Nếu là reviews thì scroll tới phần review
                        if (hash === "#v-pills-reviews") {
                            setTimeout(() => {
                                document.querySelector("#v-pills-reviews")?.scrollIntoView({
                                    behavior: 'smooth'
                                });
                            }, 300);
                        }
                    }
                }
                const tabTriggers = document.querySelectorAll('[data-bs-toggle="pill"]');
                tabTriggers.forEach(trigger => {
                    trigger.addEventListener('shown.bs.tab', function(e) {
                        const newHash = e.target.getAttribute('data-bs-target');
                        history.replaceState(null, null, newHash);
                    });
                });
            });
        </script>

    </header>

    @yield('content')

    @include('components.footer')
</body>

<style>
    /* Notification animations */
    .notification-enter {
        transition: all 0.5s ease-out;
    }

    .notification-enter.opacity-0 {
        opacity: 0;
        transform: translateX(100%);
    }

    .notification-enter.opacity-100 {
        opacity: 1;
        transform: translateX(0);
    }

    /* Progress bar animation */
    .progress-bar-shrink {
        transition: width 5s linear;
    }
</style>
<!-- Chatbox Styles -->
<style>
    #chatbox-user {
        animation: fadeInUp 0.4s;
        backdrop-filter: blur(12px) saturate(120%);
        background: rgba(255, 255, 255, 0.92);
        box-shadow: 0 8px 32px 0 rgba(132, 94, 194, 0.18);
        border-radius: 2rem;
        border: 1.5px solid #ff5f6d33;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .chat-header-glass {
        background: linear-gradient(90deg, #ff5f6d 0%, #845ec2 100%);
        backdrop-filter: blur(8px);
        border-top-left-radius: 2rem;
        border-top-right-radius: 2rem;
        box-shadow: 0 2px 8px 0 #845ec233;
    }

    .chat-bubble {
        position: relative;
        border-radius: 1.5rem;
        box-shadow: 0 2px 8px 0 #845ec233;
        padding: 0.75rem 1.25rem;
        margin-bottom: 0.5rem;
        max-width: 75%;
        word-break: break-word;

        transition: background 0.2s;
    }

    @keyframes bubbleIn {
        from {
            opacity: 0;
            transform: scale(0.95) translateY(20px);
        }

        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    .chat-bubble.user {
        background: linear-gradient(180deg, #ff5f6d 0%, #845ec2 100%);
        color: #fff;
        align-self: flex-end;
        border-bottom-right-radius: 0.3rem;
    }

    .chat-bubble.admin {
        background: #f3eaff;
        color: #222;
        align-self: flex-start;
        border-bottom-left-radius: 0.3rem;
    }

    .chat-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 0 1px 4px #845ec233;
        margin-right: 0.5rem;
        margin-left: 0.5rem;
        border: 2px solid #ff5f6d;
    }

    .chat-meta {
        font-size: 0.75rem;
        color: #b39ddb;
        margin-top: 0.2rem;
        text-align: right;
    }

    .chat-meta.admin {
        text-align: left;
    }

    #chat-send-btn {
        background: linear-gradient(135deg, #ff5f6d 0%, #845ec2 100%);
        transition: background 0.2s, transform 0.1s;
        box-shadow: 0 2px 8px 0 #ff5f6d33;
    }

    #chat-send-btn:hover {
        background: linear-gradient(135deg, #845ec2 0%, #ff5f6d 100%);
        transform: scale(1.1);
    }

    #chat-input::placeholder {
        color: #b39ddb;
        font-style: italic;
    }

    .emoji-btn {
        background: none;
        border: none;
        font-size: 1.3rem;
        cursor: pointer;
        margin-right: 0.3rem;
        filter: drop-shadow(0 1px 2px #ff5f6d33);
    }

    .emoji-btn:hover {
        transform: scale(1.2);
        filter: drop-shadow(0 2px 4px #845ec2aa);
    }

    @media (max-width: 600px) {
        #chatbox-user {
            right: 0.5rem !important;
            width: 98vw !important;
            min-width: unset !important;
        }
    }

    #chat-toggle-btn {
        background: linear-gradient(135deg, #ff5f6d 0%, #845ec2 100%) !important;
        box-shadow: 0 4px 16px 0 #845ec233;
        border: 4px solid #fff;
    }
</style>
<div id="chat-toggle-btn" onclick="toggleChatBox()"
    class="fixed bottom-6 right-6 w-16 h-16 bg-gradient-to-br from-blue-500 to-green-400 text-white rounded-full shadow-2xl flex items-center justify-center cursor-pointer transition-all duration-300 z-50 hover:scale-110 border-4 border-white">
    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
        </path>
    </svg>
</div>
{{-- CHATBOX USER START --}}
@if (auth()->check())
    <div id="chatbox-user" class="fixed bottom-28 right-8 w-96 bg-white z-50 hidden flex flex-col"
        style="min-height:420px; max-height:520px; min-width:340px;">
        <div class="chat-header-glass text-white px-6 py-4 flex items-center justify-between shadow-md">
            <div class="flex items-center gap-2">
                <img src="https://ui-avatars.com/api/?name=Admin&background=4f8cff&color=fff" class="chat-avatar"
                    alt="Admin">
                <span class="font-semibold text-lg drop-shadow">Hỗ trợ trực tuyến <span
                        class="ml-2 inline-block w-2 h-2 bg-green-400 rounded-full animate-pulse align-middle"></span></span>
            </div>
            <button onclick="toggleChatBox()" class="text-white hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
        <div id="chat-messages" class="flex-1 overflow-y-auto px-4 py-3 flex flex-col gap-2 bg-gray-50"
            style="min-height:260px; max-height:320px;"></div>
        <div class="p-4 border-t border-gray-100 bg-white rounded-b-3xl">
            <div class="flex items-center space-x-2">
                <button class="emoji-btn" onclick="toggleEmojiPicker()">😊</button>
                <input type="text" id="chat-input" placeholder="Nhập nội dung cần hỗ trợ..."
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-400 focus:border-transparent text-base shadow-sm">
                <button id="chat-send-btn"
                    class="bg-gradient-to-br from-blue-500 to-green-400 hover:from-blue-700 hover:to-green-500 text-white p-3 rounded-full shadow-lg transition-all flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </div>
            <div id="emoji-picker"
                class="hidden mt-2 bg-white border border-gray-200 rounded-xl shadow-lg p-2 flex flex-wrap gap-1 max-w-xs">
                <span class="emoji-btn" onclick="addEmoji('😀')">😀</span>
                <span class="emoji-btn" onclick="addEmoji('😂')">😂</span>
                <span class="emoji-btn" onclick="addEmoji('😍')">😍</span>
                <span class="emoji-btn" onclick="addEmoji('👍')">👍</span>
                <span class="emoji-btn" onclick="addEmoji('🙏')">🙏</span>
                <span class="emoji-btn" onclick="addEmoji('😢')">😢</span>
                <span class="emoji-btn" onclick="addEmoji('🎉')">🎉</span>
                <span class="emoji-btn" onclick="addEmoji('❤️')">❤️</span>
                <span class="emoji-btn" onclick="addEmoji('😎')">😎</span>
                <span class="emoji-btn" onclick="addEmoji('🤔')">🤔</span>
                <span class="emoji-btn" onclick="addEmoji('🥰')">🥰</span>
                <span class="emoji-btn" onclick="addEmoji('😇')">😇</span>
            </div>
        </div>
    </div>
@endif
<script>
    const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
    const userRole = "{{ auth()->user()->role ?? '' }}";

    function toggleChatBox() {
        const box = document.getElementById('chatbox-user');
        if (!isLoggedIn) {
            window.location.href = "{{ route('login') }}?error=login_required";
            return;
        }

        if (userRole == 'admin') {
            window.location.href = "{{ url()->current() }}?error=admin_cannot_chat";
            return;
        }

        if (box) {
            if (box.style.display === 'flex') {
                box.style.display = 'none';
            } else {
                box.style.display = 'flex';
            }
        }
    }

    function toggleEmojiPicker() {
        const picker = document.getElementById('emoji-picker');
        picker.classList.toggle('hidden');
    }

    function addEmoji(emoji) {
        const input = document.getElementById('chat-input');
        input.value += emoji;
        input.focus();
    }
    @if (auth()->check())
        const chatUserId = {{ auth()->id() }};

        function formatTime(ts) {
            const d = new Date(ts);
            return d.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function loadUserMessages() {
            fetch('/chat/messages?user_id=' + chatUserId)
                .then(res => res.json())
                .then(data => {
                    const box = document.getElementById('chat-messages');
                    box.innerHTML = '';
                    let html = '';
                    data.forEach(msg => {
                        if (msg.is_admin) {
                            // Admin bên trái, có avatar
                            html += `
                            <div class="mb-2 flex justify-start">
                                <div class="flex items-end gap-2">
                                    <img src="https://ui-avatars.com/api/?name=Admin&background=845ec2&color=fff" class="w-7 h-7 rounded-full shadow-sm" alt="avatar">
                                    <div>
                                        <div class="chat-bubble admin bg-purple-50 text-gray-900 px-3 py-1.5 rounded-2xl font-medium shadow-sm" style="border-bottom-left-radius: 0.4rem; font-size: 15px; min-width: 80px; max-width: 220px;">
                                            <div class="font-bold text-xs text-purple-700 mb-0.5" style="font-size: 12px;">Admin <span class="ml-2 text-[10px] text-purple-400">${msg.created_at ? formatTime(msg.created_at) : ''}</span></div>
                                            ${msg.message}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
                        } else {
                            // User bên phải, KHÔNG avatar, KHÔNG gap, sát phải
                            html += `
                            <div class="mb-2 flex justify-end">
                                <div class="max-w-[60%]">
                                    <div class="chat-bubble user bg-gradient-to-br from-pink-400 to-purple-400 text-white px-3 py-1.5 rounded-2xl font-medium shadow-sm text-right" style="border-bottom-right-radius: 0.4rem; font-size: 15px; min-width: 80px; max-width: 220px;">
                                        <div class="font-bold text-xs text-white mb-0.5 text-right" style="font-size: 12px;">Bạn <span class="ml-2 text-[10px] text-pink-200">${msg.created_at ? formatTime(msg.created_at) : ''}</span></div>
                                        ${msg.message}
                                    </div>
                                </div>
                            </div>
                            `;
                        }
                    });
                    box.innerHTML = html;
                    setTimeout(() => {
                        box.scrollTop = box.scrollHeight;
                    }, 100);
                });
        }
        document.getElementById('chat-send-btn').onclick = function() {
            const input = document.getElementById('chat-input');
            const message = input.value.trim();
            if (!message) return;
            fetch('/chat/messages', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        user_id: chatUserId,
                        message: message,
                        is_admin: false
                    })
                })
                .then(res => res.json())
                .then(data => {
                    input.value = '';
                    loadUserMessages(); // hiển thị message vừa gửi

                    // Delay nhẹ rồi fetch lại để lấy phản hồi từ chatbot nếu có
                    setTimeout(() => {
                        loadUserMessages();
                    }, 800); // Tùy thời gian backend trả lời, 500-1000ms là ổn
                });

        };
        document.getElementById('chat-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('chat-send-btn').click();
            }
        });
        setInterval(loadUserMessages, 3000);
        loadUserMessages();
    @endif
</script>
<script>
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

    // Notification System
    function showNotification(notificationId) {
        const notification = document.getElementById(notificationId);
        if (notification) {
            // Show notification
            notification.classList.remove('opacity-0', 'translate-x-full');
            notification.classList.add('opacity-100', 'translate-x-0');

            // Start progress bar animation
            const progressBar = document.getElementById(notificationId.replace('-notification', '-progress-bar'));
            if (progressBar) {
                setTimeout(() => {
                    progressBar.style.width = '0%';
                }, 100);
            }

            // Auto hide after 5 seconds
            setTimeout(() => {
                closeNotification(notificationId);
            }, 5000);
        }
    }

    function closeNotification(notificationId) {
        const notification = document.getElementById(notificationId);
        if (notification) {
            notification.classList.remove('opacity-100', 'translate-x-0');
            notification.classList.add('opacity-0', 'translate-x-full');
        }
    }

    // Show notifications on page load
    document.addEventListener('DOMContentLoaded', function() {
        const successNotification = document.getElementById('success-notification');
        const errorNotification = document.getElementById('error-notification');
        const infoNotification = document.getElementById('info-notification');

        if (successNotification) {
            setTimeout(() => showNotification('success-notification'), 100);
        }

        if (errorNotification) {
            setTimeout(() => showNotification('error-notification'), 100);
        }

        if (infoNotification) {
            setTimeout(() => showNotification('info-notification'), 100);
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

</html>
