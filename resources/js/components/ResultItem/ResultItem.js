import React from "react";
import prettyMilliseconds from "pretty-ms";

export default function ResultItem(props) {
    console.log(props);
    // check which type of item is being passed & render correct list item
    switch (props.resultType) {
        case "track":
            return (
                <li className="result-item" title="track">
                    <div className="track-name">{props.item["track_name"]}</div>
                    <div className="artist-name">
                        {props.item["artist_name"]}
                    </div>
                    <div className="track-duration">
                        {prettyMilliseconds(
                            parseInt(props.item["duration_ms"])
                        )}
                    </div>
                </li>
            );
            break;
        case "artist":
            return (
                <li className="result-item" title="artist">
                    <div className="artist-name">
                        {props.item["artist_name"]}
                    </div>
                    <div className="artist-followers">
                        {props.item["followers"]}
                    </div>
                    <div className="artist-popularity">
                        {props.item["popularity"]}
                    </div>
                </li>
            );
            break;
        default:
            return;
    }
}
