<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Recommendation;
use Faker\Factory as Faker;
use Carbon\Carbon;

class RecommendationSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $users = User::all();
        $products = Product::all();
        $recommendationsCount = 50;

        for ($i = 0; $i < $recommendationsCount; $i++) {
            $user = $users->random();
            $viewedProduct = $products->random();
            $recommendedProduct = $products->random();

            // Hindari merekomendasikan produk yang sama yang sudah dilihat
            while ($viewedProduct->id === $recommendedProduct->id) {
                $recommendedProduct = $products->random();
            }

            Recommendation::create([
                'user_id' => $user->id,
                'product_id' => $recommendedProduct->id,
                'viewed_product_id' => $viewedProduct->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            echo "Recommendation created: User {$user->id} viewed Product {$viewedProduct->id} and recommended Product {$recommendedProduct->id}\n";
        }
    }
}
