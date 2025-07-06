@extends('layouts.user')
@section('content')

    <!-- Header Section -->
    <section class="py-12 bg-gradient-to-r from-purple-50 via-pink-50 to-blue-50 mb-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1
                        class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 bg-clip-text text-transparent mb-2">
                        Giỏ hàng của bạn
                    </h1>
                    <p class="text-gray-600 text-lg">Quản lý và thanh toán đơn hàng</p>
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
                    <span class="text-purple-600 font-semibold">Giỏ hàng</span>
                </nav>
            </div>
        </div>
    </section>

    <section class="py-12 bg-gradient-to-br from-gray-50 via-white to-blue-50 min-h-screen">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-10">
                <div class="w-full lg:w-8/12">
                    @if (empty($cart) || count($cart->items) == 0)
                        <div class="flex flex-col items-center justify-center py-24 animate-fade-in">
                            <div
                                class="w-24 h-24 flex items-center justify-center bg-gradient-to-r from-purple-500 to-pink-500 rounded-full mb-6 shadow-lg">
                                <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01">
                                    </path>
                                </svg>
                            </div>
                            <div class="text-2xl font-bold text-gray-700 mb-2">Giỏ hàng của bạn đang trống!</div>
                            <div class="text-gray-500">Hãy thêm sản phẩm để bắt đầu mua sắm.</div>
                        </div>
                    @else
                        <div class="bg-white rounded-2xl shadow-lg p-4 mb-6 border-2 border-purple-100">
                            <div class="flex items-center gap-4">
                                <input type="checkbox" id="select-all"
                                    class="w-5 h-5 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 focus:ring-2">
                                <label for="select-all" class="text-lg font-semibold text-gray-800 cursor-pointer">
                                    Chọn tất cả sản phẩm
                                </label>
                            </div>
                        </div>

                        <div class="space-y-6">
                            @foreach ($cart->items as $item)
                                @php
                                    $variant = $item->productVariant;
                                    $product = $item->product;
                                    $name = $product?->name ?? 'Sản phẩm';
                                    $price = $variant?->price ?? $product?->price ?? 0;
                                    $image = $variant?->image ?? $product?->img_thumb ?? 'images/no-image.png';
                                    $subtotal = $price * $item->quantity;
                                @endphp
                                <div
                                    class="group flex items-center bg-white rounded-2xl shadow-xl border-2 border-purple-100 hover:border-purple-400 transition-all duration-300 overflow-hidden p-4 gap-6 animate-fade-in-up">
                                    <div class="flex items-center">
                                        <input type="checkbox"
                                            class="item-checkbox w-5 h-5 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 focus:ring-2"
                                            value="{{ $item->id }}" data-subtotal="{{ $subtotal }}">
                                    </div>

                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $name }}"
                                        class="w-24 h-24 object-cover rounded-xl border border-gray-200 group-hover:scale-105 transition-transform duration-300">
                                    <div class="flex-1">
                                        <h5
                                            class="font-bold text-lg text-gray-900 mb-1 group-hover:text-purple-600 transition-colors">
                                            {{ $name }}
                                        </h5>
                                        @if ($variant)
                                            <div class="flex gap-2 mb-1">
                                                <span
                                                    class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-0.5 rounded-full">Size:
                                                    {{ $variant->size }}</span>
                                                <span
                                                    class="inline-block bg-pink-100 text-pink-700 text-xs font-semibold px-2 py-0.5 rounded-full">Màu:
                                                    {{ $variant->color_name }}</span>
                                            </div>
                                        @endif
                                        <div class="flex items-center gap-2 text-gray-500 text-sm">
                                            <span>Số lượng:</span>
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                                class="flex items-center gap-2">
                                                @csrf @method('PUT')
                                                <input type="number" name="quantity"
                                                    class="w-16 rounded-xl border-gray-300 text-center focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-1 px-2 text-base"
                                                    value="{{ $item->quantity }}" min="1">
                                                <button type="submit"
                                                    class="py-1 px-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl font-semibold hover:from-purple-700 hover:to-pink-700 transition-all text-xs shadow">
                                                    Cập nhật
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end gap-2">
                                        <span class="text-xl font-bold text-pink-600">{{ number_format($subtotal, 0, ',', '.') }}
                                            VNĐ</span>
                                        <a href="{{ route('cart.remove', $item->id) }}"
                                            class="text-red-500 hover:text-white hover:bg-red-500 rounded-full p-2 transition-colors duration-200 shadow">
                                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                                <path
                                                    d="M3 6h18M9 6v12a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V6m-6 0V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="w-full lg:w-4/12 mt-10 lg:mt-0">
                    <div class="bg-white rounded-2xl shadow-2xl border-2 border-purple-100 p-8">
                        <h4 class="text-2xl font-bold mb-6 text-gray-800">Tổng cộng</h4>
                        <div class="mb-6">
                            <table class="w-full text-lg">
                                <tbody>
                                    <tr class="border-t border-b border-gray-200">
                                        <th class="py-3 text-left font-medium">Tạm tính</th>
                                        <td class="py-3 text-right font-semibold">
                                            <span
                                                id="subtotal-amount">{{ number_format($cart?->items->sum(fn($i) => ($i->productVariant?->price ?? $i->product?->price ?? 0) * $i->quantity) ?? 0, 0, ',', '.') }}
                                                VNĐ</span>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-gray-200">
                                        <th class="py-3 text-left font-bold text-xl">Tổng tiền</th>
                                        <td class="py-3 text-right font-bold text-xl text-purple-700">
                                            <span
                                                id="total-amount">{{ number_format($cart?->items->sum(fn($i) => ($i->productVariant?->price ?? $i->product?->price ?? 0) * $i->quantity) ?? 0, 0, ',', '.') }}
                                                VNĐ</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @if (!empty($cart) && count($cart->items) > 0)
                            <form id="checkout-form" action="{{ route('checkout.index') }}" method="GET">
                                <input type="hidden" name="selected_items" id="selected-items">
                                <button type="submit"
                                    class="w-full py-4 px-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold rounded-xl shadow-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-200 flex items-center justify-center gap-2 text-lg"
                                    id="checkout-button">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01">
                                        </path>
                                    </svg>
                                    Đặt hàng
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const checkboxes = document.querySelectorAll('.item-checkbox');
        const selectAll = document.getElementById('select-all');
        const checkoutBtn = document.getElementById('checkout-button');
        const subtotalEl = document.getElementById('subtotal-amount');
        const totalEl = document.getElementById('total-amount');

        function updateTotal() {
            let total = 0;
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    total += parseFloat(cb.dataset.subtotal);
                }
            });

            subtotalEl.textContent = new Intl.NumberFormat('vi-VN').format(total) + ' VNĐ';
            totalEl.textContent = new Intl.NumberFormat('vi-VN').format(total) + ' VNĐ';

            checkoutBtn.classList.toggle('disabled', total === 0);
            checkoutBtn.style.pointerEvents = total === 0 ? 'none' : 'auto';
        }

        checkboxes.forEach(cb => cb.addEventListener('change', updateTotal));
        if (selectAll) {
            selectAll.addEventListener('change', function () {
                checkboxes.forEach(cb => cb.checked = this.checked);
                updateTotal();
            });
        }

        updateTotal();
    </script>

    <script>
        document.getElementById('checkout-form')?.addEventListener('submit', function (e) {
            const selected = [];
            document.querySelectorAll('.item-checkbox:checked').forEach(cb => {
                selected.push(cb.value);
            });

            if (selected.length === 0) {
                e.preventDefault();
                alert('Vui lòng chọn ít nhất một sản phẩm để đặt hàng.');
                return;
            }

            document.getElementById('selected-items').value = selected.join(',');
        });
    </script>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-fade-in {
            animation: fade-in 0.7s ease;
        }

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.7s cubic-bezier(.39, .575, .565, 1) both;
        }
    </style>
@endsection
