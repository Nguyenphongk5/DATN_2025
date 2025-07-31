<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Xác thực OTP - Trang quản trị</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .otp-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
        }
        .otp-input {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 8px;
        }
        .btn-send-otp {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-send-otp:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .resend-timer {
            font-size: 14px;
            color: #6c757d;
        }
        .user-info {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="otp-container">
        <div class="text-center mb-4">
            <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
            <h3 class="fw-bold">Xác thực OTP</h3>
            <p class="text-muted">Nhập mã OTP đã được gửi đến email của bạn</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Thông báo OTP đã được gửi -->
        <div class="alert alert-info" id="otpSentAlert" style="display: none;">
            <i class="fas fa-envelope"></i> 
            <strong>OTP đã được gửi!</strong> Vui lòng kiểm tra email của bạn.
        </div>

        <!-- Thông tin user -->
        <div class="user-info">
            <div class="row">
                <div class="col-2">
                    <i class="fas fa-user-circle fa-2x text-primary"></i>
                </div>
                <div class="col-10">
                    <h6 class="mb-1">{{ auth()->user()->name }}</h6>
                    <small class="text-muted">{{ auth()->user()->email }}</small>
                </div>
            </div>
        </div>

        <!-- Form OTP -->
        <form id="otpForm" method="POST" action="{{ route('admin.otp.verify') }}">
            @csrf
            <div class="mb-4">
                <label for="otp" class="form-label">Mã OTP</label>
                <input type="text" 
                       class="form-control otp-input @error('otp') is-invalid @enderror" 
                       id="otp" 
                       name="otp" 
                       maxlength="6" 
                       placeholder="000000"
                       required>
                @error('otp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-check"></i> Xác thực
                </button>
            </div>
        </form>

        <hr class="my-4">

        <!-- Gửi lại OTP -->
        <div class="text-center">
            <p class="resend-timer mb-2">
                Không nhận được mã? 
                <span id="timer" class="text-muted">Gửi lại sau <span id="countdown">60</span>s</span>
            </p>
            <button type="button" id="resendBtn" class="btn btn-outline-secondary btn-sm" disabled>
                <i class="fas fa-paper-plane"></i> Gửi lại OTP
            </button>
        </div>

        <!-- Thông tin bảo mật -->
        <div class="mt-4">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i>
                <strong>Lưu ý:</strong>
                <ul class="mb-0 mt-2">
                    <li>Mã OTP có hiệu lực trong 10 phút</li>
                    <li>Mã OTP chỉ được sử dụng 1 lần</li>
                    <li>Phiên đăng nhập có hiệu lực trong 24 giờ</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto focus vào input OTP
        document.getElementById('otp').focus();

        // Auto submit khi nhập đủ 6 số
        document.getElementById('otp').addEventListener('input', function() {
            if (this.value.length === 6) {
                document.getElementById('otpForm').submit();
            }
        });

        // Chỉ cho phép nhập số
        document.getElementById('otp').addEventListener('keypress', function(e) {
            if (!/[0-9]/.test(e.key)) {
                e.preventDefault();
            }
        });

        // Timer cho nút gửi lại
        let countdown = 60;
        const timerElement = document.getElementById('countdown');
        const resendBtn = document.getElementById('resendBtn');
        const timerContainer = document.getElementById('timer');

        function updateTimer() {
            if (countdown > 0) {
                countdown--;
                timerElement.textContent = countdown;
                setTimeout(updateTimer, 1000);
            } else {
                resendBtn.disabled = false;
                timerContainer.style.display = 'none';
            }
        }

        updateTimer();

        // Gửi lại OTP
        resendBtn.addEventListener('click', function() {
            this.disabled = true;
            countdown = 60;
            timerContainer.style.display = 'inline';
            updateTimer();

            fetch('{{ route("admin.otp.resend") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                } else {
                    alert('Có lỗi xảy ra: ' + data.message);
                }
            })
            .catch(error => {
                alert('Có lỗi xảy ra khi gửi OTP');
            });
        });

        // Hiển thị thông báo OTP đã được gửi
        window.addEventListener('load', function() {
            // Hiển thị thông báo OTP đã được gửi
            const otpSentAlert = document.getElementById('otpSentAlert');
            if (otpSentAlert) {
                otpSentAlert.style.display = 'block';
                
                // Ẩn thông báo sau 5 giây
                setTimeout(function() {
                    otpSentAlert.style.display = 'none';
                }, 5000);
            }
        });
    </script>
</body>
</html> 