<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscribeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $data = $request->only('name', 'email');
        $data['coupon'] = 'GIAY10OFF'; // mã giảm giá cố định, hoặc bạn có thể random

        // Gửi cho ADMIN
        Mail::send('emails.admin_notify', $data, function ($message) use ($data) {
            $message->to('phongnvph50612@gmail.com')
                    ->subject('New Subscriber: ' . $data['name']);
        });

        // Gửi cho KHÁCH HÀNG
        Mail::send('emails.customer_coupon', $data, function ($message) use ($data) {
            $message->to($data['email'])
                    ->subject('🎁 Mã giảm giá 10% cho đơn hàng đầu tiên của bạn!');
        });

        return back()->with('success', 'Cảm ơn bạn đã đăng ký! Mã giảm giá đã được gửi qua email.');
    }
}
