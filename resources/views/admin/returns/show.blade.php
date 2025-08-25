<x-app-layout>
    <x-slot name="header">
        <div
            class="flex items-center gap-3 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-undo-alt text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Chi tiết hoàn hàng</h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto bg-white/90 rounded-3xl p-8 shadow-2xl">
            <div class="grid md:grid-cols-2 gap-8 text-base">
                <div>
                    <p><strong class="text-gray-700">Mã đơn hàng:</strong> {{ $return->order->order_code }}</p>
                    <p><strong class="text-gray-700">Khách hàng:</strong> {{ $return->order->user_name }}</p>
                    <p><strong class="text-gray-700">SĐT:</strong> {{ $return->order->user_phone }}</p>
                    <p><strong class="text-gray-700">Địa chỉ:</strong> {{ $return->order->	user_address }}</p>
                    <p><strong class="text-gray-700">Ngày yêu cầu:</strong>
                        {{ $return->created_at->format('d/m/Y H:i') }}</p>
                </div>

                <div>
                    <p><strong class="text-gray-700">Lý do hoàn hàng:</strong> {{ $return->reason }}</p>
                    <p><strong class="text-gray-700">Trạng thái:</strong>
                        @php
                        $colors = [
                        'pending' => 'text-yellow-500 font-semibold',
                        'approved' => 'text-green-600 font-semibold',
                        'rejected' => 'text-red-600 font-semibold',
                        ];
                        @endphp
                        <span class="{{ $colors[$return->status] ?? 'text-gray-500' }}">
                            {{ ucfirst($return->status) }}
                        </span>
                    </p>

                    @if ($return->note)
                    <p><strong class="text-gray-700">Ghi chú của khách:</strong> {{ $return->note }}</p>
                    @endif

                    @if ($return->status !== 'pending' && $return->response_note)
                    <p class="mt-4"><strong class="text-gray-700">Phản hồi từ shop:</strong>
                        {{ $return->response_note }}</p>
                    @endif

                    @if ($return->image)
                    <div class="mt-4">
                        <strong class="text-gray-700">Ảnh minh họa:</strong>
                        <img src="{{ asset('storage/' . $return->image) }}" alt="Ảnh minh họa"
                            class="mt-2 w-40 h-40 object-cover rounded-lg border shadow-md">
                    </div>
                    @endif
                </div>
            </div>

            {{-- Danh sách sản phẩm --}}
            @if ($return->order->orderDetails->count())
            <div class="mt-10">
                <h3 class="text-xl font-bold text-gray-700 mb-4">Sản phẩm trong đơn hàng</h3>
                <div class="overflow-x-auto rounded-xl border border-gray-200">
                    <table class="min-w-full text-base text-gray-800">
                        <thead class="bg-red-100 text-red-700">
                            <tr>
                                <th class="px-4 py-3 text-left">Sản phẩm</th>
                                <th class="px-4 py-3 text-left">Phân loại</th>
                                <th class="px-4 py-3 text-left">Số lượng</th>
                                <th class="px-4 py-3 text-left">Giá</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                            @foreach ($return->order->orderDetails as $detail)
                            <tr>
                                <td class="px-4 py-3 flex items-center gap-3">
                                    @if ($detail->productVariant->product->image)
                                    <img src="{{ asset('storage/products/' . $detail->productVariant->product->image) }}"
                                        alt="Ảnh sản phẩm" class="w-12 h-12 object-cover rounded shadow">
                                    @endif
                                    <span>{{ $detail->productVariant->product->name }}</span>
                                </td>
                                <td class="px-4 py-3">{{ $detail->productVariant->color_name }} /
                                    {{ $detail->productVariant->size }}</td>
                                <td class="px-4 py-3">{{ $detail->quantity }}</td>
                                <td class="px-4 py-3">{{ number_format($detail->price) }}đ</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            {{-- Form xử lý hoàn hàng --}}
            @if ($return->status === 'pending')
            <form method="POST" action="{{ route('admin.returns.update', $return->id) }}" class="mt-10 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="shop_response" class="block text-gray-700 font-semibold mb-2">Phản hồi từ shop:</label>
                    <textarea name="shop_response" id="shop_response" rows="4"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-300 focus:outline-none shadow-sm"
                        placeholder="Nhập phản hồi của bạn...">{{ old('shop_response') }}</textarea>
                </div>

                <div class="flex flex-col md:flex-row justify-center gap-4">
                    <button type="submit" name="action" value="approve"
                        class="bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white font-bold py-2 px-6 rounded-xl shadow-lg flex items-center gap-2 transition">
                        <i class="fas fa-check-circle"></i> Duyệt
                    </button>

                    <button type="submit" name="action" value="reject"
                        class="bg-gradient-to-r from-red-400 to-red-600 hover:from-red-500 hover:to-red-700 text-white font-bold py-2 px-6 rounded-xl shadow-lg flex items-center gap-2 transition">
                        <i class="fas fa-times-circle"></i> Từ chối
                    </button>
                </div>
            </form>

            @else
            {{-- Hiển thị phản hồi nếu đã xử lý --}}
            @if ($return->response_note)

            @endif
            @endif

            {{-- Quay lại --}}
            <div class="mt-10 text-center">
                <a href="{{ route('admin.returns.index') }}"
                    class="inline-block bg-red-500 text-white px-6 py-2 rounded-xl hover:bg-red-600 transition duration-200 shadow">
                    <i class="fas fa-arrow-left mr-1"></i> Quay lại danh sách
                </a>
            </div>
        </div>
    </div>
</x-app-layout>