import React from "react";

export default function SearchBox(props) {
    // text box value set from state to ensure the input is 'controlled'
    return (
        <input
            type="text"
            dusk="query-text"
            placeholder="Search term"
            onChange={props.updateSearchTerm}
            value={props.searchTerm}
        />
    );
}
