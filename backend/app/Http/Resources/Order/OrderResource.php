<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Order\Additional\ProductResource;
use App\Http\Resources\Order\Additional\UserResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'product'    => ProductResource::make($this->whenLoaded('product')),
            'user'       => UserResource::make($this->whenLoaded('user')),
            'price'      => $this->price,
            'created_at' => $this->created_at,
        ];
    }
}
