import React from "react";
import "./ResultsList.css";
import prettyMilliseconds from "pretty-ms";

export default function ResultsList(props) {
    // render a list of items for each value in the array passed by props
    const listItems = [];
    if (props.resultsObject[0])
        if ("track_name" in props.resultsObject[0]) {
            for (const item in props.resultsObject) {
                listItems.push(
                    <li className="result-item" title="track" key={item}>
                        <div className="track-name">
                            {props.resultsObject[item]["track_name"]}
                        </div>
                        <div className="artist-name">
                            {props.resultsObject[item]["artist_name"]}
                        </div>
                        <div className="track-duration">
                            {prettyMilliseconds(
                                parseInt(
                                    props.resultsObject[item]["duration_ms"]
                                )
                            )}
                        </div>
                    </li>
                );
            }
        } else if ("followers" in props.resultsObject[0]) {
            for (const item in props.resultsObject) {
                listItems.push(
                    <li className="result-item" title="artist" key={item}>
                        <div className="artist-name">
                            {props.resultsObject[item]["artist_name"]}
                        </div>
                        <div className="artist-followers">
                            {props.resultsObject[item]["followers"]}
                        </div>
                        <div className="artist-popularity">
                            {props.resultsObject[item]["popularity"]}
                        </div>
                    </li>
                );
            }
        } else if ("album_name" in props.resultsObject[0]) {
            for (const item in props.resultsObject) {
                listItems.push(
                    <li className="result-item" title="album" key={item}>
                        <div className="album-name">
                            {props.resultsObject[item]["album_name"]}
                        </div>
                        <div className="artist-name">
                            {props.resultsObject[item]["artist_name"]}
                        </div>
                        <div className="release-date">
                            {props.resultsObject[item]["release_date"]}
                        </div>
                    </li>
                );
            }
        }

    return <ul id="results-container">{listItems}</ul>;
}
