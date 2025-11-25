<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data produk dari database menggunakan Model Product
        $products = Product::where('id', Auth::id())->get();
        $recentProducts = Product::where('id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Hitung statistik produk - SESUAI DENGAN STATUS DI MODEL
        $totalProducts = $products->count();
        $activeProducts = $products->where('status', 'active')->count();
        $lowStockProducts = $products->where('status', 'low_stock')->count();
        $outOfStockProducts = $products->where('status', 'out_of_stock')->count();

        // Data dummy untuk demo (karena tidak ada tabel orders)
        $totalOrders = 67; // Data dummy
        $totalRevenue = 18250000; // Data dummy Rp 18.250.000

        // Data untuk chart pendapatan (data dummy untuk demo)
        $revenueData = [
            1 => 5,   // Jan: 5 juta
            2 => 7,   // Feb: 7 juta
            3 => 8,   // Mar: 8 juta
            4 => 10,  // Apr: 10 juta
            5 => 12,  // Mei: 12 juta
            6 => 15,  // Jun: 15 juta
            7 => 18,  // Jul: 18 juta
            8 => 16,  // Agu: 16 juta
            9 => 14,  // Sep: 14 juta
            10 => 12, // Okt: 12 juta
            11 => 10, // Nov: 10 juta
            12 => 8   // Des: 8 juta
        ];

        return view('dashboard', compact(
            'products',
            'recentProducts',
            'totalProducts',
            'activeProducts',
            'lowStockProducts',
            'outOfStockProducts',
            'totalOrders',
            'totalRevenue',
            'revenueData'
        ));
    }

    public function filterProducts(Request $request)
    {
        try {
            $userId = Auth::id();

            // Query dasar dengan select hanya kolom yang diperlukan - SESUAI DENGAN PRODUCTCONTROLLER
            $query = Product::where('id', $userId)
                ->select(['id', 'name', 'sku', 'category', 'price', 'stock', 'status', 'image', 'created_at']);

            // Filter by category
            if ($request->category && $request->category !== 'all') {
                $query->where('category', $request->category);
            }

            // Filter by status - SESUAI DENGAN STATUS DI MODEL
            if ($request->status && $request->status !== 'all') {
                $query->where('status', $request->status);
            }

            // Search by name - gunakan index jika ada
            if ($request->search) {
                $query->where('name', 'like', '%' . $request->search . '%');
            }

            $products = $query->latest()->get();

            // Hitung stats dengan query terpisah untuk performa lebih baik - SESUAI DENGAN PRODUCTCONTROLLER
            $totalQuery = Product::where('user_id', $userId);
            $activeQuery = clone $totalQuery;
            $lowStockQuery = clone $totalQuery;
            $outOfStockQuery = clone $totalQuery;

            $stats = [
                'total' => $totalQuery->count(),
                'active' => $activeQuery->where('status', 'active')->count(),
                'low_stock' => $lowStockQuery->where('status', 'low_stock')->count(),
                'out_of_stock' => $outOfStockQuery->where('status', 'out_of_stock')->count(),
            ];

            return response()->json([
                'success' => true,
                'products' => $products,
                'stats' => $stats
            ]);
        } catch (\Exception $e) {
            Log::error('Dashboard filter error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memfilter produk',
                'products' => [],
                'stats' => [
                    'total' => 0,
                    'active' => 0,
                    'low_stock' => 0,
                    'out_of_stock' => 0
                ]
            ], 500);
        }
    }

    public function updateProduct(Request $request, $id)
    {
        try {
            $product = Product::where('id', Auth::id())->findOrFail($id);

            $validated = $request->validate([
                'name'        => 'required|string|max:255',
                'category'    => 'required|string',
                'price'       => 'required|integer|min:0',
                'stock'       => 'required|integer|min:0',
                'description' => 'nullable|string',
                'image'       => 'nullable|image|max:2048',
            ]);

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }

                $imagePath = $request->file('image')->store('products', 'public');
                $validated['image'] = $imagePath;
            }

            // Status akan otomatis di-update oleh boot method di Model saat update
            $product->update($validated);

            return response()->json(['success' => true, 'message' => 'Produk berhasil diperbarui.']);
        } catch (\Exception $e) {
            Log::error('Dashboard update product error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui produk.'], 500);
        }
    }

    public function deleteProduct($id)
    {
        try {
            $product = Product::where('id', Auth::id())->findOrFail($id);
            $product->delete();

            return response()->json(['success' => true, 'message' => 'Produk berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error('Dashboard delete product error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal menghapus produk'], 500);
        }
    }

    public function bulkDeleteProducts(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array'
        ]);

        try {
            Product::where('id', Auth::id())
                ->whereIn('id', $request->product_ids)
                ->delete();

            return response()->json(['success' => true, 'message' => 'Produk berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error('Dashboard bulk delete error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal menghapus produk'], 500);
        }
    }

    public function getProduct($id)
    {
        try {
            $product = Product::where('user_id', Auth::id())->findOrFail($id);

            return response()->json([
                'id' => $product->id,
                'name' => $product->name,
                'category' => $product->category,
                'price' => $product->price,
                'stock' => $product->stock,
                'description' => $product->description,
                'image' => $product->image,
                'status' => $product->status,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at
            ]);
        } catch (\Exception $e) {
            Log::error('Dashboard get product error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan'], 404);
        }
    }
}
