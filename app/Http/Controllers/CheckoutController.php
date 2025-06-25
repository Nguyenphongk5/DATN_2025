<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::with(['items.productVariant.product'])->where('user_id', Auth::id())->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        return view('user.order', compact('cart'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'note' => 'nullable|string',
            'payment_method' => 'required|in:cod,online',
            'shipping_method' => 'required|in:standard,express',
        ]);

        $cart = Cart::with(['items.productVariant.product'])->where('user_id', Auth::id())->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        DB::beginTransaction();

        try {
            $totalAmount = 0;

            foreach ($cart->items as $item) {
                $price = $item->productVariant?->price ?? $item->product?->price ?? 0;
                $totalAmount += $price * $item->quantity;
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'user_name' => $request->name,
                'user_email' => Auth::user()->email,
                'user_phone' => $request->phone,
                'user_address' => $request->address,
                'voucher_id' => null,
                'discount_amount' => 0,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'payment_status' => 'Unpaid',
                'shipping_fee' => 0,
                'shipping_method' => $request->shipping_method,
                'order_code' => 'ODR-' . strtoupper(Str::random(10)),
                'note' => $request->note,
            ]);

            foreach ($cart->items as $item) {
    $variant = $item->productVariant;
    $product = $variant?->product ?? $item->product;

    OrderDetail::create([
        'order_id' => $order->id,
        'product_variant_id' => $variant?->id, // Có thể null nếu không có variant
        'product_name' => $product?->name ?? 'Không rõ',
        'size_name' => $variant?->size ?? '-',
        'color_name' => $variant?->color_name ?? '-',
        'quantity' => $item->quantity,
        'price' => $variant?->price ?? $product?->price ?? 0,
    ]);
}

            $cart->items()->delete();
            $cart->delete();

            DB::commit();

            return redirect()->route('home')->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Đã có lỗi xảy ra khi đặt hàng: ' . $e->getMessage());
        }
    }
}
