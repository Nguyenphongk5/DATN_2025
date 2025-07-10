<?php

namespace App\Http\Controllers;

use App\Mail\NewOrderNotification;
use App\Mail\OrderSuccessMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class VnPayController extends Controller
{
    public function createPayment(Request $request, $amount, $order)
    {
        // Validate input
        // $validator = Validator::make($request->all(), [
        //     'total_amount' => 'required|numeric|min:1000',
        // ]);
        // if ($validator->fails()) {
        //     dd('validate fail', $validator->errors(), $request->all());
        //     return back()->withErrors($validator)->withInput();
        // }
        // dd('validate ok', $request->all());

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return');
        $vnp_TmnCode = "5UUBMVCJ";
        $vnp_HashSecret = "D8CD62ZZATRY3PBUCBCFE2P6IX4S4MNN";

        // Tạo mã đơn hàng duy nhất
        $vnp_TxnRef = $order->order_code;
        $vnp_OrderInfo = 'Thanh toán đơn hàng tại Shop XYZ';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $amount * 100;
        $vnp_Locale = 'vn';
        // $vnp_BankCode = $request->input('bank_code');
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $startTime = date('YmdHis');
        // $expireTime = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => $startTime,
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            // "vnp_ExpireDate" => $expireTime,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != '') {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {
        $vnp_HashSecret = "D8CD62ZZATRY3PBUCBCFE2P6IX4S4MNN";
        // dd('vnpayReturn', $request->all());
        $inputData = $request->all();
        $vnp_SecureHash = $inputData['vnp_SecureHash'] ?? '';

        ksort($inputData);
        $hashData = urldecode(http_build_query($inputData));
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        // $orderCode = $request->input('vnp_TxnRef');
        $order = Order::where('order_code', $request->input('vnp_TxnRef'))->first();
        // dd($order);
        if (!$order) {
            return redirect()->route('home')->with('error', 'Không tìm thấy đơn hàng.');
        }


        if ($request->input('vnp_ResponseCode') === '00') {
            $order->update([
                'payment_status' => 'Paid',
            ]);
            $mailData = [
                    'name'           => $order->user_name,
                    'phone'          => $order->user_phone,
                    'address'        => $order->user_address,
                    'note'           => $order->note,
                    'total'          => $request->input('vnp_Amount') / 100, // VNPay trả về số tiền tính bằng đồng
                    'payment_method' => $order->payment_method,
                ];


                Mail::to(Auth::user()->email)->send(new OrderSuccessMail($mailData));
                Mail::to('phongnvph50612@gmail.com')->send(new NewOrderNotification($mailData));
            return redirect()->route('orders.history')->with('success', 'Thanh toán thành công!');
        } else {
            return redirect()->back()->with('error', 'Thanh toán thất bại!');
        }
    }
}