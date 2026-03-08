<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductProductsRequest;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductController extends Controller
{
    /**
     * Метод выводить все товары
     * И там есть код для фильтра и поиска
     *
     * @param ProductProductsRequest $request
     * @return Collection
     */
    public function products(ProductProductsRequest $request): Collection
    {
        $query = Product::query();

        if ($request->has('title')) {
            $search = str_replace('*', '', $request->get('title'));

            $query->where('title', 'LIKE', "%{$search}%");
        }

        if ($request->filled('sortBy')) {
            $sortBy = $request->get('sortBy');

            if ($sortBy === 'title') {
                $query->orderBy('title');
            }
            if ($sortBy === 'price') {
                $query->orderBy('price');
            }
            if ($sortBy === '-price') {
                $query->orderBy('price', 'desc');
            }
        }
        return $query->get();
    }
}
