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


public function boot(): void
{
    View::composer('*', function ($view) {
        $categories = Category::all();
        $view->with('categories', $categories);

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
