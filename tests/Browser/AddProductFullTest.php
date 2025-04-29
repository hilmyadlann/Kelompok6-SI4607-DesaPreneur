<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AddProductFullTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_user_can_add_product(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/toko/1')
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
                    ->pause(1000);
        });
    }

    public function test_user_cant_add_product_all_field_blank(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/toko/1')
                    ->assertSee('Produk Toko')
                    ->pause(500)

                    ->clickLink('Upload Produk')
                    ->assertPathIs('/products-tes/upload')
                    ->pause(500)

                    ->press('Upload Produk')
                    ->pause(1000);
        });
    }

    public function test_user_cant_add_product_name_more_255_char(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/toko/1')
                    ->assertSee('Produk Toko')
                    ->pause(500)

                    ->clickLink('Upload Produk')
                    ->assertPathIs('/products-tes/upload')
                    ->pause(500)

                    ->type('name', 'Eksklusif Paket Perawatan Kulit dan Rambut: Rangkaian Produk Perawatan Wajah Anti-Penuaan, Serum Antioksidan, Masker Rambut Revitalisasi, dan Pelembap Intensif untuk Kulit Kering, Normal, Berminyak, dan Kombinasi dengan Ekstrak Bunga Langka, Minyak Esensial Alami, dan Teknologi Nano Terbaru')
                    ->type('description', 'Desc Product Dusk')
                    ->type('price', '40000')
                    ->select('category_id', '1')
                    ->type('marketplace_link', 'http://shopee.com')
                    ->attach('input[name="images[]"]', 'C:\Users\User\Documents\GitHub\Kelompok1TubesRPL\tests\Browser\photo\kulit ayam.jpg')
                    ->press('Upload Produk')
                    ->assertSee('The name field must not be greater than 255 characters.')
                    ->pause(1000);
        });
    }

    public function test_user_cant_add_product_no_select_category(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/toko/1')
                    ->assertSee('Produk Toko')
                    ->pause(500)

                    ->clickLink('Upload Produk')
                    ->assertPathIs('/products-tes/upload')
                    ->pause(500)

                    ->type('name', 'Name Product Dusk')
                    ->type('description', 'Desc Product Dusk')
                    ->type('price', '40000')
                    ->type('marketplace_link', 'http://shopee.com')
                    ->attach('input[name="images[]"]', 'C:\Users\User\Documents\GitHub\Kelompok1TubesRPL\tests\Browser\photo\kulit ayam.jpg')
                    ->press('Upload Produk')
                    ->pause(1000);
        });
    }

    public function test_user_cant_add_product_with_invalid_marketplace_url(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/toko/1')
                    ->assertSee('Produk Toko')
                    ->pause(500)

                    ->clickLink('Upload Produk')
                    ->assertPathIs('/products-tes/upload')
                    ->pause(500)

                    ->type('name', 'Name Product Dusk')
                    ->type('description', 'Desc Product Dusk')
                    ->type('price', '40000')
                    ->select('category_id', '1')
                    ->type('marketplace_link', 'testmarketplace')
                    ->attach('input[name="images[]"]', 'C:\Users\User\Documents\GitHub\Kelompok1TubesRPL\tests\Browser\photo\kulit ayam.jpg')
                    ->press('Upload Produk')
                    ->assertSee('invalid format')
                    ->pause(1000);
        });
    }


}
