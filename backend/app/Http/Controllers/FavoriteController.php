<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Метод выводить избранные товары
     */
    public function index()
    {
        $user = Auth::user();

        $favorites = $user->favorites()->get();

        return response()->json($favorites);
    }

    /**
     * Метод добавляет товар в избранный
     */
    public function toggle(Product $product)
    {
        $user = Auth::user();

        $user->favorites()->toggle($product->id);

        return response()->json([
            'favorited' => $user->favorites()->where('product_id', $product->id)->exists()
        ]);
    }
}
