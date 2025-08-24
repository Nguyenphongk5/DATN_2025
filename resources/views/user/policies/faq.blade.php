@extends('layouts.user')

@section('content')
<!-- Header Section -->
<section class="py-12 bg-gradient-to-r from-purple-50 via-pink-50 to-blue-50 mb-8">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 bg-clip-text text-transparent mb-4">
                Câu Hỏi Thường Gặp
            </h1>
            <p class="text-gray-600 text-lg">Tìm câu trả lời cho những thắc mắc phổ biến nhất</p>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <div class="space-y-6">
            <!-- FAQ Item 1 -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ(1)">
                    <h3 class="text-xl font-semibold text-gray-900">Làm thế nào để đặt hàng?</h3>
                    <svg id="icon-1" class="w-6 h-6 text-purple-600 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="content-1" class="hidden mt-4">
                    <p class="text-gray-700 leading-relaxed">
                        Để đặt hàng, bạn cần: <br>
                        1. Đăng ký tài khoản hoặc đăng nhập <br>
                        2. Chọn sản phẩm và thêm vào giỏ hàng <br>
                        3. Kiểm tra giỏ hàng và nhấn "Thanh toán" <br>
                        4. Điền thông tin giao hàng và chọn phương thức thanh toán <br>
                        5. Xác nhận đơn hàng
                    </p>
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ(2)">
                    <h3 class="text-xl font-semibold text-gray-900">Thời gian giao hàng là bao lâu?</h3>
                    <svg id="icon-2" class="w-6 h-6 text-purple-600 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="content-2" class="hidden mt-4">
                    <p class="text-gray-700 leading-relaxed">
                        Thời gian giao hàng phụ thuộc vào địa điểm giao hàng: <br>
                        • Nội thành TP.HCM: 1-2 ngày làm việc <br>
                        • Ngoại thành TP.HCM: 2-3 ngày làm việc <br>
                        • Các tỉnh miền Nam: 3-5 ngày làm việc <br>
                        • Các tỉnh miền Trung: 5-7 ngày làm việc <br>
                        • Các tỉnh miền Bắc: 7-10 ngày làm việc
                    </p>
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ(3)">
                    <h3 class="text-xl font-semibold text-gray-900">Phí vận chuyển được tính như thế nào?</h3>
                    <svg id="icon-3" class="w-6 h-6 text-purple-600 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="content-3" class="hidden mt-4">
                    <p class="text-gray-700 leading-relaxed">
                        Phí vận chuyển được tính dựa trên: <br>
                        • Khoảng cách địa lý <br>
                        • Trọng lượng và kích thước sản phẩm <br>
                        • Phương thức vận chuyển <br>
                        • Miễn phí vận chuyển cho đơn hàng từ 500.000đ trở lên
                    </p>
                </div>
            </div>

            <!-- FAQ Item 4 -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ(4)">
                    <h3 class="text-xl font-semibold text-gray-900">Làm thế nào để đổi trả sản phẩm?</h3>
                    <svg id="icon-4" class="w-6 h-6 text-purple-600 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="content-4" class="hidden mt-4">
                    <p class="text-gray-700 leading-relaxed">
                        Bạn có thể đổi trả sản phẩm trong vòng 30 ngày kể từ ngày nhận hàng với điều kiện: <br>
                        • Sản phẩm còn nguyên vẹn, chưa sử dụng <br>
                        • Còn đầy đủ phụ kiện, bao bì gốc <br>
                        • Có hóa đơn mua hàng <br>
                        • Liên hệ hotline hoặc email để được hỗ trợ
                    </p>
                </div>
            </div>

            <!-- FAQ Item 5 -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ(5)">
                    <h3 class="text-xl font-semibold text-gray-900">Có những phương thức thanh toán nào?</h3>
                    <svg id="icon-5" class="w-6 h-6 text-purple-600 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="content-5" class="hidden mt-4">
                    <p class="text-gray-700 leading-relaxed">
                        Chúng tôi hỗ trợ các phương thức thanh toán: <br>
                        • Thanh toán khi nhận hàng (COD) <br>
                        • Chuyển khoản ngân hàng <br>
                        • Thanh toán qua ví điện tử (Momo, ZaloPay) <br>
                        • Thanh toán qua thẻ tín dụng/ghi nợ <br>
                        • Thanh toán qua cổng thanh toán trực tuyến
                    </p>
                </div>
            </div>

            <!-- FAQ Item 6 -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ(6)">
                    <h3 class="text-xl font-semibold text-gray-900">Làm thế nào để theo dõi đơn hàng?</h3>
                    <svg id="icon-6" class="w-6 h-6 text-purple-600 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="content-6" class="hidden mt-4">
                    <p class="text-gray-700 leading-relaxed">
                        Bạn có thể theo dõi đơn hàng bằng cách: <br>
                        • Đăng nhập vào tài khoản và xem "Lịch sử đơn hàng" <br>
                        • Sử dụng mã đơn hàng để tra cứu trạng thái <br>
                        • Nhận thông báo qua email và SMS <br>
                        • Liên hệ hotline để được hỗ trợ
                    </p>
                </div>
            </div>

            <!-- FAQ Item 7 -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ(7)">
                    <h3 class="text-xl font-semibold text-gray-900">Sản phẩm có bảo hành không?</h3>
                    <svg id="icon-7" class="w-6 h-6 text-purple-600 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="content-7" class="hidden mt-4">
                    <p class="text-gray-700 leading-relaxed">
                        Tất cả sản phẩm đều có chính sách bảo hành: <br>
                        • Bảo hành chính hãng theo tiêu chuẩn của nhà sản xuất <br>
                        • Thời gian bảo hành từ 12-24 tháng tùy sản phẩm <br>
                        • Bảo hành miễn phí trong thời gian bảo hành <br>
                        • Hỗ trợ sửa chữa hoặc thay thế sản phẩm
                    </p>
                </div>
            </div>

            <!-- FAQ Item 8 -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ(8)">
                    <h3 class="text-xl font-semibold text-gray-900">Làm thế nào để liên hệ hỗ trợ?</h3>
                    <svg id="icon-8" class="w-6 h-6 text-purple-600 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="content-8" class="hidden mt-4">
                    <p class="text-gray-700 leading-relaxed">
                        Bạn có thể liên hệ hỗ trợ qua: <br>
                        • Hotline: 1900-xxxx (8:00 - 18:00) <br>
                        • Email: support@datnstore.com <br>
                        • Chat trực tuyến trên website <br>
                        • Fanpage Facebook và Zalo <br>
                        • Địa chỉ cửa hàng: 123 Đường ABC, Quận 1, TP.HCM
                    </p>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="mt-12 bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-8 text-center">
            <h3 class="text-2xl font-bold text-gray-900 mb-4">Không tìm thấy câu trả lời?</h3>
            <p class="text-gray-600 mb-6">Hãy liên hệ với chúng tôi để được hỗ trợ trực tiếp</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="tel:1900-xxxx" class="bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-purple-700 transition-colors">
                    Gọi ngay: 1900-xxxx
                </a>
                <a href="mailto:support@datnstore.com" class="bg-pink-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-pink-700 transition-colors">
                    Gửi email
                </a>
            </div>
        </div>
    </div>
</section>

<script>
function toggleFAQ(id) {
    const content = document.getElementById(`content-${id}`);
    const icon = document.getElementById(`icon-${id}`);
    
    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
    } else {
        content.classList.add('hidden');
        icon.style.transform = 'rotate(0deg)';
    }
}
</script>
@endsection
