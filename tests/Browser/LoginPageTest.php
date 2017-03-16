<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginPageTest extends DuskTestCase
{

    public function test_login_works()
    {
        $this->browse(function ($browser) {
            $this->browse(function ($browser) {
                $browser->visit('/login')
                    ->type('email', 'user@domain.com')
                    ->type('password', 'demo12')
                    ->press('Login')
                    ->assertPathIs('/home');
            });
        });
    }
}
