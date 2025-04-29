<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterFullTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    
     public function test_user_cant_register_with_blank_column(): void
     {
         $this->browse(function (Browser $browser) {
             $browser->visit('/register')
                     ->assertSee('Silahkan Daftarkan Akun Anda')
                     ->pause(1000)
                     ->press('Daftar')
                     ->assertPathIs('/register')
                     ->pause(1000);  
         });
     }  

     public function test_user_cant_register_only_fill_name(): void
     {
         $this->browse(function (Browser $browser) {
             $browser->visit('/register')
                     ->assertSee('Silahkan Daftarkan Akun Anda')
                     ->pause(1000)
                     ->type('name', 'amandaa')
                     ->press('Daftar')
                     ->assertPathIs('/register')
                     ->pause(1000);  
         });
     }  

     public function test_user_cant_register_only_fill_name_and_email(): void
     {
         $this->browse(function (Browser $browser) {
             $browser->visit('/register')
                     ->assertSee('Silahkan Daftarkan Akun Anda')
                     ->pause(1000)
                     ->type('name', 'amandaa')
                     ->type('email', 'amandaa@gmail.com')
                     ->press('Daftar')
                     ->assertPathIs('/register')
                     ->pause(1000);  
         });
     } 
     
     public function test_user_cant_register_only_fill_name_email_and_no(): void
     {
         $this->browse(function (Browser $browser) {
             $browser->visit('/register')
                     ->assertSee('Silahkan Daftarkan Akun Anda')
                     ->pause(1000)
                     ->type('name', 'amandaa')
                     ->type('email', 'amandaa@gmail.com')
                     ->type('no_hp', '091781726783')
                     ->press('Daftar')
                     ->assertPathIs('/register')
                     ->pause(1000);  
         });
     } 

     public function test_user_cant_register_only_fill_name_email_no_and_password(): void
     {
         $this->browse(function (Browser $browser) {
             $browser->visit('/register')
                     ->assertSee('Silahkan Daftarkan Akun Anda')
                     ->pause(1000)
                     ->type('name', 'amandaa')
                     ->type('email', 'amandaa@gmail.com')
                     ->type('no_hp', '091781726783')
                     ->type('password', 'amanda12345')
                     ->press('Daftar')
                     ->assertPathIs('/register')
                     ->pause(1000);  
         });
     } 

     public function test_user_cant_register_only_fill_name_email_no_and_pass_confirmation(): void
     {
         $this->browse(function (Browser $browser) {
             $browser->visit('/register')
                     ->assertSee('Silahkan Daftarkan Akun Anda')
                     ->pause(1000)
                     ->type('name', 'amandaa')
                     ->type('email', 'amandaa@gmail.com')
                     ->type('no_hp', '091781726783')
                     ->type('password_confirmation', 'amanda12345')
                     ->press('Daftar')
                     ->assertPathIs('/register')
                     ->pause(1000);  
         });
     } 

     public function test_user_cant_register_with_email_without_at(): void
     {
         $this->browse(function (Browser $browser) {
             $browser->visit('/register')
                     ->assertSee('Silahkan Daftarkan Akun Anda')
                     ->pause(1000)
                     ->type('name', 'amandaa')
                     ->type('email', 'amandaa12345678')
                     ->type('no_hp', '091781726783')
                     ->type('password', 'amanda12345')
                     ->type('password_confirmation', 'amanda12345')
                     ->press('Daftar')
                     ->assertPathIs('/register')
                     ->pause(1000);  
         });
     } 

     public function test_user_cant_register_with_email_without_domain(): void
     {
         $this->browse(function (Browser $browser) {
             $browser->visit('/register')
                     ->assertSee('Silahkan Daftarkan Akun Anda')
                     ->pause(1000)
                     ->type('name', 'amandaa')
                     ->type('email', 'amandaa@')
                     ->type('no_hp', '091781726783')
                     ->type('password', 'amanda12345')
                     ->type('password_confirmation', 'amanda12345')
                     ->press('Daftar')
                     ->assertPathIs('/register')
                     ->pause(1000);  
         });
     } 

     public function test_user_cant_register_with_email_without_username(): void
     {
         $this->browse(function (Browser $browser) {
             $browser->visit('/register')
                     ->assertSee('Silahkan Daftarkan Akun Anda')
                     ->pause(1000)
                     ->type('name', 'amandaa')
                     ->type('email', '@gmail.com')
                     ->type('no_hp', '091781726783')
                     ->type('password', 'amanda12345')
                     ->type('password_confirmation', 'amanda12345')
                     ->press('Daftar')
                     ->assertPathIs('/register')
                     ->pause(1000);  
         });
     } 

     public function test_user_cant_register_with_email_contain_space(): void
     {
         $this->browse(function (Browser $browser) {
             $browser->visit('/register')
                     ->assertSee('Silahkan Daftarkan Akun Anda')
                     ->pause(1000)
                     ->type('name', 'amandaa')
                     ->type('email', 'amanda @gmail.com')
                     ->type('no_hp', '091781726783')
                     ->type('password', 'amanda12345')
                     ->type('password_confirmation', 'amanda12345')
                     ->press('Daftar')
                     ->assertPathIs('/register')
                     ->pause(1000);  
         });
     } 

     public function test_user_cant_register_with_email_contain_illegal_char(): void
     {
         $this->browse(function (Browser $browser) {
             $browser->visit('/register')
                     ->assertSee('Silahkan Daftarkan Akun Anda')
                     ->pause(1000)
                     ->type('name', 'amandaa')
                     ->type('email', 'amanda@gm#ail.com')
                     ->type('no_hp', '091781726783')
                     ->type('password', 'amanda12345')
                     ->type('password_confirmation', 'amanda12345')
                     ->press('Daftar')
                     ->assertPathIs('/register')
                     ->pause(1000);  
         });
     } 

     public function test_user_cant_register_with_number_is_a_text(): void
     {
         $this->browse(function (Browser $browser) {
             $browser->visit('/register')
                     ->assertSee('Silahkan Daftarkan Akun Anda')
                     ->pause(1000)
                     ->type('name', 'amandaa')
                     ->type('email', 'amanda121@gmail.com')
                     ->type('no_hp', 'abcdefg')
                     ->type('password', 'amanda12345')
                     ->type('password_confirmation', 'amanda12345')
                     ->press('Daftar')
                     ->assertPathIs('/register')
                     ->pause(1000);  
         });
     } 

     public function test_user_cant_register_with_number_mix_illegal_char(): void
     {
         $this->browse(function (Browser $browser) {
             $browser->click('span[onclick="toggleDropdown()"]')
                     ->press('Logout')
                     ->visit('/register')
                     ->assertSee('Silahkan Daftarkan Akun Anda')
                     ->pause(1000)
                     ->type('name', 'amandaa')
                     ->type('email', 'amanda090@gmail.com')
                     ->type('no_hp', '12345##12345')
                     ->type('password', 'amanda12345')
                     ->type('password_confirmation', 'amanda12345')
                     ->press('Daftar')
                     ->assertPathIs('/register')
                     ->pause(1000);  
         });
     } 

     public function test_user_cant_register_with_password_less_than_8(): void
     {
 
         $this->browse(function (Browser $browser) {
             $browser->click('span[onclick="toggleDropdown()"]')
                     ->press('Logout')
                     ->visit('/register')
                     ->assertSee('Silahkan Daftarkan Akun Anda')
                     ->pause(1000)
                     ->type('name', 'amandaa')
                     ->type('email', 'amanda090@gmail.com')
                     ->type('no_hp', '081766289736')
                     ->type('password', 'pass12')
                     ->type('password_confirmation', 'pass12')
                     ->press('Daftar')
                     ->assertPathIs('/register')
                     ->pause(1000); 
         });
     } 

     public function test_user_cant_register_with_missmatch_password(): void
     {
         $this->browse(function (Browser $browser) {
             $browser->visit('/register')
                     ->assertSee('Silahkan Daftarkan Akun Anda')
                     ->pause(1000)
                     ->type('name', 'amandaa')
                     ->type('email', 'amandaa@gmail.com')
                     ->type('no_hp', '081726837652')
                     ->type('password', 'amanda12345')
                     ->type('password_confirmation', 'amanda54321')
                     ->press('Daftar')
                     ->assertPathIs('/register')
                     ->pause(1000);  
         });
     } 

     public function test_user_can_register_with_valid_credential(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Silahkan Daftarkan Akun Anda')
                    ->type('name', 'testing duskkk')
                    ->type('email', 'testingduskkk@gmail.com')
                    ->type('no_hp', '12345678')
                    ->type('password', '12345678')
                    ->type('password_confirmation', '12345678')
                    ->press('Daftar')
                    ->assertPathIs('/dashboard')
                    ->pause(1000);  
        });
    }

     
    
    
    
    
    
}
