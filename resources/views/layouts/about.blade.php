@extends('layouts.user')

@section('title', 'Giới thiệu - Lightstep')

@section('content')
<div class="min-h-screen bg-white">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-white py-20">
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent">
                    LIGHTSTEP
                </h1>
                <p class="text-xl md:text-2xl text-gray-700 mb-8 max-w-3xl mx-auto">
                    Bước chân nhẹ nhàng, phong cách vượt trội
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                        Khám phá ngay
                    </button>
                    <button class="border-2 border-gray-800 text-gray-800 hover:bg-gray-900 hover:text-white px-8 py-3 rounded-full font-semibold transition-all duration-300">
                        Xem bộ sưu tập
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-4xl font-bold text-gray-900 mb-6">
                    Về chúng tôi
                </h2>
                <p class="text-gray-700 text-lg leading-relaxed mb-6">
                    Lightstep ra đời từ niềm đam mê tạo ra những đôi giày không chỉ đẹp mà còn mang lại sự thoải mái tuyệt đối cho người sử dụng. Chúng tôi kết hợp công nghệ tiên tiến với thiết kế thời trang để tạo nên những sản phẩm độc đáo.
                </p>
                <p class="text-gray-700 text-lg leading-relaxed">
                    Với đội ngũ thiết kế tài năng và quy trình sản xuất nghiêm ngặt, mỗi đôi giày Lightstep đều là một tác phẩm nghệ thuật hoàn hảo.
                </p>
            </div>
            <div class="relative">
                <div class="bg-gray-100 rounded-2xl p-8 border border-gray-200 shadow-sm">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-600 mb-2">50K+</div>
                            <div class="text-gray-700">Khách hàng hài lòng</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-purple-600 mb-2">200+</div>
                            <div class="text-gray-700">Mẫu giày độc quyền</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-green-600 mb-2">15+</div>
                            <div class="text-gray-700">Năm kinh nghiệm</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-yellow-500 mb-2">99%</div>
                            <div class="text-gray-700">Đánh giá tích cực</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                Tại sao chọn Lightstep?
            </h2>
            <p class="text-xl text-gray-600">
                Những giá trị cốt lõi làm nên thương hiệu
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center group">
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Thiết kế độc đáo</h3>
                <p class="text-gray-600">Mỗi mẫu giày đều được thiết kế riêng biệt, thể hiện phong cách cá nhân của bạn</p>
            </div>

            <div class="text-center group">
                <div class="bg-gradient-to-r from-green-600 to-blue-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Thoải mái tuyệt đối</h3>
                <p class="text-gray-600">Công nghệ đệm khí tiên tiến mang lại cảm giác êm ái cho mỗi bước chân</p>
            </div>

            <div class="text-center group">
                <div class="bg-gradient-to-r from-purple-600 to-pink-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Chất lượng cao cấp</h3>
                <p class="text-gray-600">Sử dụng nguyên liệu tốt nhất, đảm bảo độ bền và chất lượng vượt trội</p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="bg-gray-100 rounded-3xl p-12 text-center border border-gray-200 shadow-md">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">
                Sẵn sàng trải nghiệm?
            </h2>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Hãy để Lightstep đồng hành cùng bạn trong mọi bước đi. Khám phá bộ sưu tập mới nhất ngay hôm nay!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-10 py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                    Mua sắm ngay
                </button>
                <button class="border-2 border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white px-10 py-4 rounded-full font-semibold transition-all duration-300">
                    Liên hệ tư vấn
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

