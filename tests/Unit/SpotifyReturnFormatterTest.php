<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

require(dirname(__DIR__, 2) . "\app\Helpers\SpotifyReturnFormatter.php");

class SpotifyReturnFormatterTest extends TestCase
{
    /**
     * given a valid JSON string, returns JSON with only required properties
     * (artist_name, duration_ms, track_name) ready for responding to client 
     * request
     *
     * @return void
     */
    public function test_given_valid_query_valid_json_returned()
    {
        $spotifyAPI = new \SpotifyReturnFormatter;
        $sampleJSON = file_get_contents(dirname(__DIR__, 1) . '\sample_good.json');
        $outputJSON = $spotifyAPI->format($sampleJSON);
        // convert to array and check for only required properties
        $outputDecoded = json_decode($outputJSON, true);
        $this->assertTrue(
            isset(
                $outputDecoded['tracks'][0]['artist_name'],
                $outputDecoded['tracks'][0]['duration_ms'],
                $outputDecoded['tracks'][0]['track_name']
            ) && (count($outputDecoded['tracks'][0]) === 3)
                && $outputDecoded['tracks'][0]['artist_name'] === 'Phillipa Soo'
                && $outputDecoded['tracks'][0]['duration_ms'] === 249770
                && $outputDecoded['tracks'][0]['track_name'] === 'Helpless'
        );
    }

    /**
     * given an invalid JSON string, returns false
     *
     * @return void
     */
    public function test_given_invalid_query_false_returned()
    {
        $spotifyAPI = new \SpotifyReturnFormatter;
        $sampleJSON = file_get_contents(dirname(__DIR__, 1) . '\sample_bad.json');
        $output = $spotifyAPI->format($sampleJSON);
        // convert to array and check for only required properties
        $this->assertFalse($output);
    }
}
