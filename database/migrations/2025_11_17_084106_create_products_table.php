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

            $table->string('name');
            $table->string('sku')->unique()->nullable();

            // kategori: sepatu, aksesoris, pakaian, elektronik
            $table->string('category');

            $table->integer('price')->default(0);
            $table->integer('stock')->default(0);

            // active, low_stock, out_of_stock
            $table->enum('status', ['active', 'low_stock', 'out_of_stock'])
                ->default('active');

            $table->text('description')->nullable();

            // URL atau path storage
            $table->string('image')->nullable();

            // Info tambahan
            $table->string('weight')->nullable();     // Contoh “0.8 kg”
            $table->string('dimensions')->nullable(); // Contoh “30 x 20 x 10 cm”

            // Tags disimpan dalam JSON
            $table->json('tags')->nullable();

            $table->timestamps();
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
