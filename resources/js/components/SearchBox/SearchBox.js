import React, { useState } from "react";

export default function SearchBox(props) {
    const [searchterm, setSearchterm] = useState("");

    /* callback function sets the state of parent (form) component
     * ready for use when search button is pressed */
    const updateSearchTerm = props.updateSearchTerm;

    const handleChange = (e) => {
        setSearchterm(e.currentTarget.value);
        updateSearchTerm(e.currentTarget.value);
    };

    // text box value set from state to ensure the input is 'controlled'
    return (
        <input
            type="text"
            dusk="query-text"
            placeholder="Search term"
            onChange={handleChange}
            value={searchterm}
        />
    );
}
