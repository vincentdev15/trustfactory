<?php

namespace App\Http\Controllers;

use App\Enums\CartStatusEnum;
use App\Models\Article;
use App\Models\Order;
use App\Services\CartService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CheckoutController extends Controller
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function validate()
    {
        $cart = auth()->user()->cart->load('items.product');

        Gate::authorize('validate', $cart);

        DB::transaction(function () use ($cart) {
            $this->cartService->incrementReservedStock($cart);

            $cart->update(['status' => CartStatusEnum::VALIDATED]);
        });

        return redirect()->route('cart');
    }

    public function pay()
    {
        $cart = auth()->user()->cart->load('items.product');

        Gate::authorize('pay', $cart);

        DB::transaction(function () use ($cart) {
            $this->cartService->decrementReservedStock($cart);
            $this->cartService->decrementStock($cart);

            $order = new Order;

            $order->date = now();
            $order->number = (Order::max('number') ?? 0) + 1;
            $order->user_id = auth()->user()->id;

            $order->save();

            foreach ($cart->items as $item) {
                $article = new Article;

                $article->order_id = $order->id;
                $article->product_id = $item->product_id;
                $article->unit_price = $item->unit_price;
                $article->quantity = $item->quantity;

                $article->save();
            }

            $this->cartService->clear($cart);
        });

        return redirect()->route('cart');
    }
}
