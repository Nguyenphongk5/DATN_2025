@extends('layouts.user')

@section('content')
<!-- Header Section -->
<section class="py-12 bg-gradient-to-r from-purple-50 via-pink-50 to-blue-50 mb-8">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 bg-clip-text text-transparent mb-4">
                Chính Sách Cookie
            </h1>
            <p class="text-gray-600 text-lg">Tìm hiểu cách chúng tôi sử dụng cookie để cải thiện trải nghiệm của bạn</p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <div class="prose prose-lg max-w-none">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">1. Cookie Là Gì?</h2>
                <p class="text-gray-700 mb-4">
                    Cookie là những file nhỏ được lưu trữ trên thiết bị của bạn khi bạn truy cập website. 
                    Chúng giúp website ghi nhớ thông tin về chuyến thăm của bạn, 
                    chẳng hạn như ngôn ngữ ưa thích và các tùy chọn khác.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">2. Các Loại Cookie Chúng Tôi Sử Dụng</h2>
                
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Cookie Cần Thiết</h3>
                <p class="text-gray-700 mb-4">
                    Những cookie này cần thiết để website hoạt động bình thường:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Cookie phiên đăng nhập</li>
                    <li>Cookie giỏ hàng</li>
                    <li>Cookie bảo mật</li>
                    <li>Cookie cài đặt cơ bản</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mb-4">Cookie Hiệu Suất</h3>
                <p class="text-gray-700 mb-4">
                    Những cookie này giúp chúng tôi hiểu cách khách hàng sử dụng website:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Cookie phân tích lưu lượng truy cập</li>
                    <li>Cookie đo lường hiệu suất</li>
                    <li>Cookie ghi nhận lỗi</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mb-4">Cookie Chức Năng</h3>
                <p class="text-gray-700 mb-4">
                    Những cookie này ghi nhớ các lựa chọn của bạn:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Cookie ngôn ngữ</li>
                    <li>Cookie tùy chọn hiển thị</li>
                    <li>Cookie ghi nhớ đăng nhập</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mb-4">Cookie Quảng Cáo</h3>
                <p class="text-gray-700 mb-4">
                    Những cookie này được sử dụng để hiển thị quảng cáo phù hợp:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Cookie theo dõi quảng cáo</li>
                    <li>Cookie mạng xã hội</li>
                    <li>Cookie đối tác thứ ba</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">3. Mục Đích Sử Dụng Cookie</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi sử dụng cookie để:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Ghi nhớ tùy chọn và cài đặt của bạn</li>
                    <li>Phân tích cách sử dụng website</li>
                    <li>Cải thiện hiệu suất và trải nghiệm người dùng</li>
                    <li>Cung cấp nội dung phù hợp</li>
                    <li>Bảo mật và xác thực</li>
                    <li>Ghi nhớ thông tin giỏ hàng</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">4. Cookie Của Bên Thứ Ba</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi có thể sử dụng dịch vụ của bên thứ ba như:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Google Analytics:</strong> Phân tích lưu lượng truy cập</li>
                    <li><strong>Facebook Pixel:</strong> Theo dõi chuyển đổi</li>
                    <li><strong>Hotjar:</strong> Phân tích hành vi người dùng</li>
                    <li><strong>VnPay:</strong> Xử lý thanh toán</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">5. Quản Lý Cookie</h2>
                <p class="text-gray-700 mb-4">
                    Bạn có thể kiểm soát cookie bằng cách:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Thay đổi cài đặt trình duyệt</li>
                    <li>Xóa cookie hiện có</li>
                    <li>Từ chối cookie mới</li>
                    <li>Sử dụng chế độ ẩn danh</li>
                </ul>

                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                    <p class="text-blue-700">
                        <strong>Lưu ý:</strong> Việc vô hiệu hóa một số cookie có thể ảnh hưởng đến chức năng của website.
                    </p>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">6. Cài Đặt Trình Duyệt</h2>
                <p class="text-gray-700 mb-4">
                    Để quản lý cookie trong trình duyệt:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Chrome:</strong> Cài đặt > Bảo mật và quyền riêng tư > Cookie</li>
                    <li><strong>Firefox:</strong> Cài đặt > Quyền riêng tư & Bảo mật > Cookie</li>
                    <li><strong>Safari:</strong> Tùy chọn > Quyền riêng tư > Cookie</li>
                    <li><strong>Edge:</strong> Cài đặt > Cookie và quyền truy cập trang web</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">7. Cập Nhật Chính Sách</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi có thể cập nhật chính sách cookie này theo thời gian. 
                    Những thay đổi sẽ được thông báo trên website và qua email.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">8. Liên Hệ</h2>
                <p class="text-gray-700 mb-4">
                    Nếu bạn có câu hỏi về chính sách cookie, vui lòng liên hệ:
                </p>
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <p class="text-gray-700"><strong>Email:</strong> privacy@datnstore.com</p>
                    <p class="text-gray-700"><strong>Điện thoại:</strong> (028) 3xxx-xxxx</p>
                    <p class="text-gray-700"><strong>Địa chỉ:</strong> 123 Đường ABC, Quận 1, TP.HCM</p>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-200">
                    <p class="text-sm text-gray-500">
                        <strong>Cập nhật lần cuối:</strong> {{ date('d/m/Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
