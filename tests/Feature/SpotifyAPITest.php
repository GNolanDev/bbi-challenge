<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

require(dirname(__DIR__, 2) . "\app\Helpers\SpotifyAPI.php");

class SpotifyAPITest extends TestCase
{
    /**
     * given a valid query string, a well formed JSON response is returned
     * from the Spotify API, with at least one artist name, track name and
     * duration
     *
     * @return void
     */
    public function test_given_valid_query_spotify_json_returned()
    {
        $spotifyAPI = new \SpotifyAPI;
        $inputString = "Hello";
        $outputJSON = $spotifyAPI->getTracks($inputString);
        $outputDecoded = json_decode($outputJSON, true);
        $this->assertTrue(
            $outputDecoded &&
                isset(
                    $outputDecoded['tracks']['items'][0]['artists'][0]['name'],
                    $outputDecoded['tracks']['items'][0]['duration_ms'],
                    $outputDecoded['tracks']['items'][0]['name']
                )
        );
    }
}
