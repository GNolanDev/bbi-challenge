// src/mocks/handlers.js
import { rest } from "msw";

export const handlers = [
    // Handles a GET /api request
    rest.get("/api", (req, res, ctx) => {
        /* if query string is "TestSearchString", return a well formed JSON
         * response, otherwise return 400 (bad request) */
        const queryString = req.url.searchParams.get("q");

        if ("TestSearchString" === queryString) {
            return res(
                ctx.status(200),
                ctx.json({
                    artist_name: "First Artist Name",
                    duration_ms: "120000",
                    track_name: "First Track Name",
                })
            );
        }
        return res(ctx.status(400));
    }),
];
