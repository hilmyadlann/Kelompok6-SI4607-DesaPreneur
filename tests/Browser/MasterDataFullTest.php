<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MasterDataFullTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_admin_can_add_kecamatan_desa(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/admin')
                    ->clickLink('Manajemen Form Pendaftaran UMKM')
                    ->pause(1000)
                    ->assertPathIs('/admin/form-umkm')
                    ->type('nama_kecamatan', 'Dayeuhkolott')
                    ->type('nama_desa', 'Sukapuraa')
                    ->press('Tambah kecamatan dan desa')
                    ->assertSee('Kecamatan Dayeuhkolott dan Desa Sukapuraa berhasil ditambahkan')
                    ->pause(1000);
        });
    }

    public function test_admin_cant_add_only_nama_kecamatan(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/admin')
                    ->clickLink('Manajemen Form Pendaftaran UMKM')
                    ->pause(1000)
                    ->assertPathIs('/admin/form-umkm')
                    ->type('nama_kecamatan', 'Dayeuhkolot')
                    ->press('Tambah kecamatan dan desa')
                    ->pause(1000);
        });
    }

    public function test_admin_cant_add_only_nama_desa(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/admin')
                    ->clickLink('Manajemen Form Pendaftaran UMKM')
                    ->pause(1000)
                    ->assertPathIs('/admin/form-umkm')
                    ->type('nama_desa', 'Sukapura')
                    ->press('Tambah kecamatan dan desa')
                    ->pause(1000);
        });
    }

    public function test_admin_cant_add_nama_kecamatan_more_255_char(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/admin')
                    ->clickLink('Manajemen Form Pendaftaran UMKM')
                    ->pause(1000)
                    ->assertPathIs('/admin/form-umkm')
                    ->type('nama_kecamatan', 'Desa Kecamatan Sumber Makmur Jaya Sentosa Indah Sejahtera Mulia Abadi Bahagia Damai Sentosa Makmur Sejahtera Abadi Bersatu Kuat Teguh Maju Jaya Raya Sukses Berkah Sentosa Mulia Sari Harapan Damai Sentosa Bahagia Abadi Mulia Makmur Jaya Indah Sentosa Abadi Jaya Selamanya')
                    ->type('nama_desa', 'Sukapura')
                    ->press('Tambah kecamatan dan desa')
                    ->pause(1000);
        });
    }

    public function test_admin_cant_add_nama_desa_more_255_char(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/admin')
                    ->clickLink('Manajemen Form Pendaftaran UMKM')
                    ->pause(1000)
                    ->assertPathIs('/admin/form-umkm')
                    ->type('nama_kecamatan', 'Dayeuhkolot')
                    ->type('nama_desa', 'Desa Kecamatan Sumber Makmur Jaya Sentosa Indah Sejahtera Mulia Abadi Bahagia Damai Sentosa Makmur Sejahtera Abadi Bersatu Kuat Teguh Maju Jaya Raya Sukses Berkah Sentosa Mulia Sari Harapan Damai Sentosa Bahagia Abadi Mulia Makmur Jaya Indah Sentosa Abadi Jaya Selamanya')
                    ->press('Tambah kecamatan dan desa')
                    ->pause(1000);
        });
    }  
}
