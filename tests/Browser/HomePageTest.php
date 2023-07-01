<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomePageTest extends DuskTestCase
{
    public function testGuestMayViewPage(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Explore');
        });
    }

    public function testUserMayViewPage(): void
    {
        $this->authenticate();

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Dashboard');
        });
    }
}
