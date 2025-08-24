<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 py-16">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            
            <!-- Company Info -->
            <div class="lg:col-span-1">
                <div class="flex items-center mb-6">
                    @if($logo)
                        <img src="{{ asset('storage/' . $logo->image) }}" alt="Logo" class="h-12 w-auto mr-3">
                    @endif
                    <h3 class="text-2xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">
                        
                    </h3>
                </div>
                <p class="text-gray-300 mb-6 leading-relaxed">
                    
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.919-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold mb-6 text-purple-400">Liên Kết Nhanh</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('home.index') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Trang Chủ</a></li>
                    <li><a href="{{ route('home.products') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Sản Phẩm</a></li>
                    <li><a href="{{ route('home.search') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Tìm Kiếm</a></li>
                    <li><a href="{{ route('cart.index') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Giỏ Hàng</a></li>
                    <li><a href="{{ route('favorites.index') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Yêu Thích</a></li>
                    <li><a href="{{ route('orders.history') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Lịch Sử Đơn Hàng</a></li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div>
                <h4 class="text-lg font-semibold mb-6 text-purple-400">Hỗ Trợ Khách Hàng</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('policy.returns') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Chính Sách Đổi Trả</a></li>
                    <li><a href="{{ route('policy.warranty') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Chính Sách Bảo Hành</a></li>
                    <li><a href="{{ route('policy.shipping') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Chính Sách Vận Chuyển</a></li>
                    <li><a href="{{ route('policy.shopping-guide') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Hướng Dẫn Mua Hàng</a></li>
                    <li><a href="{{ route('policy.secure-payment') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Thanh Toán An Toàn</a></li>
                    <li><a href="{{ route('policy.faq') }}" class="text-gray-300 hover:text-white transition-colors duration-200">FAQ</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-lg font-semibold mb-6 text-purple-400">Thông Tin Liên Hệ</h4>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-purple-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <div>
                            <p class="text-gray-300">123 Đường ABC, Quận 1</p>
                            <p class="text-gray-300">TP. Hồ Chí Minh, Việt Nam</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-purple-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <div>
                            <p class="text-gray-300">Hotline: 1900-xxxx</p>
                            <p class="text-gray-300">Điện thoại: (028) 3xxx-xxxx</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-purple-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <div>
                            <p class="text-gray-300">Email: info@datnstore.com</p>
                            <p class="text-gray-300">Hỗ trợ: support@datnstore.com</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-purple-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-gray-300">Thứ 2 - Thứ 6: 8:00 - 18:00</p>
                            <p class="text-gray-300">Thứ 7: 8:00 - 12:00</p>
                            <p class="text-gray-300">Chủ Nhật: Nghỉ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Newsletter Subscription -->
        <div class="border-t border-gray-800 pt-8 mb-8">
            <div class="max-w-md mx-auto text-center">
                <h4 class="text-lg font-semibold mb-4 text-purple-400">Đăng Ký Nhận Tin Tức</h4>
                <p class="text-gray-300 mb-6">Nhận thông tin về sản phẩm mới và khuyến mãi đặc biệt</p>
                <form class="flex space-x-2">
                    <input type="email" placeholder="Nhập email của bạn" 
                           class="flex-1 px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-purple-500">
                    <button type="submit" 
                            class="px-6 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold rounded-lg hover:from-purple-600 hover:to-pink-600 transition-all duration-200">
                        Đăng Ký
                    </button>
                </form>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="border-t border-gray-800 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="text-gray-400 text-sm">
                    <p>&copy; {{ date('Y') }}. Tất cả quyền được bảo lưu.</p>
                </div>
                
                <div class="flex space-x-6 text-sm">
                    <a href="{{ route('policy.privacy') }}" class="text-gray-400 hover:text-white transition-colors duration-200">Chính Sách Bảo Mật</a>
                    <a href="{{ route('policy.terms') }}" class="text-gray-400 hover:text-white transition-colors duration-200">Điều Khoản Sử Dụng</a>
                    <a href="{{ route('policy.cookies') }}" class="text-gray-400 hover:text-white transition-colors duration-200">Chính Sách Cookie</a>
                    <a href="{{ route('policy.faq') }}" class="text-gray-400 hover:text-white transition-colors duration-200">FAQ</a>
                </div>
            </div>
        </div>
    </div>
</footer>
