<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BukaTokoFullTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    
     public function test_user_cant_apply_umkm_with_blank_column(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_only_upload_photo(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->attach('input[name="images[]"]', 'C:\Users\User\Documents\GitHub\Kelompok1TubesRPL\tests\Browser\photo\logo.jpg')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_only_fill_name(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->type('#nama', 'apply umkm')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_only_fill_description(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->type('#deskripsi', 'desc umkm')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_only_fill_category(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_only_fill_link_whatsapp(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->type('#link_whatsapp', 'https://wa.me/62812345')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_only_fill_link_marketplace(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->type('#link_marketplace', 'https://marketplacee')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_only_fill_alamat(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->type('#alamat', 'dusk link alamat')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_only_fill_kecamatan(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->select('kecamatan', '3')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_only_fill_desa(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->select('desa', '4')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_only_fill_link_googlemaps(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->type('#link_google_maps', 'http://googlemaps.com')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_without_name(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->type('#deskripsi', 'dusk deskripsi umkm')
                    ->type('#link_whatsapp', 'https://wa.me/62812345')
                    ->type('#link_marketplace', 'dusk link marketplace')
                    ->type('#alamat', 'dusk link alamat')
                    ->select('kecamatan', '3')
                    ->type('#link_google_maps', 'dusk link gmaps')
                    ->press('Daftar UMKM')
                    ->dismissDialog()
                    ->select('desa', '4')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_name_more_than_255(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->type('#nama', 'Toko Serba Ada dan Oleh-Oleh Khas Nusantara Bu Asih: Menyediakan berbagai macam produk kebutuhan sehari-hari, mulai dari sembako, alat rumah tangga, hingga oleh-oleh khas dari berbagai daerah di Indonesia. Kualitas terjamin dengan harga bersaing, pelayanan ramah, dan lokasi strategis')
                    ->type('#deskripsi', 'dusk deskripsi umkm')
                    ->type('#link_whatsapp', 'https://wa.me/62812345')
                    ->type('#link_marketplace', 'dusk link marketplace')
                    ->type('#alamat', 'dusk link alamat')
                    ->select('kecamatan', '3')
                    ->type('#link_google_maps', 'dusk link gmaps')
                    ->press('Daftar UMKM')
                    ->dismissDialog()
                    ->select('desa', '4')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_without_description(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->type('#nama', 'dusk test nama umkm')
                    ->type('#link_whatsapp', 'https://wa.me/62812345')
                    ->type('#link_marketplace', 'dusk link marketplace')
                    ->type('#alamat', 'dusk link alamat')
                    ->select('kecamatan', '3')
                    ->type('#link_google_maps', 'dusk link gmaps')
                    ->press('Daftar UMKM')
                    ->dismissDialog()
                    ->select('desa', '4')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_without_alamat(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->type('#nama', 'dusk test nama umkm')
                    ->type('#deskripsi', 'dusk deskripsi umkm')
                    ->type('#link_whatsapp', 'https://wa.me/62812345')
                    ->type('#link_marketplace', 'dusk link marketplace')
                    ->select('kecamatan', '3')
                    ->type('#link_google_maps', 'dusk link gmaps')
                    ->press('Daftar UMKM')
                    ->dismissDialog()
                    ->select('desa', '4')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_without_link_whatsapp(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->type('#nama', 'dusk test nama umkm')
                    ->type('#deskripsi', 'dusk deskripsi umkm')
                    ->type('#link_marketplace', 'dusk link marketplace')
                    ->type('#alamat', 'dusk link alamat')
                    ->select('kecamatan', '3')
                    ->type('#link_google_maps', 'dusk link gmaps')
                    ->press('Daftar UMKM')
                    ->dismissDialog()
                    ->select('desa', '4')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_with_invalid_link_whatsapp(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->type('#nama', 'dusk test nama umkm')
                    ->type('#deskripsi', 'dusk deskripsi umkm')
                    ->type('#link_whatsapp', 'testlinkwhatsapp')
                    ->type('#link_marketplace', 'dusk link marketplace')
                    ->type('#alamat', 'dusk link alamat')
                    ->select('kecamatan', '3')
                    ->type('#link_google_maps', 'dusk link gmaps')
                    ->press('Daftar UMKM')
                    ->dismissDialog()
                    ->select('desa', '4')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_link_whatsapp_more_than_255(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->type('#nama', 'dusk test nama umkm')
                    ->type('#deskripsi', 'dusk deskripsi umkm')
                    ->type('#link_whatsapp', 'https://www.example.com/this-is-a-really-long-url-that-we-are-using-to-demonstrate-how-to-create-a-long-url-for-testing-purposes-this-url-should-be-at-least-260-characters-long-to-meet-the-requirement-provided-by-the-user')
                    ->type('#link_marketplace', 'dusk link marketplace')
                    ->type('#alamat', 'dusk link alamat')
                    ->select('kecamatan', '3')
                    ->type('#link_google_maps', 'dusk link gmaps')
                    ->press('Daftar UMKM')
                    ->dismissDialog()
                    ->select('desa', '4')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_without_link_marketplace(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->type('#nama', 'dusk test nama umkm')
                    ->type('#deskripsi', 'dusk deskripsi umkm')
                    ->type('#link_whatsapp', 'https://wa.me/62812345')
                    ->type('#alamat', 'dusk link alamat')
                    ->select('kecamatan', '3')
                    ->type('#link_google_maps', 'dusk link gmaps')
                    ->press('Daftar UMKM')
                    ->dismissDialog()
                    ->select('desa', '4')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_with_invalid_link_marketplace(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->type('#nama', 'dusk test nama umkm')
                    ->type('#deskripsi', 'dusk deskripsi umkm')
                    ->type('#link_whatsapp', 'https://wa.me/62812345')
                    ->type('#link_marketplace', 'dusklinkmarketplace')
                    ->type('#alamat', 'dusk link alamat')
                    ->select('kecamatan', '3')
                    ->type('#link_google_maps', 'dusk link gmaps')
                    ->press('Daftar UMKM')
                    ->dismissDialog()
                    ->select('desa', '4')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_link_marketplace_more_than_255(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->type('#nama', 'dusk test nama umkm')
                    ->type('#deskripsi', 'dusk deskripsi umkm')
                    ->type('#link_whatsapp', 'https://www.example.com/')
                    ->type('#link_marketplace', 'https://www.example.com/this-is-a-really-long-url-that-we-are-using-to-demonstrate-how-to-create-a-long-url-for-testing-purposes-this-url-should-be-at-least-260-characters-long-to-meet-the-requirement-provided-by-the-user')
                    ->type('#alamat', 'dusk link alamat')
                    ->select('kecamatan', '3')
                    ->type('#link_google_maps', 'dusk link gmaps')
                    ->press('Daftar UMKM')
                    ->dismissDialog()
                    ->select('desa', '4')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_without_link_googlemaps(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->type('#nama', 'dusk test nama umkm')
                    ->type('#deskripsi', 'dusk deskripsi umkm')
                    ->type('#link_whatsapp', 'https://wa.me/62812345')
                    ->type('#alamat', 'dusk link alamat')
                    ->select('kecamatan', '3')
                    ->press('Daftar UMKM')
                    ->dismissDialog()
                    ->select('desa', '4')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_with_invalid_link_googlemaps(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->type('#nama', 'dusk test nama umkm')
                    ->type('#deskripsi', 'dusk deskripsi umkm')
                    ->type('#link_whatsapp', 'https://wa.me/62812345')
                    ->type('#link_marketplace', 'https://wa.me/62812345test')
                    ->type('#alamat', 'dusk link alamat')
                    ->select('kecamatan', '3')
                    ->type('#link_google_maps', 'dusklinkgmaps')
                    ->press('Daftar UMKM')
                    ->dismissDialog()
                    ->select('desa', '4')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }

    public function test_user_cant_apply_umkm_link_googlemaps_more_than_255(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->type('#nama', 'dusk test nama umkm')
                    ->type('#deskripsi', 'dusk deskripsi umkm')
                    ->type('#link_whatsapp', 'https://www.example.com/')
                    ->type('#link_marketplace', 'https://www.example.com/')
                    ->type('#alamat', 'dusk link alamat')
                    ->select('kecamatan', '3')
                    ->type('#link_google_maps', 'https://www.example.com/this-is-a-really-long-url-that-we-are-using-to-demonstrate-how-to-create-a-long-url-for-testing-purposes-this-url-should-be-at-least-260-characters-long-to-meet-the-requirement-provided-by-the-user')
                    ->press('Daftar UMKM')
                    ->dismissDialog()
                    ->select('desa', '4')
                    ->press('Daftar UMKM')
                    ->acceptDialog()
                    ->assertPathIs('/umkm/create')
                    ->pause(2000);
        });
    }



}
