<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EmptyListVisibleTest extends DuskTestCase
{
    /**
     * Check that a list container is present but empty on page load
     * 
     * @return void
     */
    public function testEmptyListVisible()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSeeNothingIn('#results-container');
        });
    }
}
