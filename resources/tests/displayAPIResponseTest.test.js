/* test to check a search term can be entered, submitteed, and that
 * the respons from the API can be received and displayed correctly
 * by checking for the first item details
 * intention - to separate F/E and B/E test functions */

import { render, screen } from "@testing-library/react";
import userEvent from "@testing-library/user-event";
import "@testing-library/jest-dom";
import React from "react";
import App from "../js/App";

test("react dom basic test", () => {
    render(<App />);
    const testString = "TestSearchString";
    const searchboxElement = screen.getByPlaceholderText(/Search term/);
    userEvent.type(searchboxElement, testString);
    // expect(searchboxElement).toHaveValue(testString);
    userEvent.click(screen.getByRole("button", { name: /Search/ }));
    const firstTrackName = screen.findByText(/First Track Name/);
    expect(firstTrackName).toBeInTheDocument();
});
