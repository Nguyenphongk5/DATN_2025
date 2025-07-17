<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\Admin\Product_VariantController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChatController as AdminChatController;
use App\Http\Controllers\Admin\LogoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Models\Logo;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GoogleController;

// <<<<<<< UI-Improved-Profile
// Route này đã được thay thế bằng HomeController::index
// Route::get('', function () {
//     return view('user.index', [
//         'banners' => \App\Models\Banner::all(),
//         'latestProducts' => \App\Models\Product::orderBy('created_at', 'desc')->take(5)->get(),
//         'categories' => \App\Models\Category::all(),
//         'logos' => Logo::all(),
//     ]);
// })->name('home');


Route::get('home/search', [HomeController::class, 'search'])->name('home.search');
Route::get('home/products', [HomeController::class, 'allProducts'])->name('home.products');

Route::resource('home', HomeController::class);
Route::middleware('auth')->get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
Route::post('/comments', [HomeController::class, 'storeComment'])->name('comments.store');
Route::put('/comments/{id}', [HomeController::class, 'updateComment'])->name('comments.update');
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

    Route::put('/order-history/{id}/cancel', [OrderHistoryController::class, 'cancel'])->name('orders.cancel');


    Route::get('/order/{id}', [OrderHistoryController::class, 'show'])->name('orders.show');
    Route::get('/order-history', [OrderHistoryController::class, 'history'])->name('orders.history');
    Route::get('/order-history/filter', [OrderHistoryController::class, 'filter']);

    Route::get('/reorder/{order}', [OrderHistoryController::class, 'reorder'])->name('orders.reorder');

    Route::get('/checkout/reorder', [CheckoutController::class, 'reorderCheckout'])->name('checkout.reorder');
});



// Admin routes
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->middleware(['auth', 'verified'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('product_variants', Product_VariantController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('logos', LogoController::class);
    Route::resource('orders', OrderController::class);
    Route::get('orders/export-qr/{id}', [OrderController::class, 'exportQr'])->name('orders.exportQr');
    Route::resource('vouchers', \App\Http\Controllers\Admin\VoucherController::class);
    Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::post('comments/store', [CommentController::class, 'store'])->name('comments.store');
    Route::patch('/comments/{id}/toggle', [CommentController::class, 'toggle'])->name('comments.toggle');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    // Product Gallery routes
    Route::prefix('products/{product}/galleries')->name('products.galleries.')->group(function () {
        Route::get('/', [ProductGalleryController::class, 'index'])->name('index');
        Route::get('/create', [ProductGalleryController::class, 'create'])->name('create');
        Route::post('/', [ProductGalleryController::class, 'store'])->name('store');
        Route::get('/{gallery}/edit', [ProductGalleryController::class, 'edit'])->name('edit');
        Route::put('/{gallery}', [ProductGalleryController::class, 'update'])->name('update');
        Route::delete('/{gallery}', [ProductGalleryController::class, 'destroy'])->name('destroy');
        Route::post('/update-order', [ProductGalleryController::class, 'updateOrder'])->name('updateOrder');
        Route::post('/{gallery}/toggle-active', [ProductGalleryController::class, 'toggleActive'])->name('toggleActive');
    });
    // Chat Box
    Route::get('/chat', [AdminChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/messages/{user}', [AdminChatController::class, 'messages'])->name('chat.messages');
    Route::post('/chat/messages', [AdminChatController::class, 'store'])->name('chat.store');
});
// routes/web.php


use App\Models\Blog;

Route::get('/', [HomeController::class, 'index'])->name('home');

use App\Http\Controllers\SubscribeController;


Route::post('/subscribe', [SubscribeController::class, 'store'])->name('subscribe.store');
// routes/web.php

// Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
use App\Http\Controllers\VnPayController;

// Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder1'])->name('checkout.placeOrder');


Route::post('/checkout/handle-payment', [CheckoutController::class, 'handlePayment'])->name('checkout.handlePayment');
Route::post('/checkout/vnpay/create', [VnPayController::class, 'createPayment'])->name('vnpay.payment');
Route::get('/checkout/vnpay/return', [VnPayController::class, 'vnpayReturn'])->name('vnpay.return');
Route::get('/vnpay/return', [VNPayController::class, 'vnpayReturn'])->name('vnpay.return');
Route::patch('/admin/orders/{order}/payment', [OrderController::class, 'updatePayment'])->name('orders.updatePayment');


Route::get('/chat/messages', [ChatController::class, 'index'])->name('chat.messages');
Route::post('/chat/messages', [ChatController::class, 'store'])->name('chat.messages.store');

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/about', function () {
    return view('layouts.about'); // đúng với đường dẫn layout/about.blade.php
})->name('about');
Route::get('/products/{id}', [HomeController::class, 'show'])->name('product.show');

// Voucher routes
Route::get('/vouchers', [App\Http\Controllers\VoucherController::class, 'index'])->name('vouchers.index');
Route::post('/validate-voucher', [App\Http\Controllers\VoucherController::class, 'validateVoucher'])->name('voucher.validate');

require __DIR__ . '/auth.php';
