<?php

namespace App\Services;

use App\Models\Cart;
use App\Enums\CartStatusEnum;

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

    public function decrementReservedStock(Cart $cart)
    {
        foreach ($cart->items as $item) {
            $item->product->decrement('reserved_stock_quantity', $item->quantity);
        }
    }

    public function incrementReservedStock(Cart $cart)
    {
        foreach ($cart->items as $item) {
            $item->product->increment('reserved_stock_quantity', $item->quantity);
        }
    }

    public function clear(Cart $cart)
    {
        foreach ($cart->items as $item) {
            $item->delete();
        }

        $cart->update(['status' => CartStatusEnum::OPEN]);
    }
}
