<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Chia sẻ biến $cart và $categories cho tất cả các view
        View::composer('*', function ($view) {
            // Lấy danh sách danh mục
            $categories = Category::all();
            $view->with('categories', $categories);

            // Nếu đã đăng nhập thì lấy giỏ hàng
            if (Auth::check()) {
                $cart = Cart::with(['items.productVariant.product', 'items.product'])
                            ->where('user_id', Auth::id())
                            ->first();
                $view->with('cart', $cart);
            } else {
                $view->with('cart', null);
            }
        });
    }
}
