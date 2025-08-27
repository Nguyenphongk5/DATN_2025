<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminOtp;
use App\Mail\AdminOtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class AdminOtpController extends Controller
{
    /**
     * Hiển thị form yêu cầu OTP
     */
    public function showOtpForm()
    {
        // Kiểm tra user đã đăng nhập và là admin
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect()->route('login')->with('error', 'Bạn không có quyền truy cập!');
        }

        // Kiểm tra đã xác thực OTP chưa
        if (Session::get('admin_otp_verified')) {
            return redirect()->route('admin.dashboard');
        }

        $user = Auth::user();
        
        // Kiểm tra xem đã có OTP hợp lệ chưa
        $existingOtp = AdminOtp::where('user_id', $user->id)
            ->where('is_used', false)
            ->where('expires_at', '>', now())
            ->first();

        if (!$existingOtp) {
            // Chỉ tạo OTP mới nếu chưa có OTP hợp lệ
            try {
                // Log thông tin user
                Log::info("Generating OTP for user: {$user->email}");
                
                $otp = AdminOtp::generateOtp(
                    $user->id,
                    request()->ip(),
                    request()->userAgent()
                );

                // Log thông tin OTP
                Log::info("OTP generated: {$otp->otp} for user: {$user->email}");

                // Gửi email
                Mail::to($user->email)->send(new AdminOtpMail($otp));
                
                // Log email sent
                Log::info("OTP email sent to: {$user->email}");

                return view('admin.auth.otp')->with('success', 'Mã OTP đã được gửi đến email của bạn!');
            } catch (\Exception $e) {
                Log::error("Error sending OTP: " . $e->getMessage());
                return view('admin.auth.otp')->with('error', 'Có lỗi xảy ra khi gửi OTP: ' . $e->getMessage());
            }
        } else {
            // Nếu đã có OTP hợp lệ, chỉ hiển thị form
            Log::info("Existing OTP found for user: {$user->email}, OTP: {$existingOtp->otp}");
            return view('admin.auth.otp')->with('info', 'Vui lòng nhập mã OTP đã được gửi trước đó!');
        }
    }

    /**
     * Gửi OTP qua email
     */
    public function sendOtp(Request $request)
    {
        $user = Auth::user();

        if (!$user->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn không có quyền truy cập!'
            ], 403);
        }

        try {
            // Tạo OTP mới
            $otp = AdminOtp::generateOtp(
                $user->id,
                $request->ip(),
                $request->userAgent()
            );

            // Gửi email OTP
            Mail::to($user->email)->send(new AdminOtpMail($otp));

            return response()->json([
                'success' => true,
                'message' => 'Mã OTP đã được gửi đến email của bạn!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi gửi OTP: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Xác thực OTP
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6'
        ]);

        $user = Auth::user();

        if (!$user->isAdmin()) {
            return redirect()->back()->with('error', 'Bạn không có quyền truy cập!');
        }

        // Kiểm tra OTP
        if (AdminOtp::verifyOtp($user->id, $request->otp)) {
            // Đánh dấu đã xác thực OTP
            Session::put('admin_otp_verified', true);
            Session::put('admin_otp_verified_at', now());

            return redirect()->route('admin.dashboard')->with('success', 'Xác thực OTP thành công!');
        }

        return redirect()->back()->with('error', 'Mã OTP không chính xác hoặc đã hết hạn!');
    }

    /**
     * Resend OTP
     */
    public function resendOtp(Request $request)
    {
        $user = Auth::user();

        if (!$user->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn không có quyền truy cập!'
            ], 403);
        }

        try {
            // Tạo OTP mới
            $otp = AdminOtp::generateOtp(
                $user->id,
                $request->ip(),
                $request->userAgent()
            );

            // Gửi email OTP
            Mail::to($user->email)->send(new AdminOtpMail($otp));

            return response()->json([
                'success' => true,
                'message' => 'Mã OTP mới đã được gửi!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi gửi OTP: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Logout admin (xóa session OTP)
     */
    public function logout()
    {
        Session::forget('admin_otp_verified');
        Session::forget('admin_otp_verified_at');
        
        return redirect()->route('home')->with('success', 'Đã đăng xuất khỏi trang quản trị!');
    }
} 