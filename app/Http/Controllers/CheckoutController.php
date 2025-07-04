<?php

namespace App\Http\Controllers;

use App\Models\{Cart, Order, OrderDetail, ProductVariant, Voucher};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSuccessMail;
use App\Mail\NewOrderNotification;

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
            'name'            => 'required|string|max:255',
            'phone'           => 'required|string|max:50',
            'address'         => 'required|string|max:255',
            'note'            => 'nullable|string',
            'payment_method'  => 'required|in:cod,online',
            'shipping_method' => 'required|in:standard,express',
            'voucher_code'    => 'nullable|string',
        ]);

        /* Lấy giỏ & lọc theo session selected_items */
        $cart = Cart::with(['items.productVariant.product'])
                    ->where('user_id', Auth::id())
                    ->first();

        $ids = session('selected_items', []);          // mảng id
        if ($ids) {
            $cart->setRelation(
                'items',
                $cart->items->whereIn('id', $ids)->values()
            );
        }

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                             ->with('error', 'Không có sản phẩm nào để đặt hàng.');
        }

        /* ---------- Tính tổng tiền & voucher ---------- */
        $totalAmount = 0;
        foreach ($cart->items as $item) {
            $price = $item->productVariant?->price ?? $item->product?->price ?? 0;
            $totalAmount += $price * $item->quantity;
        }

        $voucher        = null;
        $discountAmount = 0;

        if ($request->filled('voucher_code')) {
            $voucherCode = strtoupper(trim($request->voucher_code));
            $voucher = Voucher::whereRaw('UPPER(code) = ?', [$voucherCode])
                              ->where('is_active', 1)
                              ->where('start_date', '<=', now())
                              ->where('end_date',   '>=', now())
                              ->first();

            if (!$voucher)
                return back()->with('voucher_error', '❌ Mã giảm giá không hợp lệ hoặc đã hết hạn.');
            if ($voucher->used_count >= $voucher->quantity)
                return back()->with('voucher_error', '❌ Mã giảm giá đã được sử dụng hết.');
            if ($totalAmount < $voucher->min_money || $totalAmount > $voucher->max_money)
                return back()->with('voucher_error', '❌ Mã giảm giá không áp dụng cho đơn hàng này.');

            $discountAmount = $voucher->discount_type === 'percent'
                ? $totalAmount * $voucher->discount_value / 100
                : $voucher->discount_value;

            $discountAmount = min($discountAmount, $totalAmount);
            $totalAmount   -= $discountAmount;
        }

        /* ---------- Lưu Order ---------- */
        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id'         => Auth::id(),
                'user_name'       => $request->name,
                'user_email'      => Auth::user()->email,
                'user_phone'      => $request->phone,
                'user_address'    => $request->address,
                'voucher_id'      => $voucher?->id,
                'discount_amount' => $discountAmount,
                'total_amount'    => $totalAmount,
                'status'          => 'pending',
                'payment_method'  => $request->payment_method,
                'payment_status'  => 'Unpaid',
                'shipping_fee'    => 0,
                'shipping_method' => $request->shipping_method,
                'order_code'      => 'ODR-' . strtoupper(Str::random(10)),
                'note'            => $request->note,
            ]);

            foreach ($cart->items as $item) {
                $variant = $item->productVariant;
                $product = $variant?->product ?? $item->product;

                OrderDetail::create([
                    'order_id'           => $order->id,
                    'product_variant_id' => $variant?->id,
                    'product_name'       => $product?->name ?? 'Không rõ',
                    'size_name'          => $variant?->size ?? '-',
                    'color_name'         => $variant?->color_name ?? '-',
                    'quantity'           => $item->quantity,
                    'price'              => $variant?->price ?? $product?->price ?? 0,
                ]);
            }

            if ($voucher) $voucher->increment('used_count');

            /* Xoá cart DB */
            $cart->items()->delete();
            $cart->delete();

            DB::commit();
            /* Xoá session selected_items */
            session()->forget('selected_items');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Đặt hàng thất bại: '.$e->getMessage());
        }

        /* ---------- Gửi mail ---------- */
        $mailData = [
            'name'           => $request->name,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'note'           => $request->note,
            'total'          => $totalAmount,
            'payment_method' => $request->payment_method,
        ];

        Mail::to(Auth::user()->email)->send(new OrderSuccessMail($mailData));
        Mail::to('phongnvph50612@gmail.com')->send(new NewOrderNotification($mailData));

        return redirect()->route('home')->with('success', '🎉 Đặt hàng thành công!');
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


}
