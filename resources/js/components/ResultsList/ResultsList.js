import React from "react";
import prettyMilliseconds from "pretty-ms";
import "./ResultsList.css";

export default function ResultsList(props) {
    // render a list of items for each value in the array passed by props

    const listItems = [];
    for (const track in props.resultsObject) {
        listItems.push(
            <li className="result-item" key={track} title="track">
                <div className="track-name">
                    {props.resultsObject[track]["track_name"]}
                </div>
                <div className="artist-name">
                    {props.resultsObject[track]["artist_name"]}
                </div>
                <div className="track-duration">
                    {prettyMilliseconds(
                        parseInt(props.resultsObject[track]["duration_ms"])
                    )}
                </div>
            </li>
        );
    }

    return <ul id="results-container">{listItems}</ul>;
}
