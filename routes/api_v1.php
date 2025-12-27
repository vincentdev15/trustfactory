<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ApiInitController;

Route::middleware('shared.datas')->prefix('/v1')->group(function () {
    Route::get('init', ApiInitController::class);

    Route::middleware('auth:sanctum')->group(function () {
    });
});
