<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditProductTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_user_can_edit_product(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/umkm/create')
                    ->assertSee('Selamat, UMKM Anda Berhasil Diverifikasi')
                    ->clickLink('Lihat Profil UMKM Saya')
                    ->assertSee('Produk Toko')
                    ->pause(500)
                    ->clickLink('Edit')
                    ->attach('input[name="images[]"]', 'C:\Users\User\Documents\GitHub\Kelompok1TubesRPL\tests\Browser\photo\kulit ayam.jpg')
                    ->type('name', 'Kulit Ayam Enaaaakk')
                    ->type('description', 'Crunchy outside, Juicy inside')
                    ->press('Update Produk')
                    ->pause(500)
                    ->assertSee('Produk berhasil diperbarui');
        });
    }
}
