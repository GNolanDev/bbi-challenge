import React, { useState } from "react";
import SearchBox from "../SearchBox/SearchBox";

export default function SearchForm() {
    /* hold search term as state in the form element to allow
     * for easy submission of search when button is pressed */
    const [searchterm, setSearchterm] = useState("");

    const handleSubmit = (e) => {
        e.preventDefault();
    };

    // callback to pass to search box for keeping state updated
    const updateSearchTerm = (newSearchTerm) => {
        setSearchterm(newSearchTerm);
    };

    return <SearchBox updateSearchTerm={updateSearchTerm} />;
}
