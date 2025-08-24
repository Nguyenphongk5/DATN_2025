@extends('layouts.user')

@section('content')
<!-- Header Section -->
<section class="py-12 bg-gradient-to-r from-purple-50 via-pink-50 to-blue-50 mb-8">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 bg-clip-text text-transparent mb-4">
                Chính Sách Bảo Mật
            </h1>
            <p class="text-gray-600 text-lg">Bảo vệ thông tin cá nhân của bạn là ưu tiên hàng đầu của chúng tôi</p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <div class="prose prose-lg max-w-none">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">1. Thông Tin Chúng Tôi Thu Thập</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi thu thập các loại thông tin sau đây để cung cấp dịch vụ tốt nhất:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Thông tin cá nhân:</strong> Tên, email, số điện thoại, địa chỉ</li>
                    <li><strong>Thông tin đơn hàng:</strong> Lịch sử mua hàng, sản phẩm đã mua</li>
                    <li><strong>Thông tin thanh toán:</strong> Phương thức thanh toán, thông tin thẻ</li>
                    <li><strong>Thông tin kỹ thuật:</strong> IP address, browser, thiết bị</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">2. Mục Đích Sử Dụng Thông Tin</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi sử dụng thông tin của bạn để:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Xử lý đơn hàng và thanh toán</li>
                    <li>Giao hàng và dịch vụ khách hàng</li>
                    <li>Gửi thông tin khuyến mãi và cập nhật</li>
                    <li>Cải thiện dịch vụ và trải nghiệm người dùng</li>
                    <li>Tuân thủ quy định pháp luật</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">3. Bảo Mật Thông Tin</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi cam kết bảo vệ thông tin của bạn bằng cách:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Sử dụng mã hóa SSL để bảo vệ dữ liệu</li>
                    <li>Giới hạn quyền truy cập thông tin</li>
                    <li>Thường xuyên cập nhật hệ thống bảo mật</li>
                    <li>Đào tạo nhân viên về bảo mật thông tin</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">4. Chia Sẻ Thông Tin</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi không bán, trao đổi hoặc chuyển giao thông tin cá nhân của bạn cho bên thứ ba, 
                    trừ khi:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Bạn đã đồng ý</li>
                    <li>Cần thiết để cung cấp dịch vụ</li>
                    <li>Tuân thủ quy định pháp luật</li>
                    <li>Bảo vệ quyền và tài sản của chúng tôi</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">5. Quyền Của Bạn</h2>
                <p class="text-gray-700 mb-4">
                    Bạn có quyền:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Truy cập và cập nhật thông tin cá nhân</li>
                    <li>Yêu cầu xóa thông tin cá nhân</li>
                    <li>Từ chối nhận thông tin khuyến mãi</li>
                    <li>Khiếu nại về việc xử lý thông tin</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">6. Cookie và Công Nghệ Theo Dõi</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi sử dụng cookie để:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Ghi nhớ tùy chọn và cài đặt</li>
                    <li>Phân tích lưu lượng truy cập</li>
                    <li>Cải thiện hiệu suất website</li>
                    <li>Cung cấp nội dung phù hợp</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">7. Liên Hệ</h2>
                <p class="text-gray-700 mb-4">
                    Nếu bạn có câu hỏi về chính sách bảo mật này, vui lòng liên hệ:
                </p>
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <p class="text-gray-700"><strong>Email:</strong> privacy@datnstore.com</p>
                    <p class="text-gray-700"><strong>Điện thoại:</strong> (028) 3xxx-xxxx</p>
                    <p class="text-gray-700"><strong>Địa chỉ:</strong> 123 Đường ABC, Quận 1, TP.HCM</p>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">8. Cập Nhật Chính Sách</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi có thể cập nhật chính sách bảo mật này theo thời gian. 
                    Những thay đổi sẽ được thông báo trên website và qua email.
                </p>

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
