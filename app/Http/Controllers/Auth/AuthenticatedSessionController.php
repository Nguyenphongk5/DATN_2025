<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Logo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $logo = Logo::where('is_active', 1)->first();
        $categories = DB::table('categories')->get();
        return view('auth.login', compact('categories', 'logo'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        // if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff') {
        //     return redirect()->intended(route('dashboard', absolute: false));
        // } else {
        //     return redirect()->intended(route('home.index', absolute: false));
        // }

        session(['login_at' => now()]);

        // Xử lý thêm sản phẩm vào giỏ hàng sau khi đăng nhập
        if (session('pending_cart_item')) {
            $pendingItem = session('pending_cart_item');
            $returnUrl = $pendingItem['return_url'] ?? route('home.index');

            // Xóa session pending
            session()->forget('pending_cart_item');

            // Thêm sản phẩm vào giỏ hàng
            $this->addPendingItemToCart($pendingItem);

            return redirect($returnUrl)->with('add_to_cart', 'Sản phẩm đã được thêm vào giỏ hàng!');
        }

        if (Auth::user()->role === 'admin' || Auth::user()->role === 'staff') {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        } else {
            return redirect()->intended(route('home.index', absolute: false));
        }
    }

    private function addPendingItemToCart($pendingItem)
    {
        $user = Auth::user();
        $cart = \App\Models\Cart::firstOrCreate(['user_id' => $user->id]);

        $variant = null;
        $productId = $pendingItem['product_id'];

        // Nếu có biến thể
        if (!empty($pendingItem['color_name']) && !empty($pendingItem['size'])) {
            $variant = \App\Models\ProductVariant::where('product_id', $productId)
                ->where('color_name', $pendingItem['color_name'])
                ->where('size', $pendingItem['size'])
                ->first();

            if ($variant) {
                // Kiểm tra xem đã có trong giỏ chưa
                $item = \App\Models\CartItem::where('cart_id', $cart->id)
                    ->where('product_variant_id', $variant->id)
                    ->first();

                if ($item) {
                    $item->quantity += $pendingItem['quantity'];
                    $item->save();
                } else {
                    \App\Models\CartItem::create([
                        'cart_id' => $cart->id,
                        'product_id' => $variant->product_id,
                        'product_variant_id' => $variant->id,
                        'quantity' => $pendingItem['quantity'],
                    ]);
                }
            }
        } else {
            // Không có biến thể
            $item = \App\Models\CartItem::where('cart_id', $cart->id)
                ->where('product_id', $productId)
                ->whereNull('product_variant_id')
                ->first();

            if ($item) {
                $item->quantity += $pendingItem['quantity'];
                $item->save();
            } else {
                \App\Models\CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $productId,
                    'product_variant_id' => null,
                    'quantity' => $pendingItem['quantity'],
                ]);
            }
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}