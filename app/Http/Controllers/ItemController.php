<?php

namespace App\Http\Controllers;

use App\Enums\CartStatusEnum;
use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ItemController extends Controller
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        Gate::authorize('create', Item::class);

        $item = new Item;

        DB::transaction(function () use ($request, $item) {
            $product = Product::find($request->validated('product_id'));

            if ($product->available_quantity > 0) {
                $cart = auth()->user()->cart->load('items.product');

                if ($cart->status === CartStatusEnum::VALIDATED) {
                    $cart->update(['status' => CartStatusEnum::OPEN]);

                    $this->cartService->decrementReservedStock($cart);
                }

                $item->fill($request->validated());
                $item->unit_price = $product->price;
                $item->quantity = 1;
                $item->cart_id = $cart->id;

                $item->save();
            }
        });

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, Item $item)
    {
        Gate::authorize('update', $item);

        DB::transaction(function () use ($request, $item) {
            $quantity = $request->validated('quantity');

            $cart = auth()->user()->cart->load('items.product');

            if ($cart->status === CartStatusEnum::VALIDATED) {
                $cart->update(['status' => CartStatusEnum::OPEN]);

                $this->cartService->decrementReservedStock($cart);
            }

            $product = Product::find($request->validated('product_id'));

            if ($quantity <= ($cart->status === CartStatusEnum::OPEN ? $product->available_quantity : $product->available_quantity + $item->quantity)) {
                if ($quantity === 0) {
                    $item->delete();
                } else {
                    $item->update(['quantity' => $quantity]);
                }
            }
        });

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        Gate::authorize('delete', $item);

        DB::transaction(function () use ($item) {
            $cart = auth()->user()->cart->load('items.product');

            if ($cart->status === CartStatusEnum::VALIDATED) {
                $cart->update(['status' => CartStatusEnum::OPEN]);

                $this->cartService->decrementReservedStock($cart);
            }

            $item->delete();
        });

        return back();
    }
}
