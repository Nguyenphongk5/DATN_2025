<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\Product_VariantController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// <<<<<<< UI-Improved-Profile
Route::get('', function () {
    return view('user.index', [
        'banners' => \App\Models\Banner::all(),
        'latestProducts' => \App\Models\Product::orderBy('created_at', 'desc')->take(5)->get(),
        'categories' => \App\Models\Category::all(),
    ]);
});
Route::get('home/search', [HomeController::class, 'search'])->name('home.search');
Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::resource('home', HomeController::class);
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile', [ProfileController::class, 'avatar'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class);
    Route::resource('products',ProductController::class);
    Route::resource('product_variants', Product_VariantController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('blogs', BlogController::class);
});

require __DIR__.'/auth.php';
