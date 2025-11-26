<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display products page
     */
    public function index()
    {
        $products = Product::where('user_id', Auth::id())->latest()->get();
        return view('products.index', compact('products'));
    }

    /**
     * Filter products - OPTIMIZED VERSION
     */
    public function filter(Request $request)
    {
        try {
            $userId = Auth::id();

            $query = Product::where('user_id', $userId)
                ->select(['id', 'name', 'sku', 'category', 'price', 'stock', 'status', 'image', 'created_at']); // ← UBAH

            // Filter by category
            if ($request->category && $request->category !== 'all') {
                $query->where('category', $request->category); // ← UBAH
            }

            // Filter by status
            if ($request->status && $request->status !== 'all') {
                $query->where('status', $request->status);
            }

            // Search by name
            if ($request->search) {
                $query->where('name', 'like', '%' . $request->search . '%');
            }

            $products = $query->latest()->get();

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
            Log::error('Filter error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memfilter produk',
                'products' => [],
                'stats' => ['total' => 0, 'active' => 0, 'low_stock' => 0, 'out_of_stock' => 0]
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $product = Product::where('user_id', Auth::id())->findOrFail($id);

            return response()->json([
                'id' => $product->id,
                'name' => $product->name,
                'category' => $product->category, // ← UBAH
                'price' => $product->price,
                'original_price' => $product->original_price,
                'stock' => $product->stock,
                'description' => $product->description,
                'image' => $product->image,
                'tags' => $product->tags,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:255', // ← UBAH
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image'       => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'tags'        => 'nullable|string',
            'original_price' => 'nullable|numeric|min:0'
        ]);

        try {
            $product = new Product();
            $product->user_id = Auth::id();
            $product->name = $validated['name'];
            $product->category = $validated['category']; // ← UBAH
            $product->price = $validated['price'];
            $product->stock = $validated['stock'];
            $product->description = $validated['description'] ?? null;
            $product->tags = $validated['tags'] ?? null;
            $product->original_price = $validated['original_price'] ?? null;
            $product->sku = 'SKU-' . time() . rand(100, 999);

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
                $product->image = $imagePath;
            }

            $product->save();

            return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Store product error: ' . $e->getMessage());
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::where('user_id', Auth::id())->findOrFail($id);

            $validated = $request->validate([
                'name'        => 'required|string|max:255',
                'category'    => 'required|string|max:255',
                'price'       => 'required|numeric|min:0',
                'stock'       => 'required|integer|min:0',
                'description' => 'nullable|string',
                'image'       => 'nullable|image|max:2048',
                'tags'        => 'nullable|string',
                'original_price' => 'nullable|numeric|min:0'
            ]);

            // Update fields
            $product->name = $validated['name'];
            $product->category = $validated['category'];
            $product->price = $validated['price'];
            $product->stock = $validated['stock'];
            $product->description = $validated['description'] ?? null;
            $product->tags = $validated['tags'] ?? null;
            $product->original_price = $validated['original_price'] ?? null;

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }

                // Store new image
                $imagePath = $request->file('image')->store('products', 'public');
                $product->image = $imagePath;
            }

            // Update status based on stock
            if ($product->stock == 0) {
                $product->status = 'out_of_stock';
            } elseif ($product->stock <= 10) {
                $product->status = 'low_stock';
            } else {
                $product->status = 'active';
            }

            $product->save();

            // Return JSON response for AJAX
            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil diperbarui',
                'product' => $product
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Update product error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengupdate produk: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete product
     */
    public function destroy($id)
    {
        try {
            $product = Product::where('user_id', Auth::id())->findOrFail($id);
            $product->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Delete product error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal menghapus produk'], 500);
        }
    }
}
