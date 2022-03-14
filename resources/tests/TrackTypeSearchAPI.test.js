/* feature test - 'track' type of search is selectable and returns
 * a correct item in a correct DOM element for this type
 * Note -test depends on responses from mock service worker:
 * see 'src/mocks/handlers.js'
 * uncomment block in 'index.js'
 * */

import { render, screen } from "@testing-library/react";
import userEvent from "@testing-library/user-event";
import "@testing-library/jest-dom";
import React from "react";
import App from "../js/App";

require("isomorphic-fetch");

test("given track type input, correct elements are visible", async () => {
    render(<App />);
    const testString = "TestSearchString";
    const type = "track";
    const searchboxElement = screen.getByPlaceholderText(/Search term/);
    const trackSelectorElement = screen.getByRole("combobox", {
        name: "search-type",
    });
    // type search string and select correct dropdown - extract this part to separate function?
    userEvent.type(searchboxElement, testString);
    userEvent.selectOptions(trackSelectorElement, screen.getByText(type));
    userEvent.click(screen.getByRole("button", { name: /Search/ }));
    // wait for results to be returned
    screen.findByTitle(/Track/i).then(() => {
        expect(screen.findByText(/First Track Name/)).toBeInTheDocument();
    });
});