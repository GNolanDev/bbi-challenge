<?php

use Illuminate\Support\Facades\Http;

// sends request to Spotify API with required bearer token and returns the response in JSON format, or false if no good response received
class SpotifyAPI
{
    /* get bearer token securely, allowing raw data 
     * to stay out of version control */

    /**
     * api fetching method
     *
     * @param string $query
     * @return string|false
     */
    public function getData($query, $searchType)
    {
        //URLs
        $spotifyBaseURL =
            "https://api.spotify.com/v1/";
        $spotifyAuthURL =
            "https://accounts.spotify.com/api/token";
        // required data for spotfy authorisation endpoint
        $data = [
            'grant_type' => 'client_credentials'
        ];

        //only allow requests of the correct type
        if (!in_array($searchType, ['artist', 'album', 'track'])) {
            return false;
        }

        // get access token from account.spotify
        $clientId = config('services.spotify.clientid');
        $clientSecret = config('services.spotify.clientsecret');
        $accessResponse = Http::asForm()->withBasicAuth($clientId, $clientSecret)->withOptions([
            'verify' => base_path('cacert.pem'),
        ])->post($spotifyAuthURL, $data);
        $bearerToken = json_decode($accessResponse)->access_token;

        // use access token to access Spotify search API
        // prepare and send a http request using Http Client
        // could use ::withToken here ?
        if (!$bearerToken) return false;
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $bearerToken,
            'Content-Type' => 'application/json'
        ])->withOptions([
            'verify' => base_path('cacert.pem'),
        ])->acceptJson()->get($spotifyBaseURL . 'search/', [
            'type' => $searchType,
            'q' => $query
        ]);
        if ($response->successful() && $response->json()) {
            // return the raw string for decoding
            return $response->body();
        }
        return false;
    }
}
