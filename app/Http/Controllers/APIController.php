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
     * @param string $searchType
     * @return string
     */
    public function search(Request $request, $searchType)
    {
        $queryString = $request->input('q');
        $queryValidator = new \QueryValidator;
        $spotifyAPI = new \SpotifyAPI;
        $spotifyReturnFormatter = new \SpotifyReturnFormatter;

        // check search type is one of accepted methods
        if (!in_array($searchType, ['artist', 'album', 'track'])) {
            return response("", 404);
        }

        $returnString = $spotifyReturnFormatter->format(
            $spotifyAPI->getData(
                $queryValidator->validate(
                    $queryString
                ),
                $searchType
            ),
            $searchType
        );
        if ($returnString) {
            return response($returnString, 200, [
                'Content-Type' => 'application/json'
            ]);
        }
        return response("", 400);
    }
}
