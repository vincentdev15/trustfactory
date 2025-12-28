<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use Illuminate\Support\Facades\DB;
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

        DB::transaction(function () use ($request, $product) {

            if ($product->stock_quantity > 0) {
                $product->decrement('stock_quantity');

                $cart = auth()->user()->cart;

                $item = new Item;

                $item->fill($request->validated());
                $item->unit_price = $product->price;
                $item->quantity = 1;
                $item->cart_id = $cart->id;

                $item->save();
            }
        });

        $product->refresh();

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

        DB::transaction(function () use ($request, $item, $product) {
            $current_quantity = $item->quantity;
            $new_quantity = $request->validated('quantity');

            $gap = $new_quantity - $current_quantity;

            if ($product->stock_quantity >= $gap) {
                $product->decrement('stock_quantity', $gap);

                if ($new_quantity === 0) {
                    $item->delete();
                } else {
                    $item->increment('quantity', $gap);
                }
            }
        });

        $product->refresh();

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
