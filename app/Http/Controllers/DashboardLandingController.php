<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Desa;
use App\Models\Umkm;
use App\Models\image;
use App\Models\Recommendation;

class DashboardLandingController extends Controller
{
    public function index()
{
    $categories = Category::all();
    $productsByCategory = [];
    foreach ($categories as $category) {
        $productsByCategory[$category->name] = Product::where('category_id', $category->id)->get();
    }

    $desas = null;
    if (!isset($desa)) {
        $desas = Desa::all();
    }

    // Ambil rekomendasi produk untuk pengguna yang sedang login
    $user = auth()->user();
    $recommendations = $user->recommendations()->with('product', 'viewedProduct')->get();

    $recommendedProducts = $recommendations->flatMap(function ($recommendation) {
        if ($recommendation->viewedProduct) {
            return $recommendation->viewedProduct->category->products;
        } else {
            return $recommendation->product;
        }
    })->unique();

    return view('dashboard', compact('productsByCategory', 'desas', 'recommendedProducts'));
}

public function showProductsByCategory($category)
{
    $category = Category::where('name', $category)->firstOrFail();
    $products = Product::where('category_id', $category->id)->get();
    $desas = Desa::all();

    // Ambil rekomendasi produk untuk pengguna yang sedang login
    $user = auth()->user();
    $recommendedProducts = $user->recommendations()->with('product', 'viewedProduct')->get();

    $recommendedProducts = $recommendedProducts->flatMap(function ($recommendation) {
        if ($recommendation->viewedProduct) {
            return $recommendation->viewedProduct->category->products;
        } else {
            return $recommendation->product;
        }
    })->unique();

    return view('dashboard', compact('products', 'category', 'desas', 'recommendedProducts'));
}

    public function showUmkmsByDesa(Request $request)
    {
        $desaId = $request->input('desa_id');
        $desas = Desa::all();
        $umkms = Umkm::where('desa', $desaId)->get();
        $categories = Category::all();
        $productsByCategory = [];
        foreach ($categories as $category) {
            $productsByCategory[$category->name] = Product::where('category_id', $category->id)->get();
        }
        $user = auth()->user();
        $recommendations = $user->recommendations()->with('product', 'viewedProduct')->get();
        $recommendedProducts = $recommendations->flatMap(function ($recommendation) {
            if ($recommendation->viewedProduct) {
                return $recommendation->viewedProduct->category->products;
            } else {
                return $recommendation->product;
            }
        })->unique();

        return view('dashboard', compact('desas', 'umkms', 'productsByCategory', 'desaId', 'recommendedProducts'));
        }
    public function show(Umkm $umkm)
    {
        
        $images = image::where('umkms_id',$umkm->id)->get();
        return view('umkms.userdetail', compact('umkm', 'images'));
    }

    public function showProduct(Product $product)
    {
        $images = $product->images;
        $umkm = $product->umkm;
        $category = $product->category;
        return view('umkms.products.show', compact('product', 'images', 'umkm', 'category'));
    }
}