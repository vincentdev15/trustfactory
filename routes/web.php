<?php

use App\Http\Controllers\TrustfactoryLoadingController;
use Illuminate\Support\Facades\Route;

Route::get('/{any}', TrustfactoryLoadingController::class)->where('any', '.*');
