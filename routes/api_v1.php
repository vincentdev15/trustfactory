<?php

use App\Http\Controllers\Api\V1\ApiCartController;
use App\Http\Controllers\Api\V1\ApiInitController;
use App\Http\Controllers\Api\V1\ApiItemController;
use App\Http\Controllers\Api\V1\ApiPagesController;
use App\Http\Controllers\Api\V1\ApiProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('shared.datas')->prefix('/v1')->group(function () {
    Route::get('init', ApiInitController::class);

    Route::prefix('/pages')->group(function () {
        Route::get('market', [ApiPagesController::class, 'market']);
        Route::get('product/{product}', [ApiPagesController::class, 'product']);
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::patch('carts/pay', [ApiCartController::class, 'pay']);
        Route::patch('carts/validate', [ApiCartController::class, 'validate']);
        Route::apiResource('items', ApiItemController::class);
        Route::apiResource('products', ApiProductController::class);
    });
});
