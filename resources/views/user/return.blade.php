@extends('layouts.user')

@section('content')
<section class="py-8 px-4 max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Yêu cầu hoàn hàng</h2>

    {{-- Hiển thị thông tin đơn hàng --}}
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
            <div class="font-bold text-gray-900 text-xl leading-snug line-clamp-2 group-hover:text-pink-600 group-hover:bg-pink-50 px-2 py-1 rounded"
                title="{{ $item->product_name }}">
                {{ $item->product_name }}
            </div>
            <div class="flex flex-wrap gap-2 mt-2 text-xs">
                <span class="px-2 py-0.5 rounded bg-indigo-100 text-indigo-700 font-medium">
                    Màu: {{ $item->color_name ?? 'Không màu' }}
                </span>
                <span class="px-2 py-0.5 rounded bg-pink-100 text-pink-700 font-medium">
                    Size: {{ $item->size_name ?? 'Không size' }}
                </span>
                <span class="px-2 py-0.5 rounded bg-gray-100 text-gray-700 font-medium">
                    Số lượng: x{{ $item->quantity }}
                </span>
            </div>
        </div>
        <div
            class="text-right font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-indigo-500 text-lg min-w-[110px]">
            ₫{{ number_format($item->price * $item->quantity, 0, ',', '.') }}
        </div>
    </div>
    @endforeach

    {{-- Form hoàn hàng --}}
    <form action="{{ route('returns.store', ['order' => $order->id]) }}" method="POST" enctype="multipart/form-data"
        class="mt-8 bg-white p-6 rounded-lg shadow-md space-y-5 border">
        @csrf
        <input type="hidden" name="order_id" value="{{ $order->id }}">

        <div>
            <label for="reason" class="block font-semibold text-gray-700 mb-1">
                Lý do hoàn hàng <span class="text-red-500">*</span>
            </label>
            <select name="reason" id="reason" required
                class="w-full border rounded-lg px-4 py-2 focus:ring-pink-500 focus:border-pink-500">
                <option value="">-- Chọn lý do --</option>
                <option value="Sản phẩm bị lỗi">Sản phẩm bị lỗi</option>
                <option value="Giao sai sản phẩm">Giao sai sản phẩm</option>
                <option value="Không đúng mô tả">Không đúng mô tả</option>
                <option value="Không còn nhu cầu">Không còn nhu cầu</option>
                <option value="Khác">Lý do khác</option>
            </select>
        </div>


        <div>
            <label for="description" class="block font-semibold text-gray-700 mb-1">Mô tả chi tiết</label>
            <textarea name="note" id="note" rows="4"
                class="w-full border rounded-lg px-4 py-2 focus:ring-pink-500 focus:border-pink-500"></textarea>
        </div>

        <div>
            <label for="image" class="block font-semibold text-gray-700 mb-1">Ảnh minh họa (nếu có)</label>
            <input type="file" name="image" id="image" accept="image/*"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">
        </div>

        <div>
            <button type="submit"
                class="bg-pink-600 text-white px-6 py-2 rounded-lg hover:bg-pink-700 transition duration-200">
                Gửi yêu cầu hoàn hàng
            </button>
        </div>
    </form>
</section>
@endsection