<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AddDesaTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
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
}
