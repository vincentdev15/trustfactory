<?php

namespace App\Enums;

enum CartStatusEnum: string
{
    case OPEN = 'open';
    case VALIDATED = 'validated';
    case CHECKOUT = 'checkout';

    public function label(): string
    {
        return match($this) {
            self::OPEN => 'Open',
            self::VALIDATED => 'Validated',
            self::CHECKOUT => 'Checkout',
        };
    }
}
