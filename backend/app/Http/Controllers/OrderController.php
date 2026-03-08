<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Метод для оплаты товаров
     *
     * @param OrderRequest $request
     * @param OrderService $orderService
     * @return JsonResponse
     */
    public function store(OrderRequest $request, OrderService $orderService): JsonResponse
    {
        $user = Auth::user();

        $orders = $orderService->createOrder($user, $request->items);

        return response()->json(OrderResource::collection($orders), 201);
    }
}
