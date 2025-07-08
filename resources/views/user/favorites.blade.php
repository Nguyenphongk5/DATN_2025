@extends('layouts.user')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Sản phẩm yêu thích</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 p-5">
        @forelse($favorites as $product)
            <div class="group relative animate-fade-in-up">
                <div
                    class="bg-white rounded-3xl shadow-2xl border-2 border-transparent group-hover:border-purple-400 transition-all duration-300 overflow-hidden">
                    <div class="relative overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 group"
                        data-id="{{ $product->id }}" data-favorited="true">
                        <img src="{{ asset('storage/' . $product->img_thumb) }}" alt="{{ $product->name }}"
                            class="w-full h-60 object-cover rounded-t-3xl group-hover:scale-105 transition-transform duration-500">

                        <!-- Nút yêu thích (luôn đỏ vì là mục yêu thích) -->
                        <button
                            class="favorite-btn absolute top-4 right-4 z-10 p-2 bg-white/80 rounded-full hover:scale-110 transition-transform duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 transition-colors duration-200 favorite-icon text-red-500"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.41
                                     4.42 3 7.5 3c1.74 0 3.41 0.81
                                     4.5 2.09C13.09 3.81 14.76 3 16.5 3
                                     19.58 3 22 5.41 22 8.5c0 3.78-3.4
                                     6.86-8.55 11.54L12 21.35z" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-6 flex flex-col h-full">
                        <h3
                            class="text-lg font-extrabold text-gray-900 mb-2 line-clamp-2 group-hover:text-purple-600 transition-colors duration-200">
                            <a href="{{ route('home.show', $product->id) }}"
                                class="hover:underline">{{ $product->name }}</a>
                        </h3>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-2xl font-bold text-pink-600">
                                {{ number_format($product->price, 0, '', '.') }} VNĐ
                            </span>
                            <del class="text-base text-gray-400">
                                {{ number_format($product->price_sale, 0, '', '.') }} VNĐ
                            </del>
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
        @empty
            <p>Bạn chưa yêu thích sản phẩm nào.</p>
        @endforelse
    </div>
@endsection
