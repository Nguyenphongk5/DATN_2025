<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        // Debug: Kiểm tra user có đăng nhập không
        // if (!Auth::check()) {
        //     abort(403, 'Bạn chưa đăng nhập.');
        // }
        // // Lấy user hiện tại
        // $user = Auth::user();

        // // Debug: Kiểm tra role của user
        // if ($user->role !== User::ROLE_ADMIN && $user->role !== User::ROLE_STAFF) {
        //     abort(403, 'Bạn không có quyền truy cập. Role hiện tại: ' . $user->role);
        // }
        if(Auth::check() && (Auth::user()->role === User::ROLE_ADMIN || Auth::user()->role === User::ROLE_STAFF)) {
            // Người dùng có quyền truy cập
            return $next($request);
        }

        abort(403, 'Bạn không có quyền truy cập vào trang này.');
    }
}
