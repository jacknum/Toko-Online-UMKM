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
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            // Informasi produk yang disimpan di wishlist (untuk backup jika produk dihapus)
            $table->string('product_name');
            $table->decimal('product_price', 10, 2)->default(0);
            $table->decimal('product_original_price', 10, 2)->nullable();
            $table->integer('product_discount_percent')->default(0);
            $table->text('product_description')->nullable();
            $table->string('product_image')->nullable();
            $table->string('product_category');
            $table->integer('product_stock')->default(0);
            $table->decimal('product_rating', 3, 2)->default(0);
            $table->integer('product_review_count')->default(0);
            $table->boolean('product_is_trending')->default(false);

            // Timestamps
            $table->timestamp('added_at')->useCurrent();
            $table->timestamps();

            // Ensure a user can't add the same product to wishlist multiple times
            $table->unique(['user_id', 'product_id']);

            // Index untuk performa query
            $table->index('user_id');
            $table->index('product_id');
            $table->index('added_at');
            $table->index('product_category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};
