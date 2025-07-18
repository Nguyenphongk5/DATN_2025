@forelse ($orders as $order)
    <div class="bg-white rounded-3xl shadow-2xl mb-8 border border-gray-100 overflow-hidden">
        <div
            class="flex flex-col md:flex-row md:items-center justify-between px-8 py-5 border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-pink-50">
            <div class="text-lg font-bold text-gray-800 tracking-wide">
                <span class="text-gray-400 font-medium">Mã đơn:</span> <span
                    class="text-indigo-600">{{ $order->order_code }}</span>
            </div>
            <span class="inline-block mt-3 md:mt-0 px-5 py-1.5 rounded-full text-sm font-bold shadow-sm
                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                    @elseif($order->status === 'processing') bg-blue-100 text-blue-700
                    @elseif($order->status === 'completed' || $order->status === 'delivered') bg-green-100 text-green-700
                    @elseif($order->status === 'cancelled') bg-pink-100 text-pink-700
                        @else bg-gray-200 text-gray-600
                    @endif
                ">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <div class="px-8 py-6 bg-gradient-to-br from-white to-pink-50">
            @foreach ($order->orderDetails as $item)
                @php
                    $variant = $item->productVariant;
                    $product = $variant?->product;
                    $image = $variant?->image ?? $product?->img_thumb ?? 'images/no-image.png';
                @endphp

                <div class="flex items-center gap-6 mb-6 pb-5 border-b last:border-b-0 last:mb-0 last:pb-0 group">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('storage/' . $image) }}" alt="ảnh"
                            class="w-20 h-20 object-cover rounded-2xl border-2 border-pink-100 shadow-md">
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-bold text-gray-900 text-xl leading-snug max-w-full break-words line-clamp-2 transition-colors duration-200 group-hover:text-pink-600 group-hover:bg-pink-50 px-2 py-1 rounded cursor-pointer"
                            title="{{ $item->product_name }}">
                            {{ $item->product_name }}
                        </div>
                        <div class="flex flex-wrap gap-2 mt-2 text-xs">
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded bg-indigo-100 text-indigo-700 font-medium"><svg
                                    class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 20l9-5-9-5-9 5 9 5z" />
                                    <path d="M12 12V4" />
                                </svg>{{ $item->color_name ?? 'Không màu' }}</span>
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded bg-pink-100 text-pink-700 font-medium"><svg
                                    class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="3" />
                                    <path
                                        d="M12 2v2m0 16v2m10-10h-2M4 12H2m15.364-7.364l-1.414 1.414M6.05 17.95l-1.414 1.414m12.728 0l-1.414-1.414M6.05 6.05L4.636 4.636" />
                                </svg>{{ $item->size_name ?? 'Không size' }}</span>
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded bg-gray-100 text-gray-700 font-medium"><svg
                                    class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path
                                        d="M17 9V7a5 5 0 00-10 0v2a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2v-7a2 2 0 00-2-2z" />
                                </svg>x{{ $item->quantity }}</span>
                        </div>
                    </div>
                    <div
                        class="text-right font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-indigo-500 text-lg min-w-[110px] select-text">
                        ₫{{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                    </div>
                </div>
            @endforeach

            <div class="flex flex-col md:flex-row md:items-center md:justify-between mt-8 gap-4">
                <div
                    class="bg-gradient-to-r from-indigo-100 to-pink-100 rounded-2xl px-6 py-4 shadow-inner text-lg font-bold text-indigo-700 flex items-center justify-center md:justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-pink-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 0V4m0 16v-4m8-4h-4m-8 0H4" />
                    </svg>
                    Tổng tiền: <span
                        class="ml-2 text-pink-600">₫{{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex gap-3 justify-end">
                    <a href="{{ route('orders.show', $order->id) }}"
                        class="inline-flex items-center px-5 py-2 rounded-xl border-2 border-indigo-400 text-indigo-700 font-semibold text-base hover:bg-indigo-50 transition shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2a4 4 0 014-4h4" />
                        </svg>
                        Xem chi tiết
                    </a>
          <a href="{{ route('product.show', $item->productVariant->product->id) }}#review"
    class="inline-flex items-center px-4 py-1.5 rounded-lg text-white font-semibold text-sm bg-gradient-to-r from-green-400 to-blue-500 hover:from-green-500 hover:to-blue-600 transition shadow-md">
    <!-- icon + text -->
    Đánh giá
</a>



                    <a href="{{ route('orders.reorder', $order->id) }}"
                        class="inline-flex items-center px-5 py-2 rounded-xl bg-gradient-to-r from-pink-500 to-indigo-500 text-white font-semibold text-base hover:from-pink-400 hover:to-indigo-400 transition shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582M20 20v-5h-.581M5.21 17.293A8.966 8.966 0 013 12c0-4.418 3.134-8 7-8s7 3.582 7 8a8.966 8.966 0 01-2.21 5.293M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Mua lại
                    </a>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="bg-white rounded-2xl shadow-md text-center py-12">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-3 h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M9 3v18m6-18v18M4 21h16" />
        </svg>
        <div class="text-gray-500 text-lg font-semibold">Không có đơn hàng nào.</div>
    </div>
@endforelse
