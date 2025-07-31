<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AdminOtpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra user đã đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Kiểm tra user có phải admin không
        if (!$user->isAdmin()) {
            return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập trang quản trị!');
        }

        // Kiểm tra đã xác thực OTP chưa
        if (!Session::get('admin_otp_verified')) {
            return redirect()->route('admin.otp.form');
        }

        // Kiểm tra OTP có hết hạn không (24 giờ)
        $verifiedAt = Session::get('admin_otp_verified_at');
        if ($verifiedAt && now()->diffInHours($verifiedAt) > 24) {
            Session::forget('admin_otp_verified');
            Session::forget('admin_otp_verified_at');
            return redirect()->route('admin.otp.form')->with('error', 'Phiên đăng nhập đã hết hạn, vui lòng xác thực lại!');
        }

        return $next($request);
    }
} 