<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Umkm;
use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likeProduct(Request $request, $id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($id);

        if (!$product->likedBy()->where('user_id', $user->id)->exists()) {
            $product->likedBy()->attach($user->id);
            $product->increment('likes_count');
        }

        return response()->json(['success' => true]);
    }

    public function getProductLikes($id)
    {
        $product = Product::withCount('likes')->findOrFail($id);
        return view('product.detail', compact('product'));
    }
    
    public function getUserFavorites()
    {
        $userId = Auth::id();
        $favorites = Product::whereHas('likedBy', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        return view('favorites', compact('favorites'));
    }

    public function getMostLikedProducts($id)
    {
    $mostLikedProducts = Product::withCount('likes')
                                ->with('images')
                                ->orderBy('likes_count', 'desc')
                                ->take(10) // Ambil 10 produk paling disukai
                                ->get();

    $umkm = Umkm::with('image')->where('id',$id)->get();
    
    
    return view('umkms.products.mostLiked', compact('mostLikedProducts','umkm'));
    }

    public function destroy(Product $product)
    {
        $user = Auth::user();
        $like = Like::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();
    
        if ($like) {
            $like->delete();
            return response()->json(['success' => 'Produk berhasil dihapus dari daftar favorit.']);
        } else {
            return response()->json(['error' => 'Produk tidak ditemukan di daftar favorit.'], 404);
        }
    }

    
}
