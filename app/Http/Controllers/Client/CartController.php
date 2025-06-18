<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with([
            'items.productVariant.product'
        ])->where('user_id', auth()->id())->first(); //Cái này lỗi nhưng mà vẫn chạy được

        return view('user.cart', compact('cart'));
    }

    public function showCart()
    {

        return view('user.cart', compact('cart'));
    }
}
