<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeleteProductTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_user_can_delete_product(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/umkm/create')
                    ->assertSee('Selamat, UMKM Anda Berhasil Diverifikasi')
                    ->clickLink('Lihat Profil UMKM Saya')
                    ->assertSee('Produk Toko')
                    ->pause(500)
                    ->press('Hapus')
                    ->assertSee('Produk berhasil dihapus')
                    ->pause(1000);
        });
    }
}
