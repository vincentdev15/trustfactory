<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrustfactoryLoadingController extends Controller
{
    public function __invoke()
    {
        return view('trustfactory');
    }
}
