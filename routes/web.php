<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;

Route::get('/', HomeController::class)->name('home');

Route::prefix('/pages')->name('pages.')->group(function () {
    Route::get('market', [PageController::class, 'market'])->name('market');
    Route::get('product/{product}', [PageController::class, 'product'])->name('product');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    
    Route::get('cart', [CartController::class, 'show'])->name('cart');
    
    Route::post('checkout/validate', [CheckoutController::class, 'validate'])->name('checkout.validate');
    Route::post('checkout/pay', [CheckoutController::class, 'pay'])->name('checkout.pay');

    Route::resource('items', ItemController::class);

    Route::resource('products', ProductController::class);
});
