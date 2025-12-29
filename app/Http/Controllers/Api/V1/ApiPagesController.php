<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ApiPagesController extends Controller
{
    public function market()
    {
        $products = Product::orderBy('name')->get();

        return $products->toResourceCollection();
    }

    public function product(Product $product)
    {
        return $product->toResource();
    }
}
