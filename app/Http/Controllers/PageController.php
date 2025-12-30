<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;

class PageController extends Controller
{
    public function market()
    {
        return Inertia::render('Market', [
            'products' => fn () => Product::orderBy('name')->get()->toResourceCollection(),
        ]);
    }

    public function product(Product $product)
    {
        return Inertia::render('Product', [
            'product' => fn () => $product->toResource(),
        ]);
    }
}
