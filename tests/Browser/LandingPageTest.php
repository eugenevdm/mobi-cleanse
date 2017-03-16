<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LandingPageTest extends DuskTestCase
{

    public function test_landing_page_says_mobi_cleanse()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')
                    -> assertSee('Mobi Cleanse');
        });
    }
}
