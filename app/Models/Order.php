<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'date',
        'number',
        'user_id',
    ];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function totalPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->articles->sum(fn ($article) => $article->unit_price * $article->quantity), 2, '.', ''),
        );
    }
}
