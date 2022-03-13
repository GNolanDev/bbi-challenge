<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

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
        $inputString = "Help!";
        $outputJSON = $spotifyAPI->get($inputString);
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
