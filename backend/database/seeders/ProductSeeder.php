<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'title'    => 'Мужские Кроссовки Nike Blazer Mid Suede',
                'price'    => 12999,
                'image_url' => '/sneakers/sneakers-1.jpg'
            ],
            [
                'title'    => 'Мужские Кроссовки Nike Air Max 270',
                'price'    => 15600,
                'image_url' => '/sneakers/sneakers-2.jpg'
            ],
            [
                'title'    => 'Мужские Кроссовки Nike Blazer Mid Suede',
                'price'    => 8499,
                'image_url' => '/sneakers/sneakers-3.jpg'
            ],
            [
                'title'    => 'Кроссовки Puma X Aka Boku Future Rider',
                'price'    => 7800,
                'image_url' => '/sneakers/sneakers-4.jpg'
            ],
            [
                'title'    => 'Кроссовки Future Rider',
                'price'    => 9550,
                'image_url' => '/sneakers/sneakers-5.jpg'
            ],
            [
                'title'    => 'Кроссовки Black Edition',
                'price'    => 16999,
                'image_url' => '/sneakers/sneakers-6.jpg'
            ],
            [
                'title'    => 'Кроссовки Orange Boomb Edition',
                'price'    => 7499,
                'image_url' => '/sneakers/sneakers-7.jpg'
            ],
            [
                'title'    => 'Кроссовки Nike Air Max 270',
                'price'    => 15600,
                'image_url' => '/sneakers/sneakers-8.jpg'
            ],
            [
                'title'    => 'Кроссовки Nike Air Force 1',
                'price'    => 5900,
                'image_url' => '/sneakers/sneakers-9.jpg'],
            [
                'title'    => 'Кроссовки Adidas Ultraboost',
                'price'    => 11500,
                'image_url' => '/sneakers/sneakers-10.jpg'
            ],
            [
                'title'    => 'Кроссовки Puma Clyde All-Pro',
                'price'    => 7600,
                'image_url' => '/sneakers/sneakers-11.jpg'
            ],
            [
                'title'    => 'Кроссовки Converse Chuck Taylor All-Star',
                'price'    => 13000,
                'image_url' => '/sneakers/sneakers-12.jpg'
            ],
        ];

        foreach ($products as $product) {
            Product::query()->create([
                'title'    => $product['title'],
                'price'    => $product['price'],
                'image_url' => $product['image_url']
            ]);
        }

    }
}
