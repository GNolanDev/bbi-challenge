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
     * @return string|false
     */
    public function format($inputJSON)
    {
        if (!($decodedInput = json_decode($inputJSON))) {
            return false;
        }
        if (!(gettype($decodedInput) === 'object' &&
            isset(
                $decodedInput->tracks->items[0]->duration_ms,
                $decodedInput->tracks->items[0]->artists[0]->name,
                $decodedInput->tracks->items[0]->name
            )
        )) {
            return false;
        }
        // required properties are present, create new object for returning
        $returnObject = [];
        foreach ($decodedInput->tracks->items as $key => $value) {
            $returnObject['tracks'][$key]['artist_name'] =
                $value->artists[0]->name;
            $returnObject['tracks'][$key]['duration_ms'] =
                $value->duration_ms;
            $returnObject['tracks'][$key]['track_name'] =
                $value->name;
        }
        // may need to add escaping options here later
        return json_encode($returnObject);
    }
}
