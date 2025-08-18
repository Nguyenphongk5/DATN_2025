{{-- <!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vòng Quay May Mắn Siêu Đẹp</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        } */

        /* Animated background particles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            animation: float 6s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        #popup {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .popup-content {
            background: linear-gradient(145deg, rgba(255,255,255,0.95), rgba(255,255,255,0.9));
            padding: 30px;
            border-radius: 25px;
            text-align: center;
            width: 420px;
            max-width: 95vw;
            max-height: 95vh;
            overflow-y: auto;
            position: relative;
            box-shadow:
                0 25px 50px rgba(0,0,0,0.3),
                0 0 0 1px rgba(255,255,255,0.3),
                inset 0 1px 0 rgba(255,255,255,0.6);
            animation: slideIn 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
            backdrop-filter: blur(20px);
        }

        @keyframes slideIn {
            from {
                transform: translateY(-100px) scale(0.8);
                opacity: 0;
            }
            to {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white;
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(238, 90, 36, 0.4);
            z-index: 10;
        }

        .close-btn:hover {
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 6px 20px rgba(238, 90, 36, 0.6);
        }

        .title {
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea, #764ba2, #f093fb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 20px;
            margin-top: 10px;
            text-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .wheel-container {
            position: relative;
            margin: 20px auto;
            display: inline-block;
        }

        .wheel-wrapper {
            position: relative;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            box-shadow:
                0 0 30px rgba(102, 126, 234, 0.5),
                0 0 60px rgba(118, 75, 162, 0.3),
                inset 0 0 30px rgba(255,255,255,0.2);
            background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
            padding: 10px;
        }

        #wheel {
            border-radius: 50%;
            box-shadow:
                0 8px 32px rgba(0,0,0,0.3),
                inset 0 4px 8px rgba(255,255,255,0.3);
            transition: transform 4s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .pointer {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-top: 30px solid #ff6b6b;
            z-index: 10;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            40% {
                transform: translateX(-50%) translateY(-10px);
            }
            60% {
                transform: translateX(-50%) translateY(-5px);
            }
        }

        .center-circle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            box-shadow:
                0 4px 15px rgba(0,0,0,0.3),
                inset 0 2px 4px rgba(255,255,255,0.3);
            z-index: 5;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }

        .spin-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            margin-top: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            position: relative;
            overflow: hidden;
        }

        .spin-btn:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .spin-btn:hover:before {
            left: 100%;
        }

        .spin-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(102, 126, 234, 0.6);
        }

        .spin-btn:disabled {
            background: linear-gradient(135deg, #95a5a6, #7f8c8d);
            cursor: not-allowed;
            transform: none;
            box-shadow: 0 4px 15px rgba(149, 165, 166, 0.3);
        }

        .result {
            margin-top: 25px;
            font-size: 20px;
            font-weight: 600;
            min-height: 30px;
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .coupon-result {
            margin-top: 25px;
            padding: 20px;
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.1), rgba(139, 195, 74, 0.1));
            border: 2px solid rgba(76, 175, 80, 0.3);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            animation: zoomIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .coupon-title {
            color: #4CAF50;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .coupon-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            margin-top: 15px;
        }

        .coupon-input {
            padding: 12px 20px;
            border: 2px solid rgba(76, 175, 80, 0.3);
            border-radius: 12px;
            text-align: center;
            font-weight: 700;
            color: #4CAF50;
            background: rgba(255, 255, 255, 0.9);
            font-size: 16px;
            letter-spacing: 2px;
            width: 200px;
            max-width: 100%;
        }

        .copy-btn {
            background: linear-gradient(135deg, #2196F3, #21CBF3);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(33, 150, 243, 0.4);
            width: 140px;
        }

        .copy-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(33, 150, 243, 0.6);
        }

        .copy-status {
            margin-top: 15px;
            font-size: 14px;
            font-weight: 500;
        }

        .floating-icons {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }

        .floating-icon {
            position: absolute;
            font-size: 24px;
            animation: floatIcon 4s infinite ease-in-out;
            opacity: 0.7;
        }

        @keyframes floatIcon {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }


    </style>
</head>
<body>

<div class="particles" id="particles"></div>

<!-- Popup vòng quay -->
<div id="popup" style="display: none;">
    <div class="popup-content">
        <div class="floating-icons">
            <div class="floating-icon" style="top: 10%; left: 10%;">✨</div>
            <div class="floating-icon" style="top: 20%; right: 15%; animation-delay: 1s;">🎁</div>
            <div class="floating-icon" style="bottom: 30%; left: 20%; animation-delay: 2s;">💎</div>
            <div class="floating-icon" style="bottom: 25%; right: 10%; animation-delay: 3s;">🌟</div>
        </div>

        <button class="close-btn" onclick="closePopup()">×</button>

        <h1 class="title">🎊 VÒNG QUAY MAY MẮN 🎊</h1>

        <div class="wheel-container">
            <div class="wheel-wrapper">
                <div class="pointer"></div>
                <canvas id="wheel" width="260" height="260"></canvas>
                <div class="center-circle">🍀</div>
            </div>
        </div>

        <button id="spinBtn" class="spin-btn" onclick="spinWheel()">
            ✨ QUAY NGAY ✨
        </button>

        <div id="result" class="result"></div>

        <div id="couponResult" class="coupon-result" style="display:none;">
            <div class="coupon-title">🎉 CHÚC MỪNG BẠN! 🎉</div>
            <p style="margin: 10px 0; font-size: 16px; color: #333;">Mã giảm giá của bạn:</p>
            <div class="coupon-container">
                <input type="text" id="couponCode" readonly class="coupon-input">
                <button onclick="copyCoupon()" class="copy-btn">📋 Sao chép</button>
            </div>
            <p id="copyStatus" class="copy-status"></p>
        </div>
    </div>
</div>

<script>
    const prizes = ["10%", "15%", "20%", "25%", "Chúc bạn may mắn"];
    const couponCodes = {
        "10%": "LUCKY10",
        "15%": "SUPER15",
        "20%": "MEGA20",
        "25%": "ULTRA25"
    };
    const colors = [
        "#FFD700", // Gold
        "#FF6347", // Tomato
        "#32CD32", // Lime Green
        "#00CED1", // Dark Turquoise
        "#FF69B4"  // Hot Pink
    ];

    let anglePerSlice = 360 / prizes.length;
    let canvas, ctx;
    let hasSpun = false;

    // Khởi tạo trang - Kiểm tra localStorage và hiển thị popup nếu chưa quay
    document.addEventListener('DOMContentLoaded', () => {
        createParticles();

        // Kiểm tra đã quay chưa từ localStorage
        const hasSpunBefore = localStorage.getItem('hasSpunWheel') === 'true';

        if (!hasSpunBefore) {
            // Chưa quay -> hiển thị popup
            showWheelPopup();
        }
        // Nếu đã quay rồi -> không hiển thị popup
    });

    // Hiển thị popup vòng quay
    function showWheelPopup() {
        document.getElementById('popup').style.display = 'flex';
        canvas = document.getElementById('wheel');
        ctx = canvas.getContext('2d');
        drawWheel();
    }

    function createParticles() {
        const particlesContainer = document.getElementById('particles');
        for (let i = 0; i < 50; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 6 + 's';
            particle.style.animationDuration = (Math.random() * 3 + 3) + 's';
            particlesContainer.appendChild(particle);
        }
    }

    function drawWheel() {
        const centerX = 130;
        const centerY = 130;
        const radius = 130;

        // Vẽ các ô từ vị trí 12h và theo chiều kim đồng hồ
        for (let i = 0; i < prizes.length; i++) {
            const startAngle = (i * anglePerSlice - 90) * Math.PI / 180;
            const endAngle = ((i + 1) * anglePerSlice - 90) * Math.PI / 180;

            ctx.beginPath();
            ctx.fillStyle = colors[i];
            ctx.moveTo(centerX, centerY);
            ctx.arc(centerX, centerY, radius, startAngle, endAngle);
            ctx.lineTo(centerX, centerY);
            ctx.fill();

            // Add border
            ctx.strokeStyle = 'rgba(255,255,255,0.8)';
            ctx.lineWidth = 3;
            ctx.stroke();

            // Add text
            ctx.save();
            ctx.translate(centerX, centerY);
            const midAngle = (startAngle + endAngle) / 2;
            ctx.rotate(midAngle);
            ctx.textAlign = "center";
            ctx.fillStyle = "#000";
            ctx.font = "bold 14px Poppins";
            ctx.shadowColor = "rgba(255,255,255,0.8)";
            ctx.shadowBlur = 2;
            ctx.fillText(prizes[i], radius * 0.7, 5);
            ctx.restore();
        }
    }

    function spinWheel() {
        if (hasSpun) {
            alert("🎯 Bạn chỉ được quay 1 lần duy nhất!");
            return;
        }

        // Kiểm tra lại từ localStorage
        if (localStorage.getItem('hasSpunWheel') === 'true') {
            alert("🎯 Bạn đã quay rồi! Mỗi tài khoản chỉ được quay 1 lần.");
            return;
        }

        hasSpun = true;
        const spinBtn = document.getElementById('spinBtn');
        spinBtn.disabled = true;
        spinBtn.innerHTML = "🎲 ĐANG QUAY...";

        // Chọn ngẫu nhiên một giải thưởng
        const randomIndex = Math.floor(Math.random() * prizes.length);
        const degreesPerSlice = 360 / prizes.length;
        const targetAngle = randomIndex * degreesPerSlice + degreesPerSlice / 2;
        const totalRotation = 360 * 8 + (360 - targetAngle);

        canvas.style.transform = `rotate(${totalRotation}deg)`;

        // Lưu trạng thái đã quay vào localStorage
        const spinData = {
            hasSpun: true,
            prize: prizes[randomIndex],
            prizeIndex: randomIndex,
            spinTime: new Date().toISOString()
        };

        localStorage.setItem('hasSpunWheel', 'true');
        localStorage.setItem('wheelSpinData', JSON.stringify(spinData));

        // Hiển thị kết quả sau khi quay xong
        setTimeout(() => {
            showResult(randomIndex);
            spinBtn.innerHTML = "✅ ĐÃ HOÀN THÀNH";

            // Tự động đóng popup sau 8 giây
            setTimeout(() => {
                closePopup();
            }, 8000);
        }, 4000);
    }

    function showResult(randomIndex) {
        const prize = prizes[randomIndex];
        const resultDiv = document.getElementById("result");

        if (prize === "Chúc bạn may mắn") {
            resultDiv.innerHTML = "🍀 " + prize + " lần sau nhé!";
            resultDiv.style.color = "#ff6b6b";
        } else {
            resultDiv.innerHTML = `🎊 Bạn nhận được mã giảm ${prize}!`;
            resultDiv.style.color = "#4CAF50";
            showCoupon(prize);
        }
    }

    function showCoupon(discount) {
        const couponCode = couponCodes[discount] + '-' + Date.now();
        document.getElementById('couponCode').value = couponCode;
        document.getElementById('couponResult').style.display = 'block';

        // Lưu mã coupon vào localStorage
        const existingData = JSON.parse(localStorage.getItem('wheelSpinData') || '{}');
        existingData.couponCode = couponCode;
        localStorage.setItem('wheelSpinData', JSON.stringify(existingData));
    }

    function copyCoupon() {
        const couponInput = document.getElementById('couponCode');

        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(couponInput.value).then(() => {
                showCopySuccess();
            }).catch(() => {
                fallbackCopy(couponInput);
            });
        } else {
            fallbackCopy(couponInput);
        }
    }

    function fallbackCopy(couponInput) {
        couponInput.select();
        couponInput.setSelectionRange(0, 99999);

        try {
            document.execCommand('copy');
            showCopySuccess();
        } catch (err) {
            const status = document.getElementById('copyStatus');
            status.innerHTML = "❌ Không thể sao chép tự động. Vui lòng chọn và copy thủ công!";
            status.style.color = "#ff6b6b";
        }
    }

    function showCopySuccess() {
        const status = document.getElementById('copyStatus');
        status.innerHTML = "✅ Đã sao chép mã giảm giá thành công!";
        status.style.color = "#4CAF50";

        setTimeout(() => {
            status.innerHTML = "";
        }, 3000);
    }

    function closePopup() {
        document.getElementById('popup').style.animation = 'fadeOut 0.3s ease-out forwards';
        setTimeout(() => {
            document.getElementById('popup').style.display = 'none';
        }, 300);
    }

    // Debug function - xóa dữ liệu để test lại
    function resetWheelData() {
        localStorage.removeItem('hasSpunWheel');
        localStorage.removeItem('wheelSpinData');
        console.log('🔄 Đã reset dữ liệu vòng quay!');
        location.reload();
    }


</script>

</body>
</html> --}}
