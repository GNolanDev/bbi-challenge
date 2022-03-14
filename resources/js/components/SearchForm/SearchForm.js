import React from "react";
import SearchBox from "../SearchBox/SearchBox";
import "./SearchForm.css";

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
