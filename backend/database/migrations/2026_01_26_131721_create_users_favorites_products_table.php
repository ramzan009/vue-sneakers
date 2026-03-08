<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_favorite_product', function (Blueprint $table) {
            $table->comment('Избранные');
            $table->unsignedBigInteger('product_id')
                ->comment('Идентификатор избранного товара');

            $table->unsignedBigInteger('user_id')
                ->comment('Идентификатор пользователя');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_favorite_product');
    }
};
