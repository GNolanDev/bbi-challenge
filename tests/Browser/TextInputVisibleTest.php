<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TextInputVisibleTest extends DuskTestCase
{
    /**
     * @return void
     */
    public function testTextInputVisible()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertVisible('@query-text');
        });
    }
}
