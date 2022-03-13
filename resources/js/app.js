import React, { useState } from "react";
import SearchForm from "./components/SearchForm/SearchForm";

export default function App() {
    /* hold search term as state in the app element to allow
     * for easy submission of search when button is pressed */
    const [searchterm, setSearchterm] = useState("Search term");

    /* function initiates a request to the search API on submission*/
    const handleSubmit = (e) => {
        e.preventDefault();

        //
        console.log("search term is: ", searchterm);
    };

    // callback to pass to search box for keeping state updated
    const updateSearchTerm = (e) => {
        setSearchterm(e.currentTarget.value);
    };

    return (
        <SearchForm
            updateSearchTerm={updateSearchTerm}
            searchTerm={searchterm}
            onSubmit={handleSubmit}
        />
    );
}
