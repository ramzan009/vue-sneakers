<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::middleware(['throttle:api'])->group(function () {

    // Регистрация
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    // Вход
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

// Обязательная авторизация запроса
Route::middleware(['throttle:api', 'auth:sanctum'])->group(function () {

    // Товары
    Route::get('/product', [ProductController::class, 'products'])->name('home');

    // Избранные
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');

    // Добавление / удаление из избранного
    Route::post('/favorites/{product}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

    // Получить товары из корзины
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    // Добавление товар в корзину
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');

    // Удаление товар из корзина
    Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Оформление заказа
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');

    // Выход из аккаунта
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});




