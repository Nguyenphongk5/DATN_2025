@extends('layouts.user')

@section('content')
<!-- Header Section -->
<section class="py-12 bg-gradient-to-r from-purple-50 via-pink-50 to-blue-50 mb-8">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 bg-clip-text text-transparent mb-4">
                Điều Khoản Sử Dụng
            </h1>
            <p class="text-gray-600 text-lg">Vui lòng đọc kỹ các điều khoản trước khi sử dụng dịch vụ của chúng tôi</p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <div class="prose prose-lg max-w-none">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">1. Chấp Nhận Điều Khoản</h2>
                <p class="text-gray-700 mb-4">
                    Bằng việc truy cập và sử dụng website {{ config('app.name', 'DATN Store') }}, 
                    bạn đồng ý tuân thủ và bị ràng buộc bởi các điều khoản và điều kiện này. 
                    Nếu bạn không đồng ý với bất kỳ phần nào của các điều khoản này, 
                    vui lòng không sử dụng dịch vụ của chúng tôi.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">2. Sử Dụng Dịch Vụ</h2>
                <p class="text-gray-700 mb-4">
                    Bạn cam kết sử dụng dịch vụ của chúng tôi một cách hợp pháp và phù hợp với các điều khoản này:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Không sử dụng dịch vụ cho mục đích bất hợp pháp</li>
                    <li>Không vi phạm quyền sở hữu trí tuệ</li>
                    <li>Không gây rối hoặc làm gián đoạn dịch vụ</li>
                    <li>Không truy cập trái phép vào hệ thống</li>
                    <li>Cung cấp thông tin chính xác và đầy đủ</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">3. Tài Khoản Người Dùng</h2>
                <p class="text-gray-700 mb-4">
                    Khi tạo tài khoản, bạn có trách nhiệm:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Bảo mật thông tin đăng nhập</li>
                    <li>Không chia sẻ tài khoản với người khác</li>
                    <li>Thông báo ngay khi phát hiện vi phạm bảo mật</li>
                    <li>Cập nhật thông tin cá nhân khi cần thiết</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">4. Đặt Hàng và Thanh Toán</h2>
                <p class="text-gray-700 mb-4">
                    Khi đặt hàng, bạn đồng ý:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Cung cấp thông tin chính xác về địa chỉ giao hàng</li>
                    <li>Thanh toán đầy đủ theo giá đã niêm yết</li>
                    <li>Chấp nhận các điều kiện giao hàng</li>
                    <li>Tuân thủ chính sách đổi trả và bảo hành</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">5. Sở Hữu Trí Tuệ</h2>
                <p class="text-gray-700 mb-4">
                    Tất cả nội dung trên website, bao gồm nhưng không giới hạn ở:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Logo, thương hiệu, tên công ty</li>
                    <li>Hình ảnh, video, âm thanh</li>
                    <li>Văn bản, thiết kế, giao diện</li>
                    <li>Phần mềm, mã nguồn, cơ sở dữ liệu</li>
                </ul>
                <p class="text-gray-700 mb-4">
                    Đều thuộc quyền sở hữu của {{ config('app.name', 'DATN Store') }} và được bảo vệ bởi luật sở hữu trí tuệ.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">6. Giới Hạn Trách Nhiệm</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi không chịu trách nhiệm về:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Thiệt hại gián tiếp hoặc ngẫu nhiên</li>
                    <li>Mất lợi nhuận, dữ liệu hoặc thông tin</li>
                    <li>Gián đoạn dịch vụ do lỗi kỹ thuật</li>
                    <li>Hành vi của bên thứ ba</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">7. Chấm Dứt Dịch Vụ</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi có quyền chấm dứt hoặc tạm ngưng dịch vụ khi:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Bạn vi phạm điều khoản sử dụng</li>
                    <li>Bạn sử dụng dịch vụ sai mục đích</li>
                    <li>Có yêu cầu từ cơ quan chức năng</li>
                    <li>Bảo trì hoặc nâng cấp hệ thống</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">8. Thay Đổi Điều Khoản</h2>
                <p class="text-gray-700 mb-4">
                    Chúng tôi có quyền thay đổi các điều khoản này theo thời gian. 
                    Những thay đổi sẽ có hiệu lực ngay khi được đăng tải trên website. 
                    Việc tiếp tục sử dụng dịch vụ sau khi thay đổi được coi là chấp nhận điều khoản mới.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">9. Luật Áp Dụng</h2>
                <p class="text-gray-700 mb-4">
                    Các điều khoản này được điều chỉnh và giải thích theo luật pháp Việt Nam. 
                    Mọi tranh chấp phát sinh sẽ được giải quyết tại tòa án có thẩm quyền tại Việt Nam.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-6">10. Liên Hệ</h2>
                <p class="text-gray-700 mb-4">
                    Nếu bạn có câu hỏi về điều khoản sử dụng, vui lòng liên hệ:
                </p>
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <p class="text-gray-700"><strong>Email:</strong> legal@datnstore.com</p>
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
