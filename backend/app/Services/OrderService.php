<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Collection;

class OrderService
{
    /**
     * @param User $user
     * @param array $items
     * @return Collection
     */
    public function createOrder(User $user, array $items): Collection
    {
        $orders = collect();

        foreach ($items as $item) {
            $orders->push(
                Order::query()->create([
                    'user_id'    => $user->id,
                    'product_id' => $item['id'],
                    'price'      => $item['price'],
                ])
            );
        }

        $user->carts()->detach();

        return $orders;
    }
}
