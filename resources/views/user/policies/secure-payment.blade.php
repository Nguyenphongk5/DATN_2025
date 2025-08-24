@extends('layouts.user')

@section('content')
<!-- Header Section -->
<section class="py-12 bg-gradient-to-r from-purple-50 via-pink-50 to-blue-50 mb-8">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 bg-clip-text text-transparent mb-4">
                Thanh Toán An Toàn
            </h1>
            <p class="text-gray-600 text-lg">Thông tin chi tiết về bảo mật và an toàn khi thanh toán trực tuyến</p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <div class="prose prose-lg max-w-none">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">1. Cam Kết Bảo Mật</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi cam kết bảo vệ thông tin thanh toán của bạn với các tiêu chuẩn bảo mật cao nhất:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Mã hóa SSL 256-bit:</strong> Bảo vệ mọi thông tin truyền tải</li>
                    <li><strong>Chuẩn PCI DSS:</strong> Tuân thủ tiêu chuẩn bảo mật quốc tế</li>
                    <li><strong>Bảo mật đa lớp:</strong> Nhiều lớp bảo vệ thông tin</li>
                    <li><strong>Giám sát 24/7:</strong> Theo dõi liên tục để phát hiện mối đe dọa</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">2. Các Phương Thức Thanh Toán An Toàn</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi cung cấp nhiều phương thức thanh toán an toàn:
                </p>
                
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Thanh Toán Khi Nhận Hàng (COD)</h3>
                <p class="text-gray-700 mb-4">
                    Phương thức an toàn nhất, bạn chỉ thanh toán khi đã nhận và kiểm tra hàng:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Không cần cung cấp thông tin thẻ</li>
                    <li>Thanh toán tiền mặt khi nhận hàng</li>
                    <li>Kiểm tra sản phẩm trước khi thanh toán</li>
                    <li>Phù hợp với người mới mua hàng trực tuyến</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mb-4">Chuyển Khoản Ngân Hàng</h3>
                <p class="text-gray-700 mb-4">
                    Chuyển khoản trực tiếp đến tài khoản ngân hàng của chúng tôi:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Thông tin tài khoản rõ ràng, minh bạch</li>
                    <li>Xác nhận nhanh chóng qua SMS/Email</li>
                    <li>Không mất phí chuyển khoản</li>
                    <li>Bảo mật thông tin ngân hàng</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mb-4">Ví Điện Tử</h3>
                <p class="text-gray-700 mb-4">
                    Thanh toán qua các ví điện tử uy tín:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Momo:</strong> Ví điện tử phổ biến nhất Việt Nam</li>
                    <li><strong>ZaloPay:</strong> Tích hợp với ứng dụng Zalo</li>
                    <li><strong>VNPay:</strong> Cổng thanh toán quốc gia</li>
                    <li>Xác thực qua OTP/SMS</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mb-4">Thẻ Tín Dụng/Ghi Nợ</h3>
                <p class="text-gray-700 mb-4">
                    Thanh toán qua thẻ ngân hàng với bảo mật cao:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Hỗ trợ Visa, Mastercard, JCB</li>
                    <li>Xác thực 3D Secure</li>
                    <li>Mã hóa thông tin thẻ</li>
                    <li>Không lưu trữ thông tin thẻ</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">3. Bảo Mật Thông Tin Thanh Toán</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi áp dụng các biện pháp bảo mật:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Mã hóa đầu cuối:</strong> Thông tin được mã hóa từ thiết bị đến server</li>
                    <li><strong>Token hóa:</strong> Thay thế thông tin nhạy cảm bằng token</li>
                    <li><strong>Xác thực đa yếu tố:</strong> OTP, SMS, Email xác nhận</li>
                    <li><strong>Giới hạn giao dịch:</strong> Kiểm soát số tiền và tần suất giao dịch</li>
                    <li><strong>Phát hiện gian lận:</strong> Hệ thống AI phát hiện giao dịch bất thường</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">4. Quy Trình Thanh Toán An Toàn</h2>
                <p class="text-gray-700 mb-4">
                    Quy trình thanh toán được thiết kế để đảm bảo an toàn:
                </p>
                <ol class="list-decimal pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Xác thực người dùng:</strong> Đăng nhập và xác minh tài khoản</li>
                    <li><strong>Kiểm tra đơn hàng:</strong> Xác nhận thông tin sản phẩm và giá cả</li>
                    <li><strong>Chọn phương thức:</strong> Lựa chọn phương thức thanh toán phù hợp</li>
                    <li><strong>Xác thực thanh toán:</strong> OTP, SMS hoặc xác nhận khác</li>
                    <li><strong>Xử lý giao dịch:</strong> Xử lý thanh toán qua cổng an toàn</li>
                    <li><strong>Xác nhận kết quả:</strong> Thông báo kết quả thanh toán</li>
                </ol>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">5. Bảo Vệ Khỏi Gian Lận</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi triển khai nhiều biện pháp chống gian lận:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Giám sát giao dịch:</strong> Theo dõi mọi giao dịch để phát hiện bất thường</li>
                    <li><strong>Phát hiện gian lận:</strong> Sử dụng AI và machine learning</li>
                    <li><strong>Kiểm tra địa chỉ IP:</strong> Phát hiện giao dịch từ địa chỉ đáng ngờ</li>
                    <li><strong>Giới hạn giao dịch:</strong> Kiểm soát số tiền và tần suất</li>
                    <li><strong>Báo cáo gian lận:</strong> Hệ thống báo cáo tự động</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">6. Lưu Ý Khi Thanh Toán</h2>
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                    <ul class="list-disc pl-6 text-yellow-800 space-y-2">
                        <li>Chỉ thanh toán trên website chính thức của chúng tôi</li>
                        <li>Không chia sẻ thông tin thẻ với người khác</li>
                        <li>Kiểm tra URL website trước khi thanh toán</li>
                        <li>Không thanh toán qua email hoặc tin nhắn</li>
                        <li>Luôn đăng xuất sau khi hoàn tất giao dịch</li>
                    </ul>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">7. Xử Lý Sự Cố Thanh Toán</h2>
                <p class="text-gray-700 mb-4">
                    Trong trường hợp gặp sự cố thanh toán:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Giao dịch bị treo:</strong> Liên hệ ngay để được hỗ trợ</li>
                    <li><strong>Trừ tiền nhưng không nhận hàng:</strong> Chúng tôi sẽ hoàn tiền</li>
                    <li><strong>Thanh toán bị từ chối:</strong> Kiểm tra thông tin thẻ</li>
                    <li><strong>Lỗi hệ thống:</strong> Thử lại sau vài phút</li>
                    <li><strong>Gian lận:</strong> Báo cáo ngay để được bảo vệ</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">8. Hoàn Tiền và Bảo Vệ</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi cam kết bảo vệ quyền lợi của bạn:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Hoàn tiền 100%:</strong> Nếu giao dịch bị lỗi</li>
                    <li><strong>Bảo vệ mua hàng:</strong> Đảm bảo nhận đúng sản phẩm</li>
                    <li><strong>Hỗ trợ 24/7:</strong> Luôn sẵn sàng hỗ trợ</li>
                    <li><strong>Giải quyết nhanh chóng:</strong> Xử lý sự cố trong 24 giờ</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">9. Thông Tin Liên Hệ Hỗ Trợ</h2>
                <p class="text-gray-700 mb-4">
                    Nếu bạn cần hỗ trợ về thanh toán:
                </p>
                <div class="bg-blue-50 rounded-lg p-4 mb-6">
                    <p class="text-gray-700"><strong>Hotline thanh toán:</strong> 1900-xxxx (8:00 - 18:00)</p>
                    <p class="text-gray-700"><strong>Email:</strong> payment@datnstore.com</p>
                    <p class="text-gray-700"><strong>Chat trực tuyến:</strong> Có sẵn trên website</p>
                    <p class="text-gray-700"><strong>Fanpage:</strong> Facebook và Zalo</p>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">10. Chứng Chỉ Bảo Mật</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi đạt được các chứng chỉ bảo mật:
                </p>
                <div class="bg-green-50 rounded-lg p-4 mb-6">
                    <ul class="list-disc pl-6 text-green-800 space-y-2">
                        <li><strong>SSL Certificate:</strong> Bảo mật truyền tải dữ liệu</li>
                        <li><strong>PCI DSS:</strong> Tiêu chuẩn bảo mật thẻ tín dụng</li>
                        <li><strong>ISO 27001:</strong> Quản lý bảo mật thông tin</li>
                        <li><strong>GDPR Compliance:</strong> Tuân thủ quy định bảo vệ dữ liệu</li>
                    </ul>
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
