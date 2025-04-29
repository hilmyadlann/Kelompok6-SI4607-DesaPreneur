<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ApprovalFullTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_admin_can_approve_umkm(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/admin')
                    ->press('Setujui')
                    ->assertSee('Dashboard Admin')
                    ->pause(2000);
        });
    }

    public function test_admin_can_reject_umkm(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/admin')
                    ->press('Tolak')
                    ->assertSee('Dashboard Admin')
                    ->pause(2000);
        });
    }
}
