<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;
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
            'items' => ItemResource::collection($this->whenLoaded('items')),
            'total_price' => $this->total_price,
            'can_update' => $user?->can('update', $this->resource) ?? false,
            'can_delete' => $user?->can('delete', $this->resource) ?? false,
        ];
    }
}
