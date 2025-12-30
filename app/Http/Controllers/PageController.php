<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;

class PageController extends Controller
{
    public function market()
    {
        return Inertia::render('Market', [
            'products' => fn () => Product::orderBy('name')->get()->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'stock_quantity' => $product->stock_quantity,
                    'available_quantity' => $product->available_quantity,
                    'low_stock_limit' => $product->low_stock_limit,
                ];
            }),
        ]);
    }

    public function product(Product $product)
    {
        return Inertia::render('Product', [
            'product' => fn () => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'stock_quantity' => $product->stock_quantity,
                'available_quantity' => $product->available_quantity,
                'low_stock_limit' => $product->low_stock_limit,
            ],
        ]);
    }
}
