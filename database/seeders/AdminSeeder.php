<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $adminEmail = 'admin@123.su';

        // Cek apakah admin dengan email tersebut sudah ada
        if (!User::where('email', $adminEmail)->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => $adminEmail,
                'password' => bcrypt('superuser'),
                'role' => 'admin',
            ]);
        } else {
            echo "Admin with email $adminEmail already exists. Skipping...\n";
        }
    }
}
