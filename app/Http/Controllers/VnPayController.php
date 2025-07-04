<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class VnPayController extends Controller
{
  private function createVnpayUrl($amount, $order_id)
{
    $vnp_TmnCode = "5UUBMVCJ";
    $vnp_HashSecret = "D8CD62ZZATRY3PBUCBCFE2P6IX4S4MNN";
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = route('vnpay.return');

    $vnp_TxnRef = $order_id . '-' . time();
    $vnp_OrderInfo = "Thanh toán đơn hàng #" . $order_id;
    $vnp_Amount = $amount * 100; // Đơn vị VNPay là VND x 100
    $vnp_Locale = "vn";
    $vnp_BankCode = "NCB";
    $vnp_IpAddr = request()->ip();

    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => "other",
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
    );

    ksort($inputData);
    $query = "";
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
        $hashdata .= $key . "=" . $value . '&';
    }
    $query = rtrim($query, '&');
    $hashdata = rtrim($hashdata, '&');

    $vnp_SecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    $vnp_Url .= "?" . $query . '&vnp_SecureHash=' . $vnp_SecureHash;

    return $vnp_Url;
}


     public function vnpayReturn(Request $request)
    {
        $orderCode = $request->input('vnp_TxnRef'); // Mã đơn hàng
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');
        $vnp_Amount = $request->input('vnp_Amount') / 100;

        $order = Order::where('order_code', $orderCode)->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Không tìm thấy đơn hàng.');
        }

        if ($vnp_ResponseCode === '00') {
            // ✅ Thanh toán thành công
            $order->update([
                'payment_status' => 'Paid',
                'status' => 'confirmed'
            ]);
            return redirect()->route('home')->with('success', '🎉 Thanh toán thành công!');
        } else {
            return redirect()->route('home')->with('error', 'Thanh toán thất bại!');
        }
    }
}


