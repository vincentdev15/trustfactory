<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiPagesController extends Controller
{
    public function marketplace()
    {
        $products = Product::orderBy('name')->get();

        return $products->toResourceCollection();
    }

    public function product(Product $product)
    {
        return $product->toResource();
    }
}
