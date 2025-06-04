<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Umkm;

class PengurusController extends Controller
{
    public function index()
    {
        // Ambil desa_id dari pengguna yang sedang login
        $desaId = auth()->user()->desa_id;

        // Ambil produk yang berelasi dengan desa tersebut
        $products = Product::whereHas('umkm', function ($query) use ($desaId) {
            $query->where('desa', $desaId);
        })->with('images')->get();

        return view('pengurus.dashboard', compact('products'));
    }

    public function umkm()
    {
        // Ambil desa_id dari pengguna yang sedang login
        $desaId = auth()->user()->desa_id;

        // Ambil UMKM yang berelasi dengan desa tersebut
        $umkms = Umkm::where('desa', $desaId)->get();

        return view('pengurus.umkm', compact('umkms'));
    }

    public function statistik()
{
    // Ambil desa_id dari pengguna yang sedang login
    $desaId = auth()->user()->desa_id;

    $umkmPerKategori = Umkm::where('desa', $desaId)
        ->selectRaw('kategori, count(*) as jumlah')
        ->groupBy('kategori')
        ->get()
        ->pluck('jumlah', 'kategori');

    $produkPerKategori = Product::whereHas('umkm', function ($query) use ($desaId) {
        $query->where('desa', $desaId);
    })
    ->selectRaw('categories.name, count(*) as jumlah')
    ->join('categories', 'products.category_id', '=', 'categories.id')
    ->groupBy('categories.name')
    ->get()
    ->pluck('jumlah', 'name');

    return view('pengurus.statistik', compact('umkmPerKategori', 'produkPerKategori'));
}
}