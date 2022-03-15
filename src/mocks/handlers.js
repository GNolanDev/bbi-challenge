// src/mocks/handlers.js
import { rest } from "msw";
import data from "./test-data";

export const handlers = [
    // Handles a GET /api request
    rest.get("/api/:searchType", (req, res, ctx) => {
        /* if query string is "TestSearchString", return a well formed JSON
         * response, otherwise return 400 (bad request) */
        const queryString = req.url.searchParams.get("q");
        const { searchType } = req.params;
        console.log(queryString, searchType);
        /* filter request, respond with 404 if URL is incorrect or search type is not one of the available methods -  TODO: extract available methods to separate file? */
        if (
            !queryString ||
            "TestSearchString" !== queryString ||
            !["track", "artist", "album"].includes(searchType)
        ) {
            return res(ctx.status(404));
        }
        console.log(data[searchType]);
        // return the appropriate data from test-data.js
        return (
            res(ctx.status(200), ctx.json(data[searchType])) ??
            res(ctx.status(404))
        );
    }),
];
