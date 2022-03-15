<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class APIControllerResponseTest extends TestCase
{
    /**
     * Given a valid query string by "GET", controller returns valid 
     * JSON containing required properties
     *
     * @return void
     */
    public function test_given_valid_search_returns_good_json()
    {
        $response = $this->get('/api/track?q=Tomorrow',);
        $response->assertJsonStructure([
            'tracks' => [
                '*' => [
                    'artist_name',
                    'duration_ms',
                    'track_name'
                ]
            ]
        ]);
    }
    /**
     * Given an badly formatted query, controller returns 400 
     *
     * @return void
     */
    public function test_given_bad_format_returns_400()
    {
        $response = $this->get('/api/track?wrongparam=Help%21',);
        $response->assertStatus(404);
    }
}
