<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AddProductTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_user_can_add_product(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/umkm/create')
                    ->assertSee('Selamat, UMKM Anda Berhasil Diverifikasi')
                    ->clickLink('Lihat Profil UMKM Saya')
                    ->assertSee('Produk Toko')
                    ->pause(500)

                    ->clickLink('Upload Produk')
                    ->assertPathIs('/products-tes/upload')
                    ->pause(500)

                    ->type('name', 'Name Product Dusk')
                    ->type('description', 'Desc Product Dusk')
                    ->type('price', '40000')
                    ->select('category_id', '1')
                    ->type('marketplace_link', 'http://shopee.com')
                    ->attach('input[name="images[]"]', 'C:\Users\User\Documents\GitHub\Kelompok1TubesRPL\tests\Browser\photo\kulit ayam.jpg')
                    ->press('Upload Produk')
                    ->assertSee('Produk Berhasil di Upload')
                    ->pause(1000)

                    ->type('name', 'Macaroon')
                    ->type('description', 'isi 12 pcs')
                    ->type('price', '35000')
                    ->select('category_id', '1')
                    ->type('marketplace_link', 'http://shopee.com')
                    ->attach('input[name="images[]"]', 'C:\Users\User\Documents\GitHub\Kelompok1TubesRPL\tests\Browser\photo\macaron.jpeg')
                    ->press('Upload Produk')
                    ->assertSee('Produk Berhasil di Upload')
                    ->pause(1000)

                    ->type('name', 'Cromboloni')
                    ->type('description', 'Ada rasa coklat dan coffee')
                    ->type('price', '45000')
                    ->select('category_id', '1')
                    ->type('marketplace_link', 'http://shopee.com')
                    ->attach('input[name="images[]"]', 'C:\Users\User\Documents\GitHub\Kelompok1TubesRPL\tests\Browser\photo\cromboloni.jpg')
                    ->press('Upload Produk')
                    ->assertSee('Produk Berhasil di Upload')
                    ->pause(1000);


        });
    }
}