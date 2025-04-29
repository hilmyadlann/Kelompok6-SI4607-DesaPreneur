<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{

    /**
     * A Dusk test example.
     */
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
}
