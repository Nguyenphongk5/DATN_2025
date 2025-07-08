@extends('layouts.user')
@section('content')
    <!-- Hero Slider Section -->
    <section class="relative h-screen overflow-hidden">
        <div class="swiper hero-swiper h-full">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)
                    <div class="swiper-slide relative h-full">
                        <div class="absolute inset-0">
                            <img src="{{ asset($banner->image) }}" alt="slideshow"
                                class="w-full h-full object-cover brightness-75">
                            <div class="absolute inset-0 bg-gradient-to-br from-black/40 via-transparent to-black/60"></div>
                        </div>
                        <div class="relative z-10 flex items-center justify-center h-full">
                            <div class="text-center text-white max-w-4xl mx-auto px-4">
                                <div class="inline-block mb-6">
                                    <span
                                        class="bg-gradient-to-r from-red-500 to-orange-500 text-white text-sm font-bold px-5 py-2 rounded-full shadow-lg animate-pulse">
                                        Hot Deal
                                    </span>
                                </div>
                                <h1 class="text-5xl md:text-7xl font-bold mb-6 text-shadow-lg">
                                    {{ $banner->title }}
                                </h1>
                                <p class="text-xl md:text-2xl mb-8 opacity-90 text-shadow">
                                    Khám phá bộ sưu tập mới nhất với những ưu đãi đặc biệt
                                </p>
                                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                    <a href="#"
                                        class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-full hover:from-purple-600 hover:to-blue-600 transform hover:-translate-y-1 transition-all duration-300 shadow-lg">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01">
                                            </path>
                                        </svg>
                                        Mua ngay
                                    </a>
                                    <a href="#"
                                        class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-semibold rounded-full hover:bg-white hover:text-gray-900 transform hover:-translate-y-1 transition-all duration-300">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        Xem thêm
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Navigation -->
            <div class="swiper-button-next hero-button-next"></div>
            <div class="swiper-button-prev hero-button-prev"></div>
            <!-- Pagination -->
            <div class="swiper-pagination hero-pagination"></div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="relative -mt-24 z-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white rounded-2xl shadow-2xl p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                                <!-- icon -->
                            </div>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900 mb-2">Pick up in store</h4>
                            <p class="text-gray-600">Nhận hàng tại cửa hàng với dịch vụ nhanh chóng và tiện lợi.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-600 rounded-xl flex items-center justify-center">
                                <!-- icon -->
                            </div>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900 mb-2">Special packaging</h4>
                            <p class="text-gray-600">Đóng gói đặc biệt với thiết kế độc đáo và bảo vệ tối ưu.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-red-500 to-pink-600 rounded-xl flex items-center justify-center">
                                <!-- icon -->
                            </div>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900 mb-2">Free global returns</h4>
                            <p class="text-gray-600">Đổi trả miễn phí toàn cầu với chính sách linh hoạt.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Banners Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="relative overflow-hidden rounded-2xl shadow-lg group">
                    <div class="absolute inset-0 bg-gradient-to-r from-gray-900/70 to-transparent z-10"></div>
                    <img src="{{ asset('images/ad-image-3.png') }}" alt="Gentlemen Classics"
                        class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 z-20 flex items-center p-8">
                        <div class="text-white">
                            <div class="text-lg font-semibold mb-2">Upto 25% Off</div>
                            <h3 class="text-3xl font-bold mb-4">Gentlemen Classics</h3>
                            <a href="#"
                                class="inline-flex items-center px-6 py-3 bg-white text-gray-900 font-semibold rounded-full hover:bg-gray-100 transition-colors">
                                Xem ngay
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-2xl shadow-lg group">
                    <div class="absolute inset-0 bg-gradient-to-r from-gray-900/70 to-transparent z-10"></div>
                    <img src="{{ asset('images/ad-image-4.png') }}" alt="Casual Wears"
                        class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 z-20 flex items-center p-8">
                        <div class="text-white">
                            <div class="text-lg font-semibold mb-2">Upto 25% Off</div>
                            <h3 class="text-3xl font-bold mb-4">Casual Wears</h3>
                            <a href="#"
                                class="inline-flex items-center px-6 py-3 bg-white text-gray-900 font-semibold rounded-full hover:bg-gray-100 transition-colors">
                                Xem ngay
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trending Products Section -->
    <section class="py-20 bg-gradient-to-br from-gray-50 via-white to-blue-50">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h2
                    class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-gray-900 via-purple-800 to-pink-600 bg-clip-text text-transparent mb-4">
                    Trending Products
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Khám phá những sản phẩm hot nhất, được yêu thích nhất với thiết kế độc đáo và chất lượng cao cấp
                </p>
                <div class="w-24 h-1 bg-gradient-to-r from-purple-600 to-pink-600 mx-auto mt-6 rounded-full"></div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
                @foreach ($latestProducts as $product)
                    <div class="group relative animate-fade-in-up">
                        <div
                            class="bg-white rounded-3xl shadow-2xl border-2 border-transparent group-hover:border-purple-400 transition-all duration-300 overflow-hidden">
                            <!-- Thêm vào div chứa hình ảnh -->
                            <div class="relative overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 group"
                                data-id="{{ $product->id }}"
                                data-favorited="{{ $product->is_favorited ? 'true' : 'false' }}">
                                <!-- ảnh sản phẩm -->
                                <img src="{{ asset('storage/' . $product->img_thumb) }}" alt="{{ $product->name }}"
                                    class="w-full h-60 object-cover rounded-t-3xl group-hover:scale-105 transition-transform duration-500">

                                <!-- Nút yêu thích -->
                                <button
                                    class="favorite-btn absolute top-4 right-4 z-10 p-2 bg-white/80 rounded-full hover:scale-110 transition-transform duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-6 h-6 transition-colors duration-200 favorite-icon {{ $product->is_favorited ? 'text-red-500' : 'text-gray-400' }}"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.41
                                 4.42 3 7.5 3c1.74 0 3.41 0.81
                                 4.5 2.09C13.09 3.81 14.76 3 16.5 3
                                 19.58 3 22 5.41 22 8.5c0 3.78-3.4
                                 6.86-8.55 11.54L12 21.35z" />
                                    </svg>
                                </button>

                                <!-- % giảm giá -->
                                <span class="absolute top-4 left-4 ...">30%</span>
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
                @endforeach
            </div>

            <!-- View All Products Button -->
            <div class="text-center mt-12">
                <a href="{{ route('home.products') }}"
                    class="inline-flex items-center gap-2 bg-white border-2 border-purple-600 text-purple-600 font-semibold py-3 px-8 rounded-full hover:bg-purple-600 hover:text-white transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    <span>Xem tất cả sản phẩm</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Best Seller Products Section --}}
    @if(isset($bestSalerProducts) && count($bestSalerProducts) > 0)
        <section class="py-20 bg-gradient-to-br from-gray-50 via-white to-blue-50">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-gray-900 via-purple-800 to-pink-600 bg-clip-text text-transparent mb-4">
                        Best Seller Products
                    </h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Những sản phẩm bán chạy nhất của chúng tôi
                    </p>
                    <div class="w-24 h-1 bg-gradient-to-r from-purple-600 to-pink-600 mx-auto mt-6 rounded-full"></div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
                    @foreach ($bestSalerProducts as $product)
                        <div class="group relative animate-fade-in-up">
                            <div class="bg-white rounded-3xl shadow-2xl border-2 border-transparent group-hover:border-purple-400 transition-all duration-300 overflow-hidden">
                                <div class="relative overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 group"
                                    data-id="{{ $product->id }}"
                                    data-favorited="{{ $product->is_favorited ? 'true' : 'false' }}">
                                    <img src="{{ asset('storage/' . $product->img_thumb) }}" alt="{{ $product->name }}"
                                        class="w-full h-60 object-cover rounded-t-3xl group-hover:scale-105 transition-transform duration-500">

                                    <!-- Nút yêu thích -->
                                    <button
                                        class="favorite-btn absolute top-4 right-4 z-10 p-2 bg-white/80 rounded-full hover:scale-110 transition-transform duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-6 h-6 transition-colors duration-200 favorite-icon {{ $product->is_favorited ? 'text-red-500' : 'text-gray-400' }}"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.41
                                     4.42 3 7.5 3c1.74 0 3.41 0.81
                                     4.5 2.09C13.09 3.81 14.76 3 16.5 3
                                     19.58 3 22 5.41 22 8.5c0 3.78-3.4
                                     6.86-8.55 11.54L12 21.35z" />
                                        </svg>
                                    </button>

                                    <!-- % giảm giá -->
                                    <span class="absolute top-4 left-4 ...">30%</span>
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
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Swiper CSS and JS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        // Initialize Hero Swiper
        var heroSwiper = new Swiper('.hero-swiper', {
            loop: true,
            effect: 'fade',
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            speed: 1000,
            navigation: {
                nextEl: '.hero-button-next',
                prevEl: '.hero-button-prev',
            },
            pagination: {
                el: '.hero-pagination',
                clickable: true,
                dynamicBullets: true,
            },
        });
    </script>

    <style>
        /* Hero Slider Styles */
        .hero-button-next,
        .hero-button-prev {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            color: white;
            transition: all 0.3s ease;
        }

        .hero-button-next:hover,
        .hero-button-prev:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .hero-button-next::after,
        .hero-button-prev::after {
            font-size: 20px;
            font-weight: bold;
        }

        .hero-pagination {
            bottom: 30px;
        }

        .hero-pagination .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 1;
            transition: all 0.3s ease;
        }

        .hero-pagination .swiper-pagination-bullet-active {
            background: linear-gradient(45deg, #667eea, #764ba2);
            transform: scale(1.3);
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Animation for cards */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .group {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .group:nth-child(1) {
            animation-delay: 0.1s;
        }

        .group:nth-child(2) {
            animation-delay: 0.2s;
        }

        .group:nth-child(3) {
            animation-delay: 0.3s;
        }

        .group:nth-child(4) {
            animation-delay: 0.4s;
        }

        .group:nth-child(5) {
            animation-delay: 0.5s;
        }

        .group:nth-child(6) {
            animation-delay: 0.6s;
        }

        .group:nth-child(7) {
            animation-delay: 0.7s;
        }

        .group:nth-child(8) {
            animation-delay: 0.8s;
        }

        /* Hover effects */
        .group:hover .bg-gradient-to-r {
            background-size: 200% 200%;
            animation: gradientShift 2s ease infinite;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Glass morphism effect */
        .backdrop-blur-sm {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #8b5cf6, #ec4899);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #7c3aed, #db2777);
        }
    </style>

    <section class="py-16 bg-yellow-100">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="p-8">
                    <h2 class="text-4xl font-bold mb-4">
                        Get <span class="text-red-600">25% Discount</span> on your first purchase
                    </h2>
                    <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="p-8 bg-white rounded-2xl shadow-lg">
                    @if (session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('subscribe.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="name" class="block text-gray-700 font-semibold mb-1">Name</label>
                            <input type="text"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                name="name" id="name" placeholder="Name">
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                            <input type="email"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                name="email" id="email" placeholder="abc@mail.com">
                        </div>
                        <div class="flex items-center space-x-2">
                            <input class="rounded border-gray-300" type="checkbox" id="subscribe" value="subscribe">
                            <label class="text-gray-600" for="subscribe">Subscribe to the newsletter</label>
                        </div>
                        <button type="submit"
                            class="w-full py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-lg hover:from-purple-600 hover:to-blue-600 transition-all">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section id="latest-blog" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10">
                <h2 class="text-3xl font-bold mb-4 md:mb-0">Our Recent Blog</h2>
                <a href="#" class="inline-flex items-center text-blue-600 font-semibold hover:underline">
                    Read All Articles
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($blogs as $blog)
                    <article class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col">
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $blog->img_avt) }}" alt="{{ $blog->title }}"
                                class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center text-xs text-gray-500 space-x-4 mb-2">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <use xlink:href="#calendar"></use>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($blog->created_at)->format('d M Y') }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <use xlink:href="#category"></use>
                                    </svg>
                                    Bài viết
                                </div>
                            </div>
                            <h3 class="text-lg font-bold mb-2">{{ $blog->title }}</h3>
                            <p class="text-gray-600 mb-4">
                                {{ \Illuminate\Support\Str::limit($blog->short_description, 100) }}</p>
                            {{-- <a href="{{ route('blog.detail', $blog->slug) }}" class="mt-auto text-blue-600 font-semibold hover:underline">Đọc tiếp</a> --}}
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">
                <div class="flex items-start space-x-4 bg-white rounded-xl shadow p-6">
                    <div class="flex-shrink-0 text-blue-600">
                        <!-- icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M21.5 15a3 3 0 0 0-1.9-2.78l1.87-7a1 1 0 0 0-.18-.87A1 1 0 0 0 20.5 4H6.8l-.33-1.26A1 1 0 0 0 5.5 2h-2v2h1.23l2.48 9.26a1 1 0 0 0 1 .74H18.5a1 1 0 0 1 0 2h-13a1 1 0 0 0 0 2h1.18a3 3 0 1 0 5.64 0h2.36a3 3 0 1 0 5.82 1a2.94 2.94 0 0 0-.4-1.47A3 3 0 0 0 21.5 15Zm-3.91-3H9L7.34 6H19.2ZM9.5 20a1 1 0 1 1 1-1a1 1 0 0 1-1 1Zm8 0a1 1 0 1 1 1-1a1 1 0 0 1-1 1Z" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="text-lg font-bold mb-1">Free delivery</h5>
                        <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4 bg-white rounded-xl shadow p-6">
                    <div class="flex-shrink-0 text-green-600">
                        <!-- icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M19.63 3.65a1 1 0 0 0-.84-.2a8 8 0 0 1-6.22-1.27a1 1 0 0 0-1.14 0a8 8 0 0 1-6.22 1.27a1 1 0 0 0-.84.2a1 1 0 0 0-.37.78v7.45a9 9 0 0 0 3.77 7.33l3.65 2.6a1 1 0 0 0 1.16 0l3.65-2.6A9 9 0 0 0 20 11.88V4.43a1 1 0 0 0-.37-.78ZM18 11.88a7 7 0 0 1-2.93 5.7L12 19.77l-3.07-2.19A7 7 0 0 1 6 11.88v-6.3a10 10 0 0 0 6-1.39a10 10 0 0 0 6 1.39Zm-4.46-2.29l-2.69 2.7l-.89-.9a1 1 0 0 0-1.42 1.42l1.6 1.6a1 1 0 0 0 1.42 0L15 11a1 1 0 0 0-1.42-1.42Z" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="text-lg font-bold mb-1">100% secure payment</h5>
                        <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4 bg-white rounded-xl shadow p-6">
                    <div class="flex-shrink-0 text-yellow-500">
                        <!-- icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M22 5H2a1 1 0 0 0-1 1v4a3 3 0 0 0 2 2.82V22a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-9.18A3 3 0 0 0 23 10V6a1 1 0 0 0-1-1Zm-7 2h2v3a1 1 0 0 1-2 0Zm-4 0h2v3a1 1 0 0 1-2 0ZM7 7h2v3a1 1 0 0 1-2 0Zm-3 4a1 1 0 0 1-1-1V7h2v3a1 1 0 0 1-1 1Zm10 10h-4v-2a2 2 0 0 1 4 0Zm5 0h-3v-2a4 4 0 0 0-8 0v2H5v-8.18a3.17 3.17 0 0 0 1-.6a3 3 0 0 0 4 0a3 3 0 0 0 4 0a3 3 0 0 0 4 0a3.17 3.17 0 0 0 1 .6Zm2-11a1 1 0 0 1-2 0V7h2ZM4.3 3H20a1 1 0 0 0 0-2H4.3a1 1 0 0 0 0 2Z" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="text-lg font-bold mb-1">Quality guarantee</h5>
                        <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4 bg-white rounded-xl shadow p-6">
                    <div class="flex-shrink-0 text-pink-500">
                        <!-- icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 8.35a3.07 3.07 0 0 0-3.54.53a3 3 0 0 0 0 4.24L11.29 16a1 1 0 0 0 1.42 0l2.83-2.83a3 3 0 0 0 0-4.24A3.07 3.07 0 0 0 12 8.35Zm2.12 3.36L12 13.83l-2.12-2.12a1 1 0 0 0-1.42 1.42l1.6 1.6a1 1 0 0 0 1.42 0L15 11a1 1 0 0 0-1.42-1.42ZM12 2A10 10 0 0 0 2 12a9.89 9.89 0 0 0 2.26 6.33l-2 2a1 1 0 0 0-.21 1.09A1 1 0 0 0 3 22h9a10 10 0 0 0 0-20Zm0 18H5.41l.93-.93a1 1 0 0 0 0-1.41A8 8 0 1 1 12 20Z" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="text-lg font-bold mb-1">Guaranteed savings</h5>
                        <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4 bg-white rounded-xl shadow p-6">
                    <div class="flex-shrink-0 text-indigo-600">
                        <!-- icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M18 7h-.35A3.45 3.45 0 0 0 18 5.5a3.49 3.49 0 0 0-6-2.44A3.49 3.49 0 0 0 6 5.5A3.45 3.45 0 0 0 6.35 7H6a3 3 0 0 0-3 3v2a1 1 0 0 0 1 1h1v6a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3v-6h1a1 1 0 0 0 1-1v-2a3 3 0 0 0-3-3Zm-7 13H8a1 1 0 0 1-1-1v-6h4Zm0-9H5v-1a1 1 0 0 1 1-1h5Zm0-4H9.5A1.5 1.5 0 1 1 11 5.5Zm2-1.5A1.5 1.5 0 1 1 14.5 7H13ZM17 19a1 1 0 0 1-1 1h-3v-7h4Zm2-8h-6V9h5a1 1 0 0 1 1 1Z" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="text-lg font-bold mb-1">Daily offers</h5>
                        <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;
        document.querySelectorAll('.favorite-btn').forEach(button => {
            button.addEventListener('click', async (e) => {
                e.preventDefault();
                const parent = button.closest('[data-id]');
                const productId = parent.getAttribute('data-id');
                const icon = button.querySelector('.favorite-icon');

                try {
                    const response = await axios.post('{{ route('favorites.toggle') }}', {
                        product_id: productId
                    });

                    const message = response.data.message;

                    if (message.includes('Added')) {
                        icon.classList.remove('text-gray-400');
                        icon.classList.add('text-red-500');
                    } else {
                        icon.classList.remove('text-red-500');
                        icon.classList.add('text-gray-400');
                    }

                } catch (error) {
                    if (error.response?.status === 401) {
                        // Nếu chưa đăng nhập, chuyển về trang login
                        window.location.href = '{{ route('login') }}';
                    } else {
                        console.error('Yêu cầu thất bại:', error);
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                }
            });
        });
    </script>
@endsection
