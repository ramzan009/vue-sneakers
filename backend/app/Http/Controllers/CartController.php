<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Метод выводять все товары добавленный в корзину
     */
    public function index()
    {
        $user = Auth::user();

        $cartItems = $user->carts()->get()->map(function ($product) {
            return [
                'id'       => $product->id,
                'title'    => $product->title,
                'price'    => $product->price,
                'imageUrl' => $product->image_url,
            ];
        });

        return response()->json($cartItems);
    }

    /**
     * Метод добавляет товар в корзину
     */
    public function store(Product $product)
    {
        $user = Auth::user();

        $user->carts()->syncWithoutDetaching([$product->id]);

        return response()->json([
            'isAdded' => true,
            'product_id' => $product->id,
        ]);
    }

    /**
     * Метод удаляет товар из корзини
     */
    public function destroy(Product $product)
    {
        $user = Auth::user();

        $user->carts()->detach($product->id);

        return response()->json([
            'success' => true
        ]);
    }

}
