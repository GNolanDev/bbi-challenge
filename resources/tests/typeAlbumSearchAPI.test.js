/* feature test - 'album' type of search is selectable and returns
 * a correct item in a correct DOM element for this type
 * Note -test depends on responses from mock service worker:
 * see 'src/mocks/handlers.js'
 * uncomment block in 'index.js'
 * */

import { render, screen } from "@testing-library/react";
import userEvent from "@testing-library/user-event";
import "@testing-library/jest-dom";
import React from "react";
import App from "../js/app";

require("isomorphic-fetch");

test("given album type input, correct elements are visible", async () => {
    render(<App />);
    const testString = "TestSearchString";
    const type = "album";
    const searchboxElement = screen.getByPlaceholderText(/Search term/);
    const trackSelectorElement = screen.getByRole("combobox", {
        name: "search-type",
    });
    // type search string and select correct dropdown - extract this part to separate function?
    userEvent.type(searchboxElement, testString);
    userEvent.selectOptions(trackSelectorElement, type);
    userEvent.click(screen.getByRole("button", { name: /Search/ }));
    // wait for results to be returned & find 1st item in tracks list
    screen.findAllByTitle(/album/i).then(() => {
        expect(screen.getAllByTitle(/album/i))[0].toContainElement(
            getByText(/First Album Name/)
        );
    });
});
