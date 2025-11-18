<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Tambahkan kolom user_id sebagai nullable dulu
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
        });

        // Step 2: Cari user dengan role 'penjual' (prioritas user dengan id terkecil)
        $penjualUser = DB::table('users')
            ->where('role', 'penjual')
            ->orderBy('id')
            ->first();

        if ($penjualUser) {
            // Assign semua produk ke user penjual pertama yang ditemukan
            DB::table('products')->update(['user_id' => $penjualUser->id]);
            echo "Assigned all products to user: " . $penjualUser->name . " (ID: " . $penjualUser->id . ")\n";
        } else {
            // Fallback: gunakan user pertama yang ada
            $firstUser = DB::table('users')->orderBy('id')->first();
            if ($firstUser) {
                DB::table('products')->update(['user_id' => $firstUser->id]);
                echo "Assigned all products to user: " . $firstUser->name . " (ID: " . $firstUser->id . ")\n";
            } else {
                // Buat user default jika benar-benar tidak ada user
                $userId = DB::table('users')->insertGetId([
                    'username' => 'default_penjual',
                    'name' => 'Default Penjual',
                    'email' => 'default_penjual@example.com',
                    'phone' => '08123456789',
                    'address' => 'Alamat default',
                    'role' => 'penjual',
                    'password' => bcrypt('password123'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::table('products')->update(['user_id' => $userId]);
                echo "Created default user and assigned all products to user ID: " . $userId . "\n";
            }
        }

        // Step 3: Set user_id menjadi required dan tambahkan foreign key
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
