<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserproductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
    Route::get('dashboard', [ProductController::class, 'dashboard'])->name('dashboard');
    Route::get('create', [ProductController::class, 'create'])->name('create');
    Route::post('createpost', [ProductController::class, 'createpost'])->name('createpost');
    Route::put('update/{id}', [ProductController::class, 'update'])->name('update');

    Route::get('detail/{id}', [ProductController::class, 'detail'])->name('detail');

    Route::post('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
    Route::get('cart', [CartController::class, 'cart'])->name('cart');
    Route::get('remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('remove.from.cart');
    Route::post('/update-cart', [CartController::class, 'updateCart'])->name('update.cart');

    // web.php
    Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // user//
    Route::get('/dashboarduser', [UserproductController::class, 'dashboarduser'])->name('dashboarduser');

});

require __DIR__.'/auth.php';

