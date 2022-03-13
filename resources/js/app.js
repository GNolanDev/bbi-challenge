import React, { useState } from "react";
import SearchForm from "./components/SearchForm/SearchForm";
import ResultsList from "./components/ResultsList/ResultsList";

export default function App() {
    /* hold search term as state in the app element to allow
     * for easy submission of search when button is pressed */
    const [searchterm, setSearchterm] = useState("Search term");
    const [resultsObject, setResultsObject] = useState({});

    /* function initiates a request to the search API on submission*/
    const handleSubmit = (e) => {
        e.preventDefault();
        fetch(
            window.location.protocol +
                "//" +
                window.location.host +
                "/api?q=" +
                searchterm,
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
                // fail quietly & empty the results list
                return setResultsObject({});
            });

        // console.log("search term is: ", searchterm);
    };

    // callback to pass to search box for keeping state updated
    const updateSearchTerm = (e) => {
        setSearchterm(e.currentTarget.value);
    };

    return (
        <>
            <SearchForm
                updateSearchTerm={updateSearchTerm}
                searchTerm={searchterm}
                onSubmit={handleSubmit}
            />
            <ResultsList resultsObject={resultsObject} />
        </>
    );
}
