<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PolicyController extends Controller
{
    /**
     * Hiển thị trang chính sách bảo mật
     */
    public function privacy()
    {
        return view('user.policies.privacy');
    }

    /**
     * Hiển thị trang điều khoản sử dụng
     */
    public function terms()
    {
        return view('user.policies.terms');
    }

    /**
     * Hiển thị trang chính sách cookie
     */
    public function cookies()
    {
        return view('user.policies.cookies');
    }

    /**
     * Hiển thị trang chính sách đổi trả
     */
    public function returns()
    {
        return view('user.policies.returns');
    }

    /**
     * Hiển thị trang chính sách bảo hành
     */
    public function warranty()
    {
        return view('user.policies.warranty');
    }

    /**
     * Hiển thị trang chính sách vận chuyển
     */
    public function shipping()
    {
        return view('user.policies.shipping');
    }

    /**
     * Hiển thị trang FAQ
     */
    public function faq()
    {
        return view('user.policies.faq');
    }

    /**
     * Hiển thị trang hướng dẫn mua hàng
     */
    public function shoppingGuide()
    {
        return view('user.policies.shopping-guide');
    }

    /**
     * Hiển thị trang thanh toán an toàn
     */
    public function securePayment()
    {
        return view('user.policies.secure-payment');
    }
}
