<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = auth()->user()->umkm->products()->with('images')->get();
        return view('umkms.toko', compact('products'));
    }

    public function upload()
    {
        $categories = Category::all(); // Ambil semua kategori
        return view('umkms.products.upload', compact('categories'));
    }

    public function store(Request $request, Umkm $umkm)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'marketplace_link' => 'nullable|url',
            'images.*' => 'required|image|max:2048',
        ]);

        $product = new Product([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'category_id' => $validatedData['category_id'],
            'marketplace_link' => $validatedData['marketplace_link'] ?? null,
            'umkm_id' => auth()->user()->umkms->id,
        ]);

        $product->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('images', 'public');
                $productImage = new ProductImage([
                    'image' => $imagePath,
                    'product_id' => $product->id,
                ]);
                $productImage->save();
            }
        }

        return redirect()->back()->with('success', 'Produk Berhasil di Upload');
    }

    public function showUploadForm()
    {
        $categories = Category::all();
        return view('umkms.products.upload', compact('categories'));
    }

    // tambahan manda

    // function untuk melihat detail product
    public function show(Product $product)
    {
        return view('umkms.products.show', compact('product'));
    }

    // function untuk melihat detail product pada dashboard admin
    public function details(Product $product)
    {
        // Ambil gambar-gambar terkait produk
        $images = $product->images;

        // Mendapatkan data UMKM terkait produk 
        $umkm = $product->umkm;

        // Tampilkan halaman detail produk dengan data produk, gambar-gambar terkait, dan data UMKM
        return view('umkms.products.details', compact('product', 'images', 'umkm'));
    }

    // function untuk melihat detail product pada recommendation
    public function recommendationDetail(Product $product)
    {
        return view('recommendation-detail', compact('product'));
    }

    // function untuk update product
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'marketplace_link' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image);
            $image->delete();
        }

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('images', 'public');
                $images[] = new ProductImage([
                    'product_id' => $product->id,
                    'image' => $imagePath,
                ]);
            }
            $product->images()->saveMany($images);
        }

        $product->update($validatedData);

        return redirect()->back()->with('success', 'Produk berhasil diperbarui.');
    }

    // function untuk edit product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('umkms.products.edit', compact('product', 'categories'));
    }

    // function untuk edit product pada dashboard admin
    public function editNew($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('umkms.products.editnew', compact('product', 'categories'));
    }

    // function untuk hapus product
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
    }

    public function like($productId)
    {
        $product = Product::findOrFail($productId);
        $product->likes_count++;
        $product->save();

        return response()->json(['success' => true, 'likes_count' => $product->likes_count]);
    }

    public function mostLiked()
    {
        $products = Product::with('images')->orderBy('likes_count', 'desc')->get();
        return view('umkms.products.mostLiked', compact('products'));
    }

}