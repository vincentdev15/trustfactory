<?php

namespace App\Enums;

enum CartStatusEnum: string
{
    case OPEN = 'open';
    case CHECKOUT = 'checkout';
    case PAID = 'paid';

    public function label(): string
    {
        return match($this) {
            self::OPEN => 'Open',
            self::CHECKOUT => 'Checkout',
            self::PAID => 'Paid',
        };
    }
}
