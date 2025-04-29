<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginAdminTest extends DuskTestCase
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

    
}
