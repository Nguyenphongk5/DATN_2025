<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{


    public function handleAction(Request $request)
    {
        $action = $request->input('action');


        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'color_name' => 'nullable|string',
            'size' => 'nullable|integer',
        ]);

        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $variant = null;
        $productId = $request->product_id;

        // Nếu có biến thể
        if ($request->filled('color_name') && $request->filled('size')) {
            $variant = ProductVariant::where('product_id', $productId)
                ->where('color_name', $request->color_name)
                ->where('size', $request->size)
                ->first();

            if (!$variant) {
                return back()->with('error', 'Biến thể sản phẩm không hợp lệ');
            }

            // Gán lại product_id chính xác từ variant
            $productId = $variant->product_id;

            // Kiểm tra xem đã có trong giỏ chưa
            $item = CartItem::where('cart_id', $cart->id)
                ->where('product_variant_id', $variant->id)
                ->first();
        } else {
            // Không có biến thể
            $item = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $productId)
                ->whereNull('product_variant_id')
                ->first();
        }

        if ($item) {
            $item->quantity += $request->quantity;
            $item->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $variant?->product_id ?? $request->product_id, // đảm bảo luôn có product_id
                'product_variant_id' => $variant?->id,
                'quantity' => $request->quantity,
            ]);
        }
        if ($action === 'buy_now') {
            session([
            'buy_now' => [
                'product_id' => $request->product_id,
                'color_name' => $request->color_name,
                'size' => $request->size,
                'quantity' => $request->quantity,
            ]
        ]);
        // chuyển thẳng sang trang thanh toán
        return redirect()->route('checkout.index');
    }

        // Trả về trang trước đó với thông báo thành công
        return redirect()->back()->with('add_to_cart', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'color_name' => 'nullable|string',
            'size' => 'nullable|integer',
        ]);

        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $variant = null;
        $productId = $request->product_id;

        // Nếu có biến thể
        if ($request->filled('color_name') && $request->filled('size')) {
            $variant = ProductVariant::where('product_id', $productId)
                ->where('color_name', $request->color_name)
                ->where('size', $request->size)
                ->first();

            if (!$variant) {
                return back()->with('error', 'Biến thể sản phẩm không hợp lệ');
            }

            // Gán lại product_id chính xác từ variant
            $productId = $variant->product_id;

            // Kiểm tra xem đã có trong giỏ chưa
            $item = CartItem::where('cart_id', $cart->id)
                ->where('product_variant_id', $variant->id)
                ->first();
        } else {
            // Không có biến thể
            $item = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $productId)
                ->whereNull('product_variant_id')
                ->first();
        }

        if ($item) {
            $item->quantity += $request->quantity;
            $item->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $variant?->product_id ?? $request->product_id, // đảm bảo luôn có product_id
                'product_variant_id' => $variant?->id,
                'quantity' => $request->quantity,
            ]);
        }

   return redirect()->back()->with('add_to_cart', 'Sản phẩm đã được thêm vào giỏ hàng!');

    }

    public function index()
    {

        $cart = Cart::with(['items.productVariant.product'])->where('user_id', Auth::id())->first();
        return view('user.cart', compact('cart'));
    }
    public function remove($id)
    {
        $item = CartItem::findOrFail($id);
        $item->delete();

        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $item = \App\Models\CartItem::findOrFail($id);
        $item->quantity = $request->quantity;
        $item->save();

        return back()->with('success', 'Cập nhật số lượng thành công');
    }

    // public function buyNow(Request $request)
    // {
    //     $request->validate([
    //         'product_id' => 'required|integer|exists:products,id',
    //         'color_name' => 'required|string',
    //         'size' => 'required|string',
    //         'quantity' => 'required|integer|min:1|max:100',
    //     ]);

    //     // Lưu thông tin sản phẩm mua ngay vào session
    //     session([
    //         'buy_now' => [
    //             'product_id' => $request->product_id,
    //             'color_name' => $request->color_name,
    //             'size' => $request->size,
    //             'quantity' => $request->quantity,
    //         ]
    //     ]);

    //     // Chuyển hướng sang trang checkout mua ngay
    //     return redirect()->route('checkout.buyNow');
    // }
}
