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
    public function getTracks($query)
    {
        $bearerToken = config('services.spotify.bearertoken');
        $spotifyBaseURL =
            "https://api.spotify.com/v1/";
        $type = 'track';
        // prepare and send a http request using Http Client
        // could use ::withToken here ?
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $bearerToken,
            'Content-Type' => 'application/json'
        ])->withOptions([
            'verify' => base_path('cacert.pem'),
        ])->get($spotifyBaseURL . 'search/', [
            'type' => $type,
            'q' => $query
        ]);
        if ($response->successful() && $response->json()) {
            // return the raw string for decoding
            return $response->body();
        }
        return false;
    }
}
