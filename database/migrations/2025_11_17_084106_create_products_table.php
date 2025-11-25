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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // TAMBAHKAN INI - foreign key ke users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('name');
            $table->string('sku')->unique()->nullable();

            // Ubah category menjadi foreign key
            $table->foreignId('category_id')->constrained()->onDelete('cascade');

            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('original_price', 10, 2)->nullable(); // Harga asli sebelum diskon
            $table->integer('stock')->default(0);

            // Update status enum
            $table->enum('status', ['active', 'inactive', 'low_stock', 'out_of_stock'])
                ->default('active');

            $table->text('description')->nullable();
            $table->string('image')->nullable();

            // Rating & Review
            $table->decimal('rating', 3, 2)->default(0); // Rating 0.00 - 5.00
            $table->integer('review_count')->default(0);

            // Discount & Trending
            $table->integer('discount_percent')->default(0); // Persentase diskon
            $table->boolean('is_trending')->default(false);

            // Info tambahan
            $table->string('weight')->nullable();
            $table->string('dimensions')->nullable();
            $table->json('tags')->nullable();

            $table->timestamps();

            // Index untuk performa query
            $table->index('user_id');
            $table->index('category_id');
            $table->index('status');
            $table->index('is_trending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
