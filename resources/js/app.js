import React, { useState } from "react";
import SearchForm from "./components/SearchForm/SearchForm";
import ResultsList from "./components/ResultsList/ResultsList";

export default function App() {
    /* hold search term as state in the app element to allow
     * for easy submission of search when button is pressed */
    const [searchTerm, setSearchTerm] = useState("");
    const [searchType, setSearchType] = useState("track");
    const [resultsObject, setResultsObject] = useState({});

    /* function initiates a request to the search API on submission*/
    const handleSubmit = (e) => {
        e.preventDefault();
        fetch(
            window.location.protocol +
                "//" +
                window.location.host +
                "/api/" +
                searchType +
                "?q=" +
                searchTerm,
            {
                method: "GET",
                headers: new Headers({
                    "Cache-Control": "max-age=0",
                }),
            }
        )
            .then((response) => {
                if (response.ok) {
                    return response.json();
                }
                return Promise.reject(new Error("bad response"));
            })
            .then((responseJSON) => {
                /* check validity of response - more validation
                 * could be done here */
                const tracks = responseJSON["tracks"] ?? false;
                if (
                    !(
                        tracks &&
                        "0" in tracks &&
                        "artist_name" in tracks["0"] &&
                        "duration_ms" in tracks["0"] &&
                        "track_name" in tracks["0"]
                    )
                ) {
                    return Promise.reject(new Error("bad response"));
                }
                return setResultsObject(tracks);
            })
            .catch((err) => {
                // fail quietly
            });

        // console.log("search term is: ", searchterm);
    };

    // callbacks to pass to search box for keeping state updated
    const updateSearchType = (e) => {
        if (["album", "artist", "track"].includes(e.currentTarget.value)) {
            setSearchType(e.currentTarget.value);
        }
    };

    const updateSearchTerm = (e) => {
        setSearchTerm(e.currentTarget.value);
    };

    return (
        <>
            <SearchForm
                updateSearchTerm={updateSearchTerm}
                updateSearchType={updateSearchType}
                searchTerm={searchTerm}
                searchType={searchType}
                onSubmit={handleSubmit}
            />
            <ResultsList resultsObject={resultsObject} />
        </>
    );
}
