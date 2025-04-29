<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kecamatan;
use Carbon\Carbon;

class KecamatanSeeder extends Seeder
{
    public function run()
    {
        // Daftar nama kecamatan
        $namaKecamatan = [
            'Arjasari', 'Baleendah', 'Banjaran', 'Bojongsoang', 'Cangkuang',
            'Cicalengka', 'Cikancung', 'Cilengkrang', 'Cileunyi', 'Cimaung',
            'Cimenyan', 'Ciparay', 'Ciwidey', 'Dayeuhkolot', 'Ibun',
            'Katapang', 'Kertasari', 'Kutawaringin', 'Majalaya', 'Margaasih',
            'Margahayu', 'Nagreg', 'Pacet', 'Pameungpeuk', 'Pangalengan',
            'Paseh', 'Pasirjambu', 'Rancabali', 'Rancaekek', 'Solokanjeruk',
            'Soreang'
        ];

        foreach ($namaKecamatan as $nama) {
            Kecamatan::create([
                'nama_kecamatan' => $nama,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
