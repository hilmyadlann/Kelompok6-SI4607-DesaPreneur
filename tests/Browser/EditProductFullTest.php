<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditProductFullTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_user_can_edit_product_valid(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/toko/1')
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

    public function test_user_cant_edit_name_more_255_char(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/toko/1')
                    ->assertSee('Produk Toko')
                    ->pause(500)

                    ->clickLink('Edit')
                    ->attach('input[name="images[]"]', 'C:\Users\User\Documents\GitHub\Kelompok1TubesRPL\tests\Browser\photo\kulit ayam.jpg')
                    ->type('name', 'Eksklusif Paket Perawatan Kulit dan Rambut: Rangkaian Produk Perawatan Wajah Anti-Penuaan, Serum Antioksidan, Masker Rambut Revitalisasi, dan Pelembap Intensif untuk Kulit Kering, Normal, Berminyak, dan Kombinasi dengan Ekstrak Bunga Langka, Minyak Esensial Alami, dan Teknologi Nano Terbaru')
                    ->type('description', 'Crunchy outside, Juicy inside')
                    ->press('Update Produk')
                    ->pause(500)
                    ->assertSee('The name field must not be greater than 255 characters');
        });
    }

    public function test_user_cant_edit_umkm_with_invalid_marketplace_url(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/toko/1')
                    ->assertSee('Produk Toko')
                    ->pause(500)

                    ->clickLink('Edit')
                    ->attach('input[name="images[]"]', 'C:\Users\User\Documents\GitHub\Kelompok1TubesRPL\tests\Browser\photo\kulit ayam.jpg')
                    ->type('name', 'Eksklusif Paket Perawatan Kulit dan Rambut: Rangkaian Produk Perawatan Wajah Anti-Penuaan, Serum Antioksidan, Masker Rambut Revitalisasi, dan Pelembap Intensif untuk Kulit Kering, Normal, Berminyak, dan Kombinasi dengan Ekstrak Bunga Langka, Minyak Esensial Alami, dan Teknologi Nano Terbaru')
                    ->type('description', 'Crunchy outside, Juicy inside')
                    ->type('marketplace_link', 'testlinkmarketplace')
                    ->press('Update Produk')
                    ->pause(500)
                    ->assertSee('invalid url');
        });
    }
}
