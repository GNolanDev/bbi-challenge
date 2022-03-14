<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AtLeastOneListItemDisplayedTest extends DuskTestCase
{
    /**
     * Note - requires Front AND Back end functionality
     * Check that at least one list item is present in the list 
     * container after submitting a valid search term
     * 
     * @return void
     */
    public function testAtLeastOneListItemDisplayed()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->type('@query-text', "Hello")
                ->click('@submit-search')
                ->waitFor('#results-container li')
                ->assertVisible('#results-container li');
        });
    }
}
