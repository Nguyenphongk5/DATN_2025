@extends('layouts.user')

@section('content')
<!-- Header Section -->
<section class="py-12 bg-gradient-to-r from-purple-50 via-pink-50 to-blue-50 mb-8">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 bg-clip-text text-transparent mb-4">
                Chính Sách Bảo Hành
            </h1>
            <p class="text-gray-600 text-lg">Thông tin chi tiết về chính sách bảo hành sản phẩm</p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <div class="prose prose-lg max-w-none">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">1. Phạm Vi Bảo Hành</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi cung cấp chính sách bảo hành cho tất cả sản phẩm chính hãng với các điều kiện sau:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Sản phẩm được mua trực tiếp từ {{ config('app.name', 'DATN Store') }}</li>
                    <li>Sản phẩm còn trong thời gian bảo hành</li>
                    <li>Sản phẩm bị lỗi từ nhà sản xuất</li>
                    <li>Còn đầy đủ phụ kiện và bao bì gốc</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">2. Thời Gian Bảo Hành</h2>
                <p class="text-gray-700 mb-4">
                    Thời gian bảo hành được tính từ ngày mua hàng:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Điện thoại, máy tính:</strong> 12-24 tháng</li>
                    <li><strong>Phụ kiện điện tử:</strong> 6-12 tháng</li>
                    <li><strong>Quần áo, giày dép:</strong> 3-6 tháng</li>
                    <li><strong>Mỹ phẩm:</strong> 6-12 tháng</li>
                    <li><strong>Sản phẩm khác:</strong> Theo tiêu chuẩn nhà sản xuất</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">3. Các Trường Hợp Được Bảo Hành</h2>
                <p class="text-gray-700 mb-4">
                    Sản phẩm được bảo hành trong các trường hợp:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Lỗi kỹ thuật từ nhà sản xuất</li>
                    <li>Hư hỏng do chất lượng vật liệu</li>
                    <li>Lỗi thiết kế hoặc sản xuất</li>
                    <li>Hư hỏng do vận chuyển</li>
                    <li>Lỗi phần mềm (nếu có)</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">4. Các Trường Hợp Không Được Bảo Hành</h2>
                <p class="text-gray-700 mb-4">
                    Sản phẩm không được bảo hành trong các trường hợp:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Hư hỏng do sử dụng sai cách</li>
                    <li>Hư hỏng do tai nạn hoặc thiên tai</li>
                    <li>Hư hỏng do sửa chữa không đúng cách</li>
                    <li>Hư hỏng do môi trường không phù hợp</li>
                    <li>Hư hỏng do thay đổi phần mềm trái phép</li>
                    <li>Hư hỏng do mất phụ kiện hoặc bao bì gốc</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">5. Quy Trình Bảo Hành</h2>
                <p class="text-gray-700 mb-4">
                    Để thực hiện bảo hành, bạn cần:
                </p>
                <ol class="list-decimal pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Liên hệ hỗ trợ:</strong> Gọi hotline hoặc gửi email</li>
                    <li><strong>Cung cấp thông tin:</strong> Mã đơn hàng, lỗi gặp phải</li>
                    <li><strong>Kiểm tra sơ bộ:</strong> Nhân viên hỗ trợ kiểm tra qua điện thoại</li>
                    <li><strong>Gửi sản phẩm:</strong> Gửi sản phẩm về trung tâm bảo hành</li>
                    <li><strong>Kiểm tra chi tiết:</strong> Kỹ thuật viên kiểm tra và xác định lỗi</li>
                    <li><strong>Xử lý bảo hành:</strong> Sửa chữa hoặc thay thế sản phẩm</li>
                    <li><strong>Trả sản phẩm:</strong> Gửi lại sản phẩm đã bảo hành</li>
                </ol>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">6. Thời Gian Xử Lý Bảo Hành</h2>
                <p class="text-gray-700 mb-4">
                    Thời gian xử lý bảo hành:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Tiếp nhận yêu cầu:</strong> 24 giờ</li>
                    <li><strong>Kiểm tra sản phẩm:</strong> 2-3 ngày làm việc</li>
                    <li><strong>Sửa chữa đơn giản:</strong> 3-5 ngày làm việc</li>
                    <li><strong>Sửa chữa phức tạp:</strong> 7-14 ngày làm việc</li>
                    <li><strong>Thay thế sản phẩm:</strong> 5-7 ngày làm việc</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">7. Hình Thức Bảo Hành</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi cung cấp các hình thức bảo hành:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Sửa chữa:</strong> Sửa chữa lỗi tại trung tâm bảo hành</li>
                    <li><strong>Thay thế linh kiện:</strong> Thay thế linh kiện bị lỗi</li>
                    <li><strong>Thay thế sản phẩm:</strong> Thay thế sản phẩm mới tương đương</li>
                    <li><strong>Hoàn tiền:</strong> Hoàn tiền nếu không thể sửa chữa</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">8. Trung Tâm Bảo Hành</h2>
                <p class="text-gray-700 mb-4">
                    Địa chỉ trung tâm bảo hành:
                </p>
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <p class="text-gray-700"><strong>Địa chỉ:</strong> 123 Đường ABC, Quận 1, TP.HCM</p>
                    <p class="text-gray-700"><strong>Bộ phận:</strong> Trung tâm bảo hành</p>
                    <p class="text-gray-700"><strong>Điện thoại:</strong> (028) 3xxx-xxxx</p>
                    <p class="text-gray-700"><strong>Email:</strong> warranty@datnstore.com</p>
                    <p class="text-gray-700"><strong>Giờ làm việc:</strong> Thứ 2 - Thứ 6: 8:00 - 18:00</p>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">9. Lưu Ý Quan Trọng</h2>
                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                    <ul class="list-disc pl-6 text-blue-800 space-y-2">
                        <li>Giữ lại hóa đơn mua hàng để làm bằng chứng bảo hành</li>
                        <li>Không tự ý tháo lắp hoặc sửa chữa sản phẩm</li>
                        <li>Liên hệ ngay khi phát hiện lỗi để được hỗ trợ</li>
                        <li>Đóng gói cẩn thận khi gửi sản phẩm bảo hành</li>
                    </ul>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">10. Liên Hệ Hỗ Trợ</h2>
                <p class="text-gray-700 mb-4">
                    Nếu bạn cần hỗ trợ về bảo hành, vui lòng liên hệ:
                </p>
                <div class="bg-green-50 rounded-lg p-4 mb-6">
                    <p class="text-gray-700"><strong>Hotline bảo hành:</strong> 1900-xxxx (8:00 - 18:00)</p>
                    <p class="text-gray-700"><strong>Email:</strong> warranty@datnstore.com</p>
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
