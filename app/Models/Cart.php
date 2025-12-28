<?php

namespace App\Models;

use App\Enums\CartStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'name',
        'status',
        'user_id',
    ];

    protected $attributes = [
        'name' => 'My cart',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => CartStatusEnum::class,
        ];
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function totalPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->items->sum(fn ($item) => $item->unit_price * $item->quantity), 2, '.', ''),
        );
    }
}
