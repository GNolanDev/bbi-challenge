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
                ->value('@query-text', "Help!")
                ->click('@submit-search')
                ->assertVisible('#results-container li');
        });
    }
}
