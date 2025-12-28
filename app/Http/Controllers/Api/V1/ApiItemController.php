<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ApiItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        Gate::authorize('create', Item::class);

        $product = Product::find($request->validated('product_id'));

        if ($product->stock_quantity > 0) {
            $cart = auth()->user()->cart;

            $item = new Item;

            $item->fill($request->validated());
            $item->unit_price = $product->price;
            $item->quantity = 1;
            $item->cart_id = $cart->id;

            $item->save();
        }

        return $product->toResource();
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, Item $item)
    {
        Gate::authorize('update', $item);

        $product = Product::find($request->validated('product_id'));

        $quantity = $request->validated('quantity');

        if ($product->stock_quantity >= $quantity) {
            if ($quantity === 0) {
                $item->delete();
            } else {
                $item->increment('quantity', $gap);
            }
        }

        return $product->toResource();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        Gate::authorize('delete', $item);

        $item->delete();

        return $item->toResource();
    }
}
