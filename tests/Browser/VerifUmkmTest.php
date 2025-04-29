<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class VerifUmkmTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_admin_can_accept_umkm(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/admin')
                    ->press('Setujui')
                    ->assertSee('Dashboard Admin')
                    ->pause(2000);
        });
    }
}
