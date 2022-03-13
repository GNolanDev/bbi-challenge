<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

require_once(dirname(__DIR__, 2) . "\Helpers\QueryValidator.php");
require_once(dirname(__DIR__, 2) . "\Helpers\SpotifyAPI.php");
require_once(dirname(__DIR__, 2) . "\Helpers\SpotifyReturnFormatter.php");

class APIController extends Controller
{
    // handle all requests to the spotify search API
    /**
     * Return the limited track data from Spotify for a given 
     * search string
     * @param Request $request
     * @return string
     */
    public function search(Request $request)
    {
        $queryString = $request->input('q');
        $queryValidator = new \QueryValidator;
        $spotifyAPI = new \SpotifyAPI;
        $spotifyReturnFormatter = new \SpotifyReturnFormatter;
        $returnString = $spotifyReturnFormatter->format(
            $spotifyAPI->getTracks(
                $queryValidator->validate(
                    $queryString
                )
            )
        );
        if ($returnString) {
            return response($returnString, 200, [
                'Content-Type' => 'application/json'
            ]);
        }
        return response("", 400);
    }
}
