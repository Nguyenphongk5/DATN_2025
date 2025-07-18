<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::where('is_active', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->whereRaw('used_count < quantity')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.vouchers.index', compact('vouchers'));
    }

    public function validateVoucher(Request $request): JsonResponse
    {
        $request->validate([
            'code' => 'required|string',
            'total_amount' => 'required|numeric|min:0'
        ]);

        $code = strtoupper(trim($request->code));
        $totalAmount = (float) $request->total_amount;

        // Tìm voucher
        $voucher = Voucher::where('code', $code)
            ->where('is_active', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn.'
            ]);
        }

        // Kiểm tra số lượng đã sử dụng
        if ($voucher->used_count >= $voucher->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá đã được sử dụng hết.'
            ]);
        }

        // Kiểm tra điều kiện giá trị đơn hàng
        if ($totalAmount < $voucher->min_money) {
            return response()->json([
                'success' => false,
                'message' => "Đơn hàng tối thiểu phải từ " . number_format($voucher->min_money, 0, ',', '.') . " VNĐ."
            ]);
        }

        if ($totalAmount > $voucher->max_money) {
            return response()->json([
                'success' => false,
                'message' => "Đơn hàng tối đa chỉ được " . number_format($voucher->max_money, 0, ',', '.') . " VNĐ."
            ]);
        }

        // Kiểm tra số lần user đã dùng voucher này (không cần bảng mới)
        $user = Auth::user();
        if ($user) {
            $userUsed = Order::where('user_id', $user->id)
                ->where('voucher_id', $voucher->id)
                ->count();

            if ($userUsed >= $voucher->user_limit) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn đã sử dụng hết số lần cho phép với mã này.'
                ]);
            }
        }

        // Tính toán giảm giá
        $discountAmount = 0;
        if ($voucher->discount_type === 'percent') {
            $discountAmount = $totalAmount * $voucher->discount_value / 100;
        } else {
            $discountAmount = $voucher->discount_value;
        }

        // Đảm bảo giảm giá không vượt quá tổng tiền
        $discountAmount = min($discountAmount, $totalAmount);

        $discountText = $voucher->discount_type === 'percent' 
            ? $voucher->discount_value . '%' 
            : number_format($voucher->discount_value, 0, ',', '.') . ' VNĐ';

        return response()->json([
            'success' => true,
            'message' => "Áp dụng thành công! Giảm giá: " . $discountText,
            'discount_amount' => $discountAmount,
            'voucher' => [
                'id' => $voucher->id,
                'code' => $voucher->code,
                'discount_type' => $voucher->discount_type,
                'discount_value' => $voucher->discount_value
            ]
        ]);
    }
} 