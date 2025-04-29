<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginFullTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_user_cant_login_with_blank_column(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Selamat datang')
                    ->press('Masuk')
                    ->assertPathIs('/login')
                    ->pause(1000);  
        });
    }

    public function test_user_cant_login_only_fill_email(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Selamat datang')
                    ->type('identifier', 'amandaameliaa1910@gmail.com')
                    ->press('Masuk')
                    ->assertPathIs('/login')
                    ->pause(1000);  
        });
    }

    public function test_user_cant_login_only_fill_number(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Selamat datang')
                    ->type('identifier', '081272918511')
                    ->press('Masuk')
                    ->assertPathIs('/login')
                    ->pause(1000);  
        });
    }

    public function test_user_cant_login_only_fill_password(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Selamat datang')
                    ->type('password', '12345678')
                    ->press('Masuk')
                    ->assertPathIs('/login')
                    ->pause(1000);  
        });
    }

    public function test_user_cant_login_with_email_but_invalid_password(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Selamat datang')
                    ->type('identifier', 'amandaameliaa1910@gmail.com')
                    ->type('password', 'wrongpass123')
                    ->press('Masuk')
                    ->assertPathIs('/login')
                    ->assertSee('The provided credentials do not match our records')
                    ->pause(1000);  
        });
    }

    public function test_user_cant_login_with_email_but_has_no_domain(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Selamat datang')
                    ->type('identifier', 'amandaameliaa1910')
                    ->type('password', '12345678')
                    ->press('Masuk')
                    ->assertPathIs('/login')
                    ->assertSee('The provided credentials do not match our records')
                    ->pause(1000);  
        });
    }

    public function test_user_can_login_with_valid_email_and_password(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Selamat datang')
                    ->type('identifier', 'amandaameliaa1910@gmail.com')
                    ->type('password', '12345678')
                    ->press('Masuk')
                    ->assertPathIs('/dashboard')
                    ->click('span[onclick="toggleDropdown()"]')
                    ->press('Logout')
                    ->pause(1000);  
        });
    }

    public function test_user_can_login_with_valid_number_and_password(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Selamat datang')
                    ->type('identifier', '081272918511')
                    ->type('password', '12345678')
                    ->press('Masuk')
                    ->assertPathIs('/dashboard')
                    ->click('span[onclick="toggleDropdown()"]')
                    ->press('Logout')
                    ->pause(1000);  
        });
    }

    
    
}
