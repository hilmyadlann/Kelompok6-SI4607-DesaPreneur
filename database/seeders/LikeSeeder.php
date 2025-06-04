<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Like;
use Faker\Factory as Faker;
use Carbon\Carbon;

class LikeSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Mendapatkan semua user dan produk dari database
        $users = User::all();
        $products = Product::all();

        // Tentukan jumlah likes yang ingin Anda buat
        $likesCount = 50;

        for ($i = 0; $i < $likesCount; $i++) {
            Like::create([
                'user_id' => $faker->randomElement($users)->id,
                'product_id' => $faker->randomElement($products)->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
