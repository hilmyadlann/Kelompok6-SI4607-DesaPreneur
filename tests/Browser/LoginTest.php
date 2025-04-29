<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;


class LoginTest extends DuskTestCase
{

    /**
     * A Dusk test example.
     */
    
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

    

}
