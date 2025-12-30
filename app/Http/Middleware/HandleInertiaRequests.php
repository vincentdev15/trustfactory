<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'trustfactory';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = null;

        if (auth()->check()) {
            $user = auth()->user()->load('cart.items.product');

            $user = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'is_admin' => $user->is_admin,
                'cart' => [
                    'id' => $user->cart->id,
                    'name' => $user->cart->name,
                    'status' => $user->cart->status->value,
                    'items' => $user->cart->items->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'cart_id' => $item->cart_id,
                            'product_id' => $item->product_id,
                            'product' => [
                                'id' => $item->product->id,
                                'name' => $item->product->name,
                                'price' => $item->product->price,
                                'stock_quantity' => $item->product->stock_quantity,
                                'available_quantity' => $item->product->available_quantity,
                                'low_stock_limit' => $item->product->low_stock_limit,
                                'can_update' => $user?->can('update', $item->product) ?? false,
                                'can_delete' => $user?->can('delete', $item->product) ?? false,
                            ],
                            'unit_price' => $item->unit_price,
                            'quantity' => $item->quantity,
                            'total_price' => $item->total_price,
                            'available_quantity' => $item->available_quantity,
                            'can_update' => $user?->can('update', $item) ?? false,
                            'can_delete' => $user?->can('delete', $item) ?? false,
                        ];
                    }),
                    'total_price' => $user->cart->total_price,
                    'can_update' => $user?->can('update', $user->cart) ?? false,
                    'can_delete' => $user?->can('delete', $user->cart) ?? false,
                    'can_validate' => $user?->can('validate', $user->cart) ?? false,
                    'can_pay' => $user?->can('pay', $user->cart) ?? false,
                ],
                'items_count' => $user->cart->items->sum('quantity'),
            ];
        }

        return [
            ...parent::share($request),
            'auth.user' => $user,
        ];
    }
}
