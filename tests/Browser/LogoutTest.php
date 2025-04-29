<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LogoutTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_user_can_logout(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(7))
                    ->visit('/dashboard')
                    ->click('span[onclick="toggleDropdown()"]')
                    ->press('Logout')
                    ->pause(1000)
                    ->assertSee('Halo User');
        });
    }
}
