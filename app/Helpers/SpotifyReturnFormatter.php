<?php

/* Takes JSON in Spotify API format, returns JSON with only the required
 *  properties to send back to the client to limit unnecessary bandwidth
 * if invalid or badly formed, return false */
class SpotifyReturnFormatter
{
    /**
     * Standard formatter for "track" search, add more as required
     *
     * @param string $inputJSON
     * @param string $searchType
     * @return string|false
     */
    public function format($inputJSON, $searchType)
    {
        if (!($decodedInput = json_decode($inputJSON))) {
            return false;
        }
        if (
            !(gettype($decodedInput) === 'object') ||
            ($searchType === "track" && !isset(
                $decodedInput->tracks->items[0]->duration_ms,
                $decodedInput->tracks->items[0]->artists[0]->name,
                $decodedInput->tracks->items[0]->name
            )) ||
            ($searchType === "artist" && !isset(
                $decodedInput->artists->items[0]->followers->total,
                $decodedInput->artists->items[0]->popularity,
                $decodedInput->artists->items[0]->name
            )) ||
            ($searchType === "album" && !isset(
                $decodedInput->albums->items[0]->artists[0]->name,
                $decodedInput->albums->items[0]->release_date,
                $decodedInput->albums->items[0]->name
            ))
        ) {
            return false;
        }
        // required properties are present, create new object for returning
        $returnObject = [];
        switch ($searchType) {
            case 'track':
                foreach ($decodedInput->tracks->items as $key => $value) {
                    $returnObject['tracks'][$key]['artist_name'] =
                        $value->artists[0]->name;
                    $returnObject['tracks'][$key]['duration_ms'] =
                        $value->duration_ms;
                    $returnObject['tracks'][$key]['track_name'] =
                        $value->name;
                }
                break;
            case 'artist':
                foreach ($decodedInput->artists->items as $key => $value) {
                    $returnObject['artists'][$key]['artist_name'] =
                        $value->name;
                    $returnObject['artists'][$key]['followers'] =
                        $value->followers->total;
                    $returnObject['artists'][$key]['popularity'] =
                        $value->popularity;
                }
                break;
            case 'album':
                foreach ($decodedInput->albums->items as $key => $value) {
                    $returnObject['albums'][$key]['artist_name'] =
                        $value->artists[0]->name;
                    $returnObject['albums'][$key]['album_name'] =
                        $value->name;
                    $returnObject['albums'][$key]['release_date'] =
                        $value->release_date;
                }
                break;
            default;
        }
        // may need to add escaping options here later

        return json_encode($returnObject);
    }
}
