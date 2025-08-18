<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserVoucher;
use Carbon\Carbon;

class SpinWheelController extends Controller
{
    /**
     * Kiểm tra trạng thái đăng nhập
     */
    public function checkAuth()
    {
        return response()->json([
            'authenticated' => auth()->check(),
            'user' => auth()->check() ? auth()->user()->only(['id', 'name', 'email']) : null
        ]);
    }

    /**
     * Kiểm tra user đã quay hôm nay chưa
     */
    public function checkDailySpin()
    {
        // Kiểm tra đăng nhập
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng đăng nhập để sử dụng tính năng này.'
            ], 401);
        }

        $today = Carbon::today();

        $hasSpunToday = UserVoucher::where('user_id', auth()->id())
                                   ->whereDate('created_at', $today)
                                   ->exists();

        return response()->json([
            'has_spun_today' => $hasSpunToday,
            'message' => $hasSpunToday ? 'Bạn đã quay hôm nay rồi!' : 'Bạn có thể quay ngay bây giờ!'
        ]);
    }

    /**
     * Lưu voucher sau khi quay (chỉ cho phép 1 lần/ngày)
     */
    public function store(Request $request)
    {
        // Kiểm tra đăng nhập
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng đăng nhập để sử dụng tính năng này.'
            ], 401);
        }

        $voucherId = $request->input('voucher_id');
        $today = Carbon::today();

        // Kiểm tra đã quay hôm nay chưa
        $hasSpunToday = UserVoucher::where('user_id', auth()->id())
                                   ->whereDate('created_at', $today)
                                   ->exists();

        if ($hasSpunToday) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn đã quay hôm nay rồi! Vui lòng quay lại vào ngày mai.'
            ], 400);
        }

        try {
            $userVoucher = UserVoucher::create([
                'user_id'    => auth()->id(),
                'voucher_id' => $voucherId,
                'created_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Voucher đã được lưu thành công!',
                'data'    => $userVoucher
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lưu voucher!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Lấy lịch sử quay của user (tùy chọn)
     */
    public function getUserSpinHistory()
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng đăng nhập để xem lịch sử.'
            ], 401);
        }

        $history = UserVoucher::with('voucher')
                              ->where('user_id', auth()->id())
                              ->orderBy('created_at', 'desc')
                              ->paginate(10);

        return response()->json($history);
    }
}
