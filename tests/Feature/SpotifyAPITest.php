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
    public function test_given_valid_query_and_track_endpoint_spotify_json_returned()
    {
        $spotifyAPI = new \SpotifyAPI;
        $inputString = "Hello";
        $outputJSON = $spotifyAPI->getData($inputString, "track");
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
    /**
     * given a valid query string, a well formed JSON response is returned
     * from the Spotify API, with at least one artist name, popularity and
     * followers
     *
     * @return void
     */
    public function test_given_valid_query_and_artist_endpoint_spotify_json_returned()
    {
        $spotifyAPI = new \SpotifyAPI;
        $inputString = "John";
        $outputJSON = $spotifyAPI->getData($inputString, "artist");
        $outputDecoded = json_decode($outputJSON, true);
        $this->assertTrue(
            $outputDecoded &&
                isset(
                    $outputDecoded['artists']['items'][0]['followers']['total'],
                    $outputDecoded['artists']['items'][0]['popularity'],
                    $outputDecoded['artists']['items'][0]['name']
                )
        );
    }
    /**
     * given a valid query string, a well formed JSON response is returned
     * from the Spotify API, with at least one album name, artist name and 
     * release date
     *
     * @return void
     */
    public function test_given_valid_query_and_album_endpoint_spotify_json_returned()
    {
        $spotifyAPI = new \SpotifyAPI;
        $inputString = "Greatest";
        $outputJSON = $spotifyAPI->getData($inputString, "album");
        $outputDecoded = json_decode($outputJSON, true);
        $this->assertTrue(
            $outputDecoded &&
                isset(
                    $outputDecoded['albums']['items'][0]['artists'][0]['name'],
                    $outputDecoded['albums']['items'][0]['release_date'],
                    $outputDecoded['albums']['items'][0]['name']
                )
        );
    }
}
