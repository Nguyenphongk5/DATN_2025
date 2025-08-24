@extends('layouts.user')

@section('content')
<!-- Header Section -->
<section class="py-12 bg-gradient-to-r from-purple-50 via-pink-50 to-blue-50 mb-8">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 bg-clip-text text-transparent mb-4">
                Chính Sách Đổi Trả
            </h1>
            <p class="text-gray-600 text-lg">Thông tin chi tiết về quy trình đổi trả sản phẩm</p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <div class="prose prose-lg max-w-none">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">1. Điều Kiện Đổi Trả</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi chấp nhận đổi trả sản phẩm trong vòng 30 ngày kể từ ngày nhận hàng với các điều kiện sau:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Sản phẩm còn nguyên vẹn, chưa sử dụng</li>
                    <li>Còn đầy đủ phụ kiện, bao bì gốc</li>
                    <li>Có hóa đơn mua hàng hợp lệ</li>
                    <li>Sản phẩm không thuộc danh mục không được đổi trả</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">2. Sản Phẩm Không Được Đổi Trả</h2>
                <p class="text-gray-700 mb-4">
                    Các sản phẩm sau đây không được đổi trả:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Sản phẩm đã sử dụng hoặc có dấu hiệu sử dụng</li>
                    <li>Sản phẩm bị hư hỏng do lỗi người dùng</li>
                    <li>Sản phẩm đã mất phụ kiện hoặc bao bì gốc</li>
                    <li>Sản phẩm có thông tin cá nhân của khách hàng</li>
                    <li>Sản phẩm thuộc danh mục đặc biệt (vệ sinh cá nhân, nội thất)</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">3. Quy Trình Đổi Trả</h2>
                <p class="text-gray-700 mb-4">
                    Để thực hiện đổi trả, bạn cần:
                </p>
                <ol class="list-decimal pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Liên hệ hỗ trợ:</strong> Gọi hotline hoặc gửi email trong vòng 30 ngày</li>
                    <li><strong>Cung cấp thông tin:</strong> Mã đơn hàng, lý do đổi trả, ảnh sản phẩm</li>
                    <li><strong>Đóng gói:</strong> Đóng gói sản phẩm cẩn thận với đầy đủ phụ kiện</li>
                    <li><strong>Gửi hàng:</strong> Gửi sản phẩm về địa chỉ của chúng tôi</li>
                    <li><strong>Kiểm tra:</strong> Chúng tôi kiểm tra và xử lý trong 3-5 ngày làm việc</li>
                </ol>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">4. Phí Đổi Trả</h2>
                <p class="text-gray-700 mb-4">
                    Phí đổi trả được tính như sau:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Miễn phí:</strong> Sản phẩm bị lỗi từ nhà sản xuất</li>
                    <li><strong>Phí vận chuyển:</strong> 30.000đ cho đổi trả do lý do cá nhân</li>
                    <li><strong>Phí kiểm tra:</strong> 50.000đ nếu sản phẩm không đáp ứng điều kiện</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">5. Thời Gian Xử Lý</h2>
                <p class="text-gray-700 mb-4">
                    Thời gian xử lý đổi trả:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Tiếp nhận yêu cầu:</strong> 24 giờ</li>
                    <li><strong>Kiểm tra sản phẩm:</strong> 3-5 ngày làm việc</li>
                    <li><strong>Xử lý đổi trả:</strong> 1-2 ngày làm việc</li>
                    <li><strong>Gửi sản phẩm mới:</strong> Theo thời gian giao hàng</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">6. Hình Thức Đổi Trả</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi hỗ trợ các hình thức đổi trả:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Đổi sản phẩm:</strong> Đổi sang sản phẩm khác cùng giá trị</li>
                    <li><strong>Hoàn tiền:</strong> Hoàn tiền qua phương thức thanh toán ban đầu</li>
                    <li><strong>Đổi size/màu:</strong> Đổi sang size hoặc màu khác</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">7. Địa Chỉ Gửi Hàng</h2>
                <p class="text-gray-700 mb-4">
                    Gửi sản phẩm đổi trả về địa chỉ:
                </p>
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <p class="text-gray-700"><strong>Địa chỉ:</strong> 123 Đường ABC, Quận 1, TP.HCM</p>
                    <p class="text-gray-700"><strong>Bộ phận:</strong> Xử lý đổi trả</p>
                    <p class="text-gray-700"><strong>Điện thoại:</strong> (028) 3xxx-xxxx</p>
                    <p class="text-gray-700"><strong>Email:</strong> returns@datnstore.com</p>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">8. Lưu Ý Quan Trọng</h2>
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                    <ul class="list-disc pl-6 text-yellow-800 space-y-2">
                        <li>Chụp ảnh sản phẩm trước khi gửi để làm bằng chứng</li>
                        <li>Đóng gói cẩn thận để tránh hư hỏng trong quá trình vận chuyển</li>
                        <li>Ghi rõ mã đơn hàng và lý do đổi trả</li>
                        <li>Giữ lại biên nhận vận chuyển</li>
                    </ul>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">9. Liên Hệ Hỗ Trợ</h2>
                <p class="text-gray-700 mb-4">
                    Nếu bạn cần hỗ trợ về đổi trả, vui lòng liên hệ:
                </p>
                <div class="bg-blue-50 rounded-lg p-4 mb-6">
                    <p class="text-gray-700"><strong>Hotline:</strong> 1900-xxxx (8:00 - 18:00)</p>
                    <p class="text-gray-700"><strong>Email:</strong> returns@datnstore.com</p>
                    <p class="text-gray-700"><strong>Chat trực tuyến:</strong> Có sẵn trên website</p>
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
