<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::get('user/{id}/edit', [AdminController::class, 'editRole'])->name('user.edit');
    Route::post('user/{id}', [AdminController::class, 'updateRole'])->name('user.update');


    // =============================CATEGORY============================
    Route::prefix('/category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('listCategory');

        Route::get('/create', [CategoryController::class, 'create'])->name('createCategory');
        Route::post('/store', [CategoryController::class, 'store'])->name('storeCategory');

        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('editCategory');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('updateCategory');

        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('deleteCategory');
    });
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [AdminController::class, 'index'])->name('index');  // user list
    Route::post('/users/{user}/update-role', [AdminController::class, 'updateRole'])->name('updateRole'); // update role
});
