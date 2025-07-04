<?php

namespace App\Http\Controllers;

use App\Models\{Cart, Order, OrderDetail, ProductVariant, Voucher};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSuccessMail;
use App\Mail\NewOrderNotification;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
   public function index(Request $request)
    {
        $cart = Cart::with(['items.productVariant.product'])
                    ->where('user_id', Auth::id())
                    ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                             ->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        /* -- Lọc sản phẩm đã chọn (từ query ?selected_items=1,3,5) -- */
        $selected = $request->input('selected_items');   // chuỗi "1,3,5"
        if ($selected) {
            $ids = array_filter(explode(',', $selected)); // thành mảng
            $cart->setRelation(
                'items',
                $cart->items->whereIn('id', $ids)->values()
            );
            /* Lưu lại ids để placeOrder() dùng */
            session(['selected_items' => $ids]);
        }

        return view('user.order', compact('cart'));
    }

    /* ================================================
     *  ĐẶT HÀNG cho giỏ – chỉ item đã chọn
     * ================================================ */
public function placeOrder(Request $request)
{
    $request->validate([
        'name'            => 'required|string',
        'phone'           => 'required|string',
        'address'         => 'required|string',
        'shipping_method' => 'required|string',
        'payment_method'  => 'required|string',
    ]);

    // 1) tổng tiền (đã gửi từ form) ─ nếu =0 sẽ tự tính lại
    $totalAmount = (float) $request->input('total_amount', 0);
    if ($totalAmount <= 0) {
        $totalAmount = Cart::where('user_id', Auth::id())
                           ->with('items.productVariant.product')
                           ->first()
                           ?->items
                           ->sum(fn ($i) => ($i->productVariant?->price ?? $i->product?->price ?? 0) * $i->quantity);
    }

    // 2) cờ đã thanh toán
    $isPaid = $request->input('paid_confirmed') == 1 && $request->payment_method === 'online';

    // 3) tạo đơn
   $order = Order::create([
    'order_code'      => 'ODR-' . strtoupper(Str::random(10)),
    'user_id'         => Auth::id(),
    'user_name'       => $request->name,
    'user_email'      => Auth::user()->email,
    'user_phone'      => $request->phone,
    'user_address'    => $request->address,
    'note'            => $request->note,
    'shipping_method' => $request->shipping_method,
    'payment_method'  => $request->payment_method,
    'payment_status'  => $isPaid ? 'Paid' : 'Unpaid',
    'status'          => 'pending',
    'total_amount'    => $isPaid ? 0 : $totalAmount,
    'discount_amount' => 0, // ✅ Thêm dòng này
]);
// Gửi email cho người đặt hàng
Mail::to(Auth::user()->email)->send(new OrderSuccessMail($order));

// Gửi email cho admin
Mail::to('phongnvph50612@gmail.com')->send(new NewOrderNotification($order));


    // (tuỳ bạn) lưu OrderDetail ở đây…

    // 4) xoá giỏ
 $cart = Cart::where('user_id', Auth::id())->first();
if ($cart) {
    $cart->items()->delete(); // Xóa các cart_items trước
    $cart->delete();          // Rồi mới xóa cart
}


   return redirect()->route('home')->with('success', 'Đặt hàng thành công!');

}




    public function buyNow()
    {
        $buyNow = session('buy_now');

        if (!$buyNow) {
            return redirect()->route('home')->with('error', 'Không có sản phẩm để mua ngay.');
        }

        $variant = ProductVariant::where('product_id', $buyNow['product_id'])
            ->where('color_name', $buyNow['color_name'])
            ->where('size', $buyNow['size'])
            ->first();

        if (!$variant) {
            return redirect()->route('home')->with('error', 'Không tìm thấy biến thể sản phẩm.');
        }

        return view('user.order', [
            'variant' => $variant,
            'quantity' => $buyNow['quantity'],
        ]);
    }

    public function placeBuyNowOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'note' => 'nullable|string',
            'payment_method' => 'required|in:cod,online',
            'shipping_method' => 'required|in:standard,express',
            'voucher_code' => 'nullable|string',
        ]);

        $buyNow = session('buy_now');

        if (!$buyNow) {
            return redirect()->route('home')->with('error', 'Không có sản phẩm để mua ngay.');
        }

        $variant = ProductVariant::with('product')->where('product_id', $buyNow['product_id'])
            ->where('color_name', $buyNow['color_name'])
            ->where('size', $buyNow['size'])
            ->first();

        if (!$variant) {
            return redirect()->route('home')->with('error', 'Không tìm thấy biến thể sản phẩm.');
        }

        $totalAmount = $variant->price * $buyNow['quantity'];
        $discountAmount = 0;
        $voucher = null;

        if ($request->filled('voucher_code')) {
            $voucher = Voucher::where('code', $request->voucher_code)
                ->where('is_active', 1)
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->first();

            if (!$voucher) {
                return back()->with('voucher_error', 'Mã giảm giá không hợp lệ hoặc đã hết hạn.');
            }

            if ($voucher->quantity <= $voucher->used_count) {
                return back()->with('voucher_error', 'Mã giảm giá đã được sử dụng hết.');
            }

            if ($totalAmount < $voucher->min_money || $totalAmount > $voucher->max_money) {
                return back()->with('voucher_error', 'Mã giảm giá không áp dụng cho đơn hàng này.');
            }

            if ($voucher->discount_type === 'percent') {
                $discountAmount = $totalAmount * $voucher->discount_value / 100;
            } else {
                $discountAmount = $voucher->discount_value;
            }

            $discountAmount = min($discountAmount, $totalAmount);
            $totalAmount -= $discountAmount;
        }

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'user_name' => $request->name,
                'user_email' => Auth::user()->email,
                'user_phone' => $request->phone,
                'user_address' => $request->address,
                'voucher_id' => $voucher?->id,
                'discount_amount' => $discountAmount,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'payment_status' => 'Unpaid',
                'shipping_fee' => 0,
                'shipping_method' => $request->shipping_method,
                'order_code' => 'ODR-' . strtoupper(Str::random(10)),
                'note' => $request->note,
            ]);

            OrderDetail::create([
                'order_id' => $order->id,
                'product_variant_id' => $variant->id,
                'product_name' => $variant->product?->name ?? 'Không rõ',
                'size_name' => $variant->size,
                'color_name' => $variant->color_name,
                'quantity' => $buyNow['quantity'],
                'price' => $variant->price,
            ]);

            if ($voucher) {
                $voucher->increment('used_count');
            }

            DB::commit();
            session()->forget('buy_now');

            return redirect()->route('home')->with('success', 'Đặt hàng thành công (Mua ngay)!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Lỗi mua ngay: ' . $e->getMessage());
        }
    }

    public function handlePayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string',
            'phone'   => 'required',
            'address' => 'required',
            'payment_method' => 'required|in:cod,vnpay',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->payment_method === 'vnpay') {
            // Lưu thông tin tạm trong session để dùng sau khi thanh toán
            session([
                'checkout_data' => $request->only(['name', 'phone', 'address', 'note', 'shipping_method']),
                'checkout_total' => 100000 // ← Thay bằng giá trị thực tế từ giỏ hàng hoặc mua ngay
            ]);

            return redirect()->route('vnpay.payment');
        }

        // Nếu là COD thì xử lý đơn hàng luôn ở đây
        // TODO: Code xử lý đơn hàng khi chọn COD
        return redirect()->route('home')->with('success', 'Đặt hàng COD thành công!');
    }

 public function vnpayReturn(Request $request)
{
    $vnp_ResponseCode = $request->input('vnp_ResponseCode');
    $orderCode        = $request->input('vnp_TxnRef');

    $order = Order::where('order_code', $orderCode)->first();

    if (!$order) {
        return redirect()->route('home')->with('error', 'Không tìm thấy đơn hàng.');
    }

    if ($vnp_ResponseCode === '00') {
        $order->update([
            'payment_status' => 'Paid',
            'status'         => 'confirmed',
        ]);

        return redirect()->route('home')->with('success', '🎉 Thanh toán thành công!');
    }

    return redirect()->route('home')->with('error', '❌ Thanh toán thất bại.');
}



}
