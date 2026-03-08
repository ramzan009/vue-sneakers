<?php

namespace App\Http\Controllers;

use App\Http\Resources\Cart\CartIndexResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    /**
     * Метод выводять все товары добавленный в корзину
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $user = Auth::user();

        return CartIndexResource::collection($user->carts()->get());
    }

    /**
     * Метод добавляет товар в корзину
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function store(Product $product)
    {
        $user = Auth::user();

        $user->carts()->syncWithoutDetaching([$product->id]);

        return response()->json([
            'isAdded'    => true,
            'product_id' => $product->id,
        ]);
    }

    /**
     * Метод удаляет товар из корзини
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product)
    {
        $user = Auth::user();

        $user->carts()->detach($product->id);

        return response()->json(null, 204);
    }

}
