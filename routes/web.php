<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrustfactoryLoadingController;

Route::get('/{any}', TrustfactoryLoadingController::class)->where('any', '.*');
