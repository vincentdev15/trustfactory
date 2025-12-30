<?php

namespace App\Models;

use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy([ProductObserver::class])]
class Product extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'name',
        'price',
        'stock_quantity',
        'reserved_stock_quantity',
        'low_stock_limit',
    ];

    protected $appends = [
        'available_quantity',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'stock_quantity' => 'integer',
            'stock_quantity_reserved' => 'integer',
        ];
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function availableQuantity(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->stock_quantity - $this->reserved_stock_quantity,
        );
    }
}
