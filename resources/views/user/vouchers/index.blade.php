@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                <i class="fas fa-ticket-alt text-purple-600 mr-3"></i>
                Mã Giảm Giá
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Khám phá các mã giảm giá hấp dẫn và tiết kiệm chi phí mua sắm của bạn
            </p>
        </div>

        <!-- Vouchers Grid -->
        @if($vouchers->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($vouchers as $voucher)
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                        <!-- Voucher Header -->
                        <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white p-6 relative">
                            <div class="absolute top-0 right-0 w-8 h-8 bg-white rounded-full -mr-4 -mt-4 opacity-20"></div>
                            <div class="absolute bottom-0 right-0 w-8 h-8 bg-white rounded-full -mr-4 -mb-4 opacity-20"></div>
                            
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <i class="fas fa-percentage text-2xl mr-3"></i>
                                    <span class="text-sm font-medium opacity-90">Mã Giảm Giá</span>
                                </div>
                                <div class="text-right">
                                    <div class="text-xs opacity-75">Còn lại</div>
                                    <div class="font-bold">{{ $voucher->quantity - $voucher->used_count }}</div>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <div class="text-3xl font-bold mb-2">
                                    @if($voucher->discount_type === 'percent')
                                        {{ $voucher->discount_value }}%
                                    @else
                                        {{ number_format($voucher->discount_value, 0, ',', '.') }}₫
                                    @endif
                                </div>
                                <div class="text-sm opacity-90">
                                    @if($voucher->discount_type === 'percent')
                                        Giảm giá theo phần trăm
                                    @else
                                        Giảm giá cố định
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Voucher Body -->
                        <div class="p-6">
                            <div class="mb-4">
                                <div class="bg-gray-50 rounded-lg p-3 text-center">
                                    <span class="text-lg font-mono font-bold text-purple-600 tracking-wider">
                                        {{ $voucher->code }}
                                    </span>
                                </div>
                            </div>

                            <!-- Conditions -->
                            <div class="space-y-3 mb-6">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-shopping-cart text-purple-500 mr-2 w-4"></i>
                                    <span>Tối thiểu: {{ number_format($voucher->min_money, 0, ',', '.') }}₫</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-credit-card text-purple-500 mr-2 w-4"></i>
                                    <span>Tối đa: {{ number_format($voucher->max_money, 0, ',', '.') }}₫</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-calendar-alt text-purple-500 mr-2 w-4"></i>
                                    <span>Hết hạn: {{ \Carbon\Carbon::parse($voucher->end_date)->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-user text-purple-500 mr-2 w-4"></i>
                                    <span>Giới hạn: {{ $voucher->user_limit }} lần/người</span>
                                </div>
                            </div>

                            <!-- Copy Button -->
                            <button onclick="copyVoucherCode('{{ $voucher->code }}')" 
                                class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold py-3 px-4 rounded-xl hover:from-purple-700 hover:to-pink-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                                <i class="fas fa-copy mr-2"></i>
                                Sao chép mã
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- How to use section -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                    <i class="fas fa-question-circle text-purple-600 mr-2"></i>
                    Cách Sử Dụng
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-copy text-2xl text-purple-600"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">1. Sao chép mã</h3>
                        <p class="text-gray-600 text-sm">Nhấn vào nút "Sao chép mã" để copy mã giảm giá</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-shopping-cart text-2xl text-pink-600"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">2. Thêm vào giỏ hàng</h3>
                        <p class="text-gray-600 text-sm">Chọn sản phẩm và thêm vào giỏ hàng của bạn</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-check text-2xl text-indigo-600"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">3. Áp dụng khi thanh toán</h3>
                        <p class="text-gray-600 text-sm">Dán mã vào ô "Mã giảm giá" khi thanh toán</p>
                    </div>
                </div>
            </div>
        @else
            <!-- No vouchers available -->
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-ticket-alt text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Không có mã giảm giá</h3>
                <p class="text-gray-600 mb-6">Hiện tại không có mã giảm giá nào khả dụng. Hãy quay lại sau!</p>
                <a href="{{ route('home.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-xl hover:from-purple-700 hover:to-pink-700 transition-all duration-200">
                    <i class="fas fa-home mr-2"></i>
                    Về trang chủ
                </a>
            </div>
        @endif
    </div>
</div>

<script>
function copyVoucherCode(code) {
    navigator.clipboard.writeText(code).then(function() {
        // Show success message
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300';
        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-check mr-2"></i>
                <span>Đã sao chép mã: ${code}</span>
            </div>
        `;
        document.body.appendChild(notification);
        
        // Remove notification after 3 seconds
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }).catch(function(err) {
        console.error('Could not copy text: ', err);
    });
}
</script>
@endsection 