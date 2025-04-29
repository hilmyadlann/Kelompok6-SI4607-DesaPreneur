<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditUmkmFullTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_user_can_edit_umkm_valid(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/toko/1')
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

    public function test_user_cant_edit_umkm_name_more_255_char(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/toko/1')
                    ->assertSee('Produk Toko')
                    ->pause(500)
                    ->clickLink('Profil UMKM Saya')
                    ->attach('input[name="images"]', 'C:\Users\User\Documents\GitHub\Kelompok1TubesRPL\tests\Browser\photo\logo.jpg')
                    ->type('nama', 'Toko Serba Ada dan Oleh-Oleh Khas Nusantara Bu Asih: Menyediakan berbagai macam produk kebutuhan sehari-hari, mulai dari sembako, alat rumah tangga, hingga oleh-oleh khas dari berbagai daerah di Indonesia. Kualitas terjamin dengan harga bersaing, pelayanan ramah, dan lokasi strategis')
                    ->type('deskripsi', 'Deskripsi Updated by Dusk')
                    ->press('Simpan Perubahan')
                    ->pause(2000)
                    ->assertSee('The nama field must not be greater than 255 characters');
        });
    }

    public function test_user_cant_edit_umkm_with_invalid_wa_url(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/toko/1')
                    ->assertSee('Produk Toko')
                    ->pause(500)
                    ->clickLink('Profil UMKM Saya')
                    ->attach('input[name="images"]', 'C:\Users\User\Documents\GitHub\Kelompok1TubesRPL\tests\Browser\photo\logo.jpg')
                    ->type('nama', 'Toko Baru')
                    ->type('link_whatsapp', 'testlinkwa')
                    ->type('deskripsi', 'Deskripsi Updated by Dusk')
                    ->press('Simpan Perubahan')
                    ->pause(2000)
                    ->assertSee('invalid url');
        });
    }

    public function test_user_cant_edit_umkm_with_invalid_marketplace_url(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/toko/1')
                    ->assertSee('Produk Toko')
                    ->pause(500)
                    ->clickLink('Profil UMKM Saya')
                    ->attach('input[name="images"]', 'C:\Users\User\Documents\GitHub\Kelompok1TubesRPL\tests\Browser\photo\logo.jpg')
                    ->type('nama', 'Toko Baru')
                    ->type('link_marketplace', 'testlinkmarketplace')
                    ->type('deskripsi', 'Deskripsi Updated by Dusk')
                    ->press('Simpan Perubahan')
                    ->pause(2000)
                    ->assertSee('invalid url');
        });
    }

    public function test_user_cant_edit_umkm_with_invalid_googlemaps_url(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/toko/1')
                    ->assertSee('Produk Toko')
                    ->pause(500)
                    ->clickLink('Profil UMKM Saya')
                    ->attach('input[name="images"]', 'C:\Users\User\Documents\GitHub\Kelompok1TubesRPL\tests\Browser\photo\logo.jpg')
                    ->type('nama', 'Toko Baru')
                    ->type('link_marketplace', 'testlinkgooglemaps')
                    ->type('deskripsi', 'Deskripsi Updated by Dusk')
                    ->press('Simpan Perubahan')
                    ->pause(2000)
                    ->assertSee('invalid url');
        });
    }

    

    
}
