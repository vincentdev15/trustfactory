<?php

namespace App\Jobs;

use App\Models\Cart;
use App\Enums\CartStatusEnum;
use App\Services\CartService;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClearCartAfterExpirationJob implements ShouldQueue
{
    use Queueable;

    public $cart;
    
    /**
     * Create a new job instance.
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->cart->status === CartStatusEnum::VALIDATED && $this->cart->updated_at->diffInMinutes(Carbon::now()) >= config('teac.cart_expiration_delay')) {
            $cartService = new CartService;

            $cartService->decrementReservedStock($this->cart);

            $cartService->clear($this->cart);
        }
    }
}
