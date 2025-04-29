<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MainTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_admin_cannot_login_with_invalid_identifier(): void
     {
         $this->browse(function (Browser $browser) {
             $browser->visit('/login')
                     ->assertSee('Selamat datang')
                     ->type('identifier', 'invalid')
                     ->type('password', '00000000')  
                     ->press('Masuk')
                     ->waitForText('The provided credentials do not match our records')
                     ->assertPathIs('/login')
                     ->pause(1000);         
         });
     }
    
     public function test_admin_can_login_with_valid_identifier(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Selamat datang')
                    ->type('identifier', 'admin@123.su')
                    ->type('password', 'superuser')  
                    ->press('Masuk')
                    ->assertPathIs('/admin')
                    ->pause(1000);       
        });
    }

    public function test_admin_can_add_desa(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/admin')
                    ->clickLink('Manajemen Form Pendaftaran UMKM')
                    ->pause(1000)
                    ->assertPathIs('/admin/form-umkm')
                    ->type('nama_kecamatan', 'Bojongsoang')
                    ->type('nama_desa', 'Sukabirus')
                    ->press('Tambah kecamatan dan desa')
                    ->pause(500)
                    ->type('nama_kecamatan', 'Bojongsoang')
                    ->type('nama_desa', 'Sukapura')
                    ->press('Tambah kecamatan dan desa')
                    ->pause(500)
                    ->type('nama_kecamatan', 'Dayeuhkolot')
                    ->type('nama_desa', 'Sukasari')
                    ->press('Tambah kecamatan dan desa')
                    ->assertSee('Kecamatan Dayeuhkolot dan Desa Sukasari berhasil ditambahkan')
                    ->pause(1000);
        });
    }

    public function test_user_can_logout(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/dashboard')
                    ->click('span[onclick="toggleDropdown()"]')
                    ->press('Logout')
                    ->pause(1000)
                    ->assertSee('Halo User');
        });
    }

    public function test_user_can_make_an_account(): void
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Silahkan Daftarkan Akun Anda')
                    ->type('name', 'testing dusk')
                    ->type('email', 'testingdusk@gmail.com')
                    ->type('no_hp', '12345678')
                    ->type('password', '12345678')
                    ->type('password_confirmation', '12345678')
                    ->press('Daftar')
                    ->assertPathIs('/dashboard')
                    ->pause(1000);  
            
        });
    }

    public function test_user_cannot_login_with_invalid_identifier(): void
     {
         $this->browse(function (Browser $browser) {
             $browser->visit('/login')
                     ->assertSee('Selamat datang')
                     ->type('identifier', 'invalid')
                     ->type('password', '00000000')  
                     ->press('Masuk')
                     ->waitForText('The provided credentials do not match our records')
                     ->assertPathIs('/login')
                     ->pause(1000);         
         });
     }
    
     public function test_user_can_login_with_valid_identifier(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Selamat datang')
                    ->type('identifier', '12345678')
                    ->type('password', '12345678')  
                    ->press('Masuk')
                    ->assertPathIs('/dashboard')
                    ->pause(1000);         
        });
    }

    public function test_user_can_apply_umkm(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->pause(1000)
                    ->type('#nama', 'dusk test nama umkm')
                    ->type('#deskripsi', 'dusk deskripsi umkm')
                    ->type('#link_whatsapp', 'https://wa.me/62812345')
                    ->type('#link_marketplace', 'dusk link marketplace')
                    ->type('#alamat', 'dusk link alamat')
                    ->select('kecamatan', '1')
                    ->type('#link_google_maps', 'dusk link gmaps')
                    ->press('Daftar UMKM')
                    ->dismissDialog()
                    ->select('desa', '1')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertSee('Form ini sedang menunggu persetujuan admin')
                    ->pause(2000);
        });
    }

    public function test_admin_can_accept_umkm(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/admin')
                    ->pause(1000)
                    ->press('Setujui')
                    ->assertSee('Dashboard Admin')
                    ->pause(2000);
        });
    }

    public function test_user_can_edit_umkm(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/umkm/create')
                    ->assertSee('Selamat, UMKM Anda Berhasil Diverifikasi')
                    ->clickLink('Lihat Profil UMKM Saya')
                    ->assertSee('Produk Toko')
                    ->pause(1000)
                    ->clickLink('Profil UMKM Saya')
                    ->attach('input[name="images"]', 'C:\Users\User\Documents\GitHub\Kelompok1TubesRPL\tests\Browser\photo\logo.jpg')
                    ->type('nama', 'Nama Updated by Dusk')
                    ->type('deskripsi', 'Deskripsi Updated by Dusk')
                    ->press('Simpan Perubahan')
                    ->pause(2000)
                    ->assertSee('Data UMKM berhasil diperbarui.');
        });
    }

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

    public function test_user_can_edit_product(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/umkm/create')
                    ->assertSee('Selamat, UMKM Anda Berhasil Diverifikasi')
                    ->clickLink('Lihat Profil UMKM Saya')
                    ->assertSee('Produk Toko')
                    ->pause(2000)
                    ->clickLink('Edit')
                    ->attach('input[name="images[]"]', 'C:\Users\User\Documents\GitHub\Kelompok1TubesRPL\tests\Browser\photo\kulit ayam.jpg')
                    ->type('name', 'Kulit Ayam Enaaaakk')
                    ->type('description', 'Crunchy outside, Juicy inside')
                    ->press('Update Produk')
                    ->pause(1000)
                    ->assertSee('Produk berhasil diperbarui');
        });
    }

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
                    ->pause(1000);
        });
    }

}
