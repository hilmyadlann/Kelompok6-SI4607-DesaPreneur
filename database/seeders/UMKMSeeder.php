<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UMKM;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Category;
use App\Models\User;
use App\Models\Image;
use Faker\Factory as Faker;
use Carbon\Carbon;

class UMKMSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Mengambil semua kategori dari tabel categories
        $categories = Category::pluck('name')->toArray();

        // Mengambil semua ID kecamatan dan desa dari tabel kecamatans dan desas
        $kecamatanIds = Kecamatan::pluck('id')->toArray();
        $desaIds = Desa::pluck('id')->toArray();

        // Mengambil semua pengguna dari tabel users
        $users = User::all();

        // Membuat UMKM untuk setiap pengguna
        foreach ($users as $user) {
            // Lewati pengguna dengan peran 'admin'
            if ($user->role === 'admin') {
                continue;
            }

            // Buat UMKM baru
            $umkm = UMKM::create([
                'user_id' => $user->id, // Menetapkan user_id sesuai dengan pengguna saat ini
                'nama' => $faker->company,
                'deskripsi' => $faker->sentence,
                'kategori' => $faker->randomElement($categories), // Memilih kategori secara acak dari daftar yang valid
                'link_whatsapp' => 'https://wa.link/ndpckp',
                'link_marketplace' => 'https://www.tokopedia.com/kremlinofficial?source=universe&st=product',
                'alamat' => $faker->address,
                'kecamatan' => $faker->randomElement($kecamatanIds), // Memilih ID kecamatan secara acak dari daftar yang valid
                'desa' => $faker->randomElement($desaIds), // Memilih ID desa secara acak dari daftar yang valid
                'link_google_maps' => 'https://www.google.com/maps/place/Telkom+University/@-6.9730017,107.6291105,17z/data=!3m1!4b1!4m6!3m5!1s0x2e68e9adf177bf8d:0x437398556f9fa03!8m2!3d-6.973007!4d107.6316854!16s%2Fm%2F0y6lbq_?entry=ttu',
                'disetujui' => $faker->boolean,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Tambahkan gambar profil ke tabel images
            Image::create([
                'umkms_id' => $umkm->id,
                'image_path' => 'images/99BFWYyPd4uoQoJNJ6As4lplDJx2MYZlb3fzC4UO.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
