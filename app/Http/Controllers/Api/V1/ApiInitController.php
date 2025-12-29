<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

class ApiInitController extends Controller
{
    public function __invoke()
    {
        return response()->json([], 200);
    }
}
