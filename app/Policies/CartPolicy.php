<?php

namespace App\Policies;

use App\Enums\CartStatusEnum;
use App\Models\Cart;
use App\Models\User;

class CartPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Cart $cart): bool
    {
        return $user->id === $cart->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Cart $cart): bool
    {
        return $user->id === $cart->user_id;
    }

    /**
     * Determine whether the user can validate the model.
     */
    public function validate(User $user, Cart $cart): bool
    {
        $can_validate = $cart->status === CartStatusEnum::OPEN && count($cart->items) > 0;

        if ($can_validate) {
            foreach ($cart->items as $item) {
                if ($item->quantity > $item->product->stock_quantity) {
                    $can_validate = false;

                    break;
                }
            }
        }

        return $can_validate;
    }

    /**
     * Determine whether the user can pay the model.
     */
    public function pay(User $user, Cart $cart): bool
    {
        return $cart->status === CartStatusEnum::VALIDATED;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Cart $cart): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Cart $cart): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Cart $cart): bool
    {
        return false;
    }
}
