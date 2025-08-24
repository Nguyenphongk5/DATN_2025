@extends('layouts.user')

@section('content')
<!-- Header Section -->
<section class="py-12 bg-gradient-to-r from-purple-50 via-pink-50 to-blue-50 mb-8">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 bg-clip-text text-transparent mb-4">
                Hướng Dẫn Mua Hàng
            </h1>
            <p class="text-gray-600 text-lg">Hướng dẫn chi tiết cách mua hàng trực tuyến an toàn và thuận tiện</p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <div class="prose prose-lg max-w-none">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">1. Chuẩn Bị Trước Khi Mua Hàng</h2>
                <p class="text-gray-700 mb-4">
                    Để có trải nghiệm mua hàng tốt nhất, bạn cần chuẩn bị:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Tài khoản:</strong> Đăng ký hoặc đăng nhập tài khoản</li>
                    <li><strong>Thông tin cá nhân:</strong> Cập nhật đầy đủ thông tin liên hệ</li>
                    <li><strong>Địa chỉ giao hàng:</strong> Xác định địa chỉ giao hàng chính xác</li>
                    <li><strong>Phương thức thanh toán:</strong> Chuẩn bị thông tin thanh toán</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">2. Quy Trình Mua Hàng</h2>
                <p class="text-gray-700 mb-4">
                    Quy trình mua hàng gồm các bước sau:
                </p>
                <ol class="list-decimal pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Tìm kiếm sản phẩm:</strong> Sử dụng thanh tìm kiếm hoặc duyệt danh mục</li>
                    <li><strong>Xem chi tiết sản phẩm:</strong> Kiểm tra thông tin, hình ảnh, giá cả</li>
                    <li><strong>Chọn sản phẩm:</strong> Chọn size, màu sắc, số lượng phù hợp</li>
                    <li><strong>Thêm vào giỏ hàng:</strong> Nhấn nút "Thêm vào giỏ hàng"</li>
                    <li><strong>Kiểm tra giỏ hàng:</strong> Xem lại sản phẩm đã chọn</li>
                    <li><strong>Tiến hành thanh toán:</strong> Nhấn nút "Thanh toán"</li>
                    <li><strong>Điền thông tin:</strong> Cung cấp thông tin giao hàng và thanh toán</li>
                    <li><strong>Xác nhận đơn hàng:</strong> Kiểm tra và xác nhận thông tin</li>
                    <li><strong>Hoàn tất đơn hàng:</strong> Nhấn "Đặt hàng" để hoàn tất</li>
                </ol>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">3. Tìm Kiếm Sản Phẩm</h2>
                <p class="text-gray-700 mb-4">
                    Có nhiều cách để tìm kiếm sản phẩm:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Thanh tìm kiếm:</strong> Gõ tên sản phẩm, thương hiệu, model</li>
                    <li><strong>Danh mục sản phẩm:</strong> Duyệt theo danh mục chính</li>
                    <li><strong>Bộ lọc:</strong> Sử dụng bộ lọc giá, thương hiệu, đánh giá</li>
                    <li><strong>Sản phẩm liên quan:</strong> Xem sản phẩm tương tự</li>
                    <li><strong>Khuyến mãi:</strong> Duyệt các sản phẩm đang giảm giá</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">4. Chọn Sản Phẩm Phù Hợp</h2>
                <p class="text-gray-700 mb-4">
                    Khi chọn sản phẩm, hãy chú ý:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Thông tin sản phẩm:</strong> Đọc kỹ mô tả và thông số kỹ thuật</li>
                    <li><strong>Hình ảnh:</strong> Xem nhiều góc độ và màu sắc</li>
                    <li><strong>Đánh giá khách hàng:</strong> Tham khảo ý kiến người đã mua</li>
                    <li><strong>So sánh giá:</strong> So sánh với các sản phẩm tương tự</li>
                    <li><strong>Chính sách bảo hành:</strong> Kiểm tra thời gian và điều kiện bảo hành</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">5. Quản Lý Giỏ Hàng</h2>
                <p class="text-gray-700 mb-4">
                    Trong giỏ hàng, bạn có thể:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Thay đổi số lượng:</strong> Tăng/giảm số lượng sản phẩm</li>
                    <li><strong>Xóa sản phẩm:</strong> Loại bỏ sản phẩm không muốn mua</li>
                    <li><strong>Lưu giỏ hàng:</strong> Lưu để mua sau</li>
                    <li><strong>Áp dụng mã giảm giá:</strong> Nhập mã khuyến mãi nếu có</li>
                    <li><strong>Kiểm tra tổng tiền:</strong> Xem tổng giá trị đơn hàng</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">6. Thông Tin Giao Hàng</h2>
                <p class="text-gray-700 mb-4">
                    Khi điền thông tin giao hàng:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Họ tên người nhận:</strong> Điền chính xác tên người nhận hàng</li>
                    <li><strong>Số điện thoại:</strong> Số điện thoại để liên lạc khi giao hàng</li>
                    <li><strong>Địa chỉ chi tiết:</strong> Địa chỉ cụ thể, số nhà, đường, phường/xã</li>
                    <li><strong>Tỉnh/thành phố:</strong> Chọn đúng tỉnh/thành phố</li>
                    <li><strong>Ghi chú:</strong> Ghi chú thêm nếu cần thiết</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">7. Phương Thức Thanh Toán</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi hỗ trợ các phương thức thanh toán:
                </p>
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <ul class="list-disc pl-6 text-gray-700 space-y-2">
                        <li><strong>Thanh toán khi nhận hàng (COD):</strong> Thanh toán tiền mặt khi nhận hàng</li>
                        <li><strong>Chuyển khoản ngân hàng:</strong> Chuyển khoản trực tiếp</li>
                        <li><strong>Ví điện tử:</strong> Momo, ZaloPay, VNPay</li>
                        <li><strong>Thẻ tín dụng/ghi nợ:</strong> Visa, Mastercard, JCB</li>
                        <li><strong>Cổng thanh toán:</strong> VNPay, PayPal</li>
                    </ul>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">8. Xác Nhận Đơn Hàng</h2>
                <p class="text-gray-700 mb-4">
                    Trước khi hoàn tất, hãy kiểm tra:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Danh sách sản phẩm:</strong> Đúng sản phẩm, số lượng, giá cả</li>
                    <li><strong>Thông tin giao hàng:</strong> Địa chỉ, số điện thoại chính xác</li>
                    <li><strong>Phương thức thanh toán:</strong> Phù hợp với khả năng</li>
                    <li><strong>Mã giảm giá:</strong> Đã được áp dụng đúng</li>
                    <li><strong>Tổng tiền:</strong> Bao gồm phí vận chuyển</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">9. Sau Khi Đặt Hàng</h2>
                <p class="text-gray-700 mb-4">
                    Sau khi đặt hàng thành công:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Email xác nhận:</strong> Kiểm tra email xác nhận đơn hàng</li>
                    <li><strong>Mã đơn hàng:</strong> Lưu lại mã đơn hàng để theo dõi</li>
                    <li><strong>Theo dõi trạng thái:</strong> Kiểm tra trạng thái đơn hàng</li>
                    <li><strong>Liên hệ hỗ trợ:</strong> Liên hệ nếu cần thay đổi hoặc hủy</li>
                    <li><strong>Chuẩn bị nhận hàng:</strong> Sẵn sàng nhận hàng theo lịch hẹn</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">10. Lưu Ý Quan Trọng</h2>
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                    <ul class="list-disc pl-6 text-yellow-800 space-y-2">
                        <li>Kiểm tra kỹ thông tin trước khi xác nhận đơn hàng</li>
                        <li>Lưu lại mã đơn hàng và email xác nhận</li>
                        <li>Liên hệ ngay nếu cần thay đổi hoặc hủy đơn hàng</li>
                        <li>Chuẩn bị đầy đủ tiền nếu chọn thanh toán COD</li>
                        <li>Kiểm tra sản phẩm kỹ lưỡng khi nhận hàng</li>
                    </ul>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">11. Liên Hệ Hỗ Trợ</h2>
                <p class="text-gray-700 mb-4">
                    Nếu bạn cần hỗ trợ trong quá trình mua hàng:
                </p>
                <div class="bg-blue-50 rounded-lg p-4 mb-6">
                    <p class="text-gray-700"><strong>Hotline:</strong> 1900-xxxx (8:00 - 18:00)</p>
                    <p class="text-gray-700"><strong>Email:</strong> support@datnstore.com</p>
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
