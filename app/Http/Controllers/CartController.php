<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();
        $carts = Cart::with(['items.variant.product'])->where('user_id', $userId)->first();
        // var_dump($carts);
        return view('user.cart', compact('carts'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        // 1. Xóa các sản phẩm được chọn
        if (!empty($data['remove'])) {
            CartItem::whereIn('id', $data['remove'])->delete();
        }

        // 2. Cập nhật số lượng sản phẩm
        if (!empty($data['items'])) {
            foreach ($data['items'] as $itemData) {
                $item = CartItem::find($itemData['id']);
                if ($item && isset($itemData['quantity']) && $itemData['quantity'] >= 1) {
                    $item->quantity = $itemData['quantity'];
                    $item->save();
                }
            }
        }

        return back()->with('success', 'Giỏ hàng đã được cập nhật!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CartItem::destroy($id);
        return back();
    }
}
