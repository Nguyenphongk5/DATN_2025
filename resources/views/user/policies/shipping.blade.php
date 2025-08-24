@extends('layouts.user')

@section('content')
<!-- Header Section -->
<section class="py-12 bg-gradient-to-r from-purple-50 via-pink-50 to-blue-50 mb-8">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 bg-clip-text text-transparent mb-4">
                Chính Sách Vận Chuyển
            </h1>
            <p class="text-gray-600 text-lg">Thông tin chi tiết về dịch vụ vận chuyển và giao hàng</p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <div class="prose prose-lg max-w-none">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">1. Phạm Vi Giao Hàng</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi cung cấp dịch vụ giao hàng trên toàn quốc với các khu vực:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>TP.HCM:</strong> Tất cả quận huyện</li>
                    <li><strong>Hà Nội:</strong> Tất cả quận huyện</li>
                    <li><strong>Đà Nẵng:</strong> Tất cả quận huyện</li>
                    <li><strong>Các tỉnh miền Nam:</strong> Bình Dương, Đồng Nai, Vũng Tàu, Long An...</li>
                    <li><strong>Các tỉnh miền Trung:</strong> Thừa Thiên Huế, Quảng Nam, Khánh Hòa...</li>
                    <li><strong>Các tỉnh miền Bắc:</strong> Hải Phòng, Quảng Ninh, Thái Nguyên...</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">2. Thời Gian Giao Hàng</h2>
                <p class="text-gray-700 mb-4">
                    Thời gian giao hàng dự kiến theo từng khu vực:
                </p>
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <ul class="list-disc pl-6 text-gray-700 space-y-2">
                        <li><strong>Nội thành TP.HCM:</strong> 1-2 ngày làm việc</li>
                        <li><strong>Ngoại thành TP.HCM:</strong> 2-3 ngày làm việc</li>
                        <li><strong>Các tỉnh miền Nam:</strong> 3-5 ngày làm việc</li>
                        <li><strong>Các tỉnh miền Trung:</strong> 5-7 ngày làm việc</li>
                        <li><strong>Các tỉnh miền Bắc:</strong> 7-10 ngày làm việc</li>
                        <li><strong>Vùng sâu, vùng xa:</strong> 10-15 ngày làm việc</li>
                    </ul>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">3. Phí Vận Chuyển</h2>
                <p class="text-gray-700 mb-4">
                    Phí vận chuyển được tính dựa trên các yếu tố:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Khoảng cách địa lý:</strong> Càng xa càng cao</li>
                    <li><strong>Trọng lượng sản phẩm:</strong> Theo bảng giá của đơn vị vận chuyển</li>
                    <li><strong>Kích thước sản phẩm:</strong> Sản phẩm cồng kềnh có phí cao hơn</li>
                    <li><strong>Phương thức vận chuyển:</strong> Giao hàng nhanh có phí cao hơn</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">4. Miễn Phí Vận Chuyển</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi áp dụng miễn phí vận chuyển cho:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Đơn hàng từ 500.000đ:</strong> Miễn phí vận chuyển toàn quốc</li>
                    <li><strong>Khách hàng VIP:</strong> Miễn phí vận chuyển cho mọi đơn hàng</li>
                    <li><strong>Chương trình khuyến mãi:</strong> Theo từng đợt khuyến mãi</li>
                    <li><strong>Sản phẩm đặc biệt:</strong> Một số sản phẩm có miễn phí vận chuyển</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">5. Phương Thức Vận Chuyển</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi hợp tác với các đơn vị vận chuyển uy tín:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Giao hàng tiêu chuẩn:</strong> 3-7 ngày làm việc</li>
                    <li><strong>Giao hàng nhanh:</strong> 1-3 ngày làm việc</li>
                    <li><strong>Giao hàng siêu tốc:</strong> Trong ngày (chỉ TP.HCM)</li>
                    <li><strong>Giao hàng theo giờ:</strong> Giao hàng theo giờ hẹn</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">6. Quy Trình Giao Hàng</h2>
                <p class="text-gray-700 mb-4">
                    Quy trình giao hàng của chúng tôi:
                </p>
                <ol class="list-decimal pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Xác nhận đơn hàng:</strong> Nhân viên xác nhận thông tin giao hàng</li>
                    <li><strong>Chuẩn bị hàng:</strong> Đóng gói và chuẩn bị giao hàng</li>
                    <li><strong>Giao cho đơn vị vận chuyển:</strong> Chuyển hàng cho đối tác vận chuyển</li>
                    <li><strong>Theo dõi hành trình:</strong> Cập nhật trạng thái giao hàng</li>
                    <li><strong>Giao hàng:</strong> Nhân viên giao hàng liên hệ và giao hàng</li>
                    <li><strong>Xác nhận giao hàng:</strong> Khách hàng ký nhận và thanh toán</li>
                </ol>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">7. Theo Dõi Đơn Hàng</h2>
                <p class="text-gray-700 mb-4">
                    Bạn có thể theo dõi đơn hàng bằng cách:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Website:</strong> Đăng nhập và xem trạng thái đơn hàng</li>
                    <li><strong>Email:</strong> Nhận thông báo qua email</li>
                    <li><strong>SMS:</strong> Nhận thông báo qua tin nhắn</li>
                    <li><strong>Hotline:</strong> Gọi điện để được hỗ trợ</li>
                    <li><strong>App mobile:</strong> Theo dõi qua ứng dụng (nếu có)</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">8. Xử Lý Khi Giao Hàng</h2>
                <p class="text-gray-700 mb-4">
                    Khi nhận hàng, bạn cần:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Kiểm tra sản phẩm:</strong> Kiểm tra tình trạng sản phẩm</li>
                    <li><strong>Kiểm tra số lượng:</strong> Đảm bảo đủ số lượng đã đặt</li>
                    <li><strong>Kiểm tra chất lượng:</strong> Kiểm tra sản phẩm có bị hư hỏng không</li>
                    <li><strong>Ký nhận:</strong> Ký xác nhận đã nhận hàng</li>
                    <li><strong>Thanh toán:</strong> Thanh toán nếu chọn COD</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">9. Xử Lý Sự Cố Giao Hàng</h2>
                <p class="text-gray-700 mb-4">
                    Trong trường hợp có sự cố:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Hàng bị hư hỏng:</strong> Từ chối nhận và liên hệ hỗ trợ</li>
                    <li><strong>Thiếu hàng:</strong> Ghi chú và liên hệ ngay</li>
                    <li><strong>Giao sai địa chỉ:</strong> Liên hệ để được giao lại</li>
                    <li><strong>Giao hàng trễ:</strong> Liên hệ để được bồi thường</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">10. Liên Hệ Hỗ Trợ</h2>
                <p class="text-gray-700 mb-4">
                    Nếu bạn cần hỗ trợ về vận chuyển, vui lòng liên hệ:
                </p>
                <div class="bg-blue-50 rounded-lg p-4 mb-6">
                    <p class="text-gray-700"><strong>Hotline vận chuyển:</strong> 1900-xxxx (8:00 - 18:00)</p>
                    <p class="text-gray-700"><strong>Email:</strong> shipping@datnstore.com</p>
                    <p class="text-gray-700"><strong>Chat trực tuyến:</strong> Có sẵn trên website</p>
                    <p class="text-gray-700"><strong>Fanpage:</strong> Facebook và Zalo</p>
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
