@extends('layouts.user')

@section('content')
<div class="container mx-auto py-10 px-4">
    <h2 class="text-3xl font-extrabold text-center text-indigo-700 mb-6">🎁 Điểm Danh Nhận Quà Mỗi Ngày</h2>

    <div class="bg-white shadow-xl rounded-2xl p-6 max-w-4xl mx-auto">
        <!-- Điều hướng tháng -->
        <div class="flex justify-between items-center mb-6">
            <button onclick="prevMonth()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold px-6 py-3 rounded-lg">
                ⬅️ Tháng trước
            </button>
            <h3 class="text-2xl font-bold text-gray-800">
                <span id="month-name">Tháng 7</span> <span id="current-year">2025</span>
            </h3>
            <button onclick="nextMonth()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold px-6 py-3 rounded-lg">
                Tháng sau ➡️
            </button>
        </div>

        <!-- Tiêu đề thứ trong tuần -->
        <div class="grid grid-cols-7 gap-2 mb-4">
            <div class="text-center font-bold text-red-600 py-3 bg-red-50 rounded">Chủ Nhật</div>
            <div class="text-center font-bold text-gray-700 py-3 bg-gray-50 rounded">Thứ 2</div>
            <div class="text-center font-bold text-gray-700 py-3 bg-gray-50 rounded">Thứ 3</div>
            <div class="text-center font-bold text-gray-700 py-3 bg-gray-50 rounded">Thứ 4</div>
            <div class="text-center font-bold text-gray-700 py-3 bg-gray-50 rounded">Thứ 5</div>
            <div class="text-center font-bold text-gray-700 py-3 bg-gray-50 rounded">Thứ 6</div>
            <div class="text-center font-bold text-blue-600 py-3 bg-blue-50 rounded">Thứ 7</div>
        </div>

        <!-- Bảng lịch -->
        <div id="calendar-grid" class="grid grid-cols-7 gap-2 mb-8">
            <!-- Các ngày sẽ được tạo bởi JavaScript -->
        </div>

        <!-- Nút điểm danh -->
      <!-- Nút điểm danh -->
<div class="text-center mb-8">
    @auth
        <button onclick="checkInToday()" id="checkin-btn" class="bg-green-500 hover:bg-green-600 text-white font-bold px-8 py-4 rounded-full text-lg">
            ✅ Điểm danh hôm nay
        </button>
    @else
        <button disabled class="bg-gray-400 text-white font-bold px-8 py-4 rounded-full text-lg cursor-not-allowed">
            🔒 Vui lòng đăng nhập để điểm danh
        </button>
    @endauth
    <p id="reward-info" class="mt-6 text-lg font-semibold text-pink-600"></p>
