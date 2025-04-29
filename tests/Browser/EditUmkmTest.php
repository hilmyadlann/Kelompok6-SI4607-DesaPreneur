<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditUmkmTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_user_can_edit_umkm(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/umkm/create')
                    ->assertSee('Selamat, UMKM Anda Berhasil Diverifikasi')
                    ->clickLink('Lihat Profil UMKM Saya')
                    ->assertSee('Produk Toko')
                    ->pause(500)
                    ->clickLink('Profil UMKM Saya')
                    ->attach('input[name="images"]', 'C:\Users\User\Documents\GitHub\Kelompok1TubesRPL\tests\Browser\photo\logo.jpg')
                    ->type('nama', 'Nama Updated by Dusk')
                    ->type('deskripsi', 'Deskripsi Updated by Dusk')
                    ->press('Simpan Perubahan')
                    ->pause(2000)
                    ->assertSee('Data UMKM berhasil diperbarui.');
        });
    }
}
