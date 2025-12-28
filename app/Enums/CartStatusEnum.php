<?php

namespace App\Enums;

enum CartStatusEnum: string
{
    const ACTIVE = 'active';
    const CHECKOUT = 'checkout';
    const PAID = 'paid';

    public function label(): string
    {
        return match($this) {
            self::ACTIVE => 'Active',
            self::CHECKOUT => 'Checkout',
            self::PAID => 'Paid',
        };
    }
}
