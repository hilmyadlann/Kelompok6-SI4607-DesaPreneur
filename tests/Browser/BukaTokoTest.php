<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BukaTokoTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_user_can_apply_umkm(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/dashboard')
                    ->clickLink('Buka Toko')
                    ->waitForText('SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!')
                    ->type('#nama', 'dusk test nama umkm')
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
                    ->assertSee('Form ini sedang menunggu persetujuan admin')
                    ->pause(2000);
        });
    }
}
