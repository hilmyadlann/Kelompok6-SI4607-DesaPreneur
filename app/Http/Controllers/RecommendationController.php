<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $purchasedProducts = $user->purchasedProducts()->with('category')->get();
        $recommendedProducts = collect();

        foreach ($purchasedProducts as $product) {
            $recommendedProducts = $recommendedProducts->merge($product->category->products);
        }

        $recommendedProducts = $recommendedProducts->unique();

        return view('recommendations', compact('recommendedProducts'));
    }
}
