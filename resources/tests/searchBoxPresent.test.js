/* test to set up React UI and check for presence of Search Box
 * without the need for the Laravel Back End to be functional */

test("jest testing working", () => {
    expect(true).toBe(true);
});

import { render, screen } from "@testing-library/react";
import "@testing-library/jest-dom";
import React from "react";
import App from "../js/App";

test("react dom basic test", () => {
    render(<App />);
    const searchboxElement = screen.getByPlaceholderText(/Search term/);
    expect(searchboxElement).toBeInTheDocument();
});
