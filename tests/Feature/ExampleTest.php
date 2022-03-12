<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Ensure test suite & basic server are working.
     *
     * @return void
     */
    public function test_server_and_test_suite_are_working()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
