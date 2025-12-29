<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'status' => $this->status->value,
            'items' => ItemResource::collection($this->whenLoaded('items')),
            'total_price' => $this->total_price,
            'can_update' => $user?->can('update', $this->resource) ?? false,
            'can_delete' => $user?->can('delete', $this->resource) ?? false,
            'can_validate' => $user?->can('validate', $this->resource) ?? false,
            'can_pay' => $user?->can('pay', $this->resource) ?? false,
        ];
    }
}
