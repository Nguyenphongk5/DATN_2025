<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $userId = Auth::id();

        $items = Cart::with('variant.product')
            ->where('user_id', $userId)
            ->get();

        $total = $items->sum(function ($item) {
            $price = $item->variant->price_sale ?? $item->variant->price;
            return $item->quantity * $price;
        });

        return view('cart.index', compact('items', 'total'));
    }

    // Thêm sản phẩm vào giỏ
    public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'size'       => 'required|string',
        'color'      => 'required|string',
        'action'     => 'required|in:add_to_cart,buy_now',
    ]);

    $userId = Auth::id();

    if ($request->action === 'add_to_cart') {
        // Kiểm tra sản phẩm này (product_id + size + color) đã có trong giỏ chưa
        $existing = DB::table('carts')
            ->where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->where('size', $request->size)
            ->where('color', $request->color)
            ->first();

        if ($existing) {
            // Nếu có rồi thì tăng số lượng
            DB::table('carts')
                ->where('id', $existing->id)
                ->update([
                    'quantity'   => $existing->quantity + 1,
                    'updated_at' => now(),
                ]);
        } else {
            // Nếu chưa có thì insert mới
            DB::table('carts')->insert([
                'user_id'    => $userId,
                'product_id' => $request->product_id,
                'size'       => $request->size,
                'color'      => $request->color,
                'quantity'   => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    if ($request->action === 'buy_now') {
        // Lưu dữ liệu tạm vào session để chuyển sang trang thanh toán
        session(['buy_now' => [
            'product_id' => $request->product_id,
            'size'       => $request->size,
            'color'      => $request->color,
            'quantity'   => 1,
        ]]);

        return redirect()->route('checkout');
    }

    return back()->with('error', 'Không xác định hành động.');
}

    // Cập nhật số lượng
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $item = Cart::findOrFail($id);
        $item->update(['quantity' => $request->quantity]);

        return redirect()->back()->with('success', 'Cập nhật giỏ hàng thành công!');
    }

    // Xoá sản phẩm khỏi giỏ
    public function destroy($id)
    {
        $item = Cart::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Đã xoá sản phẩm khỏi giỏ hàng!');
    }

    // Xoá toàn bộ giỏ hàng
    public function clear()
    {
        $userId = Auth::id();
        Cart::where('user_id', $userId)->delete();

        return redirect()->back()->with('success', 'Đã xoá toàn bộ giỏ hàng!');
    }
}
