<?php

namespace App\Services;

use App\Models\Cart;

class CartService
{
    public function decrementStock(Cart $cart)
    {
        foreach ($cart->items as $item) {
            $item->product->decrement('stock_quantity', $item->quantity);
        }
    }

    public function incrementStock(Cart $cart)
    {
        foreach ($cart->items as $item) {
            $item->product->increment('stock_quantity', $item->quantity);
        }
    }
}
