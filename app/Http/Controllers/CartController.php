<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
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

    return back()->with('success', 'Đã thêm vào giỏ hàng');
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




}



