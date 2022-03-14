<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AtLeastOneTrackNameDisplayedTest extends DuskTestCase
{
    /**
     * Note - requires Front AND Back end functionality
     * Check that at least one track name is present in the list 
     * container after submitting a valid search term
     * 
     * @return void
     */
    public function testAtLeastOneTrackNameDisplayed()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->type('@query-text', "Hello")
                ->click('@submit-search')
                ->waitFor('#results-container li .track-name')
                ->assertVisible('#results-container li .track-name');
        });
    }
}
