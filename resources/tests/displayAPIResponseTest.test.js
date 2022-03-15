/* test to check a search term can be entered, submitted, and that
 * the response from the API can be received and displayed correctly
 * by checking for the first item details
 * test depends on responses from mock service worker:
 * see 'src/mocks/handlers.js' ^ uncomment block in 'index.js'
 * intention - to separate F/E and B/E test functions */

import { render, screen } from "@testing-library/react";
import userEvent from "@testing-library/user-event";
import "@testing-library/jest-dom";
import React from "react";
import App from "../js/app";

require("isomorphic-fetch");

test("react dom basic test", async () => {
    render(<App />);
    const testString = "TestSearchString";
    const searchboxElement = screen.getByPlaceholderText(/Search term/);
    userEvent.type(searchboxElement, testString);
    // expect(searchboxElement).toHaveValue(testString);
    userEvent.click(screen.getByRole("button", { name: /Search/ }));
    screen.findByText(/First Track Name/).then(() => {
        expect(screen.findByText(/First Track Name/)).toBeInTheDocument();
    });
});
