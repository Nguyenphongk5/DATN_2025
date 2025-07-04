<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\Product_VariantController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LogoController;
use App\Http\Controllers\DashboardController;
use App\Models\Logo;

// <<<<<<< UI-Improved-Profile
Route::get('', function () {
    return view('user.index', [
        'banners' => \App\Models\Banner::all(),
        'latestProducts' => \App\Models\Product::orderBy('created_at', 'desc')->take(5)->get(),
        'categories' => \App\Models\Category::all(),
        'logos' => Logo::all(),
    ]);
})->name('home');


Route::get('home/search', [HomeController::class, 'search'])->name('home.search');
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::resource('home', HomeController::class);
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile', [ProfileController::class, 'avatar'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('orders', OrderController::class);
    Route::post('/cart/add', [CartController::class, 'handleAction'])->name('cart.add');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    // web.php
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');

    Route::post('/buy-now', [CartController::class, 'buyNow'])->name('cart.buyNow');

    Route::get('/checkout/buy-now', [CheckoutController::class, 'buyNow'])->name('checkout.buyNow');
    Route::post('/checkout/place-buy-now', [CheckoutController::class, 'placeBuyNowOrder'])->name('checkout.placeBuyNowOrder');
});



// Admin routes
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->middleware(['auth', 'verified'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('product_variants', Product_VariantController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('logos', LogoController::class);
    Route::resource('orders', OrderController::class);
});
// routes/web.php


use App\Models\Blog;

Route::get('/', [HomeController::class, 'index'])->name('home');
use App\Http\Controllers\SubscribeController;

Route::post('/subscribe', [SubscribeController::class, 'store'])->name('subscribe.store');

// Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder1'])->name('checkout.placeOrder');

require __DIR__ . '/auth.php';
