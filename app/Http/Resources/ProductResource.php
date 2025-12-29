<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = auth()->user() ?? null;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'stock_quantity' => $this->stock_quantity,
            'available_quantity' => $this->available_quantity,
            'low_stock_limit' => $this->low_stock_limit,
            'can_update' => $user?->can('update', $this->resource) ?? false,
            'can_delete' => $user?->can('delete', $this->resource) ?? false,
        ];
    }
}
