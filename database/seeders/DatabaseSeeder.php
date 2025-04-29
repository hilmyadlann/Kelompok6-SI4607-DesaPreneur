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

        // Menambahkan user "yuwandi" jika belum ada
        $userEmail = 'yuwandi@gmail.com';

        if (!User::where('email', $userEmail)->exists()) {
            User::create([
                'name' => 'yuwandi',
                'email' => $userEmail,
                'password' => bcrypt('123456789'),
                'phone_number' => '1122334455',
            ]);
        } else {
            echo "User with email $userEmail already exists. Skipping...\n";
        }

        // Menambahkan 30 user tambahan dengan email @gmail.com, nomor telepon unik, dan password 'password123'
        $faker = Faker::create();

        $totalUser = 30;

        for ($i = 0; $i < $totalUser; $i++) {
            $name = $faker->firstName;
            $email = $this->generateGmailEmail($name);
            $phoneNumber = $this->generateUniquePhoneNumber();

            User::create([
                'name' => $name,
                'email' => $email,
                'phone_number' => $phoneNumber,
                'password' => bcrypt('password123'),
            ]);
        }

        // Jalankan UMKMSeeder setelah semua pengguna dibuat
        $this->call([
            UMKMSeeder::class,
            ProductSeeder::class, // Menambahkan ProductSeeder
            LikeSeeder::class,
            RecommendationSeeder::class,
        ]);
    }

    private function generateGmailEmail($name)
    {
        // Generate a unique gmail email using the user's name and a random number
        $randomNumber = rand(1000, 9999);
        $email = strtolower($name) . $randomNumber . '@gmail.com';

        // Ensure the generated email is unique
        while (User::where('email', $email)->exists()) {
            $randomNumber = rand(1000, 9999);
            $email = strtolower($name) . $randomNumber . '@gmail.com';
        }

        return $email;
    }

    private function generateUniquePhoneNumber()
    {
        // Generate a unique phone number
        $phoneNumber = '08' . rand(1000000000, 9999999999);

        // Ensure the generated phone number is unique
        while (User::where('phone_number', $phoneNumber)->exists()) {
            $phoneNumber = '08' . rand(1000000000, 9999999999);
        }

        return $phoneNumber;
    }
}
