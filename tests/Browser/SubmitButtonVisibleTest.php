<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SubmitButtonVisibleTest extends DuskTestCase
{
    /**
     * @return void
     */
    public function testSubmitButtonVisible()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertVisible('input[type="submit"]');
        });
    }
}
