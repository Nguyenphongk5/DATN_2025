<?php

namespace App\Http\Controllers;

use App\Models\{Cart, Logo, Order, OrderDetail, ProductVariant, Voucher};
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Validator};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSuccessMail;
use App\Mail\NewOrderNotification;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // Chỉ xóa session voucher khi là GET (không phải AJAX/POST)
        if ($request->isMethod('get') && !$request->ajax()) {
            session()->forget(['applied_coupon', 'discount_amount', 'voucher_success']);
        }
        $cart = Cart::with(['items.productVariant.product'])
            ->where('user_id', Auth::id())
            ->first();

        // if (!$cart || $cart->items->isEmpty()) {
        //     return redirect()->route('cart.index')
        //         ->with('error', 'Giỏ hàng của bạn đang trống.');
        // }

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
        $logo = Logo::where('is_active', 1)->first();
        $vouchers = \App\Models\Voucher::where('is_active', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->whereColumn('used_count', '<', 'quantity')
            ->get();
        return view('user.order', compact('cart', 'logo', 'vouchers'));
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
        if (strlen($request->name) < 3) {
            return back()->withInput($request->only('name', 'phone', 'address', 'note', 'payment_method', 'shipping_method'))
                ->with('error', 'Tên người nhận phải có ít nhất 3 ký tự.');
        }
        if (strlen($request->phone) < 10 || strlen($request->phone) > 10) {
            return back()->withInput($request->only('name', 'phone', 'address', 'note', 'payment_method', 'shipping_method'))
                ->with('error', 'Số điện thoại không hợp lệ.');
        }
        if (strlen($request->address) < 5) {
            return back()->withInput($request->only('name', 'phone', 'address', 'note', 'payment_method', 'shipping_method'))
                ->with('error', 'Địa chỉ nhận hàng phải có ít nhất 5 ký tự.');
        }

        $user = Auth::user();
        // 1) tổng tiền (đã gửi từ form) ─ nếu =0 sẽ tự tính lại
        $totalAmount = (float) $request->input('total_amount', 0);
        if ($totalAmount <= 0) {
            $totalAmount = Cart::where('user_id', Auth::id())
                ->with('items.productVariant.product')
                ->first()
                ?->items
                ->sum(fn($i) => ($i->productVariant?->price ?? $i->product?->price ?? 0) * $i->quantity);
        }

        // 2) cờ đã thanh toán
        $isPaid = $request->input('paid_confirmed') == 1 && $request->payment_method === 'online';

        // 3) tạo đơns

        /* Lấy giỏ & lọc theo session selected_items */
        // $cart = Cart::with(['items.productVariant.product'])
        //     ->where('user_id', Auth::id())
        //     ->first();

        // $ids = session('selected_items', []);          // mảng id
        // if ($ids) {
        //     $cart->setRelation(
        //         'items',
        //         $cart->items->whereIn('id', $ids)->values()
        //     );
        // }

        // if (!$cart || $cart->items->isEmpty()) {
        //     return redirect()->route('cart.index')
        //         ->with('error', 'Không có sản phẩm nào để đặt hàng.');
        // }

        // /* ---------- Tính tổng tiền & voucher ---------- */
        // // $totalAmount = 0;
        // // foreach ($cart->items as $item) {
        // //     $price = $item->productVariant?->price ?? $item->product?->price ?? 0;
        // //     $totalAmount += $price * $item->quantity;
        // // }

        // $voucher        = null;
        // $discountAmount = 0;

        // if ($request->filled('voucher_code')) {
        //     $voucherCode = strtoupper(trim($request->voucher_code));
        //     $voucher = Voucher::whereRaw('UPPER(code) = ?', [$voucherCode])
        //         ->where('is_active', 1)
        //         ->where('start_date', '<=', now())
        //         ->where('end_date',   '>=', now())
        //         ->first();

        //     if (!$voucher)
        //         return back()->with('voucher_error', '❌ Mã giảm giá không hợp lệ hoặc đã hết hạn.');
        //     if ($voucher->used_count >= $voucher->quantity)
        //         return back()->with('voucher_error', '❌ Mã giảm giá đã được sử dụng hết.');
        //     if ($totalAmount < $voucher->min_money || $totalAmount > $voucher->max_money)
        //         return back()->with('voucher_error', '❌ Mã giảm giá không áp dụng cho đơn hàng này.');

        //     $discountAmount = $voucher->discount_type === 'percent'
        //         ? $totalAmount * $voucher->discount_value / 100
        //         : $voucher->discount_value;

        //     $discountAmount = min($discountAmount, $totalAmount);
        //     $totalAmount   -= $discountAmount;
        // }

        // /* ---------- Lưu Order ---------- */
        // DB::beginTransaction();
        // try {
        //     $order = Order::create([
        //         'user_id'         => $user->id,
        //         'user_name'       => $request->name,
        //         'user_email'      => $user->email,
        //         'user_phone'      => $request->phone,
        //         'user_address'    => $request->address,
        //         'voucher_id'      => $voucher?->id,
        //         'discount_amount' => $discountAmount,
        //         'total_amount'    => $totalAmount,
        //         'status'          => 'pending',
        //         'payment_method'  => $request->payment_method,
        //         'payment_status'  => $isPaid ? 'Paid' : 'Unpaid',
        //         'shipping_fee'    => 0,
        //         'shipping_method' => $request->shipping_method,
        //         'order_code'      => 'ODR-' . strtoupper(Str::random(10)),
        //         'note'            => $request->note,
        //     ]);

        // /* ---------- Gửi mail ---------- */


        // return redirect()->route('home')->with('success', '🎉 Đặt hàng thành công!');

        if (session('buy_now')) {
            $buyNow = session('buy_now');

            if (!$buyNow) {
                return redirect()->route('home')->with('error', 'Không có sản phẩm để mua ngay.');
            }

            $variant = ProductVariant::with('product')->where('product_id', $buyNow['product_id'])
                ->where('color_name', $buyNow['color_name'])
                ->where('size', $buyNow['size'])
                ->first();
            $product = Product::where('id', $buyNow['product_id'])->first();

            if (!$variant) {
                return redirect()->route('home')->with('error', 'Không tìm thấy biến thể sản phẩm.');
            }

            $totalAmount = $variant->price * $buyNow['quantity'];
            $discountAmount = 0;
            $voucher = null;


            $voucherCode = $request->input('voucher_code') ?? session('applied_coupon');
            if ($voucherCode) {
                $voucher = Voucher::where('code', $voucherCode)
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

                if ($totalAmount < $voucher->min_money || ($voucher->max_money !== null && $totalAmount > $voucher->max_money)) {
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
                    'user_id'         => $user->id,
                    'user_name'       => $request->name,
                    'user_email'      => $user->email,
                    'user_phone' => $request->phone,
                    'user_address' => $request->address,
                    'voucher_id' => $voucher?->id,
                    'discount_amount' => $discountAmount,
                    'total_amount' => $totalAmount,
                    'status' => $isPaid == 'Paid' ? 'confirmed' : 'pending',
                    'payment_method' => $request->payment_method,
                    'payment_status' => $isPaid ? 'Paid' : 'Unpaid',
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

                $variant = ProductVariant::find($variant->id); // đảm bảo dữ liệu mới nhất

                if ($variant->quantity < $buyNow['quantity']) {
                    return back()->with('error', 'Số lượng sản phẩm không đủ để đặt hàng.');
                }

                // Trừ tồn kho
                $variant->decrement('quantity', $buyNow['quantity']);
                $product->decrement('quantity', $buyNow['quantity']);
                // Nếu sau khi trừ tồn kho = 0 hoặc < 0, thì ngưng bán
                if ($variant->quantity - $buyNow['quantity'] <= 0) {
                    $variant->update(['is_active' => 0]);
                }

                if ($voucher) {
                    $voucher->increment('used_count');
                }

                DB::commit();
                if ($request->payment_method === 'online') {
                    $amount = $totalAmount; // VNPay yêu cầu số tiền tính bằng đồng
                    session()->forget('buy_now');

                    return app(\App\Http\Controllers\VnPayController::class)->createPayment($request, $amount, $order);
                }
                session()->forget('buy_now');
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
                return redirect()->route('orders.history')->with('success', 'Đặt hàng thành công (Mua ngay)!');
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('error', 'Lỗi mua ngay: ' . $e->getMessage());
            }
        } else {

            $cart = Cart::with(['items.productVariant.product'])
                ->where('user_id', $user->id)
                ->first();

            if (!$cart || $cart->items->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
            }

            $selectedIds = session('selected_items', []);
            $items = $cart->items;
            if (!empty($selectedIds)) {
                $items = $items->whereIn('id', $selectedIds)->values();
            }

            $totalAmount = $items->sum(function ($item) {
                $price = $item->productVariant?->price ?? ($item->product?->price ?? 0);
                return $price * $item->quantity;
            });
            $discountAmount = 0;
            $voucher = null;

            $voucherCode = $request->input('voucher_code') ?? session('applied_coupon');
            if ($voucherCode) {
                $voucher = Voucher::where('code', $voucherCode)
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

                if ($totalAmount < $voucher->min_money || ($voucher->max_money !== null && $totalAmount > $voucher->max_money)) {
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
                    'user_id' => $user->id,
                    'user_name' => $request->name,
                    'user_email' => $user->email,
                    'user_phone' => $request->phone,
                    'user_address' => $request->address,
                    'voucher_id' => $voucher?->id,
                    'discount_amount' => $discountAmount,
                    'total_amount' => $totalAmount,
                    'status' => $isPaid ? 'confirmed' : 'pending',
                    'payment_method' => $request->payment_method,
                    'payment_status' => $isPaid ? 'Paid' : 'Unpaid',
                    'shipping_fee' => 0,
                    'shipping_method' => $request->shipping_method,
                    'order_code' => 'ODR-' . strtoupper(Str::random(10)),
                    'note' => $request->note,
                ]);

                foreach ($items as $item) {
                    $variant = $item->productVariant;
                    $product = $variant?->product ?? $item->product;
                    $price = $variant?->price ?? ($product?->price ?? 0);

                    OrderDetail::create([
                        'order_id' => $order->id,
                        'product_variant_id' => $variant?->id,
                        'product_name' => $product?->name ?? 'Không rõ',
                        'size_name' => $variant?->size,
                        'color_name' => $variant?->color_name,
                        'quantity' => $item->quantity,
                        'price' => $price,
                    ]);
                }
                foreach ($items as $item) {
                    $variant = $item->productVariant;

                    // Kiểm tra trước khi trừ
                    if ($variant->quantity < $item->quantity) {
                        return back()->with('error', 'Số lượng sản phẩm không đủ để đặt hàng.');
                    }
                    Product::where( 'id', $variant->product_id)
                        ->decrement('quantity', $item->quantity);
                    // Trừ tồn kho
                    ProductVariant::where('id', $variant->id)
                        ->decrement('quantity', $item->quantity);

                    // Nếu tồn kho sau khi trừ = 0 → set is_active = 0
                    if ($variant->quantity - $item->quantity <= 0) {
                        ProductVariant::where('id', $variant->id)
                            ->update(['is_active' => 0]);
                    }
                    if ($product->quantity - $item->quantity <= 0) {
                        Product::where('id', $product->id)
                            ->update(['is_active' => 0]);
                    }
                }

                if ($voucher) {
                    $voucher->increment('used_count');
                }

                DB::commit();
                if ($request->payment_method === 'online') {
                    $selectedIds = session('selected_items', []);
                    if (!empty($selectedIds)) {
                        // Xóa chỉ những items đã chọn
                        $cart->items()->whereIn('id', $selectedIds)->delete();

                        // Kiểm tra nếu cart còn items thì giữ lại cart, không thì xóa
                        if ($cart->items()->count() == 0) {
                            $cart->delete();
                        }
                    } else {
                        // Nếu không có selected_items (chọn tất cả) thì xóa toàn bộ cart
                        $cart->items()->delete();
                        $cart->delete();
                    }
                    session()->forget('selected_items');

                    $amount = $totalAmount; // VNPay yêu cầu số tiền tính bằng đồng
                    return app(\App\Http\Controllers\VnPayController::class)->createPayment($request, $amount, $order);
                }
                // Chỉ xóa những sản phẩm đã được chọn
                $selectedIds = session('selected_items', []);
                if (!empty($selectedIds)) {
                    // Xóa chỉ những items đã chọn
                    $cart->items()->whereIn('id', $selectedIds)->delete();

                    // Kiểm tra nếu cart còn items thì giữ lại cart, không thì xóa
                    if ($cart->items()->count() == 0) {
                        $cart->delete();
                    }
                } else {
                    // Nếu không có selected_items (chọn tất cả) thì xóa toàn bộ cart
                    $cart->items()->delete();
                    $cart->delete();
                }

                session()->forget('selected_items');
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
                return redirect()->route('orders.history')->with('success', 'Đặt hàng thành công!');
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('error', 'Lỗi khi đặt hàng: ' . $e->getMessage());
            }
        }
    }

    public function ajaxApplyVoucher(Request $request)
    {
        $code = $request->input('voucher_code');
        $total = $request->input('total_amount');
        $voucher_id = $request->input('voucher_id');

        $voucher = \App\Models\Voucher::where('code', $code)
            ->where('is_active', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        if (!$voucher) {
            return response()->json(['success' => false, 'message' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn.']);
        }
        if ($voucher->quantity <= $voucher->used_count) {
            return response()->json(['success' => false, 'message' => 'Mã giảm giá đã được sử dụng hết.']);
        }
        if ($total < $voucher->min_money || ($voucher->max_money !== null && $total > $voucher->max_money)) {
            return response()->json(['success' => false, 'message' => 'Mã giảm giá không áp dụng cho đơn hàng này.']);
        }

        $discount = $voucher->discount_type === 'percent'
            ? $total * $voucher->discount_value / 100
            : $voucher->discount_value;
        $discount = min($discount, $total);
        session([
            'applied_coupon' => $code,
            'discount_amount' => $discount,
            'voucher_id' => $voucher_id,
            'voucher_success' => 'Áp dụng mã giảm giá thành công!',
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Áp dụng mã giảm giá thành công!',
            'discount' => $discount,
            'voucher_code' => $code,
            'voucher_id' => $voucher_id,
        ]);
    }

    // public function buyNow()
    // {
    //     $buyNow = session('buy_now');

    //     if (!$buyNow) {
    //         return redirect()->route('home')->with('error', 'Không có sản phẩm để mua ngay.');
    //     }

    //     $variant = ProductVariant::where('product_id', $buyNow['product_id'])
    //         ->where('color_name', $buyNow['color_name'])
    //         ->where('size', $buyNow['size'])
    //         ->first();

    //     if (!$variant) {
    //         return redirect()->route('home')->with('error', 'Không tìm thấy biến thể sản phẩm.');
    //     }

    //     return view('user.order', [
    //         'variant' => $variant,
    //         'quantity' => $buyNow['quantity'],
    //     ]);
    // }
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

    public function placeBuyNowOrder(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'phone' => 'required|string|max:50',
        //     'address' => 'required|string|max:255',
        //     'note' => 'nullable|string',
        //     'payment_method' => 'required|in:cod,online',
        //     'shipping_method' => 'required|in:standard,express',
        //     'voucher_code' => 'nullable|string',
        // ]);

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

    public function reorderCheckout()
    {
        $items = session('reorder_items');

        if (!$items || empty($items)) {
            return redirect()->route('home')->with('error', 'Không có sản phẩm để mua lại.');
        }

        // Lấy toàn bộ variant
        $variants = [];
        foreach ($items as $item) {
            $variant = ProductVariant::where('product_id', $item['product_id'])
                ->where('color_name', $item['color_name'])
                ->where('size', $item['size'])
                ->with('product')
                ->first();

            if ($variant) {
                $variants[] = [
                    'variant' => $variant,
                    'quantity' => $item['quantity'],
                ];
            }
        }

        if (empty($variants)) {
            return redirect()->route('home')->with('error', 'Không thể tìm thấy các sản phẩm để mua lại.');
        }

        return view('user.order', [
            'variants' => $variants,

        ]);
    }
}