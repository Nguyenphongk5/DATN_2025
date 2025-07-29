@extends('layouts.user')

@section('title', 'Liên hệ - Lightstep')

@section('content')
<div class="min-h-screen bg-white">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-white py-20">
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent">
                    LIÊN HỆ LIGHTSTEP
                </h1>
                <p class="text-xl md:text-2xl text-gray-700 mb-8 max-w-3xl mx-auto">
                    Chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn trên mọi hành trình
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#contact-form" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                        Gửi tin nhắn
                    </a>
                    <a href="tel:+84234567890" class="border-2 border-gray-800 text-gray-800 hover:bg-gray-900 hover:text-white px-8 py-3 rounded-full font-semibold transition-all duration-300">
                        Gọi ngay
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Info Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center group">
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Email</h3>
                <p class="text-gray-600">support@lightstep.com</p>
                <p class="text-gray-600">Hỗ trợ 24/7</p>
            </div>

            <div class="text-center group">
                <div class="bg-gradient-to-r from-green-600 to-blue-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Điện thoại</h3>
                <p class="text-gray-600">+84 234 567 890</p>
                <p class="text-gray-600">8:00 - 22:00</p>
            </div>

            <div class="text-center group">
                <div class="bg-gradient-to-r from-purple-600 to-pink-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Địa chỉ</h3>
                <p class="text-gray-600">123 Đường Thời Trang</p>
                <p class="text-gray-600">TP. Hồ Chí Minh, Việt Nam</p>
            </div>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20" id="contact-form">
        <div class="bg-gray-100 rounded-3xl p-12 border border-gray-200 shadow-md">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    Gửi tin nhắn cho chúng tôi
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Hãy cho chúng tôi biết câu hỏi hoặc yêu cầu của bạn, đội ngũ Lightstep sẽ phản hồi sớm nhất!
                </p>
            </div>
            <div class="max-w-3xl mx-auto">
                <div>
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-gray-700 font-semibold mb-2">Họ và tên</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-600 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-300" placeholder="Nhập họ và tên">
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-600 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-300" placeholder="Nhập email của bạn">
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="subject" class="block text-gray-700 font-semibold mb-2">Chủ đề</label>
                        <input type="text" id="subject" name="subject" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-600 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-300" placeholder="Nhập chủ đề">
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block text-gray-700 font-semibold mb-2">Tin nhắn</label>
                        <textarea id="message" name="message" rows="6" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-600 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-300" placeholder="Nhập tin nhắn của bạn"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-10 py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                            Gửi tin nhắn
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                Ghé thăm showroom của chúng tôi
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Trải nghiệm trực tiếp các sản phẩm Lightstep tại showroom của chúng tôi
            </p>
        </div>
        <div class="bg-gray-100 rounded-3xl overflow-hidden border border-gray-200 shadow-md">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.630627691406!2d106.680147214623!3d10.762622392329!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f1b7c3ed289%3A0xa06651894598e488!2sHo%20Chi%20Minh%20City%2C%20Vietnam!5e0!3m2!1sen!2s!4v1634567890123!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</div>
@endsection