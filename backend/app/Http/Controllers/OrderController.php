<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Метод для оплаты товаров
     */
    public function store(OrderRequest $request)
    {
        $user = Auth::user();

        $orders = [];

        foreach ($request->items as $item) {
           $orders = Order::query()->create([
                'user_id'    => $user->id,
                'product_id' => $item['id'],
                'price'      => $item['price'],
            ]);
        }

        $user->carts()->detach();

        return response()->json([
           'orders' => $orders
        ], 201);
    }
}
