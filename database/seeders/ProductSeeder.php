<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\UMKM;
use App\Models\Category;
use App\Models\ProductImage;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Mendapatkan semua UMKM dari tabel umkms
        $umkms = UMKM::all();

        // Menentukan jumlah produk yang akan dibuat untuk setiap UMKM
        $productsPerUMKM = 3;

        foreach ($umkms as $umkm) {
            for ($i = 0; $i < $productsPerUMKM; $i++) {
                $this->createProduct($faker, $umkm);
            }
        }
    }

    private function createProduct($faker, $umkm)
    {
        // Membuat produk terkait dengan UMKM tertentu
        $product = Product::create([
            'name' => $faker->words(3, true),
            'description' => $faker->sentence,
            'price' => $faker->randomFloat(2, 0.01, 999999.99),
            'marketplace_link' => 'https://www.tokopedia.com/dedekapatisserie/kue-nastar-homemade-kue-nastar-bulat-kue-nastar-original-homemade-toples-250-gr?extParam=ivf%3Dfalse&src=topads',
            'umkm_id' => $umkm->id, // Menetapkan ID UMKM
            'category_id' => Category::inRandomOrder()->first()->id, // Memilih kategori secara acak
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'likes_count' => 0,
        ]);

        ProductImage::create([
            'image' => 'images/wLozGqQ1dQ7HXD12sgj4FB3IoAKG7dShm3pgKmHB.jpg',
            'product_id' => $product->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
