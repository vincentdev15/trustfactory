<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('market', [PageController::class, 'market'])->name('market');
Route::get('product/{product}', [PageController::class, 'product'])->name('product');

Route::middleware('auth')->group(function () {
    Route::get('cart', [CartController::class, 'show'])->name('cart');

    Route::post('checkout/validate', [CheckoutController::class, 'validate'])->name('checkout.validate');
    Route::post('checkout/pay', [CheckoutController::class, 'pay'])->name('checkout.pay');

    Route::resource('items', ItemController::class);

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('products', ProductController::class);
    });
});
