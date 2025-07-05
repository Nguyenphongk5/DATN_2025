@extends('layouts.user')

@section('content')
    <section class="py-12 bg-gradient-to-br from-gray-50 via-white to-blue-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-center text-3xl md:text-4xl font-extrabold mb-12 tracking-tight">
                Kết quả tìm kiếm cho: <span class="bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">{{ $keywords }}</span>
            </h2>
            @if ($keywords == '')
                <div class="flex flex-col items-center justify-center py-24 animate-fade-in">
                    <div class="w-24 h-24 flex items-center justify-center bg-gradient-to-r from-purple-500 to-pink-500 rounded-full mb-6 shadow-lg">
                        <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-700 mb-2">Hãy nhập từ khóa để tìm kiếm sản phẩm!</div>
                    <div class="text-gray-500">Bạn có thể tìm theo tên, loại, màu sắc, ...</div>
                </div>
            @elseif (count($products) == 0)
                <div class="flex flex-col items-center justify-center py-24 animate-fade-in">
                    <div class="w-24 h-24 flex items-center justify-center bg-gradient-to-r from-yellow-400 to-red-400 rounded-full mb-6 shadow-lg">
                        <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 005.656 0M15 9a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-700 mb-2">Không tìm thấy sản phẩm nào phù hợp!</div>
                    <div class="text-gray-500">Hãy thử lại với từ khóa khác hoặc kiểm tra chính tả.</div>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 mb-16">
                    @foreach ($products as $product)
                        <div class="group relative animate-fade-in-up">
                            <div class="bg-white rounded-3xl shadow-2xl border-2 border-transparent group-hover:border-purple-400 transition-all duration-300 overflow-hidden">
                                <div class="relative overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                                    <img src="{{ asset('storage/' . $product->img_thumb) }}" alt="{{ $product->name }}"
                                         class="w-full h-60 object-cover rounded-t-3xl group-hover:scale-105 transition-transform duration-500">
                                    <span class="absolute top-4 left-4 flex items-center gap-1 bg-gradient-to-r from-pink-500 to-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                                        </svg>
                                        -30%
                                    </span>
                                </div>
                                <div class="p-6 flex flex-col">
                                    <h3 class="text-lg font-extrabold text-gray-900 mb-2 line-clamp-2 group-hover:text-purple-600 transition-colors duration-200">
                                        <a href="{{ route('home.show', $product->id) }}" class="hover:underline">{{ $product->name }}</a>
                                    </h3>
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="text-2xl font-bold text-pink-600">{{ number_format($product->price, 0, '', '.') }} VNĐ</span>
                                        <del class="text-base text-gray-400">{{ number_format($product->price_sale, 0, '', '.') }} VNĐ</del>
                                    </div>
                                    <div class="flex items-center gap-1 mb-4">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg width="18" height="18" class="{{ $i <= 4 ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                        <span class="ml-2 text-sm text-gray-500">(4.5)</span>
                                    </div>
                                    <a href="{{ route('home.show', $product->id) }}"
                                       class="mt-auto w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold py-3 px-4 rounded-xl hover:from-purple-700 hover:to-pink-700 transition-all duration-200 flex items-center justify-center gap-2 shadow-lg">
                                        <span>Xem chi tiết</span>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="flex justify-center mb-20">
                {{ $products->links() }}
            </div>
        </div>
    </section>
@endsection

<style>
@keyframes fade-in {
    from { opacity: 0; }
    to { opacity: 1; }
}
.animate-fade-in { animation: fade-in 0.7s ease; }

@keyframes fade-in-up {
    from { opacity: 0; transform: translateY(30px);}
    to { opacity: 1; transform: translateY(0);}
}
.animate-fade-in-up { animation: fade-in-up 0.7s cubic-bezier(.39,.575,.565,1) both; }
</style>
