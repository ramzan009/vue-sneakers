<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'products';

    protected $hidden = ['pivot'];
    protected $fillable = [
        'title',
        'price',
        'image_url',
    ];

    /**
     * Отношение с user, многим ко многим
     */
    public function favoritesBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_favorites_products', 'product_id', 'user_id');
    }

    /**
     * Отношение с user, многим ко многим
     */
    public function cartsBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'cart_product', 'product_id', 'user_id');
    }

    /**
     * Отношение с order, один ко многим
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'product_id');
    }
}
