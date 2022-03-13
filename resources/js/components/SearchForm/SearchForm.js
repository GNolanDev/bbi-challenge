import React from "react";
import SearchBox from "../SearchBox/SearchBox";

export default function SearchForm(props) {
    return (
        <form onSubmit={props.onSubmit}>
            <SearchBox
                updateSearchTerm={props.updateSearchTerm}
                searchTerm={props.searchTerm}
            />
            <input
                type="submit"
                name="submit"
                dusk="submit-search"
                value="Search"
            />
        </form>
    );
}
