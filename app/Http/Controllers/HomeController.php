<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Desa;
use App\Models\Product;
use App\Models\Umkm;
use App\Models\Image;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $productsByCategory = [];
        foreach ($categories as $category) {
            $productsByCategory[$category->name] = Product::where('category_id', $category->id)->get();
        }

        $desas = Desa::all();

        return view('landing-page', compact('productsByCategory', 'desas'));
    }

    public function showProductsByCategory($category)
    {
        $category = Category::where('name', $category)->firstOrFail();
        $products = Product::where('category_id', $category->id)->get();
        $desas = Desa::all();

        return view('landing-page', compact('products', 'category', 'desas'));
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

        return view('landing-page', compact('desas', 'umkms', 'productsByCategory','desaId'));
    }

    public function show(Umkm $umkm)
    {
        $images = Image::where('umkms_id', $umkm->id)->get();
        return view('umkms.detail', compact('umkm', 'images'));
    }

    public function showProduct(Product $product)
    {
        $images = $product->images;
        $umkm = $product->umkm;
        $category = $product->category;
        return view('umkms.products.showguest', compact('product', 'images', 'umkm', 'category'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get();

        return view('searchresult', compact('products', 'query'));
    }
}