<x-app-layout>
    <x-slot name="header">
        <div
            class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-receipt text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Chi tiết đơn hàng</h2>
        </div>
    </x-slot>

    {{-- QR Code chứa toàn bộ thông tin --}}
    <div class="flex justify-center mb-8">
        <div class="bg-white rounded-3xl p-8 shadow-2xl border-4 border-indigo-200 max-w-lg w-full">
            <div
                class="text-center mb-4 font-extrabold text-2xl bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 bg-clip-text text-transparent drop-shadow-lg tracking-wide">
                Quét mã để xem nhanh thông tin đơn hàng</div>
            <div class="flex flex-col items-center gap-2">
                <div class="p-4 bg-gradient-to-br from-indigo-50 via-sky-50 to-cyan-50 rounded-2xl shadow-lg">
                    @php
                        $qrText = "Mã đơn: {$order->order_code}\n";
                        $qrText .= "Tên KH: {$order->user_name}\n";
                        $qrText .= "SĐT: {$order->user_phone}\n";
                        $qrText .= "Email: {$order->user_email}\n";
                        $qrText .= "Địa chỉ: {$order->user_address}\n";
                        $qrText .= "Trạng thái: {$order->status}\n";
                        $qrText .= "Thanh toán: {$order->payment_status}\n";
                        $qrText .= 'Tổng tiền: ' . number_format($order->total_amount, 0, ',', '.') . " VNĐ\n";
                        $qrText .= "Sản phẩm:\n";
                        foreach ($order->orderDetails as $item) {
                            $qrText .=
                                "- {$item->product_name} ({$item->quantity} x " .
                                number_format($item->price, 0, ',', '.') .
                                ")\n";
                        }
                    @endphp
                    {!! QrCode::encoding('UTF-8')->size(200)->generate($qrText) !!}
                </div>
                <div class="mt-2 text-base text-gray-700 text-center">Mã đơn: <span
                        class="font-mono font-bold text-indigo-600">{{ $order->order_code }}</span></div>
            </div>
            <div class="mt-6 flex justify-center">
                <a href="{{ route('orders.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 text-white font-bold text-lg shadow-xl hover:from-indigo-600 hover:to-cyan-500 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Quay lại danh sách
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
