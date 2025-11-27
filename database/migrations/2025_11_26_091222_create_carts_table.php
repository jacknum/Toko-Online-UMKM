<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('product_name');
            $table->decimal('price', 12, 2);
            $table->string('product_image')->nullable();
            $table->integer('quantity')->default(1);
            $table->decimal('subtotal', 12, 2)->storedAs('price * quantity');
            $table->timestamp('added_at')->useCurrent();
            $table->timestamps();

            // Ensure a user can't have duplicate products in cart
            $table->unique(['user_id', 'product_id']);

            // Index untuk query performa
            $table->index('user_id');
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
