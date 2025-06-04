<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Menjalankan seeder untuk admin dan lainnya
        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
            KecamatanSeeder::class,
            DesaSeeder::class,
        ]);

        // Menambahkan 5 user dengan password haha1234
        $users = [
            ['name' => 'hilmy', 'email' => 'hilmy@gmail.com'],
            ['name' => 'aldo', 'email' => 'aldo@gmail.com'],
            ['name' => 'pricilia', 'email' => 'pricilia@gmail.com'],
            ['name' => 'ilmi', 'email' => 'ilmi@gmail.com'],
            ['name' => 'daffa', 'email' => 'daffa@gmail.com'],
        ];

        foreach ($users as $user) {
            if (!User::where('email', $user['email'])->exists()) {
                User::create([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => bcrypt('haha1234'),
                    // 'phone_number' => '081234567890', // tambahkan jika wajib
                ]);
                echo "User {$user['name']} created.\n";
            } else {
                echo "User with email {$user['email']} already exists. Skipping...\n";
            }
        }

        // Jalankan UMKMSeeder setelah semua pengguna dibuat
        $this->call([
            UMKMSeeder::class,
            ProductSeeder::class,
            LikeSeeder::class,
            RecommendationSeeder::class,
        ]);
    }
}
