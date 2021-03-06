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
            <label htmlFor="search-type-selector">search-type</label>
            <select
                dusk="query-type"
                onChange={props.updateSearchType}
                name="search-type"
                id="search-type-selector"
                value={props.searchType}
            >
                <option value="track">track</option>
                <option value="artist">artist</option>
                <option value="album">album</option>
            </select>
            <input
                type="submit"
                name="submit"
                dusk="submit-search"
                value="Search"
            />
        </form>
    );
}
