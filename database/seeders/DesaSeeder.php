<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Desa;
use App\Models\Kecamatan; // Import model Kecamatan
use Carbon\Carbon;

class DesaSeeder extends Seeder
{
    public function run()
    {
        // Daftar desa sesuai urutan kecamatan
        $namaDesa = [
            ['Ancolmekar', 'Baros', 'Rancakole'],
            ['Bojongmalaka', 'Malakasari', 'Rancamanyar'],
            ['Banjaran', 'Banjaran Wetan', 'Ciapus'],
            ['Lengkong', 'Cipagalo', 'Buahbatu'],
            ['Bandasari', 'Cangkuang', 'Ciluncat'],
            ['Babakan Peuteuy', 'Cicalengka Kulon', 'Tenjolaya'],
            ['Cihanyir', 'Cikancung', 'Cikasungka'],
            ['Cilengkrang', 'Cipanjalu', 'Ciporeat'],
            ['Cibiru Hilir', 'Cibiru Wetan', 'Cileunyi Kulon'],
            ['Campakamulya', 'Cikalong', 'Cimaung'],
            ['Ciburial', 'Cikadut', 'Cimenyan'],
            ['Babakan', 'Bumiwangi', 'Ciheulang'],
            ['Rawabogo', 'Lebakmuncang', 'Nengkelan'],
            ['Cangkuang Kulon', 'Cangkuang Wetan', 'Citeureup', 'Sukapura'],
            ['Cibeet', 'Dukuh', 'Karyalaksana'],
            ['Banyusari', 'Cilampeni', 'Gandasari'],
            ['Cibeureum', 'Cihawuk', 'Cikembang'],
            ['Buninagara', 'Cibodas', 'Cilame'],
            ['Biru', 'Bojong', 'Majakerta'],
            ['Cigondewah Hilir', 'Lagadar', 'Mekar'],
            ['Margahayu Selatan', 'Margahayu Tengah', 'Sayati'],
            ['Bojong', 'Ciaro', 'Ciherang'],
            ['Cikawao', 'Cikitu', 'Cinanggela'],
            ['Bojongkunci', 'Bojongmanggu', 'Langonsari'],
            ['Banjarsari', 'Lamajang', 'Margaluyu'],
            ['Cigentur', 'Cijagra', 'Cipaku'],
            ['Cibodas', 'Cikoneng', 'Cisondari'],
            ['Alamendah', 'Cipelah', 'Indragiri'],
            ['Bojongloa', 'Bojongsalam', 'Cangkuang'],
            ['Bojongemas', 'Cibodas', 'Langensari'],
            ['Sukajadi', 'Karamatmulya', 'Pamekaran']
        ];

        // Mendapatkan semua ID kecamatan dari tabel kecamatans dengan urutan yang sesuai
        $kecamatanIds = Kecamatan::pluck('id')->toArray();

        foreach ($namaDesa as $index => $desas) {
            foreach ($desas as $desa) {
                Desa::create([
                    'nama_desa' => $desa,
                    'kecamatan_id' => $kecamatanIds[$index], // Memilih ID kecamatan sesuai urutan
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
