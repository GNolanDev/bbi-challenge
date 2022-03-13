import React, { useState } from "react";
import SearchBox from "../SearchBox/SearchBox";

export default function SearchForm() {
    /* hold search term as state in the form element to allow
     * for easy submission of search when button is pressed */
    const [searchterm, setSearchterm] = useState("");

    /* function initiates a request to the search API on submission*/
    const handleSubmit = (e) => {
        e.preventDefault();
        //
        //
        console.log("search term is: ", searchterm);
    };

    // callback to pass to search box for keeping state updated
    const updateSearchTerm = (newSearchTerm) => {
        setSearchterm(newSearchTerm);
    };

    return (
        <form onSubmit={handleSubmit}>
            <SearchBox updateSearchTerm={updateSearchTerm} />
            <input
                type="submit"
                name="submit"
                dusk="submit-search"
                value="Search"
            />
        </form>
    );
}
