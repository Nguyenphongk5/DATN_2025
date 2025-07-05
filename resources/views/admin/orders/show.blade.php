<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Phiếu giao hàng #{{ $order->order_code }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8 print:max-w-full">

        {{-- Nút in --}}
        <div class="flex justify-end mb-4 print:hidden">
            <button onclick="window.print()"
                class="bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded shadow">
                🖨️ In phiếu
            </button>
        </div>

        {{-- Nội dung cần in --}}
        <div id="print-section">
            <div class="bg-white border border-gray-800 p-6 shadow print:shadow-none print:border-none print:p-4">

                {{-- Tiêu đề & mã QR --}}
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h1 class="text-2xl font-bold uppercase">Phiếu giao hàng</h1>
                        <p class="text-sm">Mã đơn: <strong>{{ $order->order_code }}</strong></p>
                        <p class="text-sm">Ngày đặt: {{ $order->created_at->format('d/m/Y') }}</p>
                    </div>

                    <div class="mt-1 text-xs leading-tight">
                        @php
                            $qrContent = "Mã đơn: {$order->order_code}\n"
                                       . "Tên KH: {$order->user_name}\n"
                                       . "SĐT: {$order->user_phone}\n"
                                       . "Địa chỉ: {$order->user_address}\n"
                                       . "Tổng tiền: " . number_format($order->total_amount, 0, ',', '.') . "₫\n"
                                       . "Trạng thái: " . ucfirst($order->status);
                        @endphp
                        {!! QrCode::encoding('UTF-8')->size(90)->generate($qrContent) !!}
                    </div>
                </div>

                {{-- Thông tin người nhận --}}
                <div class="mb-4">
                    <h3 class="text-base font-semibold uppercase mb-2">Người nhận</h3>
                    <p><strong>Họ tên:</strong> {{ $order->user_name }}</p>
                    <p><strong>SĐT:</strong> {{ $order->user_phone }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $order->user_address }}</p>
                    @if ($order->note)
                        <p><strong>Ghi chú:</strong> {{ $order->note }}</p>
                    @endif
                </div>

                {{-- Sản phẩm --}}
                <div class="mb-4">
                    <h3 class="text-base font-semibold uppercase mb-2">Sản phẩm</h3>
                    <table class="w-full border border-black text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border border-black px-2 py-1 text-left">Tên SP</th>
                                <th class="border border-black px-2 py-1 text-center">Size</th>
                                <th class="border border-black px-2 py-1 text-center">Màu</th>
                                <th class="border border-black px-2 py-1 text-center">SL</th>
                                <th class="border border-black px-2 py-1 text-right">Giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderDetails as $item)
                                <tr>
                                    <td class="border border-black px-2 py-1">{{ $item->product_name }}</td>
                                    <td class="border border-black px-2 py-1 text-center">{{ $item->size_name }}</td>
                                    <td class="border border-black px-2 py-1 text-center">{{ $item->color_name }}</td>
                                    <td class="border border-black px-2 py-1 text-center">{{ $item->quantity }}</td>
                                    <td class="border border-black px-2 py-1 text-right">
                                        {{ number_format($item->price, 0, ',', '.') }}₫
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Tổng kết --}}
                <div class="text-sm">
                    <p><strong>Phí vận chuyển:</strong> {{ number_format($order->shipping_fee, 0, ',', '.') }}₫</p>
                    <p><strong>Giảm giá:</strong> {{ number_format($order->discount_amount, 0, ',', '.') }}₫</p>
                    <p><strong>Tổng cộng:</strong>
                        <span class="text-lg text-red-600 font-bold">
                            {{ number_format($order->total_amount, 0, ',', '.') }}₫
                        </span>
                    </p>
                </div>

                {{-- Footer --}}
                <div class="mt-6 text-xs text-center border-t pt-2">
                    Cảm ơn quý khách! Hotline: 090x.xxx.xxx
                </div>
            </div>
        </div>
    </div>

    {{-- CSS in --}}
    <style>
        @media print {
            body {
                margin: 0;
                background: white;
                -webkit-print-color-adjust: exact;
            }

            /* Ẩn mọi thứ khi in, trừ phần in */
            body * {
                visibility: hidden;
            }

            #print-section,
            #print-section * {
                visibility: visible;
            }

            #print-section {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            nav, header, footer, .print\:hidden {
                display: none !important;
            }

            .print\:shadow-none {
                box-shadow: none !important;
            }

            .print\:p-4 {
                padding: 1rem !important;
            }
        }
    </style>
</x-app-layout>