</div>


        <!-- Thống kê -->
        <div class="bg-purple-100 rounded-xl p-6 mb-8">
            <h4 class="text-xl font-bold text-center text-gray-800 mb-4">📊 Thống kê điểm danh tháng này</h4>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                <div class="bg-white rounded-lg p-4">
                    <div class="text-2xl font-bold text-green-600" id="total-checkins">0</div>
                    <div class="text-sm text-gray-600">Tổng điểm danh</div>
                </div>
                <div class="bg-white rounded-lg p-4">
                    <div class="text-2xl font-bold text-blue-600" id="streak-count">0</div>
                    <div class="text-sm text-gray-600">Chuỗi liên tiếp</div>
                </div>
                <div class="bg-white rounded-lg p-4">
                    <div class="text-2xl font-bold text-orange-600" id="remaining-days">0</div>
                    <div class="text-sm text-gray-600">Còn lại trong tháng</div>
                </div>
                <div class="bg-white rounded-lg p-4">
                    <div class="text-2xl font-bold text-purple-600" id="completion-rate">0%</div>
                    <div class="text-sm text-gray-600">Tỷ lệ hoàn thành</div>
                </div>
            </div>
        </div>

        <!-- Mốc phần thưởng -->
        <div class="max-w-4xl mx-auto">
            <h4 class="text-2xl font-bold text-center text-gray-800 mb-6">🎯 Mốc phần thưởng</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Quà 7 ngày -->
                <div class="bg-white shadow-lg rounded-xl p-6 text-center border-2 border-indigo-200" id="reward-7">
                    <div class="text-4xl mb-4">🥿</div>
                    <h5 class="text-xl font-bold text-indigo-700 mb-2">7 ngày</h5>
                    <p class="text-gray-600 mb-3">🎁 Nhận <b>phụ kiện giày</b></p>
                    <div class="bg-gray-200 rounded-full h-3 mb-2">
                        <div id="progress-bar-7" class="bg-indigo-500 h-3 rounded-full" style="width: 0%"></div>
                    </div>
                    <span id="progress-7" class="text-indigo-600 font-bold text-lg">0/7</span>
                </div>
                <!-- Quà 15 ngày -->
                <div class="bg-white shadow-lg rounded-xl p-6 text-center border-2 border-pink-200" id="reward-15">
                    <div class="text-4xl mb-4">🧦</div>
                    <h5 class="text-xl font-bold text-pink-600 mb-2">15 ngày</h5>
                    <p class="text-gray-600 mb-3">🎁 Nhận <b>đôi tất thể thao</b></p>
                    <div class="bg-gray-200 rounded-full h-3 mb-2">
                        <div id="progress-bar-15" class="bg-pink-500 h-3 rounded-full" style="width: 0%"></div>
                    </div>
                    <span id="progress-15" class="text-pink-600 font-bold text-lg">0/15</span>
                </div>
                <!-- Quà 30 ngày -->
                <div class="bg-white shadow-lg rounded-xl p-6 text-center border-2 border-yellow-300" id="reward-30">
                    <div class="text-4xl mb-4">🎟️</div>
                    <h5 class="text-xl font-bold text-yellow-600 mb-2">30 ngày</h5>
                    <p class="text-gray-600 mb-3">🎁 Nhận <b>phiếu mua hàng 100K</b></p>
                    <div class="bg-gray-200 rounded-full h-3 mb-2">
                        <div id="progress-bar-30" class="bg-yellow-500 h-3 rounded-full" style="width: 0%"></div>
                    </div>
                    <span id="progress-30" class="text-yellow-600 font-bold text-lg">0/30</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .calendar-day {
        min-height: 60px;
        padding: 8px;
        border-radius: 8px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: #475569;
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid transparent;
    }

    .calendar-day:hover {
        background: #e0f2fe;
        transform: translateY(-2px);
    }

    .calendar-day.empty {
        background: transparent;
        cursor: default;
        border: none;
    }

    .calendar-day.empty:hover {
        background: transparent;
        transform: none;
    }

    .calendar-day.checked {
        background: linear-gradient(135deg, #4ade80, #16a34a);
        color: white;
        border-color: #15803d;
    }

    .calendar-day.checked::after {
        content: " ✅";
        margin-left: 4px;
    }

    .calendar-day.today {
        border: 3px dashed #f59e0b;
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        animation: pulse 2s infinite;
    }

    .calendar-day.future {
        background: #f1f5f9;
        color: #94a3b8;
        cursor: not-allowed;
    }

    .calendar-day.future:hover {
        background: #f1f5f9;
        transform: none;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
</style>

<script>
       const isLoggedIn = @json(auth()->check());
    // Biến toàn cục
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    const monthNames = [
        "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6",
        "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
    ];

    // Hàm tạo bảng lịch
    function createCalendar() {
        const calendarGrid = document.getElementById("calendar-grid");
        const monthNameEl = document.getElementById("month-name");
        const yearEl = document.getElementById("current-year");

        if (!calendarGrid) {
            console.error("Không tìm thấy calendar-grid element");
            return;
        }

        // Cập nhật tiêu đề
        monthNameEl.textContent = monthNames[currentMonth];
        yearEl.textContent = currentYear;

        // Xóa nội dung cũ
        calendarGrid.innerHTML = "";

        // Tính toán ngày đầu tiên của tháng và số ngày trong tháng
        const firstDay = new Date(currentYear, currentMonth, 1);
        const firstDayIndex = firstDay.getDay(); // Chủ nhật = 0
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

        const today = new Date();
        const isCurrentMonth = currentMonth === today.getMonth() && currentYear === today.getFullYear();

        // Tạo 42 ô (6 tuần x 7 ngày)
        for (let i = 0; i < 42; i++) {
            const dayElement = document.createElement("div");
            dayElement.className = "calendar-day";

            if (i < firstDayIndex) {
                // Ô trống đầu tháng
                dayElement.classList.add("empty");
                dayElement.textContent = "";
            } else if (i >= firstDayIndex + daysInMonth) {
                // Ô trống cuối tháng
                dayElement.classList.add("empty");
                dayElement.textContent = "";
            } else {
                // Ngày trong tháng
                const dayNumber = i - firstDayIndex + 1;
                dayElement.textContent = dayNumber;

                const dateKey = `checkin-${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(dayNumber).padStart(2, '0')}`;

                // Kiểm tra ngày hôm nay
                if (isCurrentMonth && dayNumber === today.getDate()) {
                    dayElement.classList.add("today");

                    // Thêm sự kiện click cho ngày hôm nay
                    if (!localStorage.getItem(dateKey)) {
                        dayElement.addEventListener("click", checkInToday);
                    }
                }

                // Kiểm tra ngày tương lai
                if (isCurrentMonth && dayNumber > today.getDate()) {
                    dayElement.classList.add("future");
                }

                // Kiểm tra đã điểm danh
                if (localStorage.getItem(dateKey)) {
                    dayElement.classList.add("checked");
                }
            }

            calendarGrid.appendChild(dayElement);
        }

        updateStats();
    }

    // Điều hướng tháng
    function prevMonth() {
        if (currentMonth === 0) {
            currentMonth = 11;
            currentYear--;
        } else {
            currentMonth--;
        }
        createCalendar();
        updateRewardProgress();
    }

    function nextMonth() {
        if (currentMonth === 11) {
            currentMonth = 0;
            currentYear++;
        } else {
            currentMonth++;
        }
        createCalendar();
        updateRewardProgress();
    }

    // Điểm danh hôm nay
function checkInToday() {
    if (!isLoggedIn) {
        alert("⚠️ Bạn cần đăng nhập để điểm danh!");
        return;
    }

    const now = new Date();
    const dateKey = `checkin-${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}-${String(now.getDate()).padStart(2, '0')}`;

    if (localStorage.getItem(dateKey)) {
        alert("✅ Bạn đã điểm danh hôm nay rồi!");
        return;
    }

    localStorage.setItem(dateKey, "true");
    alert("🎉 Điểm danh thành công!");

    createCalendar();
    showReward();
    updateRewardProgress();

    const btn = document.getElementById("checkin-btn");
    btn.textContent = "✅ Đã điểm danh hôm nay";
    btn.className = "bg-gray-500 text-white font-bold px-8 py-4 rounded-full text-lg cursor-not-allowed";
    btn.disabled = true;
}


    // Đếm số ngày điểm danh trong tháng
    function countCheckInsThisMonth() {
        const month = currentMonth + 1;
        const year = currentYear;
        let count = 0;
        const daysInMonth = new Date(year, month, 0).getDate();

        for (let day = 1; day <= daysInMonth; day++) {
            const key = `checkin-${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            if (localStorage.getItem(key)) count++;
        }
        return count;
    }

    // Tính chuỗi điểm danh liên tiếp
    function calculateStreak() {
        const today = new Date();
        let streak = 0;
        let checkDate = new Date(today);

        while (true) {
            const key = `checkin-${checkDate.getFullYear()}-${String(checkDate.getMonth() + 1).padStart(2, '0')}-${String(checkDate.getDate()).padStart(2, '0')}`;
            if (localStorage.getItem(key)) {
                streak++;
                checkDate.setDate(checkDate.getDate() - 1);
            } else {
                break;
            }
        }
        return streak;
    }

    // Cập nhật thống kê
    function updateStats() {
        const count = countCheckInsThisMonth();
        const streak = calculateStreak();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
        const today = new Date();
        const currentDay = currentMonth === today.getMonth() && currentYear === today.getFullYear() ? today.getDate() : daysInMonth;
        const remaining = Math.max(0, daysInMonth - currentDay);
        const completionRate = Math.round((count / daysInMonth) * 100);

        document.getElementById("total-checkins").textContent = count;
        document.getElementById("streak-count").textContent = streak;
        document.getElementById("remaining-days").textContent = remaining;
        document.getElementById("completion-rate").textContent = completionRate + "%";
    }

    // Cập nhật tiến độ phần thưởng
    function updateRewardProgress() {
        const count = countCheckInsThisMonth();

        const rewards = [
            { days: 7, progressId: "progress-7", barId: "progress-bar-7" },
            { days: 15, progressId: "progress-15", barId: "progress-bar-15" },
            { days: 30, progressId: "progress-30", barId: "progress-bar-30" }
        ];

        rewards.forEach(reward => {
            const progress = Math.min(count, reward.days);
            const percentage = (progress / reward.days) * 100;

            document.getElementById(reward.progressId).textContent = `${progress}/${reward.days}`;
            document.getElementById(reward.barId).style.width = percentage + "%";
        });
    }

    // Hiển thị thông tin phần thưởng
    function showReward() {
        const count = countCheckInsThisMonth();
        const rewardInfo = document.getElementById("reward-info");

        if (count >= 30) {
            rewardInfo.innerHTML = `🥳 Xuất sắc! Bạn đã điểm danh <b>${count}</b> ngày.<br>🎁 Phần quà: <b>Phiếu mua hàng 100K</b>`;
        } else if (count >= 15) {
            rewardInfo.innerHTML = `🎉 Tuyệt vời! Bạn đã điểm danh <b>${count}</b> ngày.<br>🎁 Phần quà: <b>Đôi tất thể thao</b>`;
        } else if (count >= 7) {
            rewardInfo.innerHTML = `👍 Làm tốt lắm! Bạn đã điểm danh <b>${count}</b> ngày.<br>🎁 Phần quà: <b>Phụ kiện giày miễn phí</b>`;
        } else {
            const remaining = 7 - count;
            rewardInfo.innerHTML = `📅 Bạn đã điểm danh <b>${count}</b> ngày. Còn <b>${remaining}</b> ngày nữa để nhận quà đầu tiên! 💪`;
        }
    }

    // Khởi tạo khi trang load
    document.addEventListener("DOMContentLoaded", function() {
        console.log("Trang đã load, khởi tạo calendar...");

        // Tạo bảng lịch
        createCalendar();
        showReward();
        updateRewardProgress();

        // Kiểm tra trạng thái button điểm danh
        const today = new Date();
        const todayKey = `checkin-${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, '0')}-${String(today.getDate()).padStart(2, '0')}`;
        const checkinBtn = document.getElementById("checkin-btn");

        if (localStorage.getItem(todayKey)) {
            checkinBtn.textContent = "✅ Đã điểm danh hôm nay";
            checkinBtn.className = "bg-gray-500 text-white font-bold px-8 py-4 rounded-full text-lg cursor-not-allowed";
            checkinBtn.disabled = true;
        }

        console.log("Calendar đã được khởi tạo!");
    });
</script>
@endsection
