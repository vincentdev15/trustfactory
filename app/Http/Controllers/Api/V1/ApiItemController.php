<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Enums\CartStatusEnum;
use App\Services\CartService;
use App\Http\Requests\ItemRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ApiItemController extends Controller
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

        $item->refresh();

        return $item->toResource();
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

        DB::transaction(function () use ($request, $item) {
            $quantity = $request->validated('quantity');

            $cart = auth()->user()->cart->load('items.product');

            if ($cart->status === CartStatusEnum::VALIDATED) {
                $cart->update(['status' => CartStatusEnum::OPEN]);

                $this->cartService->decrementReservedStock($cart);
            }

            $product = Product::find($request->validated('product_id'));

            if ($quantity <= $cart->sattus === CartStatusEnum::OPEN ? $$product->available_quantity : $product->available_quantity + $item->quantity) {
                if ($quantity === 0) {
                    $item->delete();
                } else {
                    $item->update(['quantity' => $quantity]);
                }
            }
        });

        $item->refresh()->load('product');

        return $item->toResource()->additional([
            'product' => $item->product->toResource(),
        ]);
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

        return $item->toResource();
    }
}
